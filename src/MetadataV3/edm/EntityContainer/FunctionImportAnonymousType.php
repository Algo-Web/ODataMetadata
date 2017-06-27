<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\TFunctionImportAttributesTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportParameterType;

/**
 * Class representing FunctionImportAnonymousType
 */
class FunctionImportAnonymousType extends IsOK
{
    use TFunctionImportAttributesTrait;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportParameterType[] $parameter
     */
    private $parameter = [];

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
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportParameterType $parameter
     */
    public function addToParameter(TFunctionImportParameterType $parameter)
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportParameterType[]
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * Sets a new parameter
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportParameterType[] $parameter
     * @return self
     */
    public function setParameter(array $parameter)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $parameter,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportParameterType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->parameter = $parameter;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isObjectNullOrOK($this->documentation, $msg)) {
            return false;
        }
        if (!$this->isTFunctionImportAttributesValid($msg)) {
            return false;
        }
        $minParms = $this->isBindable ? 1 : 0;
        if (!$this->isValidArrayOK(
            $this->parameter,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportParameterType',
            $msg,
            $minParms
        )
        ) {
            return false;
        }

        $numParms = count($this->parameter);
        for ($i = 0; $i < $numParms - 1; $i++) {
            assert($this->parameter[$i] instanceof TFunctionImportParameterType, get_class($this->parameter[$i]));
            $outName = $this->parameter[$i]->getName();
            for ($j = $i + 1; $j < $numParms; $j++) {
                assert(
                    $this->parameter[$j] instanceof TFunctionImportParameterType,
                    get_class($this->parameter[$j]). ' ' . $j
                );
                $inName = $this->parameter[$j]->getName();
                if ($outName == $inName) {
                    $msg = "Name collision in parameters array";
                    return false;
                }
            }
        }
        return true;
    }
}
