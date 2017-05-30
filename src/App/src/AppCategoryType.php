<?php

namespace AlgoWeb\ODataMetadata\App;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing AppCategoryType
 *
 *
 * XSD Type: appCategoryType
 */
class AppCategoryType extends IsOK
{

    /**
     * @property string $scheme
     */
    private $scheme = null;

    /**
     * @property string $term
     */
    private $term = null;

    /**
     * @property string $label
     */
    private $label = null;

    /**
     * Gets as scheme
     *
     * @return string
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * Sets a new scheme
     *
     * @param string $scheme
     * @return self
     */
    public function setScheme($scheme)
    {
        $this->scheme = $scheme;
        return $this;
    }

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
     * @param string $term
     * @return self
     */
    public function setTerm($term)
    {
        $this->term = $term;
        return $this;
    }

    /**
     * Gets as label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Sets a new label
     *
     * @param string $label
     * @return self
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (null == $this->scheme && null == $this->term && null == $this->label) {
            $msg = "AppCategoryType At least one value from scheme term or label should be defined";
            return false;
        }
        return true;
    }
}
