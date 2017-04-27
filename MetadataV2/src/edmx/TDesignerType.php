<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\edmx;

/**
 * Class representing TDesignerType
 *
 *
 * XSD Type: TDesigner
 */
class TDesignerType
{

    /**
     * @property \MetadataV2\edmx\TConnectionType $connection
     */
    private $connection = null;

    /**
     * @property \MetadataV2\edmx\TOptionsType $options
     */
    private $options = null;

    /**
     * @property \MetadataV2\edmx\TDiagramType[] $diagrams
     */
    private $diagrams = null;

    /**
     * Gets as connection
     *
     * @return \MetadataV2\edmx\TConnectionType
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Sets a new connection
     *
     * @param \MetadataV2\edmx\TConnectionType $connection
     * @return self
     */
    public function setConnection(\MetadataV2\edmx\TConnectionType $connection)
    {
        $this->connection = $connection;
        return $this;
    }

    /**
     * Gets as options
     *
     * @return \MetadataV2\edmx\TOptionsType
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets a new options
     *
     * @param \MetadataV2\edmx\TOptionsType $options
     * @return self
     */
    public function setOptions(\MetadataV2\edmx\TOptionsType $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Adds as diagram
     *
     * @return self
     * @param \MetadataV2\edmx\TDiagramType $diagram
     */
    public function addToDiagrams(\MetadataV2\edmx\TDiagramType $diagram)
    {
        $this->diagrams[] = $diagram;
        return $this;
    }

    /**
     * isset diagrams
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetDiagrams($index)
    {
        return isset($this->diagrams[$index]);
    }

    /**
     * unset diagrams
     *
     * @param scalar $index
     * @return void
     */
    public function unsetDiagrams($index)
    {
        unset($this->diagrams[$index]);
    }

    /**
     * Gets as diagrams
     *
     * @return \MetadataV2\edmx\TDiagramType[]
     */
    public function getDiagrams()
    {
        return $this->diagrams;
    }

    /**
     * Sets a new diagrams
     *
     * @param \MetadataV2\edmx\TDiagramType[] $diagrams
     * @return self
     */
    public function setDiagrams(array $diagrams)
    {
        $this->diagrams = $diagrams;
        return $this;
    }
}
