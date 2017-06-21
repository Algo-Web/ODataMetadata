<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GBaseExpressionTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GExpressionTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GInlineExpressionsTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TQualifiedNameTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TValueAnnotationType
 *
 * XSD Type: TValueAnnotation
 */
class TValueAnnotationType extends IsOK
{
    use GBaseExpressionTrait, GInlineExpressionsTrait, GExpressionTrait, TSimpleIdentifierTrait, TQualifiedNameTrait {
        GExpressionTrait::getString insteadof GInlineExpressionsTrait;
        GExpressionTrait::setString insteadof GInlineExpressionsTrait;
        GExpressionTrait::getBinary insteadof GInlineExpressionsTrait;
        GExpressionTrait::setBinary insteadof GInlineExpressionsTrait;
        GExpressionTrait::getInt insteadof GInlineExpressionsTrait;
        GExpressionTrait::setInt insteadof GInlineExpressionsTrait;
        GExpressionTrait::getFloat insteadof GInlineExpressionsTrait;
        GExpressionTrait::setFloat insteadof GInlineExpressionsTrait;
        GExpressionTrait::getGuid insteadof GInlineExpressionsTrait;
        GExpressionTrait::setGuid insteadof GInlineExpressionsTrait;
        GExpressionTrait::getDecimal insteadof GInlineExpressionsTrait;
        GExpressionTrait::setDecimal insteadof GInlineExpressionsTrait;
        GExpressionTrait::getBool insteadof GInlineExpressionsTrait;
        GExpressionTrait::setBool insteadof GInlineExpressionsTrait;
        GExpressionTrait::getDateTime insteadof GInlineExpressionsTrait;
        GExpressionTrait::setDateTime insteadof GInlineExpressionsTrait;
        GExpressionTrait::getDateTimeOffset insteadof GInlineExpressionsTrait;
        GExpressionTrait::setDateTimeOffset insteadof GInlineExpressionsTrait;
        GExpressionTrait::getEnum insteadof GInlineExpressionsTrait;
        GExpressionTrait::setEnum insteadof GInlineExpressionsTrait;
        GExpressionTrait::getPath insteadof GInlineExpressionsTrait;
        GExpressionTrait::setPath insteadof GInlineExpressionsTrait;
        GExpressionTrait::normaliseString insteadof GInlineExpressionsTrait;
        GExpressionTrait::replaceString insteadof GInlineExpressionsTrait;
        GExpressionTrait::collapseString insteadof GInlineExpressionsTrait;
        GExpressionTrait::preserveString insteadof GInlineExpressionsTrait;
        GExpressionTrait::token insteadof GInlineExpressionsTrait;
        GExpressionTrait::string insteadof GInlineExpressionsTrait;
        GExpressionTrait::integer insteadof GInlineExpressionsTrait;
        GExpressionTrait::nonNegativeInteger insteadof GInlineExpressionsTrait;
        GExpressionTrait::decimal insteadof GInlineExpressionsTrait;
        GExpressionTrait::double insteadof GInlineExpressionsTrait;
        GExpressionTrait::dateTime insteadof GInlineExpressionsTrait;
        GExpressionTrait::hexBinary insteadof GInlineExpressionsTrait;
        TSimpleIdentifierTrait::isNCName insteadof TQualifiedNameTrait, GInlineExpressionsTrait;
        TSimpleIdentifierTrait::matchesRegexPattern insteadof TQualifiedNameTrait, GInlineExpressionsTrait;
        TSimpleIdentifierTrait::isName insteadof TQualifiedNameTrait, GInlineExpressionsTrait;
        TQualifiedNameTrait::isTQualifiedNameValid insteadof GInlineExpressionsTrait;
    }
    /**
     * @property string $term
     */
    private $term = null;

    /**
     * @property string $qualifier
     */
    private $qualifier = null;

    public function __construct()
    {
        $this->gExpressionMaximum = 1;
        $this->gExpressionMinimum = 1;
    }
    
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
     * @param  string $term
     * @return self
     */
    public function setTerm($term)
    {
        $term = trim($term);
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
        if (!$this->isGInlineExpressionsValid($msg)) {
            return false;
        }
        if (!$this->isGExpressionValid($msg)) {
            return false;
        }

        return true;
    }
}
