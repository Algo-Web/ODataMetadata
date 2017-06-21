<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Groups;

use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TGuidLiteralTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TQualifiedNameTrait;
use AlgoWeb\ODataMetadata\StringTraits\XSDTopLevelTrait;

trait GInlineExpressionsTrait
{
    use TQualifiedNameTrait, XSDTopLevelTrait, TGuidLiteralTrait {
        TQualifiedNameTrait::isNCName insteadof TGuidLiteralTrait;
        TQualifiedNameTrait::matchesRegexPattern insteadof TGuidLiteralTrait;
        TQualifiedNameTrait::isName insteadof TGuidLiteralTrait;
    }

    /**
     * Gets as string
     *
     * @return string
     */
    public function getString()
    {
        return $this->string;
    }

    /**
     * Sets a new string
     *
     * @param  string $string
     * @return self
     */
    public function setString($string)
    {
        $msg = null;
        if (null !== $string && !is_string($string)) {
            $msg = "String must be a string";
            throw new \InvalidArgumentException($msg);
        }
        $this->string = $string;
        return $this;
    }

    /**
     * Gets as binary
     *
     * @return mixed
     */
    public function getBinary()
    {
        return $this->binary;
    }

    /**
     * Sets a new binary
     *
     * @param  mixed $binary
     * @return self
     */
    public function setBinary($binary)
    {
        $msg = null;
        if (null != $binary && !$this->hexBinary($binary)) {
            $msg = "Binary must be hexadecimal";
            throw new \InvalidArgumentException($msg);
        }
        $this->binary = $binary;
        return $this;
    }

    /**
     * Gets as int
     *
     * @return integer
     */
    public function getInt()
    {
        return $this->int;
    }

    /**
     * Sets a new int
     *
     * @param  integer $int
     * @return self
     */
    public function setInt($int)
    {
        $msg = null;
        if (null != $int && $int !== intval($int)) {
            $msg = "Integer must be integral";
            throw new \InvalidArgumentException($msg);
        }
        $this->int = $int;
        return $this;
    }

    /**
     * Gets as float
     *
     * @return float
     */
    public function getFloat()
    {
        return $this->float;
    }

    /**
     * Sets a new float
     *
     * @param  float $float
     * @return self
     */
    public function setFloat($float)
    {
        $msg = null;
        if (null != $float && $float !== floatval($float)) {
            $msg = "Float must be floating-point";
            throw new \InvalidArgumentException($msg);
        }
        $this->float = $float;
        return $this;
    }

    /**
     * Gets as guid
     *
     * @return string
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * Sets a new guid
     *
     * @param  string $guid
     * @return self
     */
    public function setGuid($guid)
    {
        $msg = null;
        if (null != $guid && !$this->isTGuidLiteralValid($guid)) {
            $msg = "Guid must be valid GUID";
            throw new \InvalidArgumentException($msg);
        }
        $this->guid = $guid;
        return $this;
    }

    /**
     * Gets as decimal
     *
     * @return float
     */
    public function getDecimal()
    {
        return $this->decimal;
    }

    /**
     * Sets a new decimal
     *
     * @param  float $decimal
     * @return self
     */
    public function setDecimal($decimal)
    {
        $msg = null;
        if (null != $decimal && $decimal !== floatval($decimal)) {
            $msg = "Decimal must be decimal";
            throw new \InvalidArgumentException($msg);
        }
        $this->decimal = $decimal;
        return $this;
    }

    /**
     * Gets as bool
     *
     * @return boolean
     */
    public function getBool()
    {
        return $this->bool;
    }

    /**
     * Sets a new bool
     *
     * @param  boolean $bool
     * @return self
     */
    public function setBool($bool)
    {
        $msg = null;
        if (null != $bool && $bool !== boolval($bool)) {
            $msg = "Bool must be boolean";
            throw new \InvalidArgumentException($msg);
        }
        $this->bool = $bool;
        return $this;
    }

    /**
     * Gets as dateTime
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Sets a new dateTime
     *
     * @param  \DateTime $dateTime
     * @return self
     */
    public function setDateTime(\DateTime $dateTime)
    {
        $msg = null;
        if (null != $dateTime && $dateTime !== $this->dateTime($dateTime)) {
            $msg = "DateTime must be a valid date/time";
            throw new \InvalidArgumentException($msg);
        }
        $this->dateTime = $dateTime;
        return $this;
    }

    /**
     * Gets as dateTimeOffset
     *
     * @return \DateTime
     */
    public function getDateTimeOffset()
    {
        return $this->dateTimeOffset;
    }

    /**
     * Sets a new dateTimeOffset
     *
     * @param  \DateTime $dateTimeOffset
     * @return self
     */
    public function setDateTimeOffset(\DateTime $dateTimeOffset)
    {
        $msg = null;
        if (null != $dateTimeOffset && $dateTimeOffset !== $this->dateTime($dateTimeOffset)) {
            $msg = "DateTimeOffset must be a valid date/time";
            throw new \InvalidArgumentException($msg);
        }
        $this->dateTimeOffset = $dateTimeOffset;
        return $this;
    }

    /**
     * Gets as enum
     *
     * @return string
     */
    public function getEnum()
    {
        return $this->enum;
    }

    /**
     * Sets a new enum
     *
     * @param  string $enum
     * @return self
     */
    public function setEnum($enum)
    {
        $msg = null;
        if (null != $enum && !$this->isTQualifiedNameValid($enum)) {
            $msg = "Enum must be a valid TQualifiedName";
            throw new \InvalidArgumentException($msg);
        }
        $this->enum = $enum;
        return $this;
    }

    /**
     * Gets as path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Sets a new path
     *
     * @param  string $path
     * @return self
     */
    public function setPath($path)
    {
        $msg = null;
        if (null != $path && !$this->isTQualifiedNameValid($path)) {
            $msg = "Path must be a valid TQualifiedName";
            throw new \InvalidArgumentException($msg);
        }
        $this->path = $path;
        return $this;
    }

    public function isGInlineExpressionsValid(&$msg = null)
    {
        if (null != $this->string && !is_string($this->string)) {
            $msg = "String must be a string: " . get_class($this);
            return false;
        }
        if (null != $this->binary && !$this->hexBinary($this->binary)) {
            $msg = "Binary must be hexadecimal: " . get_class($this);
            return false;
        }
        if (null != $this->int && $this->int !== intval($this->int)) {
            $msg = "Integer must be integral: " . get_class($this);
            return false;
        }
        if (null != $this->float && $this->float !== floatval($this->float)) {
            $msg = "Float must be floating-point: " . get_class($this);
            return false;
        }
        if (null != $this->guid && !$this->isTGuidLiteralValid($this->guid)) {
            $msg = "Guid must be valid GUID: " . get_class($this);
            return false;
        }
        if (null != $this->bool && $this->bool !== boolval($this->bool)) {
            $msg = "Bool must be boolean: " . get_class($this);
            return false;
        }
        if (null != $this->decimal && $this->decimal !== floatval($this->decimal)) {
            $msg = "Decimal must be decimal: " . get_class($this);
            return false;
        }
        if (null != $this->enum && !$this->isTQualifiedNameValid($this->enum)) {
            $msg = "Enum must be a valid TQualifiedName: " . get_class($this);
            return false;
        }
        if (null != $this->path && !$this->isTQualifiedNameValid($this->path)) {
            $msg = "Path must be a valid TQualifiedName: " . get_class($this);
            return false;
        }
        if (null != $this->dateTime && $this->dateTime !== $this->dateTime($this->dateTime)) {
            $msg = "DateTime must be a valid date/time: " . get_class($this);
            return false;
        }
        if (null != $this->dateTimeOffset && $this->dateTimeOffset !== $this->dateTime($this->dateTimeOffset)) {
            $msg = "DateTimeOffset must be a valid date/time: " . get_class($this);
            return false;
        }

        return true;
    }
}
