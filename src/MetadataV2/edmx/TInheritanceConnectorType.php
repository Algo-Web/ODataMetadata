<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\edmx;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TInheritanceConnectorType
 *
 * XSD Type: TInheritanceConnector
 */
class TInheritanceConnectorType extends IsOK
{

    /**
     * @property string $entityType
     */
    private $entityType = null;

    /**
     * @property boolean $manuallyRouted
     */
    private $manuallyRouted = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV2\edmx\TConnectorPointType[] $connectorPoint
     */
    private $connectorPoint = array();

    /**
     * Gets as entityType
     *
     * @return string
     */
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * Sets a new entityType
     *
     * @param  string $entityType
     * @return self
     */
    public function setEntityType($entityType)
    {
        $this->entityType = $entityType;
        return $this;
    }

    /**
     * Gets as manuallyRouted
     *
     * @return boolean
     */
    public function getManuallyRouted()
    {
        return $this->manuallyRouted;
    }

    /**
     * Sets a new manuallyRouted
     *
     * @param  boolean $manuallyRouted
     * @return self
     */
    public function setManuallyRouted($manuallyRouted)
    {
        $this->manuallyRouted = $manuallyRouted;
        return $this;
    }

    /**
     * Adds as connectorPoint
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\edmx\TConnectorPointType $connectorPoint
     */
    public function addToConnectorPoint(TConnectorPointType $connectorPoint)
    {
        $this->connectorPoint[] = $connectorPoint;
        return $this;
    }

    /**
     * isset connectorPoint
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetConnectorPoint($index)
    {
        return isset($this->connectorPoint[$index]);
    }

    /**
     * unset connectorPoint
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetConnectorPoint($index)
    {
        unset($this->connectorPoint[$index]);
    }

    /**
     * Gets as connectorPoint
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV2\edmx\TConnectorPointType[]
     */
    public function getConnectorPoint()
    {
        return $this->connectorPoint;
    }

    /**
     * Sets a new connectorPoint
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\edmx\TConnectorPointType[] $connectorPoint
     * @return self
     */
    public function setConnectorPoint(array $connectorPoint)
    {
        $this->connectorPoint = $connectorPoint;
        return $this;
    }
}
