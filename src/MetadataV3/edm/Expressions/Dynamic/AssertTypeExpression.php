<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets\HasCollation;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\HasFacets;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\ExpressionBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs\ReferenceType;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.36.2.4 AssertType Expression
 *
 * An AssertType expression casts a child element expression to a given type. The result of the AssertType expression
 * is an instance of the specified type or an error. The following two examples show how you can use either the Type
 * attribute or the ReferenceType child element to assert the type.
 *
 * In example 1, AssertType uses a Type attribute.
 *
 *     <AssertType Type="Edm.String">
 *         <String>Tag1</String>
 *     </AssertType>
 *
 * In example 2, AssertType uses a nested ReferenceType element.
 *
 *     <AssertType>
 *         <ReferenceType Type="Edm.String" />
 *         <String>Tag1</String>
 *     </AssertType>
 *
 * The following rules apply to the AssertType expression:
 * - AssertType MUST define the type, either as an attribute or as a child element ReferenceType.
 * - AssertType MUST contain one expression as a child element. The expression MUST follow ReferenceType
 * if ReferenceType is used to define the type.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.2.2
 * XSD Type: TTypeAssertExpression
 */
class AssertTypeExpression extends DynamicBase
{
    use HasFacets, HasCollation;

    /**
     * @var ExpressionBase $operand
     */
    private $operand;

    /**
     * @var ReferenceType $referenceType
     */
    private $referenceType;

    /**
     * Gets as operand
     *
     * @return ExpressionBase
     */
    public function getOperand(): ExpressionBase
    {
        return $this->operand;
    }

    /**
     * Sets a new operand
     *
     * @param ExpressionBase $operand
     * @return self
     */
    public function setOperand(ExpressionBase $operand):self
    {
        $this->operand = $operand;
        return $this;
    }

    /**
     * Gets as referenceType
     *
     * @return ReferenceType
     */
    public function getReferenceType()
    {
        return $this->referenceType;
    }

    /**
     * Sets a new referenceType
     *
     * @param ReferenceType $referenceType
     * @return self
     */
    public function setReferenceType(ReferenceType $referenceType)
    {
        $this->referenceType = $referenceType;
        return $this;
    }


    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'AssertType';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        $base = $this->getReferenceType()->isAttribute() ? [$this->getReferenceType()] : [];
        return array_merge($base, $this->getAttributesHasFacets(), $this->getAttributesHasCollection());
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        $base = !$this->getReferenceType()->isAttribute() ? [$this->getReferenceType()] : [];
        $base[] = $this->getOperand();
        return $base;
    }

}

