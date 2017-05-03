<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GEmptyElementExtensibilityTrait;

/**
 * Class representing TOnActionType
 *
 *
 * XSD Type: TOnAction
 */
class TOnActionType extends IsOK
{
    use GEmptyElementExtensibilityTrait;
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
     * @param string $action
     * @return self
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isExtensibilityElementOK($msg)) {
            return false;
        }
        return true;
    }
}
