<?php

namespace AlgoWeb\ODataMetadata\App;

/**
 * Class representing AppWorkspaceType
 *
 *
 * XSD Type: appWorkspaceType
 */
class AppWorkspaceType
{

    /**
     * @property \AlgoWeb\ODataMetadata\Atom\Title $title
     */
    private $title = null;

    /**
     * @property \AlgoWeb\ODataMetadata\App\Collection[] $collection
     */
    private $collection = array(
        
    );

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
     * Adds as collection
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\App\Collection $collection
     */
    public function addToCollection(\AlgoWeb\ODataMetadata\App\Collection $collection)
    {
        $this->collection[] = $collection;
        return $this;
    }

    /**
     * isset collection
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetCollection($index)
    {
        return isset($this->collection[$index]);
    }

    /**
     * unset collection
     *
     * @param scalar $index
     * @return void
     */
    public function unsetCollection($index)
    {
        unset($this->collection[$index]);
    }

    /**
     * Gets as collection
     *
     * @return \AlgoWeb\ODataMetadata\App\Collection[]
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Sets a new collection
     *
     * @param \AlgoWeb\ODataMetadata\App\Collection[] $collection
     * @return self
     */
    public function setCollection(array $collection)
    {
        $this->collection = $collection;
        return $this;
    }


}

