<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\edmx;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TEntityTypeShapeType
 *
 * XSD Type: TEntityTypeShape
 */
class TEntityTypeShapeType extends IsOK
{

    /**
     * @property string $entityType
     */
    private $entityType = null;

    /**
     * @property float $pointX
     */
    private $pointX = null;

    /**
     * @property float $pointY
     */
    private $pointY = null;

    /**
     * @property float $width
     */
    private $width = null;

    /**
     * @property float $height
     */
    private $height = null;

    /**
     * @property boolean $isExpanded
     */
    private $isExpanded = null;

    /**
     * @property string $fillColor
     */
    private $fillColor = null;

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
        $this->pointY = $pointY;
        return $this;
    }

    /**
     * Gets as width
     *
     * @return float
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Sets a new width
     *
     * @param  float $width
     * @return self
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Gets as height
     *
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Sets a new height
     *
     * @param  float $height
     * @return self
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Gets as isExpanded
     *
     * @return boolean
     */
    public function getIsExpanded()
    {
        return $this->isExpanded;
    }

    /**
     * Sets a new isExpanded
     *
     * @param  boolean $isExpanded
     * @return self
     */
    public function setIsExpanded($isExpanded)
    {
        $this->isExpanded = $isExpanded;
        return $this;
    }

    /**
     * Gets as fillColor
     *
     * @return string
     */
    public function getFillColor()
    {
        return $this->fillColor;
    }

    /**
     * Sets a new fillColor
     *
     * @param  string $fillColor
     * @return self
     */
    public function setFillColor($fillColor)
    {
        $this->fillColor = $fillColor;
        return $this;
    }
}
