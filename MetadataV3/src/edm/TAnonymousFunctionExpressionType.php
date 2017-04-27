<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

/**
 * Class representing TAnonymousFunctionExpressionType
 *
 *
 * XSD Type: TAnonymousFunctionExpression
 */
class TAnonymousFunctionExpressionType
{

    /**
     * @property \MetadataV3\edm\TFunctionParameterType[] $parameters
     */
    private $parameters = null;

    /**
     * @property string $string
     */
    private $string = null;

    /**
     * @property mixed $binary
     */
    private $binary = null;

    /**
     * @property integer $int
     */
    private $int = null;

    /**
     * @property float $float
     */
    private $float = null;

    /**
     * @property string $guid
     */
    private $guid = null;

    /**
     * @property float $decimal
     */
    private $decimal = null;

    /**
     * @property boolean $bool
     */
    private $bool = null;

    /**
     * @property \DateTime $dateTime
     */
    private $dateTime = null;

    /**
     * @property \DateTime $dateTimeOffset
     */
    private $dateTimeOffset = null;

    /**
     * @property string $enum
     */
    private $enum = null;

    /**
     * @property string $path
     */
    private $path = null;

    /**
     * @property \MetadataV3\edm\TIfExpressionType $if
     */
    private $if = null;

    /**
     * @property \MetadataV3\edm\TRecordExpressionType $record
     */
    private $record = null;

    /**
     * @property \MetadataV3\edm\TCollectionExpressionType $collection
     */
    private $collection = null;

    /**
     * @property \MetadataV3\edm\TTypeAssertExpressionType $typeAssert
     */
    private $typeAssert = null;

    /**
     * @property \MetadataV3\edm\TTypeTestExpressionType $typeTest
     */
    private $typeTest = null;

    /**
     * @property \MetadataV3\edm\TFunctionReferenceExpressionType $functionReference
     */
    private $functionReference = null;

    /**
     * @property \MetadataV3\edm\TEntitySetReferenceExpressionType $entitySetReference
     */
    private $entitySetReference = null;

    /**
     * @property \MetadataV3\edm\TAnonymousFunctionExpressionType $anonymousFunction
     */
    private $anonymousFunction = null;

    /**
     * @property \MetadataV3\edm\TParameterReferenceExpressionType $parameterReference
     */
    private $parameterReference = null;

    /**
     * @property \MetadataV3\edm\TApplyExpressionType $apply
     */
    private $apply = null;

    /**
     * @property \MetadataV3\edm\TPropertyReferenceExpressionType $propertyReference
     */
    private $propertyReference = null;

    /**
     * @property \MetadataV3\edm\TValueTermReferenceExpressionType $valueTermReference
     */
    private $valueTermReference = null;

    /**
     * Adds as parameter
     *
     * @return self
     * @param \MetadataV3\edm\TFunctionParameterType $parameter
     */
    public function addToParameters(\MetadataV3\edm\TFunctionParameterType $parameter)
    {
        $this->parameters[] = $parameter;
        return $this;
    }

    /**
     * isset parameters
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetParameters($index)
    {
        return isset($this->parameters[$index]);
    }

    /**
     * unset parameters
     *
     * @param scalar $index
     * @return void
     */
    public function unsetParameters($index)
    {
        unset($this->parameters[$index]);
    }

    /**
     * Gets as parameters
     *
     * @return \MetadataV3\edm\TFunctionParameterType[]
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Sets a new parameters
     *
     * @param \MetadataV3\edm\TFunctionParameterType[] $parameters
     * @return self
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
        return $this;
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
     * @param string $string
     * @return self
     */
    public function setString($string)
    {
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
     * @param mixed $binary
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
     * @param integer $int
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
     * @param float $float
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
     * @param string $guid
     * @return self
     */
    public function setGuid($guid)
    {
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
     * @param float $decimal
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
     * @param boolean $bool
     * @return self
     */
    public function setBool($bool)
    {
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
     * @param \DateTime $dateTime
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
     * @param \DateTime $dateTimeOffset
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
     * @param string $enum
     * @return self
     */
    public function setEnum($enum)
    {
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
     * @param string $path
     * @return self
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Gets as if
     *
     * @return \MetadataV3\edm\TIfExpressionType
     */
    public function getIf()
    {
        return $this->if;
    }

    /**
     * Sets a new if
     *
     * @param \MetadataV3\edm\TIfExpressionType $if
     * @return self
     */
    public function setIf(\MetadataV3\edm\TIfExpressionType $if)
    {
        $this->if = $if;
        return $this;
    }

    /**
     * Gets as record
     *
     * @return \MetadataV3\edm\TRecordExpressionType
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * Sets a new record
     *
     * @param \MetadataV3\edm\TRecordExpressionType $record
     * @return self
     */
    public function setRecord(\MetadataV3\edm\TRecordExpressionType $record)
    {
        $this->record = $record;
        return $this;
    }

    /**
     * Gets as collection
     *
     * @return \MetadataV3\edm\TCollectionExpressionType
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Sets a new collection
     *
     * @param \MetadataV3\edm\TCollectionExpressionType $collection
     * @return self
     */
    public function setCollection(\MetadataV3\edm\TCollectionExpressionType $collection)
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * Gets as typeAssert
     *
     * @return \MetadataV3\edm\TTypeAssertExpressionType
     */
    public function getTypeAssert()
    {
        return $this->typeAssert;
    }

    /**
     * Sets a new typeAssert
     *
     * @param \MetadataV3\edm\TTypeAssertExpressionType $typeAssert
     * @return self
     */
    public function setTypeAssert(\MetadataV3\edm\TTypeAssertExpressionType $typeAssert)
    {
        $this->typeAssert = $typeAssert;
        return $this;
    }

    /**
     * Gets as typeTest
     *
     * @return \MetadataV3\edm\TTypeTestExpressionType
     */
    public function getTypeTest()
    {
        return $this->typeTest;
    }

    /**
     * Sets a new typeTest
     *
     * @param \MetadataV3\edm\TTypeTestExpressionType $typeTest
     * @return self
     */
    public function setTypeTest(\MetadataV3\edm\TTypeTestExpressionType $typeTest)
    {
        $this->typeTest = $typeTest;
        return $this;
    }

    /**
     * Gets as functionReference
     *
     * @return \MetadataV3\edm\TFunctionReferenceExpressionType
     */
    public function getFunctionReference()
    {
        return $this->functionReference;
    }

    /**
     * Sets a new functionReference
     *
     * @param \MetadataV3\edm\TFunctionReferenceExpressionType $functionReference
     * @return self
     */
    public function setFunctionReference(\MetadataV3\edm\TFunctionReferenceExpressionType $functionReference)
    {
        $this->functionReference = $functionReference;
        return $this;
    }

    /**
     * Gets as entitySetReference
     *
     * @return \MetadataV3\edm\TEntitySetReferenceExpressionType
     */
    public function getEntitySetReference()
    {
        return $this->entitySetReference;
    }

    /**
     * Sets a new entitySetReference
     *
     * @param \MetadataV3\edm\TEntitySetReferenceExpressionType $entitySetReference
     * @return self
     */
    public function setEntitySetReference(\MetadataV3\edm\TEntitySetReferenceExpressionType $entitySetReference)
    {
        $this->entitySetReference = $entitySetReference;
        return $this;
    }

    /**
     * Gets as anonymousFunction
     *
     * @return \MetadataV3\edm\TAnonymousFunctionExpressionType
     */
    public function getAnonymousFunction()
    {
        return $this->anonymousFunction;
    }

    /**
     * Sets a new anonymousFunction
     *
     * @param \MetadataV3\edm\TAnonymousFunctionExpressionType $anonymousFunction
     * @return self
     */
    public function setAnonymousFunction(\MetadataV3\edm\TAnonymousFunctionExpressionType $anonymousFunction)
    {
        $this->anonymousFunction = $anonymousFunction;
        return $this;
    }

    /**
     * Gets as parameterReference
     *
     * @return \MetadataV3\edm\TParameterReferenceExpressionType
     */
    public function getParameterReference()
    {
        return $this->parameterReference;
    }

    /**
     * Sets a new parameterReference
     *
     * @param \MetadataV3\edm\TParameterReferenceExpressionType $parameterReference
     * @return self
     */
    public function setParameterReference(\MetadataV3\edm\TParameterReferenceExpressionType $parameterReference)
    {
        $this->parameterReference = $parameterReference;
        return $this;
    }

    /**
     * Gets as apply
     *
     * @return \MetadataV3\edm\TApplyExpressionType
     */
    public function getApply()
    {
        return $this->apply;
    }

    /**
     * Sets a new apply
     *
     * @param \MetadataV3\edm\TApplyExpressionType $apply
     * @return self
     */
    public function setApply(\MetadataV3\edm\TApplyExpressionType $apply)
    {
        $this->apply = $apply;
        return $this;
    }

    /**
     * Gets as propertyReference
     *
     * @return \MetadataV3\edm\TPropertyReferenceExpressionType
     */
    public function getPropertyReference()
    {
        return $this->propertyReference;
    }

    /**
     * Sets a new propertyReference
     *
     * @param \MetadataV3\edm\TPropertyReferenceExpressionType $propertyReference
     * @return self
     */
    public function setPropertyReference(\MetadataV3\edm\TPropertyReferenceExpressionType $propertyReference)
    {
        $this->propertyReference = $propertyReference;
        return $this;
    }

    /**
     * Gets as valueTermReference
     *
     * @return \MetadataV3\edm\TValueTermReferenceExpressionType
     */
    public function getValueTermReference()
    {
        return $this->valueTermReference;
    }

    /**
     * Sets a new valueTermReference
     *
     * @param \MetadataV3\edm\TValueTermReferenceExpressionType $valueTermReference
     * @return self
     */
    public function setValueTermReference(\MetadataV3\edm\TValueTermReferenceExpressionType $valueTermReference)
    {
        $this->valueTermReference = $valueTermReference;
        return $this;
    }
}
