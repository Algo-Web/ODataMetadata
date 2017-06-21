<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Groups;

use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TAnonymousFunctionExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TEntitySetReferenceExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TIfExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TParameterReferenceExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyReferenceExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TRecordExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAssertExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeTestExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermReferenceExpressionType;
use AlgoWeb\ODataMetadata\StringTraits\XSDTopLevelTrait;

trait GExpressionTrait
{
    use XSDTopLevelTrait, IsOKToolboxTrait;

    private $gExpressionMinimum = -1;
    private $gExpressionMaximum = -1;

    private $gExpressionSimpleFieldNames = ['string' => 'string', 'binary' => 'hexBinary', 'int' => 'integer',
        'float' => 'double', 'guid' => null, 'decimal' => 'decimal', 'bool' => null, 'dateTime' => 'dateTime',
        'dateTimeOffset' => 'dateTime', 'enum' => null, 'path' => null];
    private $gExpressionObjectFieldTypes = [
        'if' => '\AlgoWeb\ODataMetadata\MetadataV3\edm\TIfExpressionType',
        'record' => '\AlgoWeb\ODataMetadata\MetadataV3\edm\TRecordExpressionType',
        'collection' => '\AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionExpressionType',
        'typeAssert' => '\AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAssertExpressionType',
        'typeTest' => '\AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeTestExpressionType',
        'functionReference' => '\AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType',
        'entitySetReference' => '\AlgoWeb\ODataMetadata\MetadataV3\edm\TEntitySetReferenceExpressionType',
        'anonymousFunction' => '\AlgoWeb\ODataMetadata\MetadataV3\edm\TAnonymousFunctionExpressionType',
        'parameterReference' => '\AlgoWeb\ODataMetadata\MetadataV3\edm\TParameterReferenceExpressionType',
        'apply' => '\AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType',
        'propertyReference' => '\AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyReferenceExpressionType',
        'valueTermReference' => '\AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermReferenceExpressionType'
    ];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TIfExpressionType $if
     */
    private $if = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TRecordExpressionType $record
     */
    private $record = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionExpressionType $collection
     */
    private $collection = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAssertExpressionType $typeAssert
     */
    private $typeAssert = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeTestExpressionType $typeTest
     */
    private $typeTest = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType $functionReference
     */
    private $functionReference = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntitySetReferenceExpressionType $entitySetReference
     */
    private $entitySetReference = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TAnonymousFunctionExpressionType $anonymousFunction
     */
    private $anonymousFunction = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TParameterReferenceExpressionType $parameterReference
     */
    private $parameterReference = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType $apply
     */
    private $apply = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyReferenceExpressionType $propertyReference
     */
    private $propertyReference = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermReferenceExpressionType $valueTermReference
     */
    private $valueTermReference = null;

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
            $msg = "Guid must be a valid TGuidLiteral";
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
        $this->bool = boolval($bool);
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

    /**
     * Gets as if
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TIfExpressionType
     */
    public function getIf()
    {
        return $this->if;
    }

    /**
     * Sets a new if
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TIfExpressionType $if
     * @return self
     */
    public function setIf(TIfExpressionType $if)
    {
        $msg = null;
        if (!$if->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->if = $if;
        return $this;
    }

    /**
     * Gets as record
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TRecordExpressionType
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * Sets a new record
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TRecordExpressionType $record
     * @return self
     */
    public function setRecord(TRecordExpressionType $record)
    {
        $msg = null;
        if (!$record->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->record = $record;
        return $this;
    }

    /**
     * Gets as collection
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionExpressionType
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Sets a new collection
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionExpressionType $collection
     * @return self
     */
    public function setCollection(TCollectionExpressionType $collection)
    {
        $msg = null;
        if (!$collection->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->collection = $collection;
        return $this;
    }

    /**
     * Gets as typeAssert
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAssertExpressionType
     */
    public function getTypeAssert()
    {
        return $this->typeAssert;
    }

    /**
     * Sets a new typeAssert
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAssertExpressionType $typeAssert
     * @return self
     */
    public function setTypeAssert(TTypeAssertExpressionType $typeAssert)
    {
        $msg = null;
        if (!$typeAssert->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->typeAssert = $typeAssert;
        return $this;
    }

    /**
     * Gets as typeTest
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeTestExpressionType
     */
    public function getTypeTest()
    {
        return $this->typeTest;
    }

    /**
     * Sets a new typeTest
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeTestExpressionType $typeTest
     * @return self
     */
    public function setTypeTest(TTypeTestExpressionType $typeTest)
    {
        $msg = null;
        if (!$typeTest->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->typeTest = $typeTest;
        return $this;
    }

    /**
     * Gets as functionReference
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType
     */
    public function getFunctionReference()
    {
        return $this->functionReference;
    }

    /**
     * Sets a new functionReference
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType $functionReference
     * @return self
     */
    public function setFunctionReference(TFunctionReferenceExpressionType $functionReference)
    {
        $msg = null;
        if (!$functionReference->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->functionReference = $functionReference;
        return $this;
    }

    /**
     * Gets as entitySetReference
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntitySetReferenceExpressionType
     */
    public function getEntitySetReference()
    {
        return $this->entitySetReference;
    }

    /**
     * Sets a new entitySetReference
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntitySetReferenceExpressionType $entitySetReference
     * @return self
     */
    public function setEntitySetReference(TEntitySetReferenceExpressionType $entitySetReference)
    {
        $msg = null;
        if (!$entitySetReference->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->entitySetReference = $entitySetReference;
        return $this;
    }

    /**
     * Gets as anonymousFunction
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TAnonymousFunctionExpressionType
     */
    public function getAnonymousFunction()
    {
        return $this->anonymousFunction;
    }

    /**
     * Sets a new anonymousFunction
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TAnonymousFunctionExpressionType $anonymousFunction
     * @return self
     */
    public function setAnonymousFunction(TAnonymousFunctionExpressionType $anonymousFunction)
    {
        $msg = null;
        if (!$anonymousFunction->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->anonymousFunction = $anonymousFunction;
        return $this;
    }

    /**
     * Gets as parameterReference
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TParameterReferenceExpressionType
     */
    public function getParameterReference()
    {
        return $this->parameterReference;
    }

    /**
     * Sets a new parameterReference
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TParameterReferenceExpressionType $parameterReference
     * @return self
     */
    public function setParameterReference(TParameterReferenceExpressionType $parameterReference)
    {
        $msg = null;
        if (!$parameterReference->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->parameterReference = $parameterReference;
        return $this;
    }

    /**
     * Gets as apply
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType
     */
    public function getApply()
    {
        return $this->apply;
    }

    /**
     * Sets a new apply
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType $apply
     * @return self
     */
    public function setApply(TApplyExpressionType $apply)
    {
        $msg = null;
        if (!$apply->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->apply = $apply;
        return $this;
    }

    /**
     * Gets as propertyReference
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyReferenceExpressionType
     */
    public function getPropertyReference()
    {
        return $this->propertyReference;
    }

    /**
     * Sets a new propertyReference
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyReferenceExpressionType $propertyReference
     * @return self
     */
    public function setPropertyReference(TPropertyReferenceExpressionType $propertyReference)
    {
        $msg = null;
        if (!$propertyReference->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->propertyReference = $propertyReference;
        return $this;
    }

    /**
     * Gets as valueTermReference
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermReferenceExpressionType
     */
    public function getValueTermReference()
    {
        return $this->valueTermReference;
    }

    /**
     * Sets a new valueTermReference
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermReferenceExpressionType $valueTermReference
     * @return self
     */
    public function setValueTermReference(TValueTermReferenceExpressionType $valueTermReference)
    {
        $msg = null;
        if (!$valueTermReference->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->valueTermReference = $valueTermReference;
        return $this;
    }

    public function isGExpressionValid(&$msg = null)
    {
        if (-1 < $this->gExpressionMinimum || -1 < $this->gExpressionMaximum) {
            $counter = 0;
            foreach ($this->gExpressionSimpleFieldNames as $name => $type) {
                $counter += isset($this->$name) ? 1 : 0;
            }
            foreach ($this->gExpressionObjectFieldTypes as $name => $type) {
                $counter += isset($this->$name) ? 1 : 0;
            }
            if (-1 < $this->gExpressionMinimum && $counter < $this->gExpressionMinimum) {
                $msg = $counter . " fields not null.  Need minimum of ".$this->gExpressionMinimum. ": "
                        . get_class($this);
                return false;
            }
            if (-1 < $this->gExpressionMaximum && $counter > $this->gExpressionMaximum) {
                $msg = $counter . " fields not null.  Need maximum of ".$this->gExpressionMaximum. ": "
                        . get_class($this);
                return false;
            }
        }

        if (null != $this->guid && !$this->isTGuidLiteralValid($this->guid)) {
            $msg = "Guid must be a valid TGuidLiteral: " . get_class($this);
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

        foreach ($this->gExpressionSimpleFieldNames as $key => $type) {
            if (null != $type && null != $key && null != $this->$key) {
                // this bit passes if nothing throws an exception
                $result = $this->$type($this->$key);
            }
        }

        foreach ($this->gExpressionObjectFieldTypes as $key => $type) {
            if (!$this->isObjectNullOrOK($this->$key, $msg)) {
                return false;
            }
            if (!$this->isObjectNullOrType($type, $this->$key)) {
                $msg = 'Type mismatch - should be ' . $type . ", is " . get_class($this->$key) . ": " . get_class($this);
                return false;
            }
        }

        return true;
    }
}
