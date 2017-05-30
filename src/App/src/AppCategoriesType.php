<?php

namespace AlgoWeb\ODataMetadata\App;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;

/**
 * Class representing AppCategoriesType
 *
 *
 * XSD Type: appCategoriesType
 */
class AppCategoriesType extends IsOK
{
    use IsOKToolboxTrait;
    /**
     * @property boolean $fixed
     */
    private $fixed = false;

    /**
     * @property \AlgoWeb\ODataMetadata\App\AppCategoryType[] $category
     */
    private $category = array();

    /**
     * Gets as fixed
     *
     * @return boolean
     */
    public function getFixed()
    {
        return $this->fixed;
    }

    /**
     * Sets a new fixed
     *
     * @param boolean $fixed
     * @return self
     */
    public function setFixed($fixed)
    {
        $this->fixed = $fixed;
        return $this;
    }

    /**
     * Adds as category
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\App\AppCategoryType $category
     */
    public function addToCategory(\AlgoWeb\ODataMetadata\App\AppCategoryType $category)
    {
        $this->category[] = $category;
        return $this;
    }

    /**
     * isset category
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetCategory($index)
    {
        return isset($this->category[$index]);
    }

    /**
     * unset category
     *
     * @param scalar $index
     * @return void
     */
    public function unsetCategory($index)
    {
        unset($this->category[$index]);
    }

    /**
     * Gets as category
     *
     * @return \AlgoWeb\ODataMetadata\App\AppCategoryType[]
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Sets a new category
     *
     * @param \AlgoWeb\ODataMetadata\App\AppCategoryType[] $category
     * @return self
     */
    public function setCategory(array $category)
    {
        $this->category = $category;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isValidArrayOK($this->category, '\AlgoWeb\ODataMetadata\App\AppCategoryType', $msg)) {
            return false;
        }
        return true;
    }
}