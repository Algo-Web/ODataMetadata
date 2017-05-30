<?php

namespace AlgoWeb\ODataMetadata\App;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing AppControlType
 *
 *
 * XSD Type: appControlType
 */
class AppControlType extends IsOK
{

    /**
     * @property string $draft
     */
    private $draft = null;

    /**
     * Gets as draft
     *
     * @return string
     */
    public function getDraft()
    {
        return $this->draft;
    }

    /**
     * Sets a new draft
     *
     * @param string $draft
     * @return self
     */
    public function setDraft($draft)
    {
        $this->draft = $draft;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if ("yes" != $this->draft && "no" != $this->draft) {
            $msg = "AppControlType only two valid values for draft are yes and no.";
            return false;
        }
        return true;
    }
}
