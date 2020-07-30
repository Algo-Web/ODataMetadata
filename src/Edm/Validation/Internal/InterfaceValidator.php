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
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
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
use AlgoWeb\ODataMetadata\Structure\HashSetInternal;

class InterfaceValidator
{
    private static $interfaceVisitors = null;

    private static $concreteTypeInterfaceVisitors = [];

    private static function getInterfaceVisitors(): iterable
    {
        return self::$interfaceVisitors ?? self::$interfaceVisitors = self::createInterfaceVisitorsMap();
    }

    /**
     * @var HashSetInternal
     */
    private $visited;
    /**
     * @var HashSetInternal
     */
    private $visitedBad;
    /**
     * @var HashSetInternal
     */
    private $danglingReferences;
    /**
     * @var HashSetInternal|null
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
        $this->skipVisitation                 = null === $skipVisitation ? null : new HashSetInternal(iterable_to_array($skipVisitation));
        $this->model                          = $model;
        $this->validateDirectValueAnnotations = $validateDirectValueAnnotations;
        $this->visited                        = new HashSetInternal();
        $this->visitedBad                     = new HashSetInternal();
        $this->danglingReferences             = new HashSetInternal();
    }

    /**
     * @param  IModel               $model
     * @param  ValidationRuleSet    $semanticRuleSet
     * @throws \ReflectionException
     * @return iterable|EdmError[]
     */
    public static function validateModelStructureAndSemantics(IModel $model, ValidationRuleSet $semanticRuleSet): iterable
    {
        $modelValidator = new InterfaceValidator(null, $model, true);

        // Perform structural validation of the root object.
        $errors = iterable_to_array($modelValidator->validateStructure($model));

        // Then check references for structural integrity using separate validator (in order to avoid adding referenced objects to the this.visited).
        $referencesValidator              = new InterfaceValidator($modelValidator->visited, $model, false);
        $referencesToStructurallyValidate = $modelValidator->danglingReferences;
        while (count($referencesToStructurallyValidate) !== 0) {
            foreach ($referencesToStructurallyValidate as $reference) {
                $errors = array_merge(iterable_to_array($errors), $referencesValidator->validateStructure($reference));
            }

            $referencesToStructurallyValidate = $referencesValidator->danglingReferences;
        }
        $critical = array_filter($errors, [ValidationHelper::class, 'isInterfaceCritical']);
        // If there are any critical structural errors detected, then it is not safe to traverse the root object, so return the errors without further processing.
        if (count($critical) > 0) {
            return $errors;
        }

        // If the root object is structurally sound, apply validation rules to the visited objects that are not known to be bad.
        $semanticValidationContext = new ValidationContext(
            $model,
            function (IEdmElement $item) use ($modelValidator, $referencesValidator): bool {
                return $modelValidator->visitedBad->contains($item) || $referencesValidator->visitedBad->contains($item);
            }
        );
        $concreteTypeSemanticInterfaceVisitors = [];
        foreach ($modelValidator->visited as $item) {
            if (!$modelValidator->visitedBad->contains($item)) {
                /** * @var ValidationRule $rule */
                foreach (self::getSemanticInterfaceVisitorsForObject(
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
    public static function getStructuralErrors(IEdmElement $item): iterable
    {
        $model               = $item instanceof IModel ? $item : null;
        $structuralValidator = new InterfaceValidator(null, $model, $model !== null);
        return $structuralValidator->validateStructure($item);
    }

    /**
     * @return iterable|array<string, VisitorBase>
     */
    private static function createInterfaceVisitorsMap(): iterable
    {
        $map    = [];
        $handle = opendir('.');
        if (false !== $handle) {
            while (false !== ($entry = readdir($handle))) {
                /** @var string $name */
                $name = substr($entry, 0, -4);
                $ext  = substr($entry, -4);
                if ($entry === '.' || $entry === '..' || is_dir($entry) || $ext !== '.php' || empty($ext)) {
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
    private static function computeInterfaceVisitorsForObject(string $objectType): iterable
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

    private function getInterfaceVisitorsForObject(string $objectType): iterable
    {
        $visitors = [];
        if (!isset(self::$concreteTypeInterfaceVisitors[$objectType])) {
            $visitors                                         = self::computeInterfaceVisitorsForObject($objectType);
            self::$concreteTypeInterfaceVisitors[$objectType] = $visitors;
        }

        return $visitors;
    }

    public static function createPropertyMustNotBeNullError($item, string $propertyName): EdmError
    {
        return new EdmError(
            self::getLocation($item),
            EdmErrorCode::InterfaceCriticalPropertyValueMustNotBeNull(),
            StringConst::EdmModel_Validator_Syntactic_PropertyMustNotBeNull(get_class($item), $propertyName)
        );
    }

    public static function createEnumPropertyOutOfRangeError($item, $enumValue, string $propertyName): EdmError
    {
        return new EdmError(
            self::getLocation($item),
            EdmErrorCode::InterfaceCriticalEnumPropertyValueOutOfRange(),
            StringConst::EdmModel_Validator_Syntactic_EnumPropertyValueOutOfRange(get_class($item), $propertyName, get_class($enumValue), $enumValue)
        );
    }

    public static function checkForInterfaceKindValueMismatchError($item, $kind, string $propertyName, string $interface): ?EdmError
    {
        // If object implements an expected interface, return no error.
        if (in_array($interface, class_implements($item))) {
            return null;
        }

        return new EdmError(
            self::getLocation($item),
            EdmErrorCode::InterfaceCriticalKindValueMismatch(),
            StringConst::EdmModel_Validator_Syntactic_InterfaceKindValueMismatch($kind, get_class($item), $propertyName, $interface)
        );
    }

    public static function createInterfaceKindValueUnexpectedError($item, $kind, string $propertyName): EdmError
    {
        return new EdmError(
            self::getLocation($item),
            EdmErrorCode::InterfaceCriticalKindValueUnexpected(),
            StringConst::EdmModel_Validator_Syntactic_InterfaceKindValueUnexpected($kind, get_class($item), $propertyName)
        );
    }

    public static function createTypeRefInterfaceTypeKindValueMismatchError(ITypeReference $item): EdmError
    {
        EdmUtil::checkArgumentNull($item->getDefinition(), 'item.Definition');
        return new EdmError(
            self::getLocation($item),
            EdmErrorCode::InterfaceCriticalKindValueMismatch(),
            StringConst::EdmModel_Validator_Syntactic_TypeRefInterfaceTypeKindValueMismatch(get_class($item), $item->getDefinition()->getTypeKind()->getKey())
        );
    }

    public static function createPrimitiveTypeRefInterfaceTypeKindValueMismatchError(IPrimitiveTypeReference $item): EdmError
    {
        $definition = $item->getDefinition();
        if (!$definition instanceof IPrimitiveType) {
            throw new InvalidOperationException('item.Definition is IEdmPrimitiveType');
        }
        return new EdmError(
            self::getLocation($item),
            EdmErrorCode::InterfaceCriticalKindValueMismatch(),
            StringConst::EdmModel_Validator_Syntactic_TypeRefInterfaceTypeKindValueMismatch(get_class($item), $definition->getPrimitiveKind()->getKey())
        );
    }

    public static function processEnumerable($item, ?iterable $enumerable, string $propertyName, array &$targetList, array &$errors): void
    {
        if (null === $enumerable) {
            self::collectErrors(self::createPropertyMustNotBeNullError($item, $propertyName), $errors);
        } else {
            foreach ($enumerable as $enumMember) {
                if (null !== $enumMember) {
                    $targetList[] = $enumMember;
                } else {
                    self::collectErrors(
                        new EdmError(
                            self::getLocation($item),
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

    public static function collectErrors(?EdmError $newError, ?array &$errors): void
    {
        if ($newError != null) {
            if ($errors == null) {
                $errors = [];
            }

            $errors[] = $newError;
        }
    }

    public static function isCheckableBad($element): bool
    {
        return $element instanceof ICheckable && null !== $element->getErrors() && count($element->getErrors()) > 0;
    }

    public static function getLocation($item): ILocation
    {
        return $item instanceof ILocatable && null !== $item->getLocation() ? $item->getLocation() : new ObjectLocation($item);
    }

    /**
     * @param  string                    $objectType
     * @param  ValidationRuleSet         $ruleSet
     * @param  array                     $concreteTypeSemanticInterfaceVisitors
     * @return iterable|ValidationRule[]
     */
    private static function getSemanticInterfaceVisitorsForObject(string $objectType, ValidationRuleSet $ruleSet, array &$concreteTypeSemanticInterfaceVisitors): iterable
    {
        $visitors = null;
        if (!isset($concreteTypeSemanticInterfaceVisitors[$objectType])) {
            $visitors = [];
            foreach (class_implements($objectType) as $type) {
                $visitors = array_merge($visitors, $ruleSet->getRules($type));
            }

            $concreteTypeSemanticInterfaceVisitors[$objectType] = $visitors;
        }

        return $visitors;
    }

    /**
     * @param  mixed               $item
     * @return iterable|EdmError[]
     */
    private function validateStructure($item): iterable
    {
        if ($item instanceof IEdmValidCoreModelElement || $this->visited->contains($item) ||
            ($this->skipVisitation != null && $this->skipVisitation->contains($item))) {
            // If we already visited this object, then errors (if any) have already been reported.
            return [];
        }

        $this->visited->add($item);
        if ($this->danglingReferences->contains($item)) {
            // If this edm element is visited, then it is no longer a dangling reference.
            $this->danglingReferences->remove($item);
        }

        //// First pass: collect immediate errors for each interface and collect followup objects for the second pass.

        $immediateErrors = null;
        $followup        = [];
        $references      = [];
        $visitors        = null;
        $visitors        = $this->getInterfaceVisitorsForObject(get_class($item));
        /** @var VisitorBase $visitor */
        foreach ($visitors as $visitor) {
            $errors = $visitor->visit($item, $followup, $references);

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
            $this->visitedBad->add($item);
            return $immediateErrors;
        }

        //// Second pass: collect errors from followup objects.

        $followupErrors = [];

        // An element's direct value annotations are available only through a model,
        // and so are not found in a normal traversal.
        if ($this->validateDirectValueAnnotations) {
            if ($item instanceof IEdmElement) {
                $element = $item;
                EdmUtil::checkArgumentNull($this->model, 'this->model');
                foreach ($this->model->getDirectValueAnnotationsManager()->getDirectValueAnnotations($element) as $annotation) {
                    assert($annotation instanceof IDirectValueAnnotation);
                    $followupErrors = array_merge(
                        iterable_to_array($followupErrors),
                        iterable_to_array($this->validateStructure($annotation))
                    );
                }
            }
        }

        foreach ($followup as $followupItem) {
            $followupErrors = array_merge($followupErrors, $this->validateStructure($followupItem));
        }

        foreach ($references as $referencedItem) {
            $this->collectReference($referencedItem);
        }

        return $followupErrors;
    }

    private function collectReference($reference): void
    {
        if (!($reference instanceof IEdmValidCoreModelElement) &&
            !$this->visited->contains($reference) &&
            ($this->skipVisitation == null || !$this->skipVisitation->contains($reference))) {
            $this->danglingReferences->add($reference);
        }
    }
}
