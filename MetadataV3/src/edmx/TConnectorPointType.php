<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edmx;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TConnectorPointType
 *
 *
 * XSD Type: TConnectorPoint
 */
class TConnectorPointType extends IsOK
{

    /**
     * @property float $pointX
     */
    private $pointX = null;

    /**
     * @property float $pointY
     */
    private $pointY = null;

    /**
     * Gets as pointX
     *
     * @return float
     */
    public function getPointX()
    {
        return $this->pointX;
    }

    /**
     * Sets a new pointX
     *
     * @param float $pointX
     * @return self
     */
    public function setPointX($pointX)
    {
        $this->pointX = $pointX;
        return $this;
    }

    /**
     * Gets as pointY
     *
     * @return float
     */
    public function getPointY()
    {
        return $this->pointY;
    }

    /**
     * Sets a new pointY
     *
     * @param float $pointY
     * @return self
     */
    public function setPointY($pointY)
    {
        $this->pointY = $pointY;
        return $this;
    }

    public function isOK()
    {
        if (null == $this->pointX) {
            return false;
        }
        if (null == $this->pointY) {
            return false;
        }
        return true;
    }
}
