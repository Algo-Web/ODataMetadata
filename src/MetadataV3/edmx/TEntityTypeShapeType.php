<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edmx;

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
        if (!$this->isStringNotNullOrEmpty($this->entityType)) {
            $msg = "Entity type cannot be null or empty";
            throw new \InvalidArgumentException($msg);
        }
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
        if (null != $pointX && !is_numeric($pointX)) {
            $msg = "Point X value must be numeric";
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
        if (null != $pointY && !is_numeric($pointY)) {
            $msg = "Point Y value must be numeric";
            throw new \InvalidArgumentException($msg);
        }
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
        if (null != $width && (!is_numeric($width) || 0 >= $width)) {
            $msg = "Width value must be numeric and positive";
            throw new \InvalidArgumentException($msg);
        }
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
        if (null != $height && (!is_numeric($height) || 0 >= $height)) {
            $msg = "Height value must be numeric and positive";
            throw new \InvalidArgumentException($msg);
        }
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
        if (null != $fillColor && !$this->isStringNotNullOrEmpty($fillColor)) {
            $msg = "Fill color cannot be null or empty";
            throw new \InvalidArgumentException($msg);
        }
        $this->fillColor = $fillColor;
        return $this;
    }

    /**
     * @return bool
     */
    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->entityType)) {
            $msg = "Entity type cannot be null or empty";
            return false;
        }

        if (null != $this->fillColor && !$this->isStringNotNullOrEmpty($this->fillColor)) {
            $msg = "Fill color cannot be empty";
            return false;
        }

        if (null != $this->pointX && !is_numeric($this->pointX)) {
            $msg = "Point X value must be numeric";
            return false;
        }
        if (null != $this->pointY && !is_numeric($this->pointY)) {
            $msg = "Point Y value must be numeric";
            return false;
        }
        if (null != $this->width && (!is_numeric($this->width) || 0 >= $this->width)) {
            $msg = "Width value must be numeric and positive";
            return false;
        }
        if (null != $this->height && (!is_numeric($this->height) || 0 >= $this->height)) {
            $msg = "Height value must be numeric and positive";
            return false;
        }

        return true;
    }
}
