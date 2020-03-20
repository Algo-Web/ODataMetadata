<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.21 Documentation.
 *
 * The Documentation element is used to provide documentation of comments on the contents of the conceptual schema
 * definition language (CSDL) file.
 *
 * The following is an example of the Documentation element on the EntityContainer element.
 *
 *     <EntityContainer Name="TwoThreeContainer">
 *         <Documentation>
 *             <Summary>Summary: Entity Container for storing Northwind instances</Summary>
 *             <LongDescription>LongDescription: This Entity Container is for storing Northwind instances</LongDescription>
 *         </Documentation>
 *         <EntitySet Name="Products" EntityType="Self.Product" />
 *     </EntityContainer>
 *
 * The following is an example of the Documentation element on the EntitySet element.
 *
 *     <EntitySet Name="Products" EntityType="Self.Product">
 *         <Documentation>
 *             <Summary>EntitySet Products is for storing instances of EntityType Product</Summary>
 *             <LongDescription>This EntitySet having name Products is for storing instances of EntityType Product</LongDescription>
 *         </Documentation>
 *     </EntitySet>
 *
 * The following is an example of the Documentation element on the AssociationSet element and End role.
 *
 *     <AssociationSet Name="CategoryProducts" Association="Self.CategoryProduct">
 *         <Documentation>
 *             <Summary>AssociationSet CategoryProducts is for storing instances of Association CategoryProduct</Summary>
 *             <LongDescription>This AssociationSet having name=CategoryProducts is for storing instances of Association CategoryProduct</LongDescription>
 *         </Documentation>
 *         <End Role="Category" EntitySet="Categories">
 *             <Documentation>
 *                 <Summary>This end of the relationship-instance describes the Category role for AssociationSet CategoryProducts</Summary>
 *             </Documentation>
 *         </End>
 *         <End Role="Product" EntitySet="Products">
 *             <Documentation>
 *                 <LongDescription>This end of the relationship-instance describes the Product role for AssociationSet CategoryProducts</LongDescription>
 *             </Documentation>
 *         </End>
 *     </AssociationSet>
 *
 * The following is an example of the Documentation element on the EntityType element, Property element, and NavigationProperty element.
 *
 *     <EntityType Name="Product">
 *         <Documentation>
 *             <Summary>Summary: EntityType named Product describes the content model for Product</Summary>
 *             <LongDescription>LongDescription: The EntityType named Product describes the content model for Product</LongDescription>
 *         </Documentation>
 *         <Key>
 *             <PropertyRef Name="ProductID" />
 *         </Key>
 *         <Property Name="ProductID" Type="Int32" Nullable="false">
 *             <Documentation>
 *                 <Summary>Summary: This is the key property of EntityType Product</Summary>
 *                 <LongDescription>LongDescription: This is the key property of EntityType Product</LongDescription>
 *             </Documentation>
 *         </Property>
 *         <Property Name="ProductName" Type="String">
 *             <Documentation>
 *                 <Summary>Summary: This property describes the name of the Product</Summary>
 *             </Documentation>
 *         </Property>
 *         <Property Name="QuantityPerUnit" Type="String">
 *             <Documentation>
 *                 <LongDescription>LongDescription: This property describes the quantity per unit corresponding to a product</LongDescription>
 *             </Documentation>
 *         </Property>
 *         <Property Name="PriceInfo" Nullable="false" Type="Self.PriceInfo" />
 *         <Property Name="StockInfo" Nullable="false" Type="Self.StockInfo" />
 *         <NavigationProperty Name="Category" Relationship="Self.CategoryProduct" FromRole="Product" ToRole="Category">
 *             <Documentation>
 *                 <Summary>This navigation property allows for traversing to Product-instances associated with a Category-instance</Summary>
 *                 <LongDescription> </LongDescription>
 *             </Documentation>
 *         </NavigationProperty>
 *     </EntityType>
 *
 * The following is an example of the Documentation element on the Association element.
 *     <Association Name="CategoryProduct">
 *         <Documentation>
 *             <Summary>Association CategoryProduct describes the participating end of the CategoryProduct relationship</Summary>
 *         </Documentation>
 *         <End Role="Category" Type="Self.Category" Multiplicity="1">
 *             <Documentation>
 *                 <Summary>This end of the relationship-instance describes the Category role for Association CategoryProduct</Summary>
 *             </Documentation>
 *         </End>
 *         <End Role="Product" Type="Self.Product" Multiplicity="*">
 *             <Documentation>
 *                 <LongDescription>This end of the relationship-instance describes the Product role for Association CategoryProduct</LongDescription>
 *             </Documentation>
 *         </End>
 *     </Association>
 *
 * The following rules apply to the Documentation element:
 * - Documentation can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute
 *   attributes cannot collide.
 * - Documentation can specify a summary of the document inside a Summary element.
 * - Documentation can specify a description of the documentation inside a LongDescription element.
 * - The child elements of Documentation are to appear in this sequence: Summary, LongDescription, AnnotationElement.
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl2.3
 * XSD Type: TDocumentation
 */
class Documentation extends EdmBase
{

    /**
     * @var TTextType|null $summary
     */
    private $summary = null;

    /**
     * @var TTextType|null $longDescription
     */
    private $longDescription = null;

    public function __construct(?string $summary, string $longDescription = null)
    {
        $this
            ->setSummary(
                null === $summary ?
                    null :
                    new TTextType('Summary', $summary)
            )
            ->setLongDescription(
                null === $longDescription ?
                    null :
                    new TTextType('LongDescription', $longDescription)
            );
    }

    /**
     * Gets as summary.
     *
     * @return TTextType|null
     */
    public function getSummary(): ?TTextType
    {
        return $this->summary;
    }

    /**
     * Sets a new summary.
     *
     * @param  TTextType|null $summary
     * @return self
     */
    public function setSummary(?TTextType $summary): self
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * Gets as longDescription.
     *
     * @return TTextType|null
     */
    public function getLongDescription(): ?TTextType
    {
        return $this->longDescription;
    }

    /**
     * Sets a new longDescription.
     *
     * @param  TTextType|null $longDescription
     * @return self
     */
    public function setLongDescription(?TTextType $longDescription): self
    {
        $this->longDescription = $longDescription;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'Documentation';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [$this->getSummary(), $this->getLongDescription()];
    }
}
