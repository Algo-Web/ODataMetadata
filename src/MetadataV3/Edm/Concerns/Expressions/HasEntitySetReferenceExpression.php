<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityContainer\EntitySet;

/**
 * Trait HasEntitySetReferenceExpression
 *
 * An EntitySetReference is used at times when a direct reference to an entityset already existing in the schema is required
 * most cases should not use the reference object directly but instead call get name on the referene type.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions
 */
trait HasEntitySetReferenceExpression
{
    /**
     * @var EntitySet $entitySetReference
     */
    private $entitySetReference = null;


    /**
     * Gets as entitySetReference.
     *
     * @return EntitySet
     */
    public function getEntitySetReference(): EntitySet
    {
        return $this->entitySetReference;
    }

    /**
     * Sets a new entitySetReference.
     *
     * @param  EntitySet $entitySetReference
     * @return self
     */
    public function setEntitySetReference(EntitySet $entitySetReference): self
    {
        $this->entitySetReference = $entitySetReference;
        return $this;
    }
}
