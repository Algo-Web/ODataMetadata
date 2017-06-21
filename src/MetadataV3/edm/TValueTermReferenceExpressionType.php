<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GBaseExpressionTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GExpressionTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TQualifiedNameTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TValueTermReferenceExpressionType
 *
 * XSD Type: TValueTermReferenceExpression
 */
class TValueTermReferenceExpressionType extends IsOK
{
    use GBaseExpressionTrait, GExpressionTrait, TQualifiedNameTrait, TSimpleIdentifierTrait {
        TSimpleIdentifierTrait::isNCName insteadof TQualifiedNameTrait, GExpressionTrait;
        TSimpleIdentifierTrait::matchesRegexPattern insteadof TQualifiedNameTrait, GExpressionTrait;
        TSimpleIdentifierTrait::isName insteadof TQualifiedNameTrait, GExpressionTrait;
    }

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

    public function __construct()
    {
        $this->gExpressionMaximum = 1;
        $this->gExpressionMinimum = 1;
    }

    /**
     * Sets a new term
     *
     * @param  string $term
     * @return self
     */
    public function setTerm($term)
    {
        if (!$this->isTQualifiedNameValid($term)) {
            $msg = "Term must be a valid TQualifiedName";
            throw new \InvalidArgumentException($msg);
        }
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
     * @param  string $qualifier
     * @return self
     */
    public function setQualifier($qualifier)
    {
        if (null != $qualifier && !$this->isTSimpleIdentifierValid($qualifier)) {
            $msg = "Qualifier must be a valid TSimpleIdentifier";
            throw new \InvalidArgumentException($msg);
        }
        $this->qualifier = $qualifier;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isTQualifiedNameValid($this->term)) {
            $msg = "Term must be a valid TQualifiedName";
            return false;
        }
        if (null != $this->qualifier && !$this->isTSimpleIdentifierValid($this->qualifier)) {
            $msg = "Qualifier must be a valid TSimpleIdentifier";
            return false;
        }
        if (!$this->isGExpressionValid($msg)) {
            return false;
        }

        return true;
    }
}
