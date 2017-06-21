<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GBaseExpressionTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GInlineExpressionsTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TQualifiedNameTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TTypeAnnotationType
 *
 * XSD Type: TTypeAnnotation
 */
class TTypeAnnotationType extends IsOK
{
    use IsOKToolboxTrait, GBaseExpressionTrait, GInlineExpressionsTrait, TQualifiedNameTrait, TSimpleIdentifierTrait{
        TQualifiedNameTrait::isTQualifiedNameValid insteadof GInlineExpressionsTrait;
        TSimpleIdentifierTrait::isNCName insteadof TQualifiedNameTrait, GInlineExpressionsTrait;
        TSimpleIdentifierTrait::matchesRegexPattern insteadof TQualifiedNameTrait, GInlineExpressionsTrait;
        TSimpleIdentifierTrait::isName insteadof TQualifiedNameTrait, GInlineExpressionsTrait;
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
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyValueType[] $propertyValue
     */
    private $propertyValue = [];

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
        $this->qualifier = $qualifier;
        return $this;
    }

    /**
     * Adds as propertyValue
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyValueType $propertyValue
     */
    public function addToPropertyValue(TPropertyValueType $propertyValue)
    {
        $msg = null;
        if (!$propertyValue->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->propertyValue[] = $propertyValue;
        return $this;
    }

    /**
     * isset propertyValue
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetPropertyValue($index)
    {
        return isset($this->propertyValue[$index]);
    }

    /**
     * unset propertyValue
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetPropertyValue($index)
    {
        unset($this->propertyValue[$index]);
    }

    /**
     * Gets as propertyValue
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyValueType[]
     */
    public function getPropertyValue()
    {
        return $this->propertyValue;
    }

    /**
     * Sets a new propertyValue
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyValueType[] $propertyValue
     * @return self
     */
    public function setPropertyValue(array $propertyValue)
    {
        if (!$this->isValidArrayOK(
            $propertyValue,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyValueType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->propertyValue = $propertyValue;
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
        if (!$this->isValidArrayOK(
            $this->propertyValue,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyValueType',
            $msg
        )
        ) {
            return false;
        }

        return true;
    }
}
