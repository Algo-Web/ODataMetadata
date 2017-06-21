<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\Groups\GEmptyElementExtensibilityTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TActionTrait;

/**
 * Class representing TOnActionType
 *
 * XSD Type: TOnAction
 */
class TOnActionType extends IsOK
{
    use TActionTrait, GEmptyElementExtensibilityTrait;
    /**
     * @property string $action
     */
    private $action = null;

    /**
     * Gets as action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Sets a new action
     *
     * @param  string $action
     * @return self
     */
    public function setAction($action)
    {
        if (!$this->isStringNotNullOrEmpty($action)) {
            $msg = "Action cannot be null or empty";
            throw new \InvalidArgumentException($msg);
        }
        if (!$this->isTActionValid($action)) {
            $msg = "Action must be valid TAction";
            throw new \InvalidArgumentException($msg);
        }
        $this->action = $action;
        return $this;
    }

    /**
     * @param null $msg
     * @return bool
     */
    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->action)) {
            $msg = "Action cannot be null or empty";
            return false;
        }
        if (!$this->isTActionValid($this->action)) {
            $msg = "Action must be valid TAction";
            return false;
        }
        if (!$this->isExtensibilityElementOK($msg)) {
            return false;
        }
        return true;
    }
}
