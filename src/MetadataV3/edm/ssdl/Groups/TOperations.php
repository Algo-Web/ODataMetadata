<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl;

use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;

trait TOperations
{
    use IsOKToolboxTrait;
    
    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TOnActionType[] $onDelete
     */
    private $onDelete = [];

    /**
     * Adds as onDelete
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TOnActionType $onDelete
     */
    public function addToOnDelete(TOnActionType $onDelete)
    {
        $msg = null;
        if (!$onDelete->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->onDelete[] = $onDelete;
        return $this;
    }

    /**
     * isset onDelete
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetOnDelete($index)
    {
        return isset($this->onDelete[$index]);
    }

    /**
     * unset onDelete
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetOnDelete($index)
    {
        unset($this->onDelete[$index]);
    }

    /**
     * Gets as onDelete
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TOnActionType[]
     */
    public function getOnDelete()
    {
        return $this->onDelete;
    }

    /**
     * Sets a new onDelete
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TOnActionType[] $onDelete
     * @return self
     */
    public function setOnDelete(array $onDelete)
    {
        if (!$this->isValidArrayOK($onDelete, '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TOnActionType', $msg)) {
            return false;
        }
        $this->onDelete = $onDelete;
        return $this;
    }
    
    public function isOperationsGroupOK(&$msg = null)
    {
        if (!$this->isValidArrayOK($this->onDelete, '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TOnActionType', $msg)) {
            return false;
        }
        return true;
    }
}
