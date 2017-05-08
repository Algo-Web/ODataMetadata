<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\Groups\TResultBindingGroup;

/**
 * Class representing TEntityTypeModificationFunctionWithResultType
 *
 * Extensions to modification function for entity type InsertFunction and UpdateFunction
 *
 * XSD Type: TEntityTypeModificationFunctionWithResult
 */
class TEntityTypeModificationFunctionWithResultType extends TEntityTypeModificationFunctionType
{
    use TResultBindingGroup;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TResultBindingType[] $resultBinding
     */
    private $resultBinding = null;

    /*
     * Adds as resultBinding
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TResultBindingType $resultBinding
     */
    public function addToResultBinding(TResultBindingType $resultBinding)
    {
        $msg = null;
        if (!$resultBinding->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->resultBinding[] = $resultBinding;
        return $this;
    }

    /**
     * isset resultBinding
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetResultBinding($index)
    {
        return isset($this->resultBinding[$index]);
    }

    /**
     * unset resultBinding
     *
     * @param scalar $index
     * @return void
     */
    public function unsetResultBinding($index)
    {
        unset($this->resultBinding[$index]);
    }

    /**
     * Gets as resultBinding
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TResultBindingType[]
     */
    public function getResultBinding()
    {
        return $this->resultBinding;
    }

    /**
     * Sets a new resultBinding
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TResultBindingType[] $resultBinding
     * @return self
     */
    public function setResultBinding(array $resultBinding)
    {
        $this->resultBinding = $resultBinding;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        $result = parent::isOK($msg);
        if ($result) {
            if (!$this->isResultBindingGroupOK($msg)) {
                return false;
            }
        }
        return $result;
    }
}
