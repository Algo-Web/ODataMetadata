<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TEntitySetReferenceExpressionType
 *
 *
 * XSD Type: TEntitySetReferenceExpression
 */
class TEntitySetReferenceExpressionType extends IsOK
{

    /**
     * @property string $entitySet
     */
    private $entitySet = null;

    /**
     * Gets as entitySet
     *
     * @return string
     */
    public function getEntitySet()
    {
        return $this->entitySet;
    }

    /**
     * Sets a new entitySet
     *
     * @param string $entitySet
     * @return self
     */
    public function setEntitySet($entitySet)
    {
        $this->entitySet = $entitySet;
        return $this;
    }
}
