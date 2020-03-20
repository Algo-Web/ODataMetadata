<?php


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Constant;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\ExpressionBase;
use AlgoWeb\ODataMetadata\OdataVersions;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use AlgoWeb\ODataMetadata\Writer\IAttribute;

/**
 * 2.1.36.1.2 Primitive Scalar Constant Expressions.
 *
 * The following expression elements are defined as primitive scalar constant expressions:
 * - String allows any sequence of UTF-8 characters.
 * - Int allows content in the following form: [-] [0-9]+.
 * - Float allows content in the following form: [0-9]+ ((.[0-9]+) | [E[+ | -][0-9]+]).
 * - Decimal allows content in the following form: [0-9]+.[0-9]+.
 * - Bool allows content in the following form: true | false.
 * - DateTime allows content in the following form: yyyy-mm-ddThh:mm[:ss[.fffffff]].
 * - DateTimeOffset allows content in the following form: yyyy-mm-ddThh:mm[:ss[.fffffff]]zzzzzz.
 * - Guid allows content in the following form: dddddddd-dddd-dddd-dddd-dddddddddddd where each d represents [A-Fa-f0-9].
 * - Binary allows content in the following form: [A-Fa-f0-9][A-Fa-f0-9]*.
 * The following is an example of primitive scalar constant expressions.
 * <String>text</String>
 * <Int>1</Int>
 * <Float>3.14159265</Float>
 * <Decimal>9.8</Decimal>
 * <Bool>true</Bool>
 * <DateTime>2011-08-30T14:30:00.00</DateTime>
 * <DateTimeOffset>2011-08-30T14:30:00.00-09:00</DateTimeOffset>
 * <Guid>707043F1-E7DD-475C-9928-71DA38EA7D57</Guid>
 * <Binary>6E67616F766169732E65</Binary>
 *
 *
 * Constant expressions allow the service author to supply an unchanging value to a value term or property of a type
 * term.
 *
 * The following examples show two value annotations intended as user interface hints:
 *     <EntitySet Name="Products" EntityType="Self.Product">
 *         <ValueAnnotation Term="org.example.display.DisplayName" String="Product Catalog" />
 *     </EntitySet>
 *
 *     <EntitySet Name="Suppliers" EntityType="Self.Supplier">
 *         <ValueAnnotation Term="org.example.display.DisplayName" String="Supplier Directory" />
 *     </EntitySet>
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.1
 * @package AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Constant
 */
abstract class ConstantBase extends ExpressionBase implements IAttribute
{
    /**
     * @var mixed $__value
     */
    protected $__value = null;

    /**
     * Gets a string value.
     *
     * @return string
     */
    public function __toString()
    {
        return strval($this->__value);
    }


    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [];
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [];
    }

    public function getAttributeValue(): ?string
    {
        return strval($this);
    }

    public function getAttributeNullCheck(): bool
    {
        return true;
    }

    public function getAttributeForVersion(): OdataVersions
    {
        return OdataVersions::ONE();
    }

    public function getAttributeProhibitedVersion(): array
    {
        return [];
    }

    public function getAttributePrefix(): ?string
    {
        return null;
    }

    public function getAttributeName(): string
    {
        return $this->getDomName();
    }
}
