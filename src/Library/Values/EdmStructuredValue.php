<?php


namespace AlgoWeb\ODataMetadata\Library\Values;


use AlgoWeb\ODataMetadata\Edm\Internal\Cache;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPropertyValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IStructuredValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IValue;

/**
 * Represents an EDM structured value.
 *
 * @package AlgoWeb\ODataMetadata\Library\Values
 */
class EdmStructuredValue extends EdmValue implements IStructuredValue
{
    /**
     * @var IPropertyValue[]
     */
    private $propertyValues;
    /**
     * @var Cache
     */
    private $propertiesDictionaryCache;

    /**
     * Initializes a new instance of the EdmStructuredValue class.
     *
     * @param IStructuredTypeReference $type Type that describes this value.
     * @param IPropertyValue[] $propertyValues Child values of this value.
     */
    public function __construct(IStructuredTypeReference $type, array $propertyValues)
    {
        $this->propertiesDictionaryCache = new Cache(self::class, 'array');
        parent::__construct($type);
        $this->propertyValues = $propertyValues;
    }

    /**
     * @return ValueKind Gets the kind of this value.
     */
    public function getValueKind(): ValueKind
    {
        return ValueKind::Structured();
    }

    /**
     * @return IPropertyValue[] Gets the property values of this structured value.
     */
    public function getPropertyValues(): array
    {
        return $this->propertyValues;
    }

    /**
     * @return array<string, IPropertyValue>
     */
    private function getPropertiesDictionary(): array
    {
        return $this->propertiesDictionaryCache->GetValue($this, [$this, 'ComputePropertiesDictionary']);
    }
    /**
     * Finds the value corresponding to the provided property name.
     *
     * @param string $propertyName Property to find the value of.
     * @return IPropertyValue|null The found property, or null if no property was found
     */
    public function findPropertyValues(string $propertyName): ?IPropertyValue
    {
        $propertiesDictionary = $this->getPropertiesDictionary();
        return array_key_exists($propertyName, $propertiesDictionary) ? $propertiesDictionary[$propertyName] : null;
    }

    private function ComputePropertiesDictionary():array
    {
        $propertiesDictionary = [];

        foreach ($this->propertyValues as $propertyValue)
        {
            $propertiesDictionary[$propertyValue->getName()] = $propertyValue;
        }

        return $propertiesDictionary;
    }

    /**
     * @return IValue Gets the data stored in this value.
     */
    public function getValue()
    {
        return $this;
    }
}