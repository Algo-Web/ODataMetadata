<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edmx;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TInheritanceConnectorType
 *
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
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edmx\TConnectorPointType[] $connectorPoint
     */
    private $connectorPoint = [];

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
     * @param string $entityType
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
     * @param boolean $manuallyRouted
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
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edmx\TConnectorPointType $connectorPoint
     */
    public function addToConnectorPoint(TConnectorPointType $connectorPoint)
    {
        $this->connectorPoint[] = $connectorPoint;
        return $this;
    }

    /**
     * isset connectorPoint
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetConnectorPoint($index)
    {
        return isset($this->connectorPoint[$index]);
    }

    /**
     * unset connectorPoint
     *
     * @param scalar $index
     * @return void
     */
    public function unsetConnectorPoint($index)
    {
        unset($this->connectorPoint[$index]);
    }

    /**
     * Gets as connectorPoint
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edmx\TConnectorPointType[]
     */
    public function getConnectorPoint()
    {
        return $this->connectorPoint;
    }

    /**
     * Sets a new connectorPoint
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edmx\TConnectorPointType[] $connectorPoint
     * @return self
     */
    public function setConnectorPoint(array $connectorPoint)
    {
        $this->connectorPoint = $connectorPoint;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->entityType)) {
            $msg = "Entity type cannot be null or empty";
            return false;
        }

        if (!$this->isValidArray(
            $this->connectorPoint,
            '\AlgoWeb\ODataMetadata\MetadataV3\edmx\TConnectorPointType'
        )) {
            $msg = "Designer info property set not a valid array";
            return false;
        }
        if (!$this->isChildArrayOK($this->connectorPoint, $msg)) {
            return false;
        }
        return true;
    }
}
