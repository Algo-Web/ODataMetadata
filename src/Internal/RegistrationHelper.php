<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Internal;

use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionBase;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Library\Internal\Ambiguous\AmbiguousEntityContainerBinding;
use AlgoWeb\ODataMetadata\Library\Internal\Ambiguous\AmbiguousEntitySetBinding;
use AlgoWeb\ODataMetadata\Library\Internal\Ambiguous\AmbiguousPropertyBinding;
use AlgoWeb\ODataMetadata\Library\Internal\Ambiguous\AmbiguousTypeBinding;
use AlgoWeb\ODataMetadata\Library\Internal\Ambiguous\AmbiguousValueTermBinding;
use AlgoWeb\ODataMetadata\StringConst;
use ArrayAccess;

/**
 * Class RegistrationHelper.
 * @package AlgoWeb\ODataMetadata
 * @internal
 */
abstract class RegistrationHelper
{
    /**
     * @param ISchemaElement                  $element
     * @param array<string, ISchemaType>      $schemaTypeDictionary
     * @param array<string, IValueTerm>       $valueTermDictionary
     * @param array<string, object>           $functionGroupDictionary
     * @param array<string, IEntityContainer> $containerDictionary
     */
    public static function RegisterSchemaElement(
        ISchemaElement $element,
        array $schemaTypeDictionary,
        array $valueTermDictionary,
        array $functionGroupDictionary,
        array $containerDictionary
    )
    {
        $qualifiedName = $element->FullName();
        switch ($element->getSchemaElementKind()) {
            case SchemaElementKind::Function():
                assert($element instanceof IFunction);
                self::AddFunction($element, $qualifiedName, $functionGroupDictionary);
                break;
            case SchemaElementKind::TypeDefinition():
                assert($element instanceof ISchemaType);
                self::AddElement($element, $qualifiedName, $schemaTypeDictionary, [self::class, 'CreateAmbiguousTypeBinding']);
                break;
            case SchemaElementKind::ValueTerm():
                assert($element instanceof IValueTerm);
                self::AddElement($element, $qualifiedName, $valueTermDictionary, [self::class, 'CreateAmbiguousValueTermBinding()']);
                break;
            case SchemaElementKind::EntityContainer():
                assert($element instanceof IEntityContainer);
                // Add EntityContainers to the dictionary twice to maintian backwards compat with Edms that did not consider EntityContainers to be schema elements.
                self::AddElement($element, $qualifiedName, $containerDictionary, [self::class, 'CreateAmbiguousEntityContainerBinding']);
                self::AddElement($element, $element->getName(), $containerDictionary, [self::class, 'CreateAmbiguousEntityContainerBinding']);
                break;
            case SchemaElementKind::None():
                throw new InvalidOperationException(StringConst::EdmModel_CannotUseElementWithTypeNone());
            default:
                throw new InvalidOperationException(
                    StringConst::UnknownEnumVal_SchemaElementKind($element->getSchemaElementKind()->getKey())
                );
        }
    }

    /**
     * @param IProperty                $element
     * @param string                   $name
     * @param array<string, IProperty> $dictionary
     */
    public static function RegisterProperty(IProperty $element, string $name, array $dictionary)
    {
        self::AddElement($element, $name, $dictionary, [self::class, 'CreateAmbiguousPropertyBinding']);
    }
    //Dictionary
    // Func<T, T, T>
    /**
     * @param IEdmElement                                   $element
     * @param string                                        $name
     * @param array<string, IEdmElement>                    $elementDictionary
     * @param callable(IEdmElement,IEdmElement):IEdmElement $ambiguityCreator
     */
    public static function AddElement($element, string $name, array $elementDictionary, callable $ambiguityCreator)
    {
        if (array_key_exists($name, $elementDictionary)) {
            $preexisting              = $elementDictionary[$name];
            $elementDictionary[$name] = $ambiguityCreator($preexisting, $element);
        } else {
            $elementDictionary[$name] = $element;
        }
    }

    /**
     * @param IFunctionBase         $function
     * @param string                $name
     * @param array<string, object> $functionListDictionary
     */
    public static function AddFunction(IFunctionBase $function, string $name, array $functionListDictionary)
    {
        if (array_key_exists($name, $functionListDictionary)) {
            $functionList = $functionListDictionary[$name];
            if (!is_array($functionList) && !($functionList instanceof ArrayAccess)) {
                $functionListDictionary[$name] = [$functionList];
            }
            $functionListDictionary[$name][] = $function;
        } else {
            $functionListDictionary[$name] = $function;
        }
    }

    public static function CreateAmbiguousTypeBinding(ISchemaType $first, ISchemaType $second): ISchemaType
    {
        if ($first instanceof AmbiguousTypeBinding) {
            $first->addBinding($second);
            return $first;
        }
        return new AmbiguousTypeBinding($first, $second);
    }

    public static function CreateAmbiguousValueTermBinding(IValueTerm $first, IValueTerm $second): IValueTerm
    {
        if ($first instanceof AmbiguousValueTermBinding) {
            $first->AddBinding($second);
            return $first;
        }

        return new AmbiguousValueTermBinding($first, $second);
    }

    public static function CreateAmbiguousEntitySetBinding(IEntitySet $first, IEntitySet $second): IEntitySet
    {
        if ($first instanceof AmbiguousEntitySetBinding) {
            $first->AddBinding($second);
            return $first;
        }

        return new AmbiguousEntitySetBinding($first, $second);
    }

    public static function CreateAmbiguousEntityContainerBinding(IEntityContainer $first, IEntityContainer $second): IEntityContainer
    {
        if ($first instanceof AmbiguousEntityContainerBinding) {
            $first->AddBinding($second);
            return $first;
        }

        return new AmbiguousEntityContainerBinding($first, $second);
    }

    public static function CreateAmbiguousPropertyBinding(IProperty $first, IProperty $second): IProperty
    {
        if ($first instanceof AmbiguousPropertyBinding) {
            $first->AddBinding($second);
            return $first;
        }

        return new AmbiguousPropertyBinding($first->getDeclaringType(), $first, $second);
    }
}
