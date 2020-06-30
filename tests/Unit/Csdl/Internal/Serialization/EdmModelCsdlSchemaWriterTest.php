<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Csdl\Internal\Serialization;

use AlgoWeb\ODataMetadata\Csdl\Internal\Serialization\EdmModelCsdlSchemaWriter;
use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\Enums\ConcurrencyMode;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\FunctionParameterMode;
use AlgoWeb\ODataMetadata\Enums\Multiplicity;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IBinaryConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IBooleanConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDateTimeConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDateTimeOffsetConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDecimalConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IEntitySetReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IFloatingConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IGuidConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIntegerConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPathExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IStringConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ITimeConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\IComplexType;
use AlgoWeb\ODataMetadata\Interfaces\IDocumentation;
use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Interfaces\Values\IBinaryValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IBooleanValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IIntegerValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPrimitiveValue;
use AlgoWeb\ODataMetadata\Library\EdmEnumMember;
use AlgoWeb\ODataMetadata\Library\EdmEnumType;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadNamedStructuredType;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadType;
use AlgoWeb\ODataMetadata\Library\Values\EdmEnumValue;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Version;
use Mockery as m;

class EdmModelCsdlSchemaWriterTest extends TestCase
{
    public function multiplicityProvider(): array
    {
        $result = [];

        $result[] = [Multiplicity::Many(), CsdlConstants::Value_EndMany, false];
        $result[] = [Multiplicity::One(), CsdlConstants::Value_EndRequired, false];
        $result[] = [Multiplicity::ZeroOrOne(), CsdlConstants::Value_EndOptional, false];
        $result[] = [m::mock(Multiplicity::class)->makePartial(), 'Invalid multiplicity: \'\'', true];

        return $result;
    }

    /**
     * @dataProvider multiplicityProvider
     *
     * @param  Multiplicity         $mult
     * @param  string               $expected
     * @param  bool                 $kaboom
     * @throws \ReflectionException
     */
    public function testMultiplicityAsXml(Multiplicity $mult, string $expected, bool $kaboom)
    {
        $foo = $this->getSchemaWriter();

        if ($kaboom) {
            $this->expectExceptionMessage($expected);
        }

        $actual = $this->callPrivateMethod($foo, 'MultiplicityAsXml', $mult);
        $this->assertEquals($expected, $actual);
    }

    public function funcParmProvider(): array
    {
        $result = [];

        $result[] = [FunctionParameterMode::In(), CsdlConstants::Value_ModeIn, false];
        $result[] = [FunctionParameterMode::InOut(), CsdlConstants::Value_ModeInOut, false];
        $result[] = [FunctionParameterMode::Out(), CsdlConstants::Value_ModeOut, false];
        $result[] = [m::mock(FunctionParameterMode::class)->makePartial(), 'Invalid function parameter mode: \'\'', true];

        return $result;
    }

    /**
     * @dataProvider funcParmProvider
     *
     * @param  FunctionParameterMode $mode
     * @param  string                $expected
     * @param  bool                  $kaboom
     * @throws \ReflectionException
     */
    public function testFunctionParameterModeAsXml(FunctionParameterMode $mode, string $expected, bool $kaboom)
    {
        $foo = $this->getSchemaWriter();

        if ($kaboom) {
            $this->expectExceptionMessage($expected);
        }

        $actual = $this->callPrivateMethod($foo, 'FunctionParameterModeAsXml', $mode);
        $this->assertEquals($expected, $actual);
    }

    public function concurrencyModeProvider(): array
    {
        $result = [];

        $result[] = [ConcurrencyMode::Fixed(), CsdlConstants::Value_Fixed, false];
        $result[] = [ConcurrencyMode::None(), CsdlConstants::Value_None, false];
        $result[] = [m::mock(ConcurrencyMode::class)->makePartial(), 'Invalid concurrency mode: \'\'', true];

        return $result;
    }

    /**
     * @dataProvider concurrencyModeProvider
     *
     * @param  ConcurrencyMode      $mode
     * @param  string               $expected
     * @param  bool                 $kaboom
     * @throws \ReflectionException
     */
    public function testConcurrencyModeAsXml(ConcurrencyMode $mode, string $expected, bool $kaboom)
    {
        $foo = $this->getSchemaWriter();

        if ($kaboom) {
            $this->expectExceptionMessage($expected);
        }

        $actual = $this->callPrivateMethod($foo, 'ConcurrencyModeAsXml', $mode);
        $this->assertEquals($expected, $actual);
    }

    public function writeInlineExpressionProvider(): array
    {
        $result = [];

        $result[] = [ExpressionKind::BinaryConstant(), [0xFF], '<?xml version="1.0"?>' . PHP_EOL . '<Test Binary="FF"/>' . PHP_EOL, false, IBinaryConstantExpression::class];
        $result[] = [ExpressionKind::BooleanConstant(), true, '<?xml version="1.0"?>' . PHP_EOL . '<Test Bool="true"/>' . PHP_EOL, false, IBooleanConstantExpression::class];
        $result[] = [ExpressionKind::DateTimeConstant(), new \DateTime('2000-01-01'), '<?xml version="1.0"?>' . PHP_EOL . '<Test DateTime="2000-01-01T00:00:00.000000000"/>' . PHP_EOL, false, IDateTimeConstantExpression::class];
        $result[] = [ExpressionKind::DateTimeOffsetConstant(), new \DateTime('2000-01-02 01:02:03'), '<?xml version="1.0"?>' . PHP_EOL . '<Test DateTimeOffset="2000-01-02T01:02:03.000Z+00:00"/>' . PHP_EOL, false, IDateTimeOffsetConstantExpression::class];
        $result[] = [ExpressionKind::DecimalConstant(), 0, '<?xml version="1.0"?>' . PHP_EOL . '<Test Decimal="0M"/>' . PHP_EOL, false, IDecimalConstantExpression::class];
        $result[] = [ExpressionKind::FloatingConstant(), 0, '<?xml version="1.0"?>' . PHP_EOL . '<Test Float="0F"/>' . PHP_EOL, false, IFloatingConstantExpression::class];
        $result[] = [ExpressionKind::GuidConstant(), '059d1a1e-11bc-4951-88f7-940cf1d1a66a', '<?xml version="1.0"?>' . PHP_EOL . '<Test Guid="059d1a1e-11bc-4951-88f7-940cf1d1a66a"/>' . PHP_EOL, false, IGuidConstantExpression::class];
        $result[] = [ExpressionKind::IntegerConstant(), 0, '<?xml version="1.0"?>' . PHP_EOL . '<Test Int="0"/>' . PHP_EOL, false, IIntegerConstantExpression::class];
        $result[] = [ExpressionKind::Path(), ['all', 'your', 'base', 'are', 'belong', 'to', 'us'], '<?xml version="1.0"?>' . PHP_EOL . '<Test Path="all/your/base/are/belong/to/us"/>' . PHP_EOL, false, IPathExpression::class];
        $result[] = [ExpressionKind::StringConstant(), 'string', '<?xml version="1.0"?>' . PHP_EOL . '<Test String="string"/>' . PHP_EOL, false, IStringConstantExpression::class];
        $result[] = [ExpressionKind::TimeConstant(), new \DateTime('2000-01-01 01:02:03'), '<?xml version="1.0"?>' . PHP_EOL . '<Test Time="01:02:03.000000"/>' . PHP_EOL, false, ITimeConstantExpression::class];
        $result[] = [ExpressionKind::EntitySetReference(), null, '<?xml version="1.0" >' . PHP_EOL . '<Test/>' . PHP_EOL, true, IEntitySetReferenceExpression::class];

        return $result;
    }

    /**
     * @dataProvider writeInlineExpressionProvider
     *
     * @param ExpressionKind $kind
     * @param $payload
     * @param $expected
     * @param  bool                 $kaboom
     * @throws \ReflectionException
     */
    public function testWriteInlineExpression(ExpressionKind $kind, $payload, $expected, bool $kaboom, string $type)
    {
        $writer = $this->getWriter();
        $foo    = $this->getSchemaWriterWithMock($writer);

        $expr = m::mock($type)->makePartial();
        $expr->shouldReceive('getExpressionKind')->andReturn($kind);
        if ($kind != ExpressionKind::Path()) {
            $expr->shouldReceive('getValue')->andReturn($payload);
        } else {
            $expr->shouldReceive('getPath')->andReturn($payload);
        }

        if ($kaboom) {
            $this->expectException(InvalidOperationException::class);
            $this->expectExceptionMessage('Invalid expression kind: \'EntitySetReference\'');
        }

        $writer->startElement('Test');
        $foo->WriteInlineExpression($expr);
        $writer->endElement();

        $actual = $writer->outputMemory(true);
        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    /**
     * @throws \ReflectionException
     */
    public function testWriteFunctionImportElementHeaderBothComposableAndSideEffecting()
    {
        $writer = $this->getWriter();
        $foo    = $this->getSchemaWriterWithMock($writer);

        $import = m::mock(IFunctionImport::class)->makePartial();
        $import->shouldReceive('isComposable')->andReturn(true)->once();
        $import->shouldReceive('isSideEffecting')->andReturn(true)->once();
        $import->shouldReceive('getName')->andReturn('functionName')->once();

        $msg = 'The function import \'functionName\' cannot be composable and side-effecting at the same time.';
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage($msg);

        $foo->WriteFunctionImportElementHeader($import);
    }

    public function functionImportElementHeaderProvider(): array
    {
        $result   = [];
        $result[] = [false, false, IEntitySetReferenceExpression::class, false, '<?xml version="1.0"?>' . PHP_EOL . '<FunctionImport Name="functionName" ReturnType="fullName" IsSideEffecting="false" EntitySet="name"/>' . PHP_EOL];
        $result[] = [false, true, IPathExpression::class, false, '<?xml version="1.0"?>' . PHP_EOL . '<FunctionImport Name="functionName" ReturnType="fullName" EntitySetPath="path"/>' . PHP_EOL];
        $result[] = [true, false, IBinaryConstantExpression::class, true, ''];
        $result[] = [false, true, null, false, '<?xml version="1.0"?>' . PHP_EOL . '<FunctionImport Name="functionName" ReturnType="fullName"/>' . PHP_EOL];

        return $result;
    }

    /**
     * @dataProvider functionImportElementHeaderProvider
     *
     * @param  bool                 $isComposable
     * @param  bool                 $isSideEffecting
     * @param  string|null          $type
     * @param  bool                 $kaboom
     * @param  string               $expected
     * @throws \ReflectionException
     */
    public function testWriteFunctionImportElementHeader(
        bool $isComposable,
        bool $isSideEffecting,
        ?string $type,
        bool $kaboom,
        string $expected
    ) {
        $writer = $this->getWriter();
        $foo    = $this->getSchemaWriterWithMock($writer);

        $entitySet = null;
        if (null !== $type) {
            $entitySet = m::mock($type);
            $entitySet->shouldReceive('getPath')->andReturn(['path']);
            $entitySet->shouldReceive('getReferencedEntitySet->getName')->andReturn('name');
        }

        if ($kaboom) {
            $msg = StringConst::EdmModel_Validator_Semantic_FunctionImportEntitySetExpressionIsInvalid('functionName');

            $this->expectException(InvalidOperationException::class);
            $this->expectExceptionMessage($msg);
        }

        $schemaElement = m::mock(BadNamedStructuredType::class)->makePartial();
        $schemaElement->shouldReceive('fullName')->andReturn('fullName');

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('isCollection')->andReturn(false);
        $typeRef->shouldReceive('isEntityReference')->andReturn(false);
        $typeRef->shouldReceive('getDefinition')->andReturn($schemaElement);

        $import = m::mock(IFunctionImport::class)->makePartial();
        $import->shouldReceive('getReturnType')->andReturn($typeRef);
        $import->shouldReceive('isComposable')->andReturn($isComposable)->once();
        $import->shouldReceive('isSideEffecting')->andReturn($isSideEffecting)->once();
        $import->shouldReceive('getName')->andReturn('functionName')->once();
        $import->shouldReceive('getEntitySet')->andReturn($entitySet)->atLeast(1);
        $import->shouldReceive('isBindable')->andReturn(false)->once();

        $foo->WriteFunctionImportElementHeader($import);

        $writer->endElement();
        $actual = $writer->outputMemory(true);
        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    public function writeDocumentationElementProvider(): array
    {
        $result   = [];
        $result[] = [null, null, '<?xml version="1.0"?>' . PHP_EOL . '<Documentation/>' . PHP_EOL];
        $result[] = ['summary', null, '<?xml version="1.0"?>' . PHP_EOL . '<Documentation>' . PHP_EOL . '   <Summary><![CDATA[summary]]></Summary>' . PHP_EOL . '</Documentation>' . PHP_EOL];
        $result[] = [null, 'description', '<?xml version="1.0"?>' . PHP_EOL . '<Documentation>' . PHP_EOL . '   <LongDescription><![CDATA[description]]></LongDescription>' . PHP_EOL . '</Documentation>' . PHP_EOL];
        $result[] = ['summary', 'description', '<?xml version="1.0"?>' . PHP_EOL . '<Documentation>' . PHP_EOL . '   <Summary><![CDATA[summary]]></Summary>' . PHP_EOL . '   <LongDescription><![CDATA[description]]></LongDescription>' . PHP_EOL . '</Documentation>' . PHP_EOL];

        return $result;
    }

    /**
     * @dataProvider writeDocumentationElementProvider
     *
     * @param string|null $summary
     * @param string|null $description
     * @param string      $expected
     */
    public function testWriteDocumentationElementProvider(?string $summary, ?string $description, string $expected)
    {
        $writer = $this->getWriter();
        $foo    = $this->getSchemaWriterWithMock($writer);

        $doc = m::mock(IDocumentation::class)->makePartial();
        $doc->shouldReceive('getSummary')->andReturn($summary);
        $doc->shouldReceive('getDescription')->andReturn($description);

        $foo->WriteDocumentationElement($doc);
        $actual = $writer->outputMemory(true);
        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    public function writeEnumMemberElementHeaderProvider(): array
    {
        $result   = [];
        $result[] = [null, '<?xml version="1.0"?>' . PHP_EOL . '<Member Name="name" Value="0"/>' . PHP_EOL, IIntegerValue::class];
        $result[] = [false, '<?xml version="1.0"?>' . PHP_EOL . '<Member Name="name"/>' . PHP_EOL, IBooleanValue::class];
        $result[] = [true, '<?xml version="1.0"?>' . PHP_EOL . '<Member Name="name" Value="0"/>' . PHP_EOL, IIntegerValue::class];
        return $result;
    }

    /**
     * @dataProvider writeEnumMemberElementHeaderProvider
     *
     * @param  bool|null            $explicit
     * @param  string               $expected
     * @throws \ReflectionException
     */
    public function testWriteEnumMemberElementHeader(?bool $explicit, string $expected, string $type)
    {
        $writer = $this->getWriter();
        $foo    = $this->getSchemaWriterWithMock($writer);

        $prim = m::mock($type)->makePartial();
        $prim->shouldReceive('getValueKind')->andReturn(ValueKind::Integer());
        $prim->shouldReceive('getValue')->andReturn(0);

        $enum = m::mock(EdmEnumMember::class)->makePartial();
        $enum->shouldReceive('IsValueExplicit')->andReturn($explicit);
        $enum->shouldReceive('getName')->andReturn('name');
        $enum->shouldReceive('getValue')->andReturn($prim);

        $foo->WriteEnumMemberElementHeader($enum);

        $writer->endElement();
        $actual = $writer->outputMemory(true);
        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    /**
     * @throws \ReflectionException
     */
    public function testWriteComplexTypeElementHeader()
    {
        $writer = $this->getWriter();
        $foo    = $this->getSchemaWriterWithMock($writer);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<ComplexType Name="name"/>' . PHP_EOL;

        $complex = m::mock(IComplexType::class)->makePartial();
        $complex->shouldReceive('getName')->andReturn('name');
        $complex->shouldReceive('isAbstract')->andReturn(false);
        $complex->shouldReceive('BaseComplexType')->andReturn(null);

        $foo->WriteComplexTypeElementHeader($complex);

        $writer->endElement();
        $actual = $writer->outputMemory(true);
        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    /**
     * @throws \ReflectionException
     */
    public function testWritePropertyRefElement()
    {
        $writer = $this->getWriter();
        $foo    = $this->getSchemaWriterWithMock($writer);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<PropertyRef Name="name"/>' . PHP_EOL;

        $prop = m::mock(IStructuralProperty::class);
        $prop->shouldReceive('getName')->andReturn('name');

        $foo->WritePropertyRefElement($prop);

        $writer->endElement();
        $actual = $writer->outputMemory(true);
        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    public function writeValueTermElementHeaderProvider(): array
    {
        $result   = [];
        $result[] = [false, null, '<?xml version="1.0"?>' . PHP_EOL . '<ValueTerm Name="name"/>' . PHP_EOL];
        $result[] = [true, null, '<?xml version="1.0"?>' . PHP_EOL . '<ValueTerm Name="name"/>' . PHP_EOL];
        $result[] = [false, ITypeReference::class, '<?xml version="1.0"?>' . PHP_EOL . '<ValueTerm Name="name"/>' . PHP_EOL];
        $result[] = [true, ITypeReference::class, '<?xml version="1.0"?>' . PHP_EOL . '<ValueTerm Name="name" Type="fullName"/>' . PHP_EOL];

        return $result;
    }

    /**
     * @dataProvider writeValueTermElementHeaderProvider
     *
     * @param bool $isInline
     * @param $type
     * @param  string               $expected
     * @throws \ReflectionException
     */
    public function testWriteValueTermElementHeader(bool $isInline, $type, string $expected)
    {
        $writer = $this->getWriter();
        $foo    = $this->getSchemaWriterWithMock($writer);

        $typeRef = null;
        if ($type) {
            $def = m::mock(EdmEnumType::class)->makePartial();
            $def->shouldReceive('FullName')->andReturn('fullName');

            $typeRef = m::mock($type);
            $typeRef->shouldReceive('isCollection')->andReturn(false);
            $typeRef->shouldReceive('isEntityReference')->andReturn(false);
            $typeRef->shouldReceive('getDefinition')->andReturn($def);
        }

        $term = m::mock(IValueTerm::class);
        $term->shouldReceive('getType')->andReturn($typeRef);
        $term->shouldReceive('getName')->andReturn('name');

        $foo->WriteValueTermElementHeader($term, $isInline);

        $writer->endElement();
        $actual = $writer->outputMemory(true);
        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    public function writeEnumTypeElementHeaderProvider(): array
    {
        $result   = [];
        $result[] = [PrimitiveTypeKind::Int32(), false, '<?xml version="1.0"?>' . PHP_EOL . '<EnumType Name="name"/>' . PHP_EOL];
        $result[] = [PrimitiveTypeKind::Int64(), false, '<?xml version="1.0"?>' . PHP_EOL . '<EnumType Name="name" UnderlyingType="FullName"/>' . PHP_EOL];
        $result[] = [PrimitiveTypeKind::Int32(), true, '<?xml version="1.0"?>' . PHP_EOL . '<EnumType Name="name" IsFlags="true"/>' . PHP_EOL];
        $result[] = [PrimitiveTypeKind::Int64(), true, '<?xml version="1.0"?>' . PHP_EOL . '<EnumType Name="name" UnderlyingType="FullName" IsFlags="true"/>' . PHP_EOL];


        return $result;
    }

    /**
     * @dataProvider writeEnumTypeElementHeaderProvider
     *
     * @param  PrimitiveTypeKind    $type
     * @param  bool                 $isFlags
     * @param  string               $expected
     * @throws \ReflectionException
     */
    public function testWriteEnumTypeElementHeaderProvider(PrimitiveTypeKind $type, bool $isFlags, string $expected)
    {
        $writer = $this->getWriter();
        $foo    = $this->getSchemaWriterWithMock($writer);

        $prim = m::mock(IPrimitiveType::class)->makePartial();
        $prim->shouldReceive('getPrimitiveKind')->andReturn($type);
        $prim->shouldReceive('FullName')->andReturn('FullName');

        $enum = m::mock(IEnumType::class)->makePartial();
        $enum->shouldReceive('getUnderlyingType')->andReturn($prim);
        $enum->shouldReceive('getName')->andReturn('name');
        $enum->shouldReceive('isFlags')->andReturn($isFlags);

        $foo->WriteEnumTypeElementHeader($enum);
        $writer->endElement();
        $actual = $writer->outputMemory(true);
        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    public function testWriteDeclaredKeyPropertiesElementHeader()
    {
        $writer = $this->getWriter();
        $foo    = $this->getSchemaWriterWithMock($writer);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<Key/>' . PHP_EOL;

        $foo->WriteDeclaredKeyPropertiesElementHeader();

        $writer->endElement();
        $actual = $writer->outputMemory(true);
        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    /**
     * @return EdmModelCsdlSchemaWriter
     */
    protected function getSchemaWriter(): EdmModelCsdlSchemaWriter
    {
        $model    = m::mock(IModel::class)->makePartial();
        $mappings = [];
        $ver      = Version::v3();
        $writer   = new \XMLWriter();

        $foo = new EdmModelCsdlSchemaWriter($model, $mappings, $ver, $writer);
        return $foo;
    }

    /**
     * @return EdmModelCsdlSchemaWriter
     */
    protected function getSchemaWriterWithMock(\XMLWriter $writer): EdmModelCsdlSchemaWriter
    {
        $model    = m::mock(IModel::class)->makePartial();
        $mappings = [];
        $ver      = Version::v3();

        $foo = new EdmModelCsdlSchemaWriter($model, $mappings, $ver, $writer);
        return $foo;
    }

    /**
     * @return \XMLWriter
     */
    protected function getWriter(): \XMLWriter
    {
        $writer = new \XMLWriter();
        $writer->openMemory();
        $writer->startDocument();
        $writer->setIndent(true);
        $writer->setIndentString('   ');
        return $writer;
    }
}
