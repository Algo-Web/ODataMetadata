<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Edm\Internal\Cache;
use AlgoWeb\ODataMetadata\Enums\ConcurrencyMode;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Helpers\StructuredTypeHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Internal\RegistrationHelper;
use AlgoWeb\ODataMetadata\Library\Core\EdmCoreModel;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Common base class for definitions of EDM structured types.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
abstract class EdmStructuredType extends EdmType implements IStructuredType
{
    use StructuredTypeHelpers;
    /**
     * @var IStructuredType
     */
    private $baseStructuredType;
    /**
     * @var IProperty[]
     */
    private $declaredProperties = [];
    /**
     * @var bool
     */
    private $isAbstract;
    /**
     * @var bool
     */
    private $isOpen;
    /**
     * @var Cache
     */
    private $propertiesDictionary;


    /**
     * Initializes a new instance of the EdmStructuredType class.
     * @param bool            $isAbstract         denotes a structured type that cannot be instantiated
     * @param bool            $isOpen             denotes if the type is open
     * @param IStructuredType $baseStructuredType Base type of the type
     */
    public function __construct(bool $isAbstract, bool $isOpen, ?IStructuredType $baseStructuredType)
    {
        $this->baseStructuredType = $baseStructuredType;
        $this->isAbstract         = $isAbstract;
        $this->isOpen             = $isOpen;

        $this->propertiesDictionary = new Cache(self::class, 'array<string, IProperty>');
    }

    /**
     * Gets a value indicating whether this type is abstract.
     *
     * @return bool
     */
    public function isAbstract(): bool
    {
        return $this->isAbstract;
    }

    /**
     * Gets a value indicating whether this type is open.
     *
     * @return bool
     */
    public function isOpen(): bool
    {
        return $this->isOpen;
    }

    /**
     * Gets the base type of this type.
     *
     * @return IStructuredType|null
     */
    public function getBaseType(): ?IStructuredType
    {
        return $this->baseStructuredType;
    }

    /**
     * Gets the properties declared immediately within this type.
     *
     * @return IProperty[]
     */
    public function getDeclaredProperties(): array
    {
        return $this->declaredProperties;
    }

    /**
     * Searches for a structural or navigation property with the given name in this type and all base types and returns
     * null if no such property exists.
     *
     * @param  string         $name the name of the property being found
     * @return IProperty|null the requested property, or null if no such property exists
     */
    public function findProperty(string $name): ?IProperty
    {
        $computerProperties = $this->getPropertiesDictionary();
        return array_key_exists($name, $computerProperties) ? $computerProperties[$name] : null;
    }

    /**
     * Adds the property to this type.
     * @see IProperty::getDeclaringType() of the 'property' must be this type.
     * @param IProperty $property the property being added
     */
    public function AddProperty(IProperty $property): void
    {
        if ($this !== $property->getDeclaringType()) {
            throw new InvalidOperationException(StringConst::EdmModel_Validator_Semantic_DeclaringTypeMustBeCorrect($property->getName()));
        }

        $this->declaredProperties[] = $property;

        $this->propertiesDictionary->clear();
    }

    /**
     * @return array<string, IProperty>
     */
    protected function getPropertiesDictionary(): array
    {
        return $this->propertiesDictionary->getValue($this, [$this, 'ComputePropertiesDictionary']);
    }

    /**
     * Computes the the cached dictionary of properties for this type definition.
     *
     * @return array<string, IProperty> dictionary of properties keyed by their name
     */
    private function ComputePropertiesDictionary(): array
    {
        $properties = [];
        /** @var IProperty $property */
        foreach ($this->Properties() as $property) {
            RegistrationHelper::registerProperty($property, $property->getName(), $properties);
        }

        return $properties;
    }

    /**
     * Creates and adds a nullable structural property to this type.
     *
     * @param  string                $name       name of the property
     * @param  PrimitiveTypeKind     $type       type of the property
     * @param  bool                  $isNullable flag specifying if the property is nullable
     * @return EdmStructuralProperty created structural property
     */
    public function AddStructuralProperty(string $name, PrimitiveTypeKind $type, bool $isNullable = true): EdmStructuralProperty
    {
        $property = new EdmStructuralProperty($this, $name, EdmCoreModel::getInstance()->GetPrimitive($type, $isNullable));
        $this->AddProperty($property);
        return $property;
    }

    /**
     * Creates and adds a structural property to this type.
     *
     * @param  string                $name            name of the property
     * @param  ITypeReference        $type            type of the property
     * @param  string|null           $defaultValue    the default value of this property
     * @param  ConcurrencyMode|null  $concurrencyMode the concurrency mode of this property
     * @return EdmStructuralProperty created structural property
     */
    public function AddStructuralPropertyReferenceReference(string $name, ITypeReference $type, ?string $defaultValue = null, ?ConcurrencyMode $concurrencyMode = null): EdmStructuralProperty
    {
        $property = new EdmStructuralProperty($this, $name, $type, $defaultValue, $concurrencyMode);
        $this->AddProperty($property);
        return $property;
    }
}
