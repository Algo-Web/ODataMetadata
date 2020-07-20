<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/07/20
 * Time: 2:45 PM.
 */
namespace AlgoWeb\ODataMetadata\Tests\Unit;

use AlgoWeb\ODataMetadata\Csdl\Internal\Semantics\BadElements\UnresolvedFunction;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Exception\ArgumentNullException;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class EdmUtilTest extends TestCase
{
    public function testIsNullOrWhitespaceInternalWithNull()
    {
        $value = null;

        $expected = true;
        $actual   = EdmUtil::IsNullOrWhiteSpaceInternal($value);
        $this->assertEquals($expected, $actual);
    }

    public function testIsNullOrWhitespaceInternalWithEmptyString()
    {
        $value = '';

        $expected = true;
        $actual   = EdmUtil::IsNullOrWhiteSpaceInternal($value);
        $this->assertEquals($expected, $actual);
    }

    public function testIsNullOrWhitespaceInternalWithWhitespaceString()
    {
        $value = " \t\n\r\0\x0B";

        $expected = true;
        $actual   = EdmUtil::IsNullOrWhiteSpaceInternal($value);
        $this->assertEquals($expected, $actual);
    }

    public function testIsValidUndottedName()
    {
        $string = 'Foobar';

        $expected = true;
        $actual   = EdmUtil::IsValidUndottedName($string);
        $this->assertEquals($expected, $actual);
    }

    public function testIsInvalidUndottedNameLeadingUnderscore()
    {
        $string = '_Foo_bar';

        $expected = false;
        $actual   = EdmUtil::IsValidUndottedName($string);
        $this->assertEquals($expected, $actual);
    }

    public function testIsValidDottedNameSingleSegment()
    {
        $string = 'foobar';

        $expected = true;
        $actual   = EdmUtil::IsValidDottedName($string);
        $this->assertEquals($expected, $actual);
    }

    public function testIsValidDottedNameMultipleSegment()
    {
        $string = 'foo.bar.baz';

        $expected = true;
        $actual   = EdmUtil::IsValidDottedName($string);
        $this->assertEquals($expected, $actual);
    }

    public function qualifiedNameProvider(): array
    {
        $result   = [];
        $result[] = ['foo', false];
        $result[] = ['foo.bar', true];
        $result[] = ['foo..', false];
        $result[] = ['..foo', false];

        return $result;
    }

    /**
     * @dataProvider qualifiedNameProvider
     *
     * @param string $string
     * @param bool   $expected
     */
    public function testIsQualifiedName(string $string, bool $expected)
    {
        $actual   = EdmUtil::IsQualifiedName($string);
        $this->assertEquals($expected, $actual);
    }

    public function tryGetNamespaceProvider(): array
    {
        $result   = [];
        $result[] = ['foo/bar', 'foo', 'bar', true];
        $result[] = ['foo.bar', 'foo', 'bar', true];

        return $result;
    }

    /**
     * @dataProvider tryGetNamespaceProvider
     *
     * @param string $qualName
     * @param string $expectedNamepace
     * @param string $expectedName
     * @param bool   $expected
     */
    public function testTryGetNamespaceNameFromQualifiedName(
        string $qualName,
        string $expectedNamepace,
        string $expectedName,
        bool $expected
    ) {
        $actualNamespace = null;
        $actualName      = null;

        $actual = EdmUtil::TryGetNamespaceNameFromQualifiedName($qualName, $actualNamespace, $actualName);

        $this->assertEquals($expected, $actual);
        $this->assertEquals($expectedNamepace, $actualNamespace);
        $this->assertEquals($expectedName, $actualName);
    }

    public function testParameterisedNameFromUnresolvedFunctionNullNamespace()
    {
        $function = m::mock(UnresolvedFunction::class)->makePartial();
        $function->shouldReceive('getNamespace')->andReturn(null);

        $this->expectException(ArgumentNullException::class);
        $this->expectExceptionMessage('Value for parameter function->getNamespace cannot be null.');

        EdmUtil::ParameterizedName($function);
    }

    public function testParameterisedNameFromUnresolvedFunctionNonNullNamespace()
    {
        $function = m::mock(UnresolvedFunction::class)->makePartial();
        $function->shouldReceive('getNamespace')->andReturn('namespace');
        $function->shouldReceive('getName')->andReturn('name');

        $expected = 'namespace/name';
        $actual   = EdmUtil::ParameterizedName($function);
        $this->assertEquals($expected, $actual);
    }

    public function testParameterisedNameSchemaElementWithNullNamespace()
    {
        $function = m::mock(IFunction::class);
        $function->shouldReceive('getNamespace')->andReturn(null);
        $function->shouldReceive('getParameters')->andReturn([]);

        $this->assertTrue($function instanceof ISchemaElement);

        $this->expectException(ArgumentNullException::class);
        $this->expectExceptionMessage('Value for parameter function->getNamespace cannot be null.');

        EdmUtil::ParameterizedName($function);
    }

    public function testParameterisedNameSchemaElementWithNonNullNamespaceThreeParms()
    {
        $parm1 = m::mock(IFunctionParameter::class);
        $parm1->shouldReceive('getType->FullName')->andReturn('FullName');
        $parm1->shouldReceive('getType->IsCollection')->andReturn(false);
        $parm1->shouldReceive('getType->IsEntityReference')->andReturn(false);

        $typeRef2 = m::mock(ITypeReference::class);
        $typeRef2->shouldReceive('FullName')->andReturn('FullName');
        $typeRef2->shouldReceive('IsCollection')->andReturn(true);
        $typeRef2->shouldReceive('IsEntityReference')->andReturn(false);
        $typeRef2->shouldReceive('AsCollection->ElementType->FullName')->andReturn('CollectionFullName');

        $parm2 = m::mock(IFunctionParameter::class);
        $parm2->shouldReceive('getType')->andReturn($typeRef2);

        $typeRef3 = m::mock(ITypeReference::class);
        $typeRef3->shouldReceive('FullName')->andReturn('FullName');
        $typeRef3->shouldReceive('IsCollection')->andReturn(false);
        $typeRef3->shouldReceive('IsEntityReference')->andReturn(true);
        $typeRef3->shouldReceive('AsEntityReference->EntityType->FullName')->andReturn('EntityFullName');

        $parm3 = m::mock(IFunctionParameter::class);
        $parm3->shouldReceive('getType')->andReturn($typeRef3);

        $function = m::mock(IFunction::class);
        $function->shouldReceive('getNamespace')->andReturn('namespace');
        $function->shouldReceive('getName')->andReturn('name');
        $function->shouldReceive('getParameters')->andReturn([$parm1, $parm2, $parm3]);

        $expected = 'namespace.name(FullName, Collection(CollectionFullName), Ref(EntityFullName))';
        $actual   = EdmUtil::ParameterizedName($function);
        $this->assertEquals($expected, $actual);
    }
}
