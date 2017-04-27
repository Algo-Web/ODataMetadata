<?php

namespace AlgoWeb\ODataMetadata\MetadataV1\edmx;

/**
 * Class representing TInheritanceConnectorType
 *
 *
 * XSD Type: TInheritanceConnector
 */
class TInheritanceConnectorType
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
     * @property \MetadataV1\edmx\TConnectorPointType[] $connectorPoint
     */
    private $connectorPoint = array(
        
    );

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
     * @param \MetadataV1\edmx\TConnectorPointType $connectorPoint
     */
    public function addToConnectorPoint(\MetadataV1\edmx\TConnectorPointType $connectorPoint)
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
     * @return \MetadataV1\edmx\TConnectorPointType[]
     */
    public function getConnectorPoint()
    {
        return $this->connectorPoint;
    }

    /**
     * Sets a new connectorPoint
     *
     * @param \MetadataV1\edmx\TConnectorPointType[] $connectorPoint
     * @return self
     */
    public function setConnectorPoint(array $connectorPoint)
    {
        $this->connectorPoint = $connectorPoint;
        return $this;
    }
}
