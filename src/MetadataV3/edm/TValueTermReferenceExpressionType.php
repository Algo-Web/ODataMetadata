<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GExpressionTrait;

/**
 * Class representing TValueTermReferenceExpressionType
 *
 *
 * XSD Type: TValueTermReferenceExpression
 */
class TValueTermReferenceExpressionType extends IsOK
{
    use GExpressionTrait;
    /**
     * @property string $term
     */
    private $term = null;

    /**
     * @property string $qualifier
     */
    private $qualifier = null;

    /**
     * Gets as term
     *
     * @return string
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * Sets a new term
     *
     * @param string $term
     * @return self
     */
    public function setTerm($term)
    {
        $this->term = $term;
        return $this;
    }

    /**
     * Gets as qualifier
     *
     * @return string
     */
    public function getQualifier()
    {
        return $this->qualifier;
    }

    /**
     * Sets a new qualifier
     *
     * @param string $qualifier
     * @return self
     */
    public function setQualifier($qualifier)
    {
        $this->qualifier = $qualifier;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isGExpressionValid($msg)) {
            return false;
        }

        return true;
    }
}
