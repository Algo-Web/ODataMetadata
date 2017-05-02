<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

/**
 * Class representing TEntityTypeModificationFunctionWithResultType
 *
 * Extensions to modification function for entity type InsertFunction and UpdateFunction
 *
 * XSD Type: TEntityTypeModificationFunctionWithResult
 */
class TEntityTypeModificationFunctionWithResultType extends TEntityTypeModificationFunctionType
{
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
            if (!$this->isValidArray(
                $this->resultBinding,
                '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TScalarPropertyType'
            )) {
                $msg = "Scalar property array not a valid array";
                return false;
            }
            if (!$this->isChildArrayOK($this->resultBinding, $msg)) {
                return false;
            }
        }
        return true;
    }
}
