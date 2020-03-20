<?php


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets\HasCollation;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\HasFacets;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\ExpressionBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs\TypeRef;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.36.2.3 IsType Expression.
 *
 * An IsType expression tests whether a child element expression is of a given type. The result of the IsType expression
 * is a Boolean value. The following two examples show how you can use either the Type attribute or the TypeRef child
 * element to test the type.
 *
 * In example 1, IsType uses a Type attribute.
 *
 *    <IsType Type="Edm.String">
 *        <String>Tag1</String>
 *    </IsType>
 *
 * In example 2, IsType uses a nested TypeRef child element.
 *
 *     <IsType>
 *          <TypeRef Type="Edm.String" />
 *          <String>Tag1</String>
 *     </IsType>
 *
 * The following rules apply to the IsType expression:
 * - IsType MUST define the type either as an attribute or as a child element TypeRef.
 * - IsType MUST contain one expression as a child element. The expression MUST follow TypeRef if TypeRef is used to
 *   define the type.
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.8
 * XSD Type: TIsTypeExpression
 */
class IsTypeExpression extends DynamicBase
{
    use HasFacets, HasCollation;

    /**
     * @var ExpressionBase $operand
     */
    private $operand;

    /**
     * @var TypeRef $referenceType
     */
    private $typeRef;

    /**
     * Gets as operand.
     *
     * @return ExpressionBase
     */
    public function getOperand(): ExpressionBase
    {
        return $this->operand;
    }

    /**
     * Sets a new operand.
     *
     * @param  ExpressionBase $operand
     * @return self
     */
    public function setOperand(ExpressionBase $operand):self
    {
        $this->operand = $operand;
        return $this;
    }

    /**
     * Gets as referenceType.
     *
     * @return TypeRef
     */
    public function getTypeRef(): TypeRef
    {
        return $this->typeRef;
    }

    /**
     * Sets a new referenceType.
     *
     * @param  TypeRef $typeRef
     * @return self
     */
    public function setReferenceType(TypeRef $typeRef): self
    {
        $this->typeRef = $typeRef;
        return $this;
    }


    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'IsType';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        $base = $this->getTypeRef()->isAttribute() ? [$this->getTypeRef()] : [];
        return array_merge($base, $this->getAttributesHasFacets(), $this->getAttributesHasCollection());
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        $base = !$this->getTypeRef()->isAttribute() ? [$this->getTypeRef()] : [];
        $base[] = $this->getOperand();
        return $base;
    }
}
