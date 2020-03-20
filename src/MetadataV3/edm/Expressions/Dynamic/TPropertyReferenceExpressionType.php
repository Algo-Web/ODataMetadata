<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic;

use DateTime;

/**
 * Class representing TPropertyReferenceExpressionType.
 *
 * 16.2.14 The Edm:PropertyReference Expression
 *
 * The value of a Edm:PropertyReference is a reference to a structural property.
 *
 * The Edm:PropertyReference expression MUST contain a value of the type [qualifiedname][csdl19]. The value of the
 * property reference expression MUST resolve to a valid signature of a property.
 *
 *     <ValueAnnotation Term="org.example.AlternateKey">
 *         <PropertyReference Property="SSN"/>
 *     </ValueAnnotation>
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.14
 * XSD Type: TPropertyReferenceExpression
 */
class TPropertyReferenceExpressionType extends DynamicBase
{

    /**
     * @var string $property
     */
    private $property = null;

    /**
     * @var string $string
     */
    private $string = null;

    /**
     * @var mixed $binary
     */
    private $binary = null;

    /**
     * @var int $int
     */
    private $int = null;

    /**
     * @var float $float
     */
    private $float = null;

    /**
     * @var string $guid
     */
    private $guid = null;

    /**
     * @var float $decimal
     */
    private $decimal = null;

    /**
     * @var bool $bool
     */
    private $bool = null;

    /**
     * @var DateTime $dateTime
     */
    private $dateTime = null;

    /**
     * @var DateTime $dateTimeOffset
     */
    private $dateTimeOffset = null;

    /**
     * @var string $enum
     */
    private $enum = null;

    /**
     * @var string $path
     */
    private $path = null;

    /**
     * @var TIfExpressionType $if
     */
    private $if = null;

    /**
     * @var TRecordExpressionType $record
     */
    private $record = null;

    /**
     * @var TCollectionExpressionType $collection
     */
    private $collection = null;

    /**
     * @var AssertTypeExpression $typeAssert
     */
    private $typeAssert = null;

    /**
     * @var IsTypeExpression $typeTest
     */
    private $typeTest = null;

    /**
     * @var TFunctionReferenceExpressionType $functionReference
     */
    private $functionReference = null;

    /**
     * @var TEntitySetReferenceExpressionType $entitySetReference
     */
    private $entitySetReference = null;

    /**
     * @var TAnonymousFunctionExpressionType $anonymousFunction
     */
    private $anonymousFunction = null;

    /**
     * @var TParameterReferenceExpressionType $parameterReference
     */
    private $parameterReference = null;

    /**
     * @var TApplyExpressionType $apply
     */
    private $apply = null;

    /**
     * @var TPropertyReferenceExpressionType $propertyReference
     */
    private $propertyReference = null;

    /**
     * @var TValueTermReferenceExpressionType $valueTermReference
     */
    private $valueTermReference = null;

    /**
     * Gets as property.
     *
     * @return string
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Sets a new property.
     *
     * @param  string $property
     * @return self
     */
    public function setProperty($property)
    {
        $this->property = $property;
        return $this;
    }

    /**
     * Gets as string.
     *
     * @return string
     */
    public function getString()
    {
        return $this->string;
    }

    /**
     * Sets a new string.
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
     * Gets as binary.
     *
     * @return mixed
     */
    public function getBinary()
    {
        return $this->binary;
    }

    /**
     * Sets a new binary.
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
     * Gets as int.
     *
     * @return int
     */
    public function getInt()
    {
        return $this->int;
    }

    /**
     * Sets a new int.
     *
     * @param  int  $int
     * @return self
     */
    public function setInt($int)
    {
        $this->int = $int;
        return $this;
    }

    /**
     * Gets as float.
     *
     * @return float
     */
    public function getFloat()
    {
        return $this->float;
    }

    /**
     * Sets a new float.
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
     * Gets as guid.
     *
     * @return string
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * Sets a new guid.
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
     * Gets as decimal.
     *
     * @return float
     */
    public function getDecimal()
    {
        return $this->decimal;
    }

    /**
     * Sets a new decimal.
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
     * Gets as bool.
     *
     * @return bool
     */
    public function getBool()
    {
        return $this->bool;
    }

    /**
     * Sets a new bool.
     *
     * @param  bool $bool
     * @return self
     */
    public function setBool($bool)
    {
        $this->bool = $bool;
        return $this;
    }

    /**
     * Gets as dateTime.
     *
     * @return DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Sets a new dateTime.
     *
     * @param  DateTime $dateTime
     * @return self
     */
    public function setDateTime(DateTime $dateTime)
    {
        $this->dateTime = $dateTime;
        return $this;
    }

    /**
     * Gets as dateTimeOffset.
     *
     * @return DateTime
     */
    public function getDateTimeOffset()
    {
        return $this->dateTimeOffset;
    }

    /**
     * Sets a new dateTimeOffset.
     *
     * @param  DateTime $dateTimeOffset
     * @return self
     */
    public function setDateTimeOffset(DateTime $dateTimeOffset)
    {
        $this->dateTimeOffset = $dateTimeOffset;
        return $this;
    }

    /**
     * Gets as enum.
     *
     * @return string
     */
    public function getEnum()
    {
        return $this->enum;
    }

    /**
     * Sets a new enum.
     *
     * @param  string $enum
     * @return self
     */
    public function setEnum($enum)
    {
        $this->enum = $enum;
        return $this;
    }

    /**
     * Gets as path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Sets a new path.
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
     * Gets as if.
     *
     * @return TIfExpressionType
     */
    public function getIf()
    {
        return $this->if;
    }

    /**
     * Sets a new if.
     *
     * @param  TIfExpressionType $if
     * @return self
     */
    public function setIf(TIfExpressionType $if)
    {
        $this->if = $if;
        return $this;
    }

    /**
     * Gets as record.
     *
     * @return TRecordExpressionType
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * Sets a new record.
     *
     * @param  TRecordExpressionType $record
     * @return self
     */
    public function setRecord(TRecordExpressionType $record)
    {
        $this->record = $record;
        return $this;
    }

    /**
     * Gets as collection.
     *
     * @return TCollectionExpressionType
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Sets a new collection.
     *
     * @param  TCollectionExpressionType $collection
     * @return self
     */
    public function setCollection(TCollectionExpressionType $collection)
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * Gets as typeAssert.
     *
     * @return AssertTypeExpression
     */
    public function getTypeAssert()
    {
        return $this->typeAssert;
    }

    /**
     * Sets a new typeAssert.
     *
     * @param  AssertTypeExpression $typeAssert
     * @return self
     */
    public function setTypeAssert(AssertTypeExpression $typeAssert)
    {
        $this->typeAssert = $typeAssert;
        return $this;
    }

    /**
     * Gets as typeTest.
     *
     * @return IsTypeExpression
     */
    public function getTypeTest()
    {
        return $this->typeTest;
    }

    /**
     * Sets a new typeTest.
     *
     * @param  IsTypeExpression $typeTest
     * @return self
     */
    public function setTypeTest(IsTypeExpression $typeTest)
    {
        $this->typeTest = $typeTest;
        return $this;
    }

    /**
     * Gets as functionReference.
     *
     * @return TFunctionReferenceExpressionType
     */
    public function getFunctionReference()
    {
        return $this->functionReference;
    }

    /**
     * Sets a new functionReference.
     *
     * @param  TFunctionReferenceExpressionType $functionReference
     * @return self
     */
    public function setFunctionReference(TFunctionReferenceExpressionType $functionReference)
    {
        $this->functionReference = $functionReference;
        return $this;
    }

    /**
     * Gets as entitySetReference.
     *
     * @return TEntitySetReferenceExpressionType
     */
    public function getEntitySetReference()
    {
        return $this->entitySetReference;
    }

    /**
     * Sets a new entitySetReference.
     *
     * @param  TEntitySetReferenceExpressionType $entitySetReference
     * @return self
     */
    public function setEntitySetReference(TEntitySetReferenceExpressionType $entitySetReference)
    {
        $this->entitySetReference = $entitySetReference;
        return $this;
    }

    /**
     * Gets as anonymousFunction.
     *
     * @return TAnonymousFunctionExpressionType
     */
    public function getAnonymousFunction()
    {
        return $this->anonymousFunction;
    }

    /**
     * Sets a new anonymousFunction.
     *
     * @param  TAnonymousFunctionExpressionType $anonymousFunction
     * @return self
     */
    public function setAnonymousFunction(TAnonymousFunctionExpressionType $anonymousFunction)
    {
        $this->anonymousFunction = $anonymousFunction;
        return $this;
    }

    /**
     * Gets as parameterReference.
     *
     * @return TParameterReferenceExpressionType
     */
    public function getParameterReference()
    {
        return $this->parameterReference;
    }

    /**
     * Sets a new parameterReference.
     *
     * @param  TParameterReferenceExpressionType $parameterReference
     * @return self
     */
    public function setParameterReference(TParameterReferenceExpressionType $parameterReference)
    {
        $this->parameterReference = $parameterReference;
        return $this;
    }

    /**
     * Gets as apply.
     *
     * @return TApplyExpressionType
     */
    public function getApply()
    {
        return $this->apply;
    }

    /**
     * Sets a new apply.
     *
     * @param  TApplyExpressionType $apply
     * @return self
     */
    public function setApply(TApplyExpressionType $apply)
    {
        $this->apply = $apply;
        return $this;
    }

    /**
     * Gets as propertyReference.
     *
     * @return TPropertyReferenceExpressionType
     */
    public function getPropertyReference()
    {
        return $this->propertyReference;
    }

    /**
     * Sets a new propertyReference.
     *
     * @param  TPropertyReferenceExpressionType $propertyReference
     * @return self
     */
    public function setPropertyReference(TPropertyReferenceExpressionType $propertyReference)
    {
        $this->propertyReference = $propertyReference;
        return $this;
    }

    /**
     * Gets as valueTermReference.
     *
     * @return TValueTermReferenceExpressionType
     */
    public function getValueTermReference()
    {
        return $this->valueTermReference;
    }

    /**
     * Sets a new valueTermReference.
     *
     * @param  TValueTermReferenceExpressionType $valueTermReference
     * @return self
     */
    public function setValueTermReference(TValueTermReferenceExpressionType $valueTermReference)
    {
        $this->valueTermReference = $valueTermReference;
        return $this;
    }
}
