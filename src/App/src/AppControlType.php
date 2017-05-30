<?php

namespace AlgoWeb\ODataMetadata\App;

/**
 * Class representing AppControlType
 *
 *
 * XSD Type: appControlType
 */
class AppControlType
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
}
