<?php

namespace MetadataV3\edm;

/**
 * Class representing TCollectionExpressionType
 *
 *
 * XSD Type: TCollectionExpression
 */
class TCollectionExpressionType
{

    /**
     * @property string[] $string
     */
    private $string = array(
        
    );

    /**
     * @property mixed[] $binary
     */
    private $binary = array(
        
    );

    /**
     * @property integer[] $int
     */
    private $int = array(
        
    );

    /**
     * @property float[] $float
     */
    private $float = array(
        
    );

    /**
     * @property string[] $guid
     */
    private $guid = array(
        
    );

    /**
     * @property float[] $decimal
     */
    private $decimal = array(
        
    );

    /**
     * @property boolean[] $bool
     */
    private $bool = array(
        
    );

    /**
     * @property \DateTime[] $dateTime
     */
    private $dateTime = array(
        
    );

    /**
     * @property \DateTime[] $dateTimeOffset
     */
    private $dateTimeOffset = array(
        
    );

    /**
     * @property string[] $enum
     */
    private $enum = array(
        
    );

    /**
     * @property string[] $path
     */
    private $path = array(
        
    );

    /**
     * @property \MetadataV3\edm\TIfExpressionType[] $if
     */
    private $if = array(
        
    );

    /**
     * @property \MetadataV3\edm\TRecordExpressionType[] $record
     */
    private $record = array(
        
    );

    /**
     * @property \MetadataV3\edm\TCollectionExpressionType[] $collection
     */
    private $collection = array(
        
    );

    /**
     * @property \MetadataV3\edm\TTypeAssertExpressionType[] $typeAssert
     */
    private $typeAssert = array(
        
    );

    /**
     * @property \MetadataV3\edm\TTypeTestExpressionType[] $typeTest
     */
    private $typeTest = array(
        
    );

    /**
     * @property \MetadataV3\edm\TFunctionReferenceExpressionType[] $functionReference
     */
    private $functionReference = array(
        
    );

    /**
     * @property \MetadataV3\edm\TEntitySetReferenceExpressionType[]
     * $entitySetReference
     */
    private $entitySetReference = array(
        
    );

    /**
     * @property \MetadataV3\edm\TAnonymousFunctionExpressionType[] $anonymousFunction
     */
    private $anonymousFunction = array(
        
    );

    /**
     * @property \MetadataV3\edm\TParameterReferenceExpressionType[]
     * $parameterReference
     */
    private $parameterReference = array(
        
    );

    /**
     * @property \MetadataV3\edm\TApplyExpressionType[] $apply
     */
    private $apply = array(
        
    );

    /**
     * @property \MetadataV3\edm\TPropertyReferenceExpressionType[] $propertyReference
     */
    private $propertyReference = array(
        
    );

    /**
     * @property \MetadataV3\edm\TValueTermReferenceExpressionType[]
     * $valueTermReference
     */
    private $valueTermReference = array(
        
    );

    /**
     * Adds as string
     *
     * @return self
     * @param string $string
     */
    public function addToString($string)
    {
        $this->string[] = $string;
        return $this;
    }

    /**
     * isset string
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetString($index)
    {
        return isset($this->string[$index]);
    }

    /**
     * unset string
     *
     * @param scalar $index
     * @return void
     */
    public function unsetString($index)
    {
        unset($this->string[$index]);
    }

    /**
     * Gets as string
     *
     * @return string[]
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
    public function setString(array $string)
    {
        $this->string = $string;
        return $this;
    }

    /**
     * Adds as binary
     *
     * @return self
     * @param mixed $binary
     */
    public function addToBinary($binary)
    {
        $this->binary[] = $binary;
        return $this;
    }

    /**
     * isset binary
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetBinary($index)
    {
        return isset($this->binary[$index]);
    }

    /**
     * unset binary
     *
     * @param scalar $index
     * @return void
     */
    public function unsetBinary($index)
    {
        unset($this->binary[$index]);
    }

    /**
     * Gets as binary
     *
     * @return mixed[]
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
    public function setBinary(array $binary)
    {
        $this->binary = $binary;
        return $this;
    }

    /**
     * Adds as int
     *
     * @return self
     * @param integer $int
     */
    public function addToInt($int)
    {
        $this->int[] = $int;
        return $this;
    }

    /**
     * isset int
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetInt($index)
    {
        return isset($this->int[$index]);
    }

    /**
     * unset int
     *
     * @param scalar $index
     * @return void
     */
    public function unsetInt($index)
    {
        unset($this->int[$index]);
    }

    /**
     * Gets as int
     *
     * @return integer[]
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
    public function setInt(array $int)
    {
        $this->int = $int;
        return $this;
    }

    /**
     * Adds as float
     *
     * @return self
     * @param float $float
     */
    public function addToFloat($float)
    {
        $this->float[] = $float;
        return $this;
    }

    /**
     * isset float
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetFloat($index)
    {
        return isset($this->float[$index]);
    }

    /**
     * unset float
     *
     * @param scalar $index
     * @return void
     */
    public function unsetFloat($index)
    {
        unset($this->float[$index]);
    }

    /**
     * Gets as float
     *
     * @return float[]
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
    public function setFloat(array $float)
    {
        $this->float = $float;
        return $this;
    }

    /**
     * Adds as guid
     *
     * @return self
     * @param string $guid
     */
    public function addToGuid($guid)
    {
        $this->guid[] = $guid;
        return $this;
    }

    /**
     * isset guid
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetGuid($index)
    {
        return isset($this->guid[$index]);
    }

    /**
     * unset guid
     *
     * @param scalar $index
     * @return void
     */
    public function unsetGuid($index)
    {
        unset($this->guid[$index]);
    }

    /**
     * Gets as guid
     *
     * @return string[]
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
    public function setGuid(array $guid)
    {
        $this->guid = $guid;
        return $this;
    }

    /**
     * Adds as decimal
     *
     * @return self
     * @param float $decimal
     */
    public function addToDecimal($decimal)
    {
        $this->decimal[] = $decimal;
        return $this;
    }

    /**
     * isset decimal
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetDecimal($index)
    {
        return isset($this->decimal[$index]);
    }

    /**
     * unset decimal
     *
     * @param scalar $index
     * @return void
     */
    public function unsetDecimal($index)
    {
        unset($this->decimal[$index]);
    }

    /**
     * Gets as decimal
     *
     * @return float[]
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
    public function setDecimal(array $decimal)
    {
        $this->decimal = $decimal;
        return $this;
    }

    /**
     * Adds as bool
     *
     * @return self
     * @param boolean $bool
     */
    public function addToBool($bool)
    {
        $this->bool[] = $bool;
        return $this;
    }

    /**
     * isset bool
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetBool($index)
    {
        return isset($this->bool[$index]);
    }

    /**
     * unset bool
     *
     * @param scalar $index
     * @return void
     */
    public function unsetBool($index)
    {
        unset($this->bool[$index]);
    }

    /**
     * Gets as bool
     *
     * @return boolean[]
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
    public function setBool(array $bool)
    {
        $this->bool = $bool;
        return $this;
    }

    /**
     * Adds as dateTime
     *
     * @return self
     * @param \DateTime $dateTime
     */
    public function addToDateTime(\DateTime $dateTime)
    {
        $this->dateTime[] = $dateTime;
        return $this;
    }

    /**
     * isset dateTime
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetDateTime($index)
    {
        return isset($this->dateTime[$index]);
    }

    /**
     * unset dateTime
     *
     * @param scalar $index
     * @return void
     */
    public function unsetDateTime($index)
    {
        unset($this->dateTime[$index]);
    }

    /**
     * Gets as dateTime
     *
     * @return \DateTime[]
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
    public function setDateTime(array $dateTime)
    {
        $this->dateTime = $dateTime;
        return $this;
    }

    /**
     * Adds as dateTimeOffset
     *
     * @return self
     * @param \DateTime $dateTimeOffset
     */
    public function addToDateTimeOffset(\DateTime $dateTimeOffset)
    {
        $this->dateTimeOffset[] = $dateTimeOffset;
        return $this;
    }

    /**
     * isset dateTimeOffset
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetDateTimeOffset($index)
    {
        return isset($this->dateTimeOffset[$index]);
    }

    /**
     * unset dateTimeOffset
     *
     * @param scalar $index
     * @return void
     */
    public function unsetDateTimeOffset($index)
    {
        unset($this->dateTimeOffset[$index]);
    }

    /**
     * Gets as dateTimeOffset
     *
     * @return \DateTime[]
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
    public function setDateTimeOffset(array $dateTimeOffset)
    {
        $this->dateTimeOffset = $dateTimeOffset;
        return $this;
    }

    /**
     * Adds as enum
     *
     * @return self
     * @param string $enum
     */
    public function addToEnum($enum)
    {
        $this->enum[] = $enum;
        return $this;
    }

    /**
     * isset enum
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetEnum($index)
    {
        return isset($this->enum[$index]);
    }

    /**
     * unset enum
     *
     * @param scalar $index
     * @return void
     */
    public function unsetEnum($index)
    {
        unset($this->enum[$index]);
    }

    /**
     * Gets as enum
     *
     * @return string[]
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
    public function setEnum(array $enum)
    {
        $this->enum = $enum;
        return $this;
    }

    /**
     * Adds as path
     *
     * @return self
     * @param string $path
     */
    public function addToPath($path)
    {
        $this->path[] = $path;
        return $this;
    }

    /**
     * isset path
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetPath($index)
    {
        return isset($this->path[$index]);
    }

    /**
     * unset path
     *
     * @param scalar $index
     * @return void
     */
    public function unsetPath($index)
    {
        unset($this->path[$index]);
    }

    /**
     * Gets as path
     *
     * @return string[]
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
    public function setPath(array $path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Adds as if
     *
     * @return self
     * @param \MetadataV3\edm\TIfExpressionType $if
     */
    public function addToIf(\MetadataV3\edm\TIfExpressionType $if)
    {
        $this->if[] = $if;
        return $this;
    }

    /**
     * isset if
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetIf($index)
    {
        return isset($this->if[$index]);
    }

    /**
     * unset if
     *
     * @param scalar $index
     * @return void
     */
    public function unsetIf($index)
    {
        unset($this->if[$index]);
    }

    /**
     * Gets as if
     *
     * @return \MetadataV3\edm\TIfExpressionType[]
     */
    public function getIf()
    {
        return $this->if;
    }

    /**
     * Sets a new if
     *
     * @param \MetadataV3\edm\TIfExpressionType[] $if
     * @return self
     */
    public function setIf(array $if)
    {
        $this->if = $if;
        return $this;
    }

    /**
     * Adds as record
     *
     * @return self
     * @param \MetadataV3\edm\TRecordExpressionType $record
     */
    public function addToRecord(\MetadataV3\edm\TRecordExpressionType $record)
    {
        $this->record[] = $record;
        return $this;
    }

    /**
     * isset record
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetRecord($index)
    {
        return isset($this->record[$index]);
    }

    /**
     * unset record
     *
     * @param scalar $index
     * @return void
     */
    public function unsetRecord($index)
    {
        unset($this->record[$index]);
    }

    /**
     * Gets as record
     *
     * @return \MetadataV3\edm\TRecordExpressionType[]
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * Sets a new record
     *
     * @param \MetadataV3\edm\TRecordExpressionType[] $record
     * @return self
     */
    public function setRecord(array $record)
    {
        $this->record = $record;
        return $this;
    }

    /**
     * Adds as collection
     *
     * @return self
     * @param \MetadataV3\edm\TCollectionExpressionType $collection
     */
    public function addToCollection(\MetadataV3\edm\TCollectionExpressionType $collection)
    {
        $this->collection[] = $collection;
        return $this;
    }

    /**
     * isset collection
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetCollection($index)
    {
        return isset($this->collection[$index]);
    }

    /**
     * unset collection
     *
     * @param scalar $index
     * @return void
     */
    public function unsetCollection($index)
    {
        unset($this->collection[$index]);
    }

    /**
     * Gets as collection
     *
     * @return \MetadataV3\edm\TCollectionExpressionType[]
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Sets a new collection
     *
     * @param \MetadataV3\edm\TCollectionExpressionType[] $collection
     * @return self
     */
    public function setCollection(array $collection)
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * Adds as typeAssert
     *
     * @return self
     * @param \MetadataV3\edm\TTypeAssertExpressionType $typeAssert
     */
    public function addToTypeAssert(\MetadataV3\edm\TTypeAssertExpressionType $typeAssert)
    {
        $this->typeAssert[] = $typeAssert;
        return $this;
    }

    /**
     * isset typeAssert
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetTypeAssert($index)
    {
        return isset($this->typeAssert[$index]);
    }

    /**
     * unset typeAssert
     *
     * @param scalar $index
     * @return void
     */
    public function unsetTypeAssert($index)
    {
        unset($this->typeAssert[$index]);
    }

    /**
     * Gets as typeAssert
     *
     * @return \MetadataV3\edm\TTypeAssertExpressionType[]
     */
    public function getTypeAssert()
    {
        return $this->typeAssert;
    }

    /**
     * Sets a new typeAssert
     *
     * @param \MetadataV3\edm\TTypeAssertExpressionType[] $typeAssert
     * @return self
     */
    public function setTypeAssert(array $typeAssert)
    {
        $this->typeAssert = $typeAssert;
        return $this;
    }

    /**
     * Adds as typeTest
     *
     * @return self
     * @param \MetadataV3\edm\TTypeTestExpressionType $typeTest
     */
    public function addToTypeTest(\MetadataV3\edm\TTypeTestExpressionType $typeTest)
    {
        $this->typeTest[] = $typeTest;
        return $this;
    }

    /**
     * isset typeTest
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetTypeTest($index)
    {
        return isset($this->typeTest[$index]);
    }

    /**
     * unset typeTest
     *
     * @param scalar $index
     * @return void
     */
    public function unsetTypeTest($index)
    {
        unset($this->typeTest[$index]);
    }

    /**
     * Gets as typeTest
     *
     * @return \MetadataV3\edm\TTypeTestExpressionType[]
     */
    public function getTypeTest()
    {
        return $this->typeTest;
    }

    /**
     * Sets a new typeTest
     *
     * @param \MetadataV3\edm\TTypeTestExpressionType[] $typeTest
     * @return self
     */
    public function setTypeTest(array $typeTest)
    {
        $this->typeTest = $typeTest;
        return $this;
    }

    /**
     * Adds as functionReference
     *
     * @return self
     * @param \MetadataV3\edm\TFunctionReferenceExpressionType $functionReference
     */
    public function addToFunctionReference(\MetadataV3\edm\TFunctionReferenceExpressionType $functionReference)
    {
        $this->functionReference[] = $functionReference;
        return $this;
    }

    /**
     * isset functionReference
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetFunctionReference($index)
    {
        return isset($this->functionReference[$index]);
    }

    /**
     * unset functionReference
     *
     * @param scalar $index
     * @return void
     */
    public function unsetFunctionReference($index)
    {
        unset($this->functionReference[$index]);
    }

    /**
     * Gets as functionReference
     *
     * @return \MetadataV3\edm\TFunctionReferenceExpressionType[]
     */
    public function getFunctionReference()
    {
        return $this->functionReference;
    }

    /**
     * Sets a new functionReference
     *
     * @param \MetadataV3\edm\TFunctionReferenceExpressionType[] $functionReference
     * @return self
     */
    public function setFunctionReference(array $functionReference)
    {
        $this->functionReference = $functionReference;
        return $this;
    }

    /**
     * Adds as entitySetReference
     *
     * @return self
     * @param \MetadataV3\edm\TEntitySetReferenceExpressionType $entitySetReference
     */
    public function addToEntitySetReference(\MetadataV3\edm\TEntitySetReferenceExpressionType $entitySetReference)
    {
        $this->entitySetReference[] = $entitySetReference;
        return $this;
    }

    /**
     * isset entitySetReference
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetEntitySetReference($index)
    {
        return isset($this->entitySetReference[$index]);
    }

    /**
     * unset entitySetReference
     *
     * @param scalar $index
     * @return void
     */
    public function unsetEntitySetReference($index)
    {
        unset($this->entitySetReference[$index]);
    }

    /**
     * Gets as entitySetReference
     *
     * @return \MetadataV3\edm\TEntitySetReferenceExpressionType[]
     */
    public function getEntitySetReference()
    {
        return $this->entitySetReference;
    }

    /**
     * Sets a new entitySetReference
     *
     * @param \MetadataV3\edm\TEntitySetReferenceExpressionType[] $entitySetReference
     * @return self
     */
    public function setEntitySetReference(array $entitySetReference)
    {
        $this->entitySetReference = $entitySetReference;
        return $this;
    }

    /**
     * Adds as anonymousFunction
     *
     * @return self
     * @param \MetadataV3\edm\TAnonymousFunctionExpressionType $anonymousFunction
     */
    public function addToAnonymousFunction(\MetadataV3\edm\TAnonymousFunctionExpressionType $anonymousFunction)
    {
        $this->anonymousFunction[] = $anonymousFunction;
        return $this;
    }

    /**
     * isset anonymousFunction
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetAnonymousFunction($index)
    {
        return isset($this->anonymousFunction[$index]);
    }

    /**
     * unset anonymousFunction
     *
     * @param scalar $index
     * @return void
     */
    public function unsetAnonymousFunction($index)
    {
        unset($this->anonymousFunction[$index]);
    }

    /**
     * Gets as anonymousFunction
     *
     * @return \MetadataV3\edm\TAnonymousFunctionExpressionType[]
     */
    public function getAnonymousFunction()
    {
        return $this->anonymousFunction;
    }

    /**
     * Sets a new anonymousFunction
     *
     * @param \MetadataV3\edm\TAnonymousFunctionExpressionType[] $anonymousFunction
     * @return self
     */
    public function setAnonymousFunction(array $anonymousFunction)
    {
        $this->anonymousFunction = $anonymousFunction;
        return $this;
    }

    /**
     * Adds as parameterReference
     *
     * @return self
     * @param \MetadataV3\edm\TParameterReferenceExpressionType $parameterReference
     */
    public function addToParameterReference(\MetadataV3\edm\TParameterReferenceExpressionType $parameterReference)
    {
        $this->parameterReference[] = $parameterReference;
        return $this;
    }

    /**
     * isset parameterReference
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetParameterReference($index)
    {
        return isset($this->parameterReference[$index]);
    }

    /**
     * unset parameterReference
     *
     * @param scalar $index
     * @return void
     */
    public function unsetParameterReference($index)
    {
        unset($this->parameterReference[$index]);
    }

    /**
     * Gets as parameterReference
     *
     * @return \MetadataV3\edm\TParameterReferenceExpressionType[]
     */
    public function getParameterReference()
    {
        return $this->parameterReference;
    }

    /**
     * Sets a new parameterReference
     *
     * @param \MetadataV3\edm\TParameterReferenceExpressionType[] $parameterReference
     * @return self
     */
    public function setParameterReference(array $parameterReference)
    {
        $this->parameterReference = $parameterReference;
        return $this;
    }

    /**
     * Adds as apply
     *
     * @return self
     * @param \MetadataV3\edm\TApplyExpressionType $apply
     */
    public function addToApply(\MetadataV3\edm\TApplyExpressionType $apply)
    {
        $this->apply[] = $apply;
        return $this;
    }

    /**
     * isset apply
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetApply($index)
    {
        return isset($this->apply[$index]);
    }

    /**
     * unset apply
     *
     * @param scalar $index
     * @return void
     */
    public function unsetApply($index)
    {
        unset($this->apply[$index]);
    }

    /**
     * Gets as apply
     *
     * @return \MetadataV3\edm\TApplyExpressionType[]
     */
    public function getApply()
    {
        return $this->apply;
    }

    /**
     * Sets a new apply
     *
     * @param \MetadataV3\edm\TApplyExpressionType[] $apply
     * @return self
     */
    public function setApply(array $apply)
    {
        $this->apply = $apply;
        return $this;
    }

    /**
     * Adds as propertyReference
     *
     * @return self
     * @param \MetadataV3\edm\TPropertyReferenceExpressionType $propertyReference
     */
    public function addToPropertyReference(\MetadataV3\edm\TPropertyReferenceExpressionType $propertyReference)
    {
        $this->propertyReference[] = $propertyReference;
        return $this;
    }

    /**
     * isset propertyReference
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetPropertyReference($index)
    {
        return isset($this->propertyReference[$index]);
    }

    /**
     * unset propertyReference
     *
     * @param scalar $index
     * @return void
     */
    public function unsetPropertyReference($index)
    {
        unset($this->propertyReference[$index]);
    }

    /**
     * Gets as propertyReference
     *
     * @return \MetadataV3\edm\TPropertyReferenceExpressionType[]
     */
    public function getPropertyReference()
    {
        return $this->propertyReference;
    }

    /**
     * Sets a new propertyReference
     *
     * @param \MetadataV3\edm\TPropertyReferenceExpressionType[] $propertyReference
     * @return self
     */
    public function setPropertyReference(array $propertyReference)
    {
        $this->propertyReference = $propertyReference;
        return $this;
    }

    /**
     * Adds as valueTermReference
     *
     * @return self
     * @param \MetadataV3\edm\TValueTermReferenceExpressionType $valueTermReference
     */
    public function addToValueTermReference(\MetadataV3\edm\TValueTermReferenceExpressionType $valueTermReference)
    {
        $this->valueTermReference[] = $valueTermReference;
        return $this;
    }

    /**
     * isset valueTermReference
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetValueTermReference($index)
    {
        return isset($this->valueTermReference[$index]);
    }

    /**
     * unset valueTermReference
     *
     * @param scalar $index
     * @return void
     */
    public function unsetValueTermReference($index)
    {
        unset($this->valueTermReference[$index]);
    }

    /**
     * Gets as valueTermReference
     *
     * @return \MetadataV3\edm\TValueTermReferenceExpressionType[]
     */
    public function getValueTermReference()
    {
        return $this->valueTermReference;
    }

    /**
     * Sets a new valueTermReference
     *
     * @param \MetadataV3\edm\TValueTermReferenceExpressionType[] $valueTermReference
     * @return self
     */
    public function setValueTermReference(array $valueTermReference)
    {
        $this->valueTermReference = $valueTermReference;
        return $this;
    }


}

