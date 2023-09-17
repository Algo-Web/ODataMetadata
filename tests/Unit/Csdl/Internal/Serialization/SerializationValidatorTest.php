<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26/07/20
 * Time: 5:17 PM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Csdl\Internal\Serialization;

use AlgoWeb\ODataMetadata\Csdl\Internal\Serialization\SerializationValidator;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\ValidationHelper;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class SerializationValidatorTest extends TestCase
{
    public function testInterfaceCriticalIsSignificantToSerialization()
    {
        $code  = EdmErrorCode::InterfaceCriticalPropertyValueMustNotBeNull();
        $error = m::mock(EdmError::class);
        $error->shouldReceive('getErrorCode')->andReturn($code);

        $this->assertTrue(ValidationHelper::isInterfaceCritical($error));

        $reflec = new \ReflectionClass(SerializationValidator::class);
        $method = $reflec->getMethod('significantToSerialization');
        $method->setAccessible(true);

        $expected = true;
        $actual   = $method->invoke(null, $error);
        $this->assertEquals($expected, $actual);
    }

    public function isSignificantProvider(): array
    {
        $rawCodes = [ EdmErrorCode::InvalidName(),
            EdmErrorCode::NameTooLong(),
            EdmErrorCode::InvalidNamespaceName(),
            EdmErrorCode::SystemNamespaceEncountered(),
            EdmErrorCode::RowTypeMustNotHaveBaseType(),
            EdmErrorCode::ReferencedTypeMustHaveValidName(),
            EdmErrorCode::FunctionImportEntitySetExpressionIsInvalid(),
            EdmErrorCode::FunctionImportParameterIncorrectType(),
            EdmErrorCode::OnlyInputParametersAllowedInFunctions(),
            EdmErrorCode::InvalidFunctionImportParameterMode(),
            EdmErrorCode::TypeMustNotHaveKindOfNone(),
            EdmErrorCode::PrimitiveTypeMustNotHaveKindOfNone(),
            EdmErrorCode::PropertyMustNotHaveKindOfNone(),
            EdmErrorCode::TermMustNotHaveKindOfNone(),
            EdmErrorCode::SchemaElementMustNotHaveKindOfNone(),
            EdmErrorCode::EntityContainerElementMustNotHaveKindOfNone(),
            EdmErrorCode::BinaryValueCannotHaveEmptyValue(),
            EdmErrorCode::EnumMustHaveIntegerUnderlyingType(),
            EdmErrorCode::EnumMemberTypeMustMatchEnumUnderlyingType(),];


        $result   = [];
        $result[] = [EdmErrorCode::InvalidErrorCodeValue(), false];

        foreach ($rawCodes as $code) {
            $result[] = [$code, true];
        }

        return $result;
    }

    /**
     * @dataProvider isSignificantProvider
     *
     * @param  EdmErrorCode         $code
     * @param  bool                 $expected
     * @throws \ReflectionException
     */
    public function testIsSignificantToSerialization(EdmErrorCode $code, bool $expected)
    {
        $error = m::mock(EdmError::class);
        $error->shouldReceive('getErrorCode')->andReturn($code);

        $this->assertFalse(ValidationHelper::isInterfaceCritical($error));

        $reflec = new \ReflectionClass(SerializationValidator::class);
        $method = $reflec->getMethod('significantToSerialization');
        $method->setAccessible(true);

        $actual = $method->invoke(null, $error);
        $this->assertEquals($expected, $actual);
    }
}
