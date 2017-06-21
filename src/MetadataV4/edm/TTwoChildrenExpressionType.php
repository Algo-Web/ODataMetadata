<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TTwoChildrenExpressionType
 *
 * XSD Type: TTwoChildrenExpression
 */
class TTwoChildrenExpressionType extends IsOK
{

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[] $annotation
     */
    private $annotation = array();

    /**
     * @property string[] $binary
     */
    private $binary = array();

    /**
     * @property boolean[] $bool
     */
    private $bool = array();

    /**
     * @property \DateTime[] $date
     */
    private $date = array();

    /**
     * @property \DateTime[] $dateTimeOffset
     */
    private $dateTimeOffset = array();

    /**
     * @property float[] $decimal
     */
    private $decimal = array();

    /**
     * @property \DateInterval[] $duration
     */
    private $duration = array();

    /**
     * @property string[] $enumMember
     */
    private $enumMember = null;

    /**
     * @property float[] $float
     */
    private $float = array();

    /**
     * @property string[] $guid
     */
    private $guid = array();

    /**
     * @property integer[] $int
     */
    private $int = array();

    /**
     * @property string[] $string
     */
    private $string = array();

    /**
     * @property \DateTime[] $timeOfDay
     */
    private $timeOfDay = array();

    /**
     * @property string[] $annotationPath
     */
    private $annotationPath = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TApplyExpressionType[] $apply
     */
    private $apply = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TCastOrIsOfExpressionType[] $cast
     */
    private $cast = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TCollectionExpressionType[] $collection
     */
    private $collection = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TIfExpressionType[] $if
     */
    private $if = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[] $eq
     */
    private $eq = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[] $ne
     */
    private $ne = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[] $ge
     */
    private $ge = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[] $gt
     */
    private $gt = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[] $le
     */
    private $le = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[] $lt
     */
    private $lt = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[] $and
     */
    private $and = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[] $or
     */
    private $or = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TOneChildExpressionType[] $not
     */
    private $not = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TCastOrIsOfExpressionType[] $isOf
     */
    private $isOf = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TLabeledElementExpressionType[] $labeledElement
     */
    private $labeledElement = array();

    /**
     * @property string[] $labeledElementReference
     */
    private $labeledElementReference = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[] $null
     */
    private $null = null;

    /**
     * @property string[] $navigationPropertyPath
     */
    private $navigationPropertyPath = array();

    /**
     * @property string[] $path
     */
    private $path = array();

    /**
     * @property string[] $propertyPath
     */
    private $propertyPath = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TRecordExpressionType[] $record
     */
    private $record = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TOneChildExpressionType[] $urlRef
     */
    private $urlRef = array();

    /**
     * Adds as annotation
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation $annotation
     */
    public function addToAnnotation(Annotation $annotation)
    {
        $this->annotation[] = $annotation;
        return $this;
    }

    /**
     * isset annotation
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetAnnotation($index)
    {
        return isset($this->annotation[$index]);
    }

    /**
     * unset annotation
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetAnnotation($index)
    {
        unset($this->annotation[$index]);
    }

    /**
     * Gets as annotation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[]
     */
    public function getAnnotation()
    {
        return $this->annotation;
    }

    /**
     * Sets a new annotation
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[] $annotation
     * @return self
     */
    public function setAnnotation(array $annotation)
    {
        $this->annotation = $annotation;
        return $this;
    }

    /**
     * Adds as binary
     *
     * @return self
     * @param  string $binary
     */
    public function addToBinary($binary)
    {
        $this->binary[] = $binary;
        return $this;
    }

    /**
     * isset binary
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetBinary($index)
    {
        return isset($this->binary[$index]);
    }

    /**
     * unset binary
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetBinary($index)
    {
        unset($this->binary[$index]);
    }

    /**
     * Gets as binary
     *
     * @return string[]
     */
    public function getBinary()
    {
        return $this->binary;
    }

    /**
     * Sets a new binary
     *
     * @param  string $binary
     * @return self
     */
    public function setBinary(array $binary)
    {
        $this->binary = $binary;
        return $this;
    }

    /**
     * Adds as bool
     *
     * @return self
     * @param  boolean $bool
     */
    public function addToBool($bool)
    {
        $this->bool[] = $bool;
        return $this;
    }

    /**
     * isset bool
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetBool($index)
    {
        return isset($this->bool[$index]);
    }

    /**
     * unset bool
     *
     * @param  scalar $index
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
     * @param  boolean $bool
     * @return self
     */
    public function setBool(array $bool)
    {
        $this->bool = $bool;
        return $this;
    }

    /**
     * Adds as date
     *
     * @return self
     * @param  \DateTime $date
     */
    public function addToDate(\DateTime $date)
    {
        $this->date[] = $date;
        return $this;
    }

    /**
     * isset date
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetDate($index)
    {
        return isset($this->date[$index]);
    }

    /**
     * unset date
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetDate($index)
    {
        unset($this->date[$index]);
    }

    /**
     * Gets as date
     *
     * @return \DateTime[]
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets a new date
     *
     * @param  \DateTime $date
     * @return self
     */
    public function setDate(array $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Adds as dateTimeOffset
     *
     * @return self
     * @param  \DateTime $dateTimeOffset
     */
    public function addToDateTimeOffset(\DateTime $dateTimeOffset)
    {
        $this->dateTimeOffset[] = $dateTimeOffset;
        return $this;
    }

    /**
     * isset dateTimeOffset
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetDateTimeOffset($index)
    {
        return isset($this->dateTimeOffset[$index]);
    }

    /**
     * unset dateTimeOffset
     *
     * @param  scalar $index
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
     * @param  \DateTime $dateTimeOffset
     * @return self
     */
    public function setDateTimeOffset(array $dateTimeOffset)
    {
        $this->dateTimeOffset = $dateTimeOffset;
        return $this;
    }

    /**
     * Adds as decimal
     *
     * @return self
     * @param  float $decimal
     */
    public function addToDecimal($decimal)
    {
        $this->decimal[] = $decimal;
        return $this;
    }

    /**
     * isset decimal
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetDecimal($index)
    {
        return isset($this->decimal[$index]);
    }

    /**
     * unset decimal
     *
     * @param  scalar $index
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
     * @param  float $decimal
     * @return self
     */
    public function setDecimal(array $decimal)
    {
        $this->decimal = $decimal;
        return $this;
    }

    /**
     * Adds as duration
     *
     * @return self
     * @param  \DateInterval $duration
     */
    public function addToDuration(\DateInterval $duration)
    {
        $this->duration[] = $duration;
        return $this;
    }

    /**
     * isset duration
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetDuration($index)
    {
        return isset($this->duration[$index]);
    }

    /**
     * unset duration
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetDuration($index)
    {
        unset($this->duration[$index]);
    }

    /**
     * Gets as duration
     *
     * @return \DateInterval[]
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Sets a new duration
     *
     * @param  \DateInterval $duration
     * @return self
     */
    public function setDuration(array $duration)
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * Adds as enumMember
     *
     * @return self
     * @param  string $enumMember
     */
    public function addToEnumMember($enumMember)
    {
        $this->enumMember[] = $enumMember;
        return $this;
    }

    /**
     * isset enumMember
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetEnumMember($index)
    {
        return isset($this->enumMember[$index]);
    }

    /**
     * unset enumMember
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetEnumMember($index)
    {
        unset($this->enumMember[$index]);
    }

    /**
     * Gets as enumMember
     *
     * @return string[]
     */
    public function getEnumMember()
    {
        return $this->enumMember;
    }

    /**
     * Sets a new enumMember
     *
     * @param  string $enumMember
     * @return self
     */
    public function setEnumMember(array $enumMember)
    {
        $this->enumMember = $enumMember;
        return $this;
    }

    /**
     * Adds as float
     *
     * @return self
     * @param  float $float
     */
    public function addToFloat($float)
    {
        $this->float[] = $float;
        return $this;
    }

    /**
     * isset float
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetFloat($index)
    {
        return isset($this->float[$index]);
    }

    /**
     * unset float
     *
     * @param  scalar $index
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
     * @param  float $float
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
     * @param  string $guid
     */
    public function addToGuid($guid)
    {
        $this->guid[] = $guid;
        return $this;
    }

    /**
     * isset guid
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetGuid($index)
    {
        return isset($this->guid[$index]);
    }

    /**
     * unset guid
     *
     * @param  scalar $index
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
     * @param  string $guid
     * @return self
     */
    public function setGuid(array $guid)
    {
        $this->guid = $guid;
        return $this;
    }

    /**
     * Adds as int
     *
     * @return self
     * @param  integer $int
     */
    public function addToInt($int)
    {
        $this->int[] = $int;
        return $this;
    }

    /**
     * isset int
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetInt($index)
    {
        return isset($this->int[$index]);
    }

    /**
     * unset int
     *
     * @param  scalar $index
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
     * @param  integer $int
     * @return self
     */
    public function setInt(array $int)
    {
        $this->int = $int;
        return $this;
    }

    /**
     * Adds as string
     *
     * @return self
     * @param  string $string
     */
    public function addToString($string)
    {
        $this->string[] = $string;
        return $this;
    }

    /**
     * isset string
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetString($index)
    {
        return isset($this->string[$index]);
    }

    /**
     * unset string
     *
     * @param  scalar $index
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
     * @param  string $string
     * @return self
     */
    public function setString(array $string)
    {
        $this->string = $string;
        return $this;
    }

    /**
     * Adds as timeOfDay
     *
     * @return self
     * @param  \DateTime $timeOfDay
     */
    public function addToTimeOfDay(\DateTime $timeOfDay)
    {
        $this->timeOfDay[] = $timeOfDay;
        return $this;
    }

    /**
     * isset timeOfDay
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetTimeOfDay($index)
    {
        return isset($this->timeOfDay[$index]);
    }

    /**
     * unset timeOfDay
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetTimeOfDay($index)
    {
        unset($this->timeOfDay[$index]);
    }

    /**
     * Gets as timeOfDay
     *
     * @return \DateTime[]
     */
    public function getTimeOfDay()
    {
        return $this->timeOfDay;
    }

    /**
     * Sets a new timeOfDay
     *
     * @param  \DateTime $timeOfDay
     * @return self
     */
    public function setTimeOfDay(array $timeOfDay)
    {
        $this->timeOfDay = $timeOfDay;
        return $this;
    }

    /**
     * Adds as annotationPath
     *
     * @return self
     * @param  string $annotationPath
     */
    public function addToAnnotationPath($annotationPath)
    {
        $this->annotationPath[] = $annotationPath;
        return $this;
    }

    /**
     * isset annotationPath
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetAnnotationPath($index)
    {
        return isset($this->annotationPath[$index]);
    }

    /**
     * unset annotationPath
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetAnnotationPath($index)
    {
        unset($this->annotationPath[$index]);
    }

    /**
     * Gets as annotationPath
     *
     * @return string[]
     */
    public function getAnnotationPath()
    {
        return $this->annotationPath;
    }

    /**
     * Sets a new annotationPath
     *
     * @param  string $annotationPath
     * @return self
     */
    public function setAnnotationPath(array $annotationPath)
    {
        $this->annotationPath = $annotationPath;
        return $this;
    }

    /**
     * Adds as apply
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TApplyExpressionType $apply
     */
    public function addToApply(TApplyExpressionType $apply)
    {
        $this->apply[] = $apply;
        return $this;
    }

    /**
     * isset apply
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetApply($index)
    {
        return isset($this->apply[$index]);
    }

    /**
     * unset apply
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetApply($index)
    {
        unset($this->apply[$index]);
    }

    /**
     * Gets as apply
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TApplyExpressionType[]
     */
    public function getApply()
    {
        return $this->apply;
    }

    /**
     * Sets a new apply
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TApplyExpressionType[] $apply
     * @return self
     */
    public function setApply(array $apply)
    {
        $this->apply = $apply;
        return $this;
    }

    /**
     * Adds as cast
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TCastOrIsOfExpressionType $cast
     */
    public function addToCast(TCastOrIsOfExpressionType $cast)
    {
        $this->cast[] = $cast;
        return $this;
    }

    /**
     * isset cast
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetCast($index)
    {
        return isset($this->cast[$index]);
    }

    /**
     * unset cast
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetCast($index)
    {
        unset($this->cast[$index]);
    }

    /**
     * Gets as cast
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TCastOrIsOfExpressionType[]
     */
    public function getCast()
    {
        return $this->cast;
    }

    /**
     * Sets a new cast
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TCastOrIsOfExpressionType[] $cast
     * @return self
     */
    public function setCast(array $cast)
    {
        $this->cast = $cast;
        return $this;
    }

    /**
     * Adds as collection
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TCollectionExpressionType $collection
     */
    public function addToCollection(TCollectionExpressionType $collection)
    {
        $this->collection[] = $collection;
        return $this;
    }

    /**
     * isset collection
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetCollection($index)
    {
        return isset($this->collection[$index]);
    }

    /**
     * unset collection
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetCollection($index)
    {
        unset($this->collection[$index]);
    }

    /**
     * Gets as collection
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TCollectionExpressionType[]
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Sets a new collection
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TCollectionExpressionType[] $collection
     * @return self
     */
    public function setCollection(array $collection)
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * Adds as if
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TIfExpressionType $if
     */
    public function addToIf(TIfExpressionType $if)
    {
        $this->if[] = $if;
        return $this;
    }

    /**
     * isset if
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetIf($index)
    {
        return isset($this->if[$index]);
    }

    /**
     * unset if
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetIf($index)
    {
        unset($this->if[$index]);
    }

    /**
     * Gets as if
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TIfExpressionType[]
     */
    public function getIf()
    {
        return $this->if;
    }

    /**
     * Sets a new if
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TIfExpressionType[] $if
     * @return self
     */
    public function setIf(array $if)
    {
        $this->if = $if;
        return $this;
    }

    /**
     * Adds as eq
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $eq
     */
    public function addToEq(TTwoChildrenExpressionType $eq)
    {
        $this->eq[] = $eq;
        return $this;
    }

    /**
     * isset eq
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetEq($index)
    {
        return isset($this->eq[$index]);
    }

    /**
     * unset eq
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetEq($index)
    {
        unset($this->eq[$index]);
    }

    /**
     * Gets as eq
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[]
     */
    public function getEq()
    {
        return $this->eq;
    }

    /**
     * Sets a new eq
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[] $eq
     * @return self
     */
    public function setEq(array $eq)
    {
        $this->eq = $eq;
        return $this;
    }

    /**
     * Adds as ne
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $ne
     */
    public function addToNe(TTwoChildrenExpressionType $ne)
    {
        $this->ne[] = $ne;
        return $this;
    }

    /**
     * isset ne
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetNe($index)
    {
        return isset($this->ne[$index]);
    }

    /**
     * unset ne
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetNe($index)
    {
        unset($this->ne[$index]);
    }

    /**
     * Gets as ne
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[]
     */
    public function getNe()
    {
        return $this->ne;
    }

    /**
     * Sets a new ne
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[] $ne
     * @return self
     */
    public function setNe(array $ne)
    {
        $this->ne = $ne;
        return $this;
    }

    /**
     * Adds as ge
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $ge
     */
    public function addToGe(TTwoChildrenExpressionType $ge)
    {
        $this->ge[] = $ge;
        return $this;
    }

    /**
     * isset ge
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetGe($index)
    {
        return isset($this->ge[$index]);
    }

    /**
     * unset ge
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetGe($index)
    {
        unset($this->ge[$index]);
    }

    /**
     * Gets as ge
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[]
     */
    public function getGe()
    {
        return $this->ge;
    }

    /**
     * Sets a new ge
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[] $ge
     * @return self
     */
    public function setGe(array $ge)
    {
        $this->ge = $ge;
        return $this;
    }

    /**
     * Adds as gt
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $gt
     */
    public function addToGt(TTwoChildrenExpressionType $gt)
    {
        $this->gt[] = $gt;
        return $this;
    }

    /**
     * isset gt
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetGt($index)
    {
        return isset($this->gt[$index]);
    }

    /**
     * unset gt
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetGt($index)
    {
        unset($this->gt[$index]);
    }

    /**
     * Gets as gt
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[]
     */
    public function getGt()
    {
        return $this->gt;
    }

    /**
     * Sets a new gt
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[] $gt
     * @return self
     */
    public function setGt(array $gt)
    {
        $this->gt = $gt;
        return $this;
    }

    /**
     * Adds as le
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $le
     */
    public function addToLe(TTwoChildrenExpressionType $le)
    {
        $this->le[] = $le;
        return $this;
    }

    /**
     * isset le
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetLe($index)
    {
        return isset($this->le[$index]);
    }

    /**
     * unset le
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetLe($index)
    {
        unset($this->le[$index]);
    }

    /**
     * Gets as le
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[]
     */
    public function getLe()
    {
        return $this->le;
    }

    /**
     * Sets a new le
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[] $le
     * @return self
     */
    public function setLe(array $le)
    {
        $this->le = $le;
        return $this;
    }

    /**
     * Adds as lt
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $lt
     */
    public function addToLt(TTwoChildrenExpressionType $lt)
    {
        $this->lt[] = $lt;
        return $this;
    }

    /**
     * isset lt
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetLt($index)
    {
        return isset($this->lt[$index]);
    }

    /**
     * unset lt
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetLt($index)
    {
        unset($this->lt[$index]);
    }

    /**
     * Gets as lt
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[]
     */
    public function getLt()
    {
        return $this->lt;
    }

    /**
     * Sets a new lt
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[] $lt
     * @return self
     */
    public function setLt(array $lt)
    {
        $this->lt = $lt;
        return $this;
    }

    /**
     * Adds as and
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $and
     */
    public function addToAnd(TTwoChildrenExpressionType $and)
    {
        $this->and[] = $and;
        return $this;
    }

    /**
     * isset and
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetAnd($index)
    {
        return isset($this->and[$index]);
    }

    /**
     * unset and
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetAnd($index)
    {
        unset($this->and[$index]);
    }

    /**
     * Gets as and
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[]
     */
    public function getAnd()
    {
        return $this->and;
    }

    /**
     * Sets a new and
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[] $and
     * @return self
     */
    public function setAnd(array $and)
    {
        $this->and = $and;
        return $this;
    }

    /**
     * Adds as or
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $or
     */
    public function addToOr(TTwoChildrenExpressionType $or)
    {
        $this->or[] = $or;
        return $this;
    }

    /**
     * isset or
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetOr($index)
    {
        return isset($this->or[$index]);
    }

    /**
     * unset or
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetOr($index)
    {
        unset($this->or[$index]);
    }

    /**
     * Gets as or
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[]
     */
    public function getOr()
    {
        return $this->or;
    }

    /**
     * Sets a new or
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType[] $or
     * @return self
     */
    public function setOr(array $or)
    {
        $this->or = $or;
        return $this;
    }

    /**
     * Adds as not
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TOneChildExpressionType $not
     */
    public function addToNot(TOneChildExpressionType $not)
    {
        $this->not[] = $not;
        return $this;
    }

    /**
     * isset not
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetNot($index)
    {
        return isset($this->not[$index]);
    }

    /**
     * unset not
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetNot($index)
    {
        unset($this->not[$index]);
    }

    /**
     * Gets as not
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TOneChildExpressionType[]
     */
    public function getNot()
    {
        return $this->not;
    }

    /**
     * Sets a new not
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TOneChildExpressionType[] $not
     * @return self
     */
    public function setNot(array $not)
    {
        $this->not = $not;
        return $this;
    }

    /**
     * Adds as isOf
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TCastOrIsOfExpressionType $isOf
     */
    public function addToIsOf(TCastOrIsOfExpressionType $isOf)
    {
        $this->isOf[] = $isOf;
        return $this;
    }

    /**
     * isset isOf
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetIsOf($index)
    {
        return isset($this->isOf[$index]);
    }

    /**
     * unset isOf
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetIsOf($index)
    {
        unset($this->isOf[$index]);
    }

    /**
     * Gets as isOf
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TCastOrIsOfExpressionType[]
     */
    public function getIsOf()
    {
        return $this->isOf;
    }

    /**
     * Sets a new isOf
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TCastOrIsOfExpressionType[] $isOf
     * @return self
     */
    public function setIsOf(array $isOf)
    {
        $this->isOf = $isOf;
        return $this;
    }

    /**
     * Adds as labeledElement
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TLabeledElementExpressionType $labeledElement
     */
    public function addToLabeledElement(TLabeledElementExpressionType $labeledElement)
    {
        $this->labeledElement[] = $labeledElement;
        return $this;
    }

    /**
     * isset labeledElement
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetLabeledElement($index)
    {
        return isset($this->labeledElement[$index]);
    }

    /**
     * unset labeledElement
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetLabeledElement($index)
    {
        unset($this->labeledElement[$index]);
    }

    /**
     * Gets as labeledElement
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TLabeledElementExpressionType[]
     */
    public function getLabeledElement()
    {
        return $this->labeledElement;
    }

    /**
     * Sets a new labeledElement
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TLabeledElementExpressionType[] $labeledElement
     * @return self
     */
    public function setLabeledElement(array $labeledElement)
    {
        $this->labeledElement = $labeledElement;
        return $this;
    }

    /**
     * Adds as labeledElementReference
     *
     * @return self
     * @param  string $labeledElementReference
     */
    public function addToLabeledElementReference($labeledElementReference)
    {
        $this->labeledElementReference[] = $labeledElementReference;
        return $this;
    }

    /**
     * isset labeledElementReference
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetLabeledElementReference($index)
    {
        return isset($this->labeledElementReference[$index]);
    }

    /**
     * unset labeledElementReference
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetLabeledElementReference($index)
    {
        unset($this->labeledElementReference[$index]);
    }

    /**
     * Gets as labeledElementReference
     *
     * @return string[]
     */
    public function getLabeledElementReference()
    {
        return $this->labeledElementReference;
    }

    /**
     * Sets a new labeledElementReference
     *
     * @param  string $labeledElementReference
     * @return self
     */
    public function setLabeledElementReference(array $labeledElementReference)
    {
        $this->labeledElementReference = $labeledElementReference;
        return $this;
    }

    /**
     * Adds as annotation
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation $annotation
     */
    public function addToNull(Annotation $annotation)
    {
        $this->null[] = $annotation;
        return $this;
    }

    /**
     * isset null
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetNull($index)
    {
        return isset($this->null[$index]);
    }

    /**
     * unset null
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetNull($index)
    {
        unset($this->null[$index]);
    }

    /**
     * Gets as null
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[]
     */
    public function getNull()
    {
        return $this->null;
    }

    /**
     * Sets a new null
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[] $null
     * @return self
     */
    public function setNull(array $null)
    {
        $this->null = $null;
        return $this;
    }

    /**
     * Adds as navigationPropertyPath
     *
     * @return self
     * @param  string $navigationPropertyPath
     */
    public function addToNavigationPropertyPath($navigationPropertyPath)
    {
        $this->navigationPropertyPath[] = $navigationPropertyPath;
        return $this;
    }

    /**
     * isset navigationPropertyPath
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetNavigationPropertyPath($index)
    {
        return isset($this->navigationPropertyPath[$index]);
    }

    /**
     * unset navigationPropertyPath
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetNavigationPropertyPath($index)
    {
        unset($this->navigationPropertyPath[$index]);
    }

    /**
     * Gets as navigationPropertyPath
     *
     * @return string[]
     */
    public function getNavigationPropertyPath()
    {
        return $this->navigationPropertyPath;
    }

    /**
     * Sets a new navigationPropertyPath
     *
     * @param  string $navigationPropertyPath
     * @return self
     */
    public function setNavigationPropertyPath(array $navigationPropertyPath)
    {
        $this->navigationPropertyPath = $navigationPropertyPath;
        return $this;
    }

    /**
     * Adds as path
     *
     * @return self
     * @param  string $path
     */
    public function addToPath($path)
    {
        $this->path[] = $path;
        return $this;
    }

    /**
     * isset path
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetPath($index)
    {
        return isset($this->path[$index]);
    }

    /**
     * unset path
     *
     * @param  scalar $index
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
     * @param  string $path
     * @return self
     */
    public function setPath(array $path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Adds as propertyPath
     *
     * @return self
     * @param  string $propertyPath
     */
    public function addToPropertyPath($propertyPath)
    {
        $this->propertyPath[] = $propertyPath;
        return $this;
    }

    /**
     * isset propertyPath
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetPropertyPath($index)
    {
        return isset($this->propertyPath[$index]);
    }

    /**
     * unset propertyPath
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetPropertyPath($index)
    {
        unset($this->propertyPath[$index]);
    }

    /**
     * Gets as propertyPath
     *
     * @return string[]
     */
    public function getPropertyPath()
    {
        return $this->propertyPath;
    }

    /**
     * Sets a new propertyPath
     *
     * @param  string $propertyPath
     * @return self
     */
    public function setPropertyPath(array $propertyPath)
    {
        $this->propertyPath = $propertyPath;
        return $this;
    }

    /**
     * Adds as record
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TRecordExpressionType $record
     */
    public function addToRecord(TRecordExpressionType $record)
    {
        $this->record[] = $record;
        return $this;
    }

    /**
     * isset record
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetRecord($index)
    {
        return isset($this->record[$index]);
    }

    /**
     * unset record
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetRecord($index)
    {
        unset($this->record[$index]);
    }

    /**
     * Gets as record
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TRecordExpressionType[]
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * Sets a new record
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TRecordExpressionType[] $record
     * @return self
     */
    public function setRecord(array $record)
    {
        $this->record = $record;
        return $this;
    }

    /**
     * Adds as urlRef
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TOneChildExpressionType $urlRef
     */
    public function addToUrlRef(TOneChildExpressionType $urlRef)
    {
        $this->urlRef[] = $urlRef;
        return $this;
    }

    /**
     * isset urlRef
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetUrlRef($index)
    {
        return isset($this->urlRef[$index]);
    }

    /**
     * unset urlRef
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetUrlRef($index)
    {
        unset($this->urlRef[$index]);
    }

    /**
     * Gets as urlRef
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TOneChildExpressionType[]
     */
    public function getUrlRef()
    {
        return $this->urlRef;
    }

    /**
     * Sets a new urlRef
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TOneChildExpressionType[] $urlRef
     * @return self
     */
    public function setUrlRef(array $urlRef)
    {
        $this->urlRef = $urlRef;
        return $this;
    }
}
