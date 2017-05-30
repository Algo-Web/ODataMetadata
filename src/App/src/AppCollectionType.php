<?php

namespace AlgoWeb\ODataMetadata\App;

/**
 * Class representing AppCollectionType
 *
 *
 * XSD Type: appCollectionType
 */
class AppCollectionType
{

    /**
     * @property string $href
     */
    private $href = null;

    /**
     * @property \AlgoWeb\ODataMetadata\Atom\Title $title
     */
    private $title = null;

    /**
     * @property string[] $accept
     */
    private $accept = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\App\AppCategoriesType[] $categories
     */
    private $categories = array(
        
    );

    /**
     * Gets as href
     *
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * Sets a new href
     *
     * @param string $href
     * @return self
     */
    public function setHref($href)
    {
        $this->href = $href;
        return $this;
    }

    /**
     * Gets as title
     *
     * @return \AlgoWeb\ODataMetadata\Atom\Title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets a new title
     *
     * @param \AlgoWeb\ODataMetadata\Atom\Title $title
     * @return self
     */
    public function setTitle(\AlgoWeb\ODataMetadata\Atom\Title $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Adds as accept
     *
     * @return self
     * @param string $accept
     */
    public function addToAccept($accept)
    {
        $this->accept[] = $accept;
        return $this;
    }

    /**
     * isset accept
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetAccept($index)
    {
        return isset($this->accept[$index]);
    }

    /**
     * unset accept
     *
     * @param scalar $index
     * @return void
     */
    public function unsetAccept($index)
    {
        unset($this->accept[$index]);
    }

    /**
     * Gets as accept
     *
     * @return string[]
     */
    public function getAccept()
    {
        return $this->accept;
    }

    /**
     * Sets a new accept
     *
     * @param string[] $accept
     * @return self
     */
    public function setAccept(array $accept)
    {
        $this->accept = $accept;
        return $this;
    }

    /**
     * Adds as categories
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\App\AppCategoriesType $categories
     */
    public function addToCategories(\AlgoWeb\ODataMetadata\App\AppCategoriesType $categories)
    {
        $this->categories[] = $categories;
        return $this;
    }

    /**
     * isset categories
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetCategories($index)
    {
        return isset($this->categories[$index]);
    }

    /**
     * unset categories
     *
     * @param scalar $index
     * @return void
     */
    public function unsetCategories($index)
    {
        unset($this->categories[$index]);
    }

    /**
     * Gets as categories
     *
     * @return \AlgoWeb\ODataMetadata\App\AppCategoriesType[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Sets a new categories
     *
     * @param \AlgoWeb\ODataMetadata\App\AppCategoriesType[] $categories
     * @return self
     */
    public function setCategories(array $categories)
    {
        $this->categories = $categories;
        return $this;
    }


}

