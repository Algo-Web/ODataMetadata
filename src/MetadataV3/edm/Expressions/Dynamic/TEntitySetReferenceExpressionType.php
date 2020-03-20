<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic;

/**
 * Class representing TEntitySetReferenceExpressionType.
 *
 * 16.2.4 The Edm:EntitySetReference Expression
 * The value of an Edm:EntitySetReference is a reference to an entity set. A reference to an entity set is a collection
 * of entities.
 *
 * The Edm:EntitySetReference expression MUST contain a value of the type [qualifiedidentifier][csdl19]. The value of
 * the entity set reference expression MUST resolve to an entity set.
 *
 * The Edm:EntitySetReference expression MUST be written with element notation, as shown in the following example:
 *
 *     <ValueAnnotation Term="org.example.seo.SaleProducts">
 *         <EntitySetReference>Self.SaleProducts</EntitySetReference>
 *     </ValueAnnotation>
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.2.4
 * XSD Type: TEntitySetReferenceExpression
 */
class TEntitySetReferenceExpressionType extends DynamicBase
{

    /**
     * @var string $entitySet
     */
    private $entitySet = null;

    /**
     * Gets as entitySet.
     *
     * @return string
     */
    public function getEntitySet()
    {
        return $this->entitySet;
    }

    /**
     * Sets a new entitySet.
     *
     * @param  string $entitySet
     * @return self
     */
    public function setEntitySet($entitySet)
    {
        $this->entitySet = $entitySet;
        return $this;
    }
}
