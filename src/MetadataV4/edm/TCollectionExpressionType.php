<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TCollectionExpressionType
 *
 * XSD Type: TCollectionExpression
 */
class TCollectionExpressionType extends IsOK
{

    /**
     * @property string $binary
     */
    private $binary = null;

    /**
     * @property boolean $bool
     */
    private $bool = null;

    /**
     * @property \DateTime $date
     */
    private $date = null;

    /**
     * @property \DateTime $dateTimeOffset
     */
    private $dateTimeOffset = null;

    /**
     * @property float $decimal
     */
    private $decimal = null;

    /**
     * @property \DateInterval $duration
     */
    private $duration = null;

    /**
     * @property string[] $enumMember
     */
    private $enumMember = null;

    /**
     * @property float $float
     */
    private $float = null;

    /**
     * @property string $guid
     */
    private $guid = null;

    /**
     * @property integer $int
     */
    private $int = null;

    /**
     * @property string $string
     */
    private $string = null;

    /**
     * @property \DateTime $timeOfDay
     */
    private $timeOfDay = null;

    /**
     * @property string $annotationPath
     */
    private $annotationPath = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TApplyExpressionType $apply
     */
    private $apply = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TCastOrIsOfExpressionType $cast
     */
    private $cast = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TCollectionExpressionType $collection
     */
    private $collection = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TIfExpressionType $if
     */
    private $if = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $eq
     */
    private $eq = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $ne
     */
    private $ne = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $ge
     */
    private $ge = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $gt
     */
    private $gt = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $le
     */
    private $le = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $lt
     */
    private $lt = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $and
     */
    private $and = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $or
     */
    private $or = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TOneChildExpressionType $not
     */
    private $not = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TCastOrIsOfExpressionType $isOf
     */
    private $isOf = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TLabeledElementExpressionType $labeledElement
     */
    private $labeledElement = null;

    /**
     * @property string $labeledElementReference
     */
    private $labeledElementReference = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[] $null
     */
    private $null = null;

    /**
     * @property string $navigationPropertyPath
     */
    private $navigationPropertyPath = null;

    /**
     * @property string $path
     */
    private $path = null;

    /**
     * @property string $propertyPath
     */
    private $propertyPath = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TRecordExpressionType $record
     */
    private $record = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TOneChildExpressionType $urlRef
     */
    private $urlRef = null;

    /**
     * Gets as binary
     *
     * @return string
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
    public function setBinary($binary)
    {
        $this->binary = $binary;
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
        $this->bool = $bool;
        return $this;
    }

    /**
     * Gets as date
     *
     * @return \DateTime
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
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
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
     * Gets as duration
     *
     * @return \DateInterval
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
    public function setDuration(\DateInterval $duration)
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
        $this->guid = $guid;
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
        $this->string = $string;
        return $this;
    }

    /**
     * Gets as timeOfDay
     *
     * @return \DateTime
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
    public function setTimeOfDay(\DateTime $timeOfDay)
    {
        $this->timeOfDay = $timeOfDay;
        return $this;
    }

    /**
     * Gets as annotationPath
     *
     * @return string
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
    public function setAnnotationPath($annotationPath)
    {
        $this->annotationPath = $annotationPath;
        return $this;
    }

    /**
     * Gets as apply
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TApplyExpressionType
     */
    public function getApply()
    {
        return $this->apply;
    }

    /**
     * Sets a new apply
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TApplyExpressionType $apply
     * @return self
     */
    public function setApply(TApplyExpressionType $apply)
    {
        $this->apply = $apply;
        return $this;
    }

    /**
     * Gets as cast
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TCastOrIsOfExpressionType
     */
    public function getCast()
    {
        return $this->cast;
    }

    /**
     * Sets a new cast
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TCastOrIsOfExpressionType $cast
     * @return self
     */
    public function setCast(TCastOrIsOfExpressionType $cast)
    {
        $this->cast = $cast;
        return $this;
    }

    /**
     * Gets as collection
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TCollectionExpressionType
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Sets a new collection
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TCollectionExpressionType $collection
     * @return self
     */
    public function setCollection(TCollectionExpressionType $collection)
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * Gets as if
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TIfExpressionType
     */
    public function getIf()
    {
        return $this->if;
    }

    /**
     * Sets a new if
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TIfExpressionType $if
     * @return self
     */
    public function setIf(TIfExpressionType $if)
    {
        $this->if = $if;
        return $this;
    }

    /**
     * Gets as eq
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType
     */
    public function getEq()
    {
        return $this->eq;
    }

    /**
     * Sets a new eq
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $eq
     * @return self
     */
    public function setEq(TTwoChildrenExpressionType $eq)
    {
        $this->eq = $eq;
        return $this;
    }

    /**
     * Gets as ne
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType
     */
    public function getNe()
    {
        return $this->ne;
    }

    /**
     * Sets a new ne
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $ne
     * @return self
     */
    public function setNe(TTwoChildrenExpressionType $ne)
    {
        $this->ne = $ne;
        return $this;
    }

    /**
     * Gets as ge
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType
     */
    public function getGe()
    {
        return $this->ge;
    }

    /**
     * Sets a new ge
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $ge
     * @return self
     */
    public function setGe(TTwoChildrenExpressionType $ge)
    {
        $this->ge = $ge;
        return $this;
    }

    /**
     * Gets as gt
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType
     */
    public function getGt()
    {
        return $this->gt;
    }

    /**
     * Sets a new gt
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $gt
     * @return self
     */
    public function setGt(TTwoChildrenExpressionType $gt)
    {
        $this->gt = $gt;
        return $this;
    }

    /**
     * Gets as le
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType
     */
    public function getLe()
    {
        return $this->le;
    }

    /**
     * Sets a new le
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $le
     * @return self
     */
    public function setLe(TTwoChildrenExpressionType $le)
    {
        $this->le = $le;
        return $this;
    }

    /**
     * Gets as lt
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType
     */
    public function getLt()
    {
        return $this->lt;
    }

    /**
     * Sets a new lt
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $lt
     * @return self
     */
    public function setLt(TTwoChildrenExpressionType $lt)
    {
        $this->lt = $lt;
        return $this;
    }

    /**
     * Gets as and
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType
     */
    public function getAnd()
    {
        return $this->and;
    }

    /**
     * Sets a new and
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $and
     * @return self
     */
    public function setAnd(TTwoChildrenExpressionType $and)
    {
        $this->and = $and;
        return $this;
    }

    /**
     * Gets as or
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType
     */
    public function getOr()
    {
        return $this->or;
    }

    /**
     * Sets a new or
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TTwoChildrenExpressionType $or
     * @return self
     */
    public function setOr(TTwoChildrenExpressionType $or)
    {
        $this->or = $or;
        return $this;
    }

    /**
     * Gets as not
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TOneChildExpressionType
     */
    public function getNot()
    {
        return $this->not;
    }

    /**
     * Sets a new not
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TOneChildExpressionType $not
     * @return self
     */
    public function setNot(TOneChildExpressionType $not)
    {
        $this->not = $not;
        return $this;
    }

    /**
     * Gets as isOf
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TCastOrIsOfExpressionType
     */
    public function getIsOf()
    {
        return $this->isOf;
    }

    /**
     * Sets a new isOf
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TCastOrIsOfExpressionType $isOf
     * @return self
     */
    public function setIsOf(TCastOrIsOfExpressionType $isOf)
    {
        $this->isOf = $isOf;
        return $this;
    }

    /**
     * Gets as labeledElement
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TLabeledElementExpressionType
     */
    public function getLabeledElement()
    {
        return $this->labeledElement;
    }

    /**
     * Sets a new labeledElement
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TLabeledElementExpressionType $labeledElement
     * @return self
     */
    public function setLabeledElement(TLabeledElementExpressionType $labeledElement)
    {
        $this->labeledElement = $labeledElement;
        return $this;
    }

    /**
     * Gets as labeledElementReference
     *
     * @return string
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
    public function setLabeledElementReference($labeledElementReference)
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
     * Gets as navigationPropertyPath
     *
     * @return string
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
    public function setNavigationPropertyPath($navigationPropertyPath)
    {
        $this->navigationPropertyPath = $navigationPropertyPath;
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
        $this->path = $path;
        return $this;
    }

    /**
     * Gets as propertyPath
     *
     * @return string
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
    public function setPropertyPath($propertyPath)
    {
        $this->propertyPath = $propertyPath;
        return $this;
    }

    /**
     * Gets as record
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TRecordExpressionType
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * Sets a new record
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TRecordExpressionType $record
     * @return self
     */
    public function setRecord(TRecordExpressionType $record)
    {
        $this->record = $record;
        return $this;
    }

    /**
     * Gets as urlRef
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TOneChildExpressionType
     */
    public function getUrlRef()
    {
        return $this->urlRef;
    }

    /**
     * Sets a new urlRef
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TOneChildExpressionType $urlRef
     * @return self
     */
    public function setUrlRef(TOneChildExpressionType $urlRef)
    {
        $this->urlRef = $urlRef;
        return $this;
    }
}
