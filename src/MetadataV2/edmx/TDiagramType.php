<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\edmx;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TDiagramType
 *
 * XSD Type: TDiagram
 */
class TDiagramType extends IsOK
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $diagramId
     */
    private $diagramId = null;

    /**
     * @property integer $zoomLevel
     */
    private $zoomLevel = null;

    /**
     * @property boolean $showGrid
     */
    private $showGrid = null;

    /**
     * @property boolean $snapToGrid
     */
    private $snapToGrid = null;

    /**
     * @property boolean $displayType
     */
    private $displayType = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV2\edmx\TEntityTypeShapeType[] $entityTypeShape
     */
    private $entityTypeShape = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV2\edmx\TAssociationConnectorType[] $associationConnector
     */
    private $associationConnector = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV2\edmx\TInheritanceConnectorType[] $inheritanceConnector
     */
    private $inheritanceConnector = array();

    /**
     * Gets as name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as diagramId
     *
     * @return string
     */
    public function getDiagramId()
    {
        return $this->diagramId;
    }

    /**
     * Sets a new diagramId
     *
     * @param  string $diagramId
     * @return self
     */
    public function setDiagramId($diagramId)
    {
        $this->diagramId = $diagramId;
        return $this;
    }

    /**
     * Gets as zoomLevel
     *
     * @return integer
     */
    public function getZoomLevel()
    {
        return $this->zoomLevel;
    }

    /**
     * Sets a new zoomLevel
     *
     * @param  integer $zoomLevel
     * @return self
     */
    public function setZoomLevel($zoomLevel)
    {
        $this->zoomLevel = $zoomLevel;
        return $this;
    }

    /**
     * Gets as showGrid
     *
     * @return boolean
     */
    public function getShowGrid()
    {
        return $this->showGrid;
    }

    /**
     * Sets a new showGrid
     *
     * @param  boolean $showGrid
     * @return self
     */
    public function setShowGrid($showGrid)
    {
        $this->showGrid = $showGrid;
        return $this;
    }

    /**
     * Gets as snapToGrid
     *
     * @return boolean
     */
    public function getSnapToGrid()
    {
        return $this->snapToGrid;
    }

    /**
     * Sets a new snapToGrid
     *
     * @param  boolean $snapToGrid
     * @return self
     */
    public function setSnapToGrid($snapToGrid)
    {
        $this->snapToGrid = $snapToGrid;
        return $this;
    }

    /**
     * Gets as displayType
     *
     * @return boolean
     */
    public function getDisplayType()
    {
        return $this->displayType;
    }

    /**
     * Sets a new displayType
     *
     * @param  boolean $displayType
     * @return self
     */
    public function setDisplayType($displayType)
    {
        $this->displayType = $displayType;
        return $this;
    }

    /**
     * Adds as entityTypeShape
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\edmx\TEntityTypeShapeType $entityTypeShape
     */
    public function addToEntityTypeShape(TEntityTypeShapeType $entityTypeShape)
    {
        $this->entityTypeShape[] = $entityTypeShape;
        return $this;
    }

    /**
     * isset entityTypeShape
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetEntityTypeShape($index)
    {
        return isset($this->entityTypeShape[$index]);
    }

    /**
     * unset entityTypeShape
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetEntityTypeShape($index)
    {
        unset($this->entityTypeShape[$index]);
    }

    /**
     * Gets as entityTypeShape
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV2\edmx\TEntityTypeShapeType[]
     */
    public function getEntityTypeShape()
    {
        return $this->entityTypeShape;
    }

    /**
     * Sets a new entityTypeShape
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\edmx\TEntityTypeShapeType[] $entityTypeShape
     * @return self
     */
    public function setEntityTypeShape(array $entityTypeShape)
    {
        $this->entityTypeShape = $entityTypeShape;
        return $this;
    }

    /**
     * Adds as associationConnector
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\edmx\TAssociationConnectorType $associationConnector
     */
    public function addToAssociationConnector(TAssociationConnectorType $associationConnector)
    {
        $this->associationConnector[] = $associationConnector;
        return $this;
    }

    /**
     * isset associationConnector
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetAssociationConnector($index)
    {
        return isset($this->associationConnector[$index]);
    }

    /**
     * unset associationConnector
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetAssociationConnector($index)
    {
        unset($this->associationConnector[$index]);
    }

    /**
     * Gets as associationConnector
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV2\edmx\TAssociationConnectorType[]
     */
    public function getAssociationConnector()
    {
        return $this->associationConnector;
    }

    /**
     * Sets a new associationConnector
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\edmx\TAssociationConnectorType[] $associationConnector
     * @return self
     */
    public function setAssociationConnector(array $associationConnector)
    {
        $this->associationConnector = $associationConnector;
        return $this;
    }

    /**
     * Adds as inheritanceConnector
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\edmx\TInheritanceConnectorType $inheritanceConnector
     */
    public function addToInheritanceConnector(TInheritanceConnectorType $inheritanceConnector)
    {
        $this->inheritanceConnector[] = $inheritanceConnector;
        return $this;
    }

    /**
     * isset inheritanceConnector
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetInheritanceConnector($index)
    {
        return isset($this->inheritanceConnector[$index]);
    }

    /**
     * unset inheritanceConnector
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetInheritanceConnector($index)
    {
        unset($this->inheritanceConnector[$index]);
    }

    /**
     * Gets as inheritanceConnector
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV2\edmx\TInheritanceConnectorType[]
     */
    public function getInheritanceConnector()
    {
        return $this->inheritanceConnector;
    }

    /**
     * Sets a new inheritanceConnector
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\edmx\TInheritanceConnectorType[] $inheritanceConnector
     * @return self
     */
    public function setInheritanceConnector(array $inheritanceConnector)
    {
        $this->inheritanceConnector = $inheritanceConnector;
        return $this;
    }
}
