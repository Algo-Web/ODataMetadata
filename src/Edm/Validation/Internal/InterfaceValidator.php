<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator\VisitorBase;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator\VisitorOfT;
use AlgoWeb\ODataMetadata\Edm\Validation\ObjectLocation;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRuleSet;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\ICheckable;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEdmValidCoreModelElement;
use AlgoWeb\ODataMetadata\Interfaces\ILocatable;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\StringConst;

class InterfaceValidator
{
    private static $interfaceVisitors = null;

    private static $concreteTypeInterfaceVisitors = [];

    private static function getInterfaceVisitors(): iterable
    {
        return self::$interfaceVisitors ?? self::$interfaceVisitors = self::CreateInterfaceVisitorsMap();
    }

    /**
     * @var array
     */
    private $visited = [];
    /**
     * @var array
     */
    private $visitedBad = [];
    /**
     * @var array
     */
    private $danglingReferences = [];
    /**
     * @var array|null
     */
    private $skipVisitation;
    /**
     * @var bool
     */
    private $validateDirectValueAnnotations;
    /**
     * @var IModel|null
     */
    private $model;

    private function __construct(?iterable $skipVisitation, ?IModel $model, bool $validateDirectValueAnnotations)
    {
        $this->skipVisitation                 = iterable_to_array($skipVisitation);
        $this->model                          = $model;
        $this->validateDirectValueAnnotations = $validateDirectValueAnnotations;
    }

    /**
     * @param  IModel               $model
     * @param  ValidationRuleSet    $semanticRuleSet
     * @throws \ReflectionException
     * @return iterable|EdmError[]
     */
    public static function ValidateModelStructureAndSemantics(IModel $model, ValidationRuleSet $semanticRuleSet): iterable
    {
        $modelValidator = new InterfaceValidator(null, $model, true);

        // Perform structural validation of the root object.
        $errors = iterable_to_array($modelValidator->ValidateStructure($model));

        // Then check references for structural integrity using separate validator (in order to avoid adding referenced objects to the this.visited).
        $referencesValidator              = new InterfaceValidator($modelValidator->visited, $model, false);
        $referencesToStructurallyValidate = $modelValidator->danglingReferences;
        while (count($referencesToStructurallyValidate) !== 0) {
            foreach ($referencesToStructurallyValidate as $reference) {
                $errors = array_merge(iterable_to_array($errors), $referencesValidator->ValidateStructure($reference));
            }

            $referencesToStructurallyValidate = $referencesValidator->danglingReferences;
        }
        $critical = array_filter($errors, [ValidationHelper::class, 'IsInterfaceCritical']);
        // If there are any critical structural errors detected, then it is not safe to traverse the root object, so return the errors without further processing.
        if (count($critical) > 0) {
            return $errors;
        }

        // If the root object is structurally sound, apply validation rules to the visited objects that are not known to be bad.
        $semanticValidationContext = new ValidationContext(
            $model,
            function (IEdmElement $item) use ($modelValidator, $referencesValidator): bool {
                return in_array($item, $modelValidator->visitedBad) || in_array($item, $referencesValidator->visitedBad);
            }
        );
        $concreteTypeSemanticInterfaceVisitors = [];
        foreach ($modelValidator->visited as $item) {
            if (!in_array($item, $modelValidator->visitedBad)) {
                /** * @var ValidationRule $rule */
                foreach (self::GetSemanticInterfaceVisitorsForObject(
                    get_class($item),
                    $semanticRuleSet,
                    $concreteTypeSemanticInterfaceVisitors
                ) as $rule) {
                    $rule($semanticValidationContext, $item);
                }
            }
        }

        $errors = array_merge($errors, $semanticValidationContext->getErrors());
        return $errors;
    }

    /**
     * @param  IEdmElement         $item
     * @return iterable|EdmError[]
     */
    public static function GetStructuralErrors(IEdmElement $item): iterable
    {
        $model               = $item instanceof IModel ? $item : null;
        $structuralValidator = new InterfaceValidator(null, $model, $model !== null);
        return $structuralValidator->ValidateStructure($item);
    }

    /**
     * @return iterable|array<string, VisitorBase>
     */
    private static function CreateInterfaceVisitorsMap(): iterable
    {
        $map    = [];
        $handle = opendir('.');
        if (false !== $handle) {
            while (false !== ($entry = readdir($handle))) {
                /** @var string $name */
                $name = substr($entry, -4);
                if ($entry === '.' || $entry === '..' || is_dir($entry) || $name !== '.php') {
                    continue;
                }
                if ($name === 'VisitorBase' || $name === 'VisitorOfT') {
                    continue;
                }
                $class = __CLASS__ . '\\' . $name;
                /** @var VisitorOfT $instance */
                $instance                  = new $class();
                $map[$instance->forType()] = $instance;
            }
        }
        return $map;
    }

    /**
     * @param  string                 $objectType
     * @return iterable|VisitorBase[]
     */
    private static function ComputeInterfaceVisitorsForObject(string $objectType): iterable
    {
        $visitors = [];
        foreach (class_implements($objectType) as $type) {
            $visitor = null;
            if (isset(self::getInterfaceVisitors()[$type])) {
                $visitor    = self::getInterfaceVisitors()[$type];
                $visitors[] = $visitor;
            }
        }

        return $visitors;
    }

    private function GetInterfaceVisitorsForObject(string $objectType): iterable
    {
        $visitors = [];
        if (!isset(self::$concreteTypeInterfaceVisitors[$objectType])) {
            $visitors                                         = self::ComputeInterfaceVisitorsForObject($objectType);
            self::$concreteTypeInterfaceVisitors[$objectType] = $visitors;
        }

        return $visitors;
    }

    public static function CreatePropertyMustNotBeNullError($item, string $propertyName): EdmError
    {
        return new EdmError(
            self::GetLocation($item),
            EdmErrorCode::InterfaceCriticalPropertyValueMustNotBeNull(),
            StringConst::EdmModel_Validator_Syntactic_PropertyMustNotBeNull(get_class($item), $propertyName)
        );
    }

    public static function CreateEnumPropertyOutOfRangeError($item, $enumValue, string $propertyName): EdmError
    {
        return new EdmError(
            self::GetLocation($item),
            EdmErrorCode::InterfaceCriticalEnumPropertyValueOutOfRange(),
            StringConst::EdmModel_Validator_Syntactic_EnumPropertyValueOutOfRange(get_class($item), $propertyName, get_class($enumValue), $enumValue)
        );
    }

    public static function CheckForInterfaceKindValueMismatchError($item, $kind, string $propertyName, string $interface): ?EdmError
    {
        // If object implements an expected interface, return no error.
        if (in_array($interface, class_implements($item))) {
            return null;
        }

        return new EdmError(
            self::GetLocation($item),
            EdmErrorCode::InterfaceCriticalKindValueMismatch(),
            StringConst::EdmModel_Validator_Syntactic_InterfaceKindValueMismatch($kind, get_class($item), $propertyName, $interface)
        );
    }

    public static function CreateInterfaceKindValueUnexpectedError($item, $kind, string $propertyName): EdmError
    {
        return new EdmError(
            self::GetLocation($item),
            EdmErrorCode::InterfaceCriticalKindValueUnexpected(),
            StringConst::EdmModel_Validator_Syntactic_InterfaceKindValueUnexpected($kind, get_class($item), $propertyName)
        );
    }

    public static function CreateTypeRefInterfaceTypeKindValueMismatchError(ITypeReference $item): EdmError
    {
        assert($item->getDefinition() != null, 'item.Definition != null');
        return new EdmError(
            self::GetLocation($item),
            EdmErrorCode::InterfaceCriticalKindValueMismatch(),
            StringConst::EdmModel_Validator_Syntactic_TypeRefInterfaceTypeKindValueMismatch(get_class($item), $item->getDefinition()->getTypeKind()->getKey())
        );
    }

    public static function CreatePrimitiveTypeRefInterfaceTypeKindValueMismatchError(IPrimitiveTypeReference $item): EdmError
    {
        $definition = $item->getDefinition();
        assert($definition instanceof IPrimitiveType, 'item.Definition is IEdmPrimitiveType');
        return new EdmError(
            self::GetLocation($item),
            EdmErrorCode::InterfaceCriticalKindValueMismatch(),
            StringConst::EdmModel_Validator_Syntactic_TypeRefInterfaceTypeKindValueMismatch(get_class($item), $definition->getPrimitiveKind()->getKey())
        );
    }

    public static function ProcessEnumerable($item, ?iterable $enumerable, string $propertyName, array &$targetList, array &$errors): void
    {
        if ($enumerable == null) {
            self::CollectErrors(self::CreatePropertyMustNotBeNullError($item, $propertyName), $errors);
        } else {
            foreach ($enumerable as $enumMember) {
                if ($enumMember != null) {
                    $targetList[] = $enumMember;
                } else {
                    self::CollectErrors(
                        new EdmError(
                            self::GetLocation($item),
                            EdmErrorCode::InterfaceCriticalEnumerableMustNotHaveNullElements(),
                            StringConst::EdmModel_Validator_Syntactic_EnumerableMustNotHaveNullElements(get_class($item), $propertyName)
                        ),
                        $errors
                    );
                    break;
                }
            }
        }
    }

    public static function CollectErrors(?EdmError $newError, ?array &$errors): void
    {
        if ($newError != null) {
            if ($errors == null) {
                $errors = [];
            }

            $errors[] = $newError;
        }
    }

    public static function IsCheckableBad($element): bool
    {
        return $element instanceof ICheckable && $element->getErrors() != null && count($element->getErrors()) > 0;
    }

    public static function GetLocation($item): ILocation
    {
        return $item instanceof ILocatable && $item->getLocation() != null ? $item->getLocation() : new ObjectLocation($item);
    }

    /**
     * @param  string                    $objectType
     * @param  ValidationRuleSet         $ruleSet
     * @param  array                     $concreteTypeSemanticInterfaceVisitors
     * @return iterable|ValidationRule[]
     */
    private static function GetSemanticInterfaceVisitorsForObject(string $objectType, ValidationRuleSet $ruleSet, array &$concreteTypeSemanticInterfaceVisitors): iterable
    {
        $visitors = null;
        if (!isset($concreteTypeSemanticInterfaceVisitors[$objectType])) {
            $visitors = [];
            foreach (class_implements($objectType) as $type) {
                $visitors = array_merge($visitors, $ruleSet->GetRules($type));
            }

            $concreteTypeSemanticInterfaceVisitors[$objectType] = $visitors;
        }

        return $visitors;
    }

    /**
     * @param $item
     * @return iterable|EdmError[]
     */
    private function ValidateStructure($item): iterable
    {
        if ($item instanceof IEdmValidCoreModelElement || in_array($item, $this->visited) || ($this->skipVisitation != null && in_array($item, $this->skipVisitation))) {
            // If we already visited this object, then errors (if any) have already been reported.
            return [];
        }

        $this->visited[] = $item;
        if (in_array($item, $this->danglingReferences)) {
            // If this edm element is visited, then it is no longer a dangling reference.
            $index = array_search($item, $this->danglingReferences);
            unset($this->danglingReferences[$index]);
        }

        //// First pass: collect immediate errors for each interface and collect followup objects for the second pass.

        $immediateErrors = null;
        $followup        = [];
        $references      = [];
        $visitors        = null;
        $visitors        = $this->GetInterfaceVisitorsForObject(get_class($item));
        /** @var VisitorBase $visitor */
        foreach ($visitors as $visitor) {
            $errors = $visitor->Visit($item, $followup, $references);

            // For performance reasons some visitors may return null errors enumerator.
            if ($errors != null) {
                /** @var EdmError $error */
                foreach ($errors as $error) {
                    if ($immediateErrors == null) {
                        $immediateErrors = [];
                    }

                    $immediateErrors[] = $error;
                }
            }
        }

        // End of the first pass: if there are immediate errors, return them without doing the second pass.
        if ($immediateErrors !== null) {
            $this->visitedBad[] = $item;
            return $immediateErrors;
        }

        //// Second pass: collect errors from followup objects.

        $followupErrors = [];

        // An element's direct value annotations are available only through a model,
        // and so are not found in a normal traversal.
        if ($this->validateDirectValueAnnotations) {
            if ($item instanceof IEdmElement) {
                $element = $item;
                foreach ($this->model->getDirectValueAnnotationsManager()->getDirectValueAnnotations($element) as $annotation) {
                    assert($annotation instanceof IDirectValueAnnotation);
                    $followupErrors = array_merge(
                        iterable_to_array($followupErrors),
                        iterable_to_array($this->ValidateStructure($annotation))
                    );
                }
            }
        }

        foreach ($followup as $followupItem) {
            $followupErrors = array_merge($followupErrors, $this->ValidateStructure($followupItem));
        }

        foreach ($references as $referencedItem) {
            $this->CollectReference($referencedItem);
        }

        return $followupErrors;
    }

    private function CollectReference($reference): void
    {
        if (!($reference instanceof IEdmValidCoreModelElement) &&
            !in_array($reference, $this->visited) &&
            ($this->skipVisitation == null || !in_array($reference, $this->skipVisitation))) {
            $this->danglingReferences[] = $reference;
        }
    }
}
