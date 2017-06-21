<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edmx;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TConnectorPointType
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
     * @param  float $pointX
     * @return self
     */
    public function setPointX($pointX)
    {
        if (null == $pointX || !is_numeric($pointX)) {
            $msg = "Point X value must be present and numeric";
            throw new \InvalidArgumentException($msg);
        }
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
     * @param  float $pointY
     * @return self
     */
    public function setPointY($pointY)
    {
        if (null == $pointY || !is_numeric($pointY)) {
            $msg = "Point Y value must be present and numeric";
            throw new \InvalidArgumentException($msg);
        }
        $this->pointY = $pointY;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (null == $this->pointX || !is_numeric($this->pointX)) {
            $msg = "Point X value must be present and numeric";
            return false;
        }
        if (null == $this->pointY || !is_numeric($this->pointY)) {
            $msg = "Point X value must be present and numeric";
            return false;
        }
        return true;
    }
}
