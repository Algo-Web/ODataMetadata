<?php


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;


trait HasGuidExpression
{
    /**
     * @var string[] $guid
     */
    private $guid = [

    ];


    /**
     * Adds as guid
     *
     * @return self
     * @param string $guid
     */
    public function addToGuid($guid)
    {
        $this->guid[] = $guid;
        return $this;
    }

    /**
     * isset guid
     *
     * @param int|string $index
     * @return bool
     */
    public function issetGuid($index)
    {
        return isset($this->guid[$index]);
    }

    /**
     * unset guid
     *
     * @param int|string $index
     * @return void
     */
    public function unsetGuid($index)
    {
        unset($this->guid[$index]);
    }

    /**
     * Gets as guid
     *
     * @return string[]
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * Sets a new guid
     *
     * @param string[] $guid
     * @return self
     */
    public function setGuid(array $guid)
    {
        $this->guid = $guid;
        return $this;
    }
}