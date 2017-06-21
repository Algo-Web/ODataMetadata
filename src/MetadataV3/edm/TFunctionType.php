<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\TFacetAttributesTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TCommandTextTrait;

/**
 * Class representing TFunctionType
 *
 * XSD Type: TFunction
 */
class TFunctionType extends IsOK
{
    use TFacetAttributesTrait, TCommandTextTrait, TSimpleIdentifierTrait;
    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReturnTypeType[] $returnType
     */
    private $returnType = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType[] $parameter
     */
    private $parameter = [];

    /**
     * @property string[] $definingExpression
     */
    private $definingExpression = [];

    /**
     * Gets as name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        if (!$this->isTSimpleIdentifierValid($name)) {
            $msg = "Name must be a valid TSimpleIdentifier";
            throw new \InvalidArgumentException($msg);
        }
        $this->name = $name;
        return $this;
    }

    /**
     * Adds as returnType
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReturnTypeType $returnType
     */
    public function addToReturnType(TFunctionReturnTypeType $returnType)
    {
        $msg = null;
        if (!$returnType->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->returnType[] = $returnType;
        return $this;
    }

    /**
     * isset returnType
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetReturnType($index)
    {
        return isset($this->returnType[$index]);
    }

    /**
     * unset returnType
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetReturnType($index)
    {
        unset($this->returnType[$index]);
    }

    /**
     * Gets as returnType
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReturnTypeType[]
     */
    public function getReturnType()
    {
        return $this->returnType;
    }

    /**
     * Sets a new returnType
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReturnTypeType[] $returnType
     * @return self
     */
    public function setReturnType(array $returnType)
    {
        if (!$this->isValidArrayOK(
            $returnType,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReturnTypeType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->returnType = $returnType;
        return $this;
    }

    /**
     * Gets as documentation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(TDocumentationType $documentation)
    {
        $msg = null;
        if (!$documentation->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Adds as parameter
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType $parameter
     */
    public function addToParameter(TFunctionParameterType $parameter)
    {
        $msg = null;
        if (!$parameter->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->parameter[] = $parameter;
        return $this;
    }

    /**
     * isset parameter
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetParameter($index)
    {
        return isset($this->parameter[$index]);
    }

    /**
     * unset parameter
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetParameter($index)
    {
        unset($this->parameter[$index]);
    }

    /**
     * Gets as parameter
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType[]
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * Sets a new parameter
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType[] $parameter
     * @return self
     */
    public function setParameter(array $parameter)
    {
        if (!$this->isValidArrayOK(
            $parameter,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->parameter = $parameter;
        return $this;
    }

    /**
     * Adds as definingExpression
     *
     * @return self
     * @param  string $definingExpression
     */
    public function addToDefiningExpression($definingExpression)
    {
        $this->definingExpression[] = $definingExpression;
        return $this;
    }

    /**
     * isset definingExpression
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetDefiningExpression($index)
    {
        return isset($this->definingExpression[$index]);
    }

    /**
     * unset definingExpression
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetDefiningExpression($index)
    {
        unset($this->definingExpression[$index]);
    }

    /**
     * Gets as definingExpression
     *
     * @return string[]
     */
    public function getDefiningExpression()
    {
        return $this->definingExpression;
    }

    /**
     * Sets a new definingExpression
     *
     * @param  string $definingExpression
     * @return self
     */
    public function setDefiningExpression(array $definingExpression)
    {
        $this->definingExpression = $definingExpression;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isTSimpleIdentifierValid($this->name)) {
            $msg = "Name must be a valid TSimpleIdentifier";
            return false;
        }
        if (!$this->isObjectNullOrOK($this->documentation, $msg)) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->parameter,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionParameterType',
            $msg
        )
        ) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->returnType,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReturnTypeType',
            $msg
        )
        ) {
            return false;
        }
        foreach ($this->returnType as $type) {
            if (!is_string($type) || !$this->isTCommandTextValid($type)) {
                $msg = implode($type) . " must be a valid TCommandText";
                return false;
            }
        }
        if (!$this->isTFacetAttributesTraitValid($msg)) {
            return false;
        }
        return true;
    }
}
