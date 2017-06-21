<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GBaseExpressionTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GExpressionTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GInlineExpressionsTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TPropertyValueType
 *
 * XSD Type: TPropertyValue
 */
class TPropertyValueType extends IsOK
{
    use GBaseExpressionTrait, GInlineExpressionsTrait, GExpressionTrait, TSimpleIdentifierTrait {
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
        TSimpleIdentifierTrait::isNCName insteadof GExpressionTrait, GInlineExpressionsTrait;
        TSimpleIdentifierTrait::matchesRegexPattern insteadof GExpressionTrait, GInlineExpressionsTrait;
        TSimpleIdentifierTrait::isName insteadof GExpressionTrait, GInlineExpressionsTrait;
    }
    /**
     * @property string $property
     */
    private $property = null;

    public function __construct()
    {
        $this->gExpressionMaximum = 1;
        $this->gExpressionMinimum = 1;
    }
    
    /**
     * Gets as property
     *
     * @return string
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Sets a new property
     *
     * @param  string $property
     * @return self
     */
    public function setProperty($property)
    {
        if (!$this->isTSimpleIdentifierValid($property)) {
            $msg = "Property must be a valid TSimpleIdentifier";
            throw new \InvalidArgumentException($msg);
        }
        $this->property = $property;
        return $this;
    }
    
    public function isOK(&$msg = null)
    {
        if (!$this->isTSimpleIdentifierValid($this->property)) {
            $msg = "Property must be a valid TSimpleIdentifier";
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
