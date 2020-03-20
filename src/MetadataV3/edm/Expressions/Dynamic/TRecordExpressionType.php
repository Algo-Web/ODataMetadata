<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Annotations\PropertyValue;

/**
 * Class representing TRecordExpressionType.
 *
 * 16.2.15 The Edm:Record Expression
 *
 * The Edm:Record expression enables a new entity type or complex type to be constructed.
 *
 * A record expression can specify a [simpleidentifier][csdl19] or [qualifiedidentifier][csdl19] value for
 * the Edm:Type attribute. If no value is specified for the type attribute, the type is derived from the expression's
 * context. If a value is specified, the value MUST resolve to an entity type or complex type in the entity model.
 *
 * A record expression MUST contain zero or more Edm:PropertyValue elements.
 *
 * A record expression MUST be written with element notation, as shown in the following example:
 *
 *     <ValueAnnotation Term="org.example.person.Employee">
 *         <Record>
 *             <PropertyValue Property="GivenName" Path="FirstName" />
 *             <PropertyValue Property="Surname" Path="LastName" />
 *         </Record>
 *     </ValueAnnotation>
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.15
 * @see https://docs.microsoft.com/en-us/openspecs/windows_protocols/mc-csdl/acee574d-2fe1-4da7-a65e-acf35643eb1d
 * @see https://docs.microsoft.com/en-us/openspecs/windows_protocols/mc-csdl/ecc942a0-af88-4012-be6f-439c706641d4
 * XSD Type: TRecordExpression
 */
class TRecordExpressionType extends DynamicBase
{

    /**
     * @var string $type
     */
    private $type = null;

    /**
     * @var PropertyValue[] $propertyValue
     */
    private $propertyValue = [
        
    ];

    /**
     * Gets as type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets a new type.
     *
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Adds as propertyValue.
     *
     * @param PropertyValue $propertyValue
     *@return self
     */
    public function addToPropertyValue(PropertyValue $propertyValue)
    {
        $this->propertyValue[] = $propertyValue;
        return $this;
    }

    /**
     * isset propertyValue.
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetPropertyValue($index)
    {
        return isset($this->propertyValue[$index]);
    }

    /**
     * unset propertyValue.
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetPropertyValue($index)
    {
        unset($this->propertyValue[$index]);
    }

    /**
     * Gets as propertyValue.
     *
     * @return PropertyValue[]
     */
    public function getPropertyValue()
    {
        return $this->propertyValue;
    }

    /**
     * Sets a new propertyValue.
     *
     * @param  PropertyValue[] $propertyValue
     * @return self
     */
    public function setPropertyValue(array $propertyValue)
    {
        $this->propertyValue = $propertyValue;
        return $this;
    }
}
