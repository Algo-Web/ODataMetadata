<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Enums\ContainerElementKind;
use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Helpers\EntityContainerHelpers;
use AlgoWeb\ODataMetadata\Helpers\SchemaElementHelpers;
use AlgoWeb\ODataMetadata\Helpers\VocabularyAnnotatableHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IEntitySetReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPathExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainerElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionBase;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Internal\RegistrationHelper;
use AlgoWeb\ODataMetadata\StringConst;

class EdmEntityContainer extends EdmElement implements IEntityContainer
{
    use EntityContainerHelpers;
    use SchemaElementHelpers;
    use VocabularyAnnotatableHelpers;
    /**
     * @var string
     */
    private $namespaceName;
    /**
     * @var string
     */
    private $name;
    /**
     * @var array<IEntityContainerElement>
     */
    private $containerElements = [];
    /**
     * @var array<string, IEntitySet>
     */
    private $entitySetDictionary = [];
    /**
     * @var array<string, object>
     */
    private $functionImportDictionary = [];
    /**
     * @var bool
     */
    private $isDefault = false;
    /**
     * @var bool
     */
    private $isLazyLoadEnabled = true;

    /**
     * Initializes a new instance of the EdmEntityContainer class.
     *
     * @param string    $namespaceName     namespace of the entity container
     * @param string    $name              name of the entity container
     * @param bool|null $isDefault
     * @param bool|null $isLazyLoadEnabled
     */
    public function __construct(string $namespaceName, string $name, bool $isDefault = null, bool $isLazyLoadEnabled = null)
    {
        $this->namespaceName     = $namespaceName;
        $this->name              = $name;
        $this->isDefault         = $isDefault;
        $this->isLazyLoadEnabled = $isLazyLoadEnabled;
    }

    /**
     * Gets a collection of the elements of this entity container.
     *
     * @return array|IEntityContainerElement[]
     */
    public function getElements(): array
    {
        return $this->containerElements;
    }

    /**
     *  Searches for an entity set with the given name in this entity container and returns null if no such set exists.
     *
     * @param  string          $setName The name of the element being found
     * @return IEntitySet|null the requested element, or null if the element does not exist
     */
    public function findEntitySet(string $setName): ?IEntitySet
    {
        return array_key_exists($setName, $this->entitySetDictionary) ? $this->entitySetDictionary[$setName] : null;
    }

    /**
     * Searches for function imports with the given name in this entity container and returns empty enumerable if no
     * such function import exists.
     *
     * @param  string                  $functionName the name of the function import being found
     * @return array|IFunctionImport[] a group of the requested function imports, or an empty enumerable if no such function import exists
     */
    public function findFunctionImports(string $functionName): array
    {
        if (array_key_exists($functionName, $this->functionImportDictionary)) {
            $element = $this->functionImportDictionary[$functionName];
            return is_array($element) ? $element : [$element];
        }
        return [];
    }

    /**
     * @return string|null gets the name of this element
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return SchemaElementKind gets the kind of this schema element
     */
    public function getSchemaElementKind(): SchemaElementKind
    {
        return SchemaElementKind::EntityContainer();
    }

    /**
     * @return string gets the namespace this schema element belongs to
     */
    public function getNamespace(): string
    {
        return $this->namespaceName;
    }
    /**
     * Creates and adds a function import to this entity container.
     *
     * @param  string            $name          name of the function import
     * @param  ITypeReference    $returnType    return type of the function import
     * @param  IExpression|null  $entitySet     An entity set containing entities returned by this function import.
     *                                          The two expression kinds supported are IEntitySetReferenceExpression and IPathExpression.
     * @param  bool|null         $sideEffecting a value indicating whether this function import has side-effects
     * @param  bool|null         $composable    a value indicating whether this function import can be composed inside expressions
     * @param  bool|null         $bindable      a value indicating whether this function import can be used as an extension method for the type of the first parameter of this function import
     * @return EdmFunctionImport created function import
     */
    public function AddFunctionImport(string $name, ITypeReference $returnType, ?IExpression $entitySet, ?bool $sideEffecting, ?bool $composable, ?bool $bindable): EdmFunctionImport
    {
        assert($entitySet instanceof IEntitySetReferenceExpression || $entitySet instanceof IPathExpression, 'The two expression kinds supported are IEntitySetReferenceExpression and IPathExpression.');
        $functionImport = new EdmFunctionImport($this, $name, $returnType, $entitySet, $sideEffecting, $composable, $bindable);
        $this->AddElement($functionImport);
        return $functionImport;
    }


    /**
     *  Creates and adds an entity set to this entity container.
     *
     * @param  string       $name        name of the entity set
     * @param  IEntityType  $elementType the entity type of the elements in this entity set
     * @return EdmEntitySet created entity set
     */
    public function AddEntitySet(string $name, IEntityType $elementType): EdmEntitySet
    {
        $entitySet = new EdmEntitySet($this, $name, $elementType);
        $this->AddElement($entitySet);
        return $entitySet;
    }

    /**
     * Adds an entity container element to this entity container.
     * @param IEntityContainerElement $element the element to add
     */
    public function AddElement(IEntityContainerElement $element): void
    {
        $this->containerElements[] = $element;

        switch ($element->getContainerElementKind()) {
            case ContainerElementKind::EntitySet():
                RegistrationHelper::AddElement($element, $element->getName(), $this->entitySetDictionary, [RegistrationHelper::class, 'CreateAmbiguousEntitySetBinding']);
                break;
            case ContainerElementKind::FunctionImport():
                assert($element instanceof IFunctionBase);
                RegistrationHelper::AddFunction($element, $element->getName(), $this->functionImportDictionary);
                break;
            case ContainerElementKind::None():
                throw new InvalidOperationException(StringConst::EdmEntityContainer_CannotUseElementWithTypeNone());
            default:
                throw new InvalidOperationException(StringConst::UnknownEnumVal_ContainerElementKind($element->getContainerElementKind()->getKey()));
        }
    }

    public function isDefault(): ?bool
    {
        return $this->isDefault;
    }


    public function isLazyLoadEnabled(): ?bool
    {
        return $this->isLazyLoadEnabled;
    }
}
