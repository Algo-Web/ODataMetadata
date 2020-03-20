<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityContainer\FunctionImport;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic\TEntitySetReferenceExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\TOperandType;
use AlgoWeb\ODataMetadata\OdataVersions;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use DOMElement;

/**
 * 2.1.16 FunctionImport ReturnType
 *
 * A ReturnType describes the shape of data that is returned from a FunctionImport element. ReturnType is used to map
 * to stored procedures with multiple result sets. In CSDL 3.0, the return type of a function import can be declared
 * as a child element.
 *
 * The following is an example of the ReturnType element.
 *
 *     <FunctionImport Name="GetOrdersAndProducts">
 *         <ReturnType Type="Collection(Self.Order)" EntitySet="Orders"/>
 *         <ReturnType Type="Collection(Self.Product)" EntitySet="Products"/>
 *     </FunctionImport>
 *
 * The following rules apply to the FunctionImport ReturnType element:
 * - ReturnType can define type declarations as an attribute.
 * - If defined in CSDL 1.1, CSDL 2.0, or CSDL 3.0, the Type of FunctionImport ReturnType MUST be an EDMSimpleType,
 *   EntityType, or ComplexType that is in scope or a collection of one of these in-scope types. In CSDL 1.0, the
 *   ReturnType is a collection of either EDMSimpleType or EntityType.
 * - ReturnType can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute
 *   attributes cannot collide.
 * - The order of the ReturnType elements MUST match that of the underlying stored procedure.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl12.5
 * XSD Type: TFunctionImportReturnType
 */
class ReturnType extends EdmBase
{
    /**
     * @var string $type
     */
    private $type = null;

    /**
     * @var TEntitySetReferenceExpressionType $entitySet
     */
    private $entitySet = null;

    /**
     * Gets as type
     *
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Sets a new type
     *
     * @param string|null $type
     * @return self
     */
    public function setType(?string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Gets as entitySet
     *
     * @return TEntitySetReferenceExpressionType|null
     */
    public function getEntitySet(): ?TEntitySetReferenceExpressionType
    {
        return $this->entitySet;
    }

    /**
     * Sets a new entitySet
     *
     * @param TEntitySetReferenceExpressionType|null $entitySet
     * @return self
     */
    public function setEntitySet(?TEntitySetReferenceExpressionType $entitySet): self
    {
        $this->entitySet = $entitySet;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'ReturnType';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('Type', $this->getType(), true),
            new AttributeContainer('EntitySet', $this->getEntitySet(), true)
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {

    }
    public function requiredVersion(): OdataVersions
    {
        return OdataVersions::THREE();
    }
}

