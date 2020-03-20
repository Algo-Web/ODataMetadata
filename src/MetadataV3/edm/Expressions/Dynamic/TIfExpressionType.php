<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic;

use DateTime;

/**
 * Class representing TIfExpressionType
 *
 * 16.2.7 The Edm:If Expression
 *
 * The Edm:If expression enables a value to be obtained by evaluating a conditional expression.
 *
 * An if expression MUST contain exactly three child expressions. The first child expression is the conditional
 * expression and MUST evaluate to a boolean result.
 *
 * The second and third child expressions are the expressions which are evaluated conditionally. If the conditional
 * expression evaluates to true, the second child expression MUST be evaluated and its value MUST be returned as the
 * result of the Edm:If expression. If the conditional expression evaluates to false, the third child expression MUST
 * be evaluated and its value MUST be returned as the result of the Edm:If expression.
 *
 * The second child expression MUST return a value that is type compatible with the value returned from the third
 * child expression.
 *
 * The Edm:If expression MUST be written with element notation, as shown in the following example:
 *
 *     <ValueAnnotation Term="org.example.person.Gender">
 *         <If>
 *             <Path>IsFemale</Path>
 *             <String>Female</String>
 *             <String>Male</String>
 *         </If>
 *     </ValueAnnotation>
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.2.7
 * @link https://docs.microsoft.com/en-us/openspecs/windows_protocols/mc-csdl/120e2b40-c73a-4b0b-98c2-8d2ab6b8dfd3
 * XSD Type: TIfExpression
 */
class TIfExpressionType extends DynamicBase{
    /**
     * @var string[] $string
     */
    private $string = [

    ];

    /**
     * @var mixed[] $binary
     */
    private $binary = [

    ];

    /**
     * @var int[] $int
     */
    private $int = [

    ];

    /**
     * @var float[] $float
     */
    private $float = [

    ];

    /**
     * @var string[] $guid
     */
    private $guid = [

    ];

    /**
     * @var float[] $decimal
     */
    private $decimal = [

    ];

    /**
     * @var bool[] $bool
     */
    private $bool = [

    ];

    /**
     * @var DateTime[] $dateTime
     */
    private $dateTime = [

    ];

    /**
     * @var DateTime[] $dateTimeOffset
     */
    private $dateTimeOffset = [

    ];

    /**
     * @var string[] $enum
     */
    private $enum = [

    ];

    /**
     * @var string[] $path
     */
    private $path = [

    ];

    /**
     * @varTIfExpressionType[] $if
     */
    private $if = [

    ];

    /**
     * @var TRecordExpressionType[] $record
     */
    private $record = [

    ];

    /**
     * @var TCollectionExpressionType[] $collection
     */
    private $collection = [

    ];

    /**
     * @var AssertTypeExpression[] $typeAssert
     */
    private $typeAssert = [

    ];

    /**
     * @var IsTypeExpression[] $typeTest
     */
    private $typeTest = [

    ];

    /**
     * @var TFunctionReferenceExpressionType[] $functionReference
     */
    private $functionReference = [

    ];

    /**
     * @var TEntitySetReferenceExpressionType[] $entitySetReference
     */
    private $entitySetReference = [

    ];

    /**
     * @var TAnonymousFunctionExpressionType[] $anonymousFunction
     */
    private $anonymousFunction = [

    ];

    /**
     * @var TParameterReferenceExpressionType[] $parameterReference
     */
    private $parameterReference = [

    ];

    /**
     * @var TApplyExpressionType[] $apply
     */
    private $apply = [

    ];

    /**
     * @var TPropertyReferenceExpressionType[] $propertyReference
     */
    private $propertyReference = [

    ];

    /**
     * @var TValueTermReferenceExpressionType[] $valueTermReference
     */
    private $valueTermReference = [

    ];

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
     * @param int|string $index
     * @return bool
     */
    public function issetString($index)
    {
        return isset($this->string[$index]);
    }

    /**
     * unset string
     *
     * @param int|string $index
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
     * @param string[] $string
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
     * @param int|string $index
     * @return bool
     */
    public function issetBinary($index)
    {
        return isset($this->binary[$index]);
    }

    /**
     * unset binary
     *
     * @param int|string $index
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
     * @param int $int
     */
    public function addToInt($int)
    {
        $this->int[] = $int;
        return $this;
    }

    /**
     * isset int
     *
     * @param int|string $index
     * @return bool
     */
    public function issetInt($index)
    {
        return isset($this->int[$index]);
    }

    /**
     * unset int
     *
     * @param int|string $index
     * @return void
     */
    public function unsetInt($index)
    {
        unset($this->int[$index]);
    }

    /**
     * Gets as int
     *
     * @return int[]
     */
    public function getInt()
    {
        return $this->int;
    }

    /**
     * Sets a new int
     *
     * @param int[] $int
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
     * @param int|string $index
     * @return bool
     */
    public function issetFloat($index)
    {
        return isset($this->float[$index]);
    }

    /**
     * unset float
     *
     * @param int|string $index
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
     * @param float[] $float
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
     * @param int|string $index
     * @return bool
     */
    public function issetGuid($index)
    {
        return isset($this->guid[$index]);
    }

    /**
     * unset guid
     *
     * @param int|string $index
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
     * @param string[] $guid
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
     * @param int|string $index
     * @return bool
     */
    public function issetDecimal($index)
    {
        return isset($this->decimal[$index]);
    }

    /**
     * unset decimal
     *
     * @param int|string $index
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
     * @param float[] $decimal
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
     * @param bool $bool
     */
    public function addToBool($bool)
    {
        $this->bool[] = $bool;
        return $this;
    }

    /**
     * isset bool
     *
     * @param int|string $index
     * @return bool
     */
    public function issetBool($index)
    {
        return isset($this->bool[$index]);
    }

    /**
     * unset bool
     *
     * @param int|string $index
     * @return void
     */
    public function unsetBool($index)
    {
        unset($this->bool[$index]);
    }

    /**
     * Gets as bool
     *
     * @return bool[]
     */
    public function getBool()
    {
        return $this->bool;
    }

    /**
     * Sets a new bool
     *
     * @param bool[] $bool
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
     * @param DateTime $dateTime
     */
    public function addToDateTime(DateTime $dateTime)
    {
        $this->dateTime[] = $dateTime;
        return $this;
    }

    /**
     * isset dateTime
     *
     * @param int|string $index
     * @return bool
     */
    public function issetDateTime($index)
    {
        return isset($this->dateTime[$index]);
    }

    /**
     * unset dateTime
     *
     * @param int|string $index
     * @return void
     */
    public function unsetDateTime($index)
    {
        unset($this->dateTime[$index]);
    }

    /**
     * Gets as dateTime
     *
     * @return DateTime[]
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Sets a new dateTime
     *
     * @param DateTime[] $dateTime
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
     * @param DateTime $dateTimeOffset
     */
    public function addToDateTimeOffset(DateTime $dateTimeOffset)
    {
        $this->dateTimeOffset[] = $dateTimeOffset;
        return $this;
    }

    /**
     * isset dateTimeOffset
     *
     * @param int|string $index
     * @return bool
     */
    public function issetDateTimeOffset($index)
    {
        return isset($this->dateTimeOffset[$index]);
    }

    /**
     * unset dateTimeOffset
     *
     * @param int|string $index
     * @return void
     */
    public function unsetDateTimeOffset($index)
    {
        unset($this->dateTimeOffset[$index]);
    }

    /**
     * Gets as dateTimeOffset
     *
     * @return DateTime[]
     */
    public function getDateTimeOffset()
    {
        return $this->dateTimeOffset;
    }

    /**
     * Sets a new dateTimeOffset
     *
     * @param DateTime[] $dateTimeOffset
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
     * @param int|string $index
     * @return bool
     */
    public function issetEnum($index)
    {
        return isset($this->enum[$index]);
    }

    /**
     * unset enum
     *
     * @param int|string $index
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
     * @param string[] $enum
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
     * @param int|string $index
     * @return bool
     */
    public function issetPath($index)
    {
        return isset($this->path[$index]);
    }

    /**
     * unset path
     *
     * @param int|string $index
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
     * @param string[] $path
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
     * @param TIfExpressionType $if
     */
    public function addToIf(TIfExpressionType $if)
    {
        $this->if[] = $if;
        return $this;
    }

    /**
     * isset if
     *
     * @param int|string $index
     * @return bool
     */
    public function issetIf($index)
    {
        return isset($this->if[$index]);
    }

    /**
     * unset if
     *
     * @param int|string $index
     * @return void
     */
    public function unsetIf($index)
    {
        unset($this->if[$index]);
    }

    /**
     * Gets as if
     *
     * @return TIfExpressionType[]
     */
    public function getIf()
    {
        return $this->if;
    }

    /**
     * Sets a new if
     *
     * @param TIfExpressionType[] $if
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
     * @param TRecordExpressionType $record
     */
    public function addToRecord(TRecordExpressionType $record)
    {
        $this->record[] = $record;
        return $this;
    }

    /**
     * isset record
     *
     * @param int|string $index
     * @return bool
     */
    public function issetRecord($index)
    {
        return isset($this->record[$index]);
    }

    /**
     * unset record
     *
     * @param int|string $index
     * @return void
     */
    public function unsetRecord($index)
    {
        unset($this->record[$index]);
    }

    /**
     * Gets as record
     *
     * @return TRecordExpressionType[]
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * Sets a new record
     *
     * @param TRecordExpressionType[] $record
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
     * @param TCollectionExpressionType $collection
     */
    public function addToCollection(TCollectionExpressionType $collection)
    {
        $this->collection[] = $collection;
        return $this;
    }

    /**
     * isset collection
     *
     * @param int|string $index
     * @return bool
     */
    public function issetCollection($index)
    {
        return isset($this->collection[$index]);
    }

    /**
     * unset collection
     *
     * @param int|string $index
     * @return void
     */
    public function unsetCollection($index)
    {
        unset($this->collection[$index]);
    }

    /**
     * Gets as collection
     *
     * @return TCollectionExpressionType[]
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Sets a new collection
     *
     * @param TCollectionExpressionType[] $collection
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
     * @param AssertTypeExpression $typeAssert
     *@return self
     */
    public function addToTypeAssert(AssertTypeExpression $typeAssert)
    {
        $this->typeAssert[] = $typeAssert;
        return $this;
    }

    /**
     * isset typeAssert
     *
     * @param int|string $index
     * @return bool
     */
    public function issetTypeAssert($index)
    {
        return isset($this->typeAssert[$index]);
    }

    /**
     * unset typeAssert
     *
     * @param int|string $index
     * @return void
     */
    public function unsetTypeAssert($index)
    {
        unset($this->typeAssert[$index]);
    }

    /**
     * Gets as typeAssert
     *
     * @return AssertTypeExpression[]
     */
    public function getTypeAssert()
    {
        return $this->typeAssert;
    }

    /**
     * Sets a new typeAssert
     *
     * @param AssertTypeExpression[] $typeAssert
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
     * @param IsTypeExpression $typeTest
     * @return self
     */
    public function addToTypeTest(IsTypeExpression $typeTest)
    {
        $this->typeTest[] = $typeTest;
        return $this;
    }

    /**
     * isset typeTest
     *
     * @param int|string $index
     * @return bool
     */
    public function issetTypeTest($index)
    {
        return isset($this->typeTest[$index]);
    }

    /**
     * unset typeTest
     *
     * @param int|string $index
     * @return void
     */
    public function unsetTypeTest($index)
    {
        unset($this->typeTest[$index]);
    }

    /**
     * Gets as typeTest
     *
     * @return IsTypeExpression[]
     */
    public function getTypeTest()
    {
        return $this->typeTest;
    }

    /**
     * Sets a new typeTest
     *
     * @param IsTypeExpression[] $typeTest
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
     * @param TFunctionReferenceExpressionType $functionReference
     */
    public function addToFunctionReference(TFunctionReferenceExpressionType $functionReference)
    {
        $this->functionReference[] = $functionReference;
        return $this;
    }

    /**
     * isset functionReference
     *
     * @param int|string $index
     * @return bool
     */
    public function issetFunctionReference($index)
    {
        return isset($this->functionReference[$index]);
    }

    /**
     * unset functionReference
     *
     * @param int|string $index
     * @return void
     */
    public function unsetFunctionReference($index)
    {
        unset($this->functionReference[$index]);
    }

    /**
     * Gets as functionReference
     *
     * @return TFunctionReferenceExpressionType[]
     */
    public function getFunctionReference()
    {
        return $this->functionReference;
    }

    /**
     * Sets a new functionReference
     *
     * @param TFunctionReferenceExpressionType[] $functionReference
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
     * @param TEntitySetReferenceExpressionType $entitySetReference
     */
    public function addToEntitySetReference(TEntitySetReferenceExpressionType $entitySetReference)
    {
        $this->entitySetReference[] = $entitySetReference;
        return $this;
    }

    /**
     * isset entitySetReference
     *
     * @param int|string $index
     * @return bool
     */
    public function issetEntitySetReference($index)
    {
        return isset($this->entitySetReference[$index]);
    }

    /**
     * unset entitySetReference
     *
     * @param int|string $index
     * @return void
     */
    public function unsetEntitySetReference($index)
    {
        unset($this->entitySetReference[$index]);
    }

    /**
     * Gets as entitySetReference
     *
     * @return TEntitySetReferenceExpressionType[]
     */
    public function getEntitySetReference()
    {
        return $this->entitySetReference;
    }

    /**
     * Sets a new entitySetReference
     *
     * @param TEntitySetReferenceExpressionType[] $entitySetReference
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
     * @param TAnonymousFunctionExpressionType $anonymousFunction
     */
    public function addToAnonymousFunction(TAnonymousFunctionExpressionType $anonymousFunction)
    {
        $this->anonymousFunction[] = $anonymousFunction;
        return $this;
    }

    /**
     * isset anonymousFunction
     *
     * @param int|string $index
     * @return bool
     */
    public function issetAnonymousFunction($index)
    {
        return isset($this->anonymousFunction[$index]);
    }

    /**
     * unset anonymousFunction
     *
     * @param int|string $index
     * @return void
     */
    public function unsetAnonymousFunction($index)
    {
        unset($this->anonymousFunction[$index]);
    }

    /**
     * Gets as anonymousFunction
     *
     * @return TAnonymousFunctionExpressionType[]
     */
    public function getAnonymousFunction()
    {
        return $this->anonymousFunction;
    }

    /**
     * Sets a new anonymousFunction
     *
     * @param TAnonymousFunctionExpressionType[] $anonymousFunction
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
     * @param TParameterReferenceExpressionType $parameterReference
     */
    public function addToParameterReference(TParameterReferenceExpressionType $parameterReference)
    {
        $this->parameterReference[] = $parameterReference;
        return $this;
    }

    /**
     * isset parameterReference
     *
     * @param int|string $index
     * @return bool
     */
    public function issetParameterReference($index)
    {
        return isset($this->parameterReference[$index]);
    }

    /**
     * unset parameterReference
     *
     * @param int|string $index
     * @return void
     */
    public function unsetParameterReference($index)
    {
        unset($this->parameterReference[$index]);
    }

    /**
     * Gets as parameterReference
     *
     * @return TParameterReferenceExpressionType[]
     */
    public function getParameterReference()
    {
        return $this->parameterReference;
    }

    /**
     * Sets a new parameterReference
     *
     * @param TParameterReferenceExpressionType[] $parameterReference
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
     * @param TApplyExpressionType $apply
     */
    public function addToApply(TApplyExpressionType $apply)
    {
        $this->apply[] = $apply;
        return $this;
    }

    /**
     * isset apply
     *
     * @param int|string $index
     * @return bool
     */
    public function issetApply($index)
    {
        return isset($this->apply[$index]);
    }

    /**
     * unset apply
     *
     * @param int|string $index
     * @return void
     */
    public function unsetApply($index)
    {
        unset($this->apply[$index]);
    }

    /**
     * Gets as apply
     *
     * @return TApplyExpressionType[]
     */
    public function getApply()
    {
        return $this->apply;
    }

    /**
     * Sets a new apply
     *
     * @param TApplyExpressionType[] $apply
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
     * @param TPropertyReferenceExpressionType $propertyReference
     */
    public function addToPropertyReference(TPropertyReferenceExpressionType $propertyReference)
    {
        $this->propertyReference[] = $propertyReference;
        return $this;
    }

    /**
     * isset propertyReference
     *
     * @param int|string $index
     * @return bool
     */
    public function issetPropertyReference($index)
    {
        return isset($this->propertyReference[$index]);
    }

    /**
     * unset propertyReference
     *
     * @param int|string $index
     * @return void
     */
    public function unsetPropertyReference($index)
    {
        unset($this->propertyReference[$index]);
    }

    /**
     * Gets as propertyReference
     *
     * @return TPropertyReferenceExpressionType[]
     */
    public function getPropertyReference()
    {
        return $this->propertyReference;
    }

    /**
     * Sets a new propertyReference
     *
     * @param TPropertyReferenceExpressionType[] $propertyReference
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
     * @param TValueTermReferenceExpressionType $valueTermReference
     */
    public function addToValueTermReference(TValueTermReferenceExpressionType $valueTermReference)
    {
        $this->valueTermReference[] = $valueTermReference;
        return $this;
    }

    /**
     * isset valueTermReference
     *
     * @param int|string $index
     * @return bool
     */
    public function issetValueTermReference($index)
    {
        return isset($this->valueTermReference[$index]);
    }

    /**
     * unset valueTermReference
     *
     * @param int|string $index
     * @return void
     */
    public function unsetValueTermReference($index)
    {
        unset($this->valueTermReference[$index]);
    }

    /**
     * Gets as valueTermReference
     *
     * @return TValueTermReferenceExpressionType[]
     */
    public function getValueTermReference()
    {
        return $this->valueTermReference;
    }

    /**
     * Sets a new valueTermReference
     *
     * @param TValueTermReferenceExpressionType[] $valueTermReference
     * @return self
     */
    public function setValueTermReference(array $valueTermReference)
    {
        $this->valueTermReference = $valueTermReference;
        return $this;
    }

}

