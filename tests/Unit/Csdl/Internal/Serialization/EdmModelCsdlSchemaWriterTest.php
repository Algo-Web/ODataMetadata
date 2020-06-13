<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Csdl\Internal\Serialization;

use AlgoWeb\ODataMetadata\Csdl\Internal\Serialization\EdmModelCsdlSchemaWriter;
use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\Enums\ConcurrencyMode;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\FunctionParameterMode;
use AlgoWeb\ODataMetadata\Enums\Multiplicity;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
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
     * @param Multiplicity $mult
     * @param string $expected
     * @param bool $kaboom
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
     * @param FunctionParameterMode $mode
     * @param string $expected
     * @param bool $kaboom
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
     * @param ConcurrencyMode $mode
     * @param string $expected
     * @param bool $kaboom
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

        $result[] = [ExpressionKind::BinaryConstant(), [0xFF], '<?xml version="1.0"?>'.PHP_EOL.'<Test Binary="FF"/>'.PHP_EOL, false];
        $result[] = [ExpressionKind::BooleanConstant(), true, '<?xml version="1.0"?>'.PHP_EOL.'<Test Bool="true"/>'.PHP_EOL, false];
        $result[] = [ExpressionKind::DateTimeConstant(), new \DateTime('2000-01-01'), '<?xml version="1.0"?>'.PHP_EOL.'<Test DateTime="2000-01-01T00:00:00.000000000"/>'.PHP_EOL, false];
        $result[] = [ExpressionKind::DateTimeOffsetConstant(), new \DateTime('2000-01-02 01:02:03'), '<?xml version="1.0"?>'.PHP_EOL.'<Test DateTimeOffset="2000-01-02T01:02:03.000Z+00:00"/>'.PHP_EOL, false];
        $result[] = [ExpressionKind::DecimalConstant(), 0, '<?xml version="1.0"?>'.PHP_EOL.'<Test Decimal="0M"/>'.PHP_EOL, false];
        $result[] = [ExpressionKind::FloatingConstant(), 0, '<?xml version="1.0"?>'.PHP_EOL.'<Test Float="0F"/>'.PHP_EOL, false];
        $result[] = [ExpressionKind::GuidConstant(), '059d1a1e-11bc-4951-88f7-940cf1d1a66a', '<?xml version="1.0"?>'.PHP_EOL.'<Test Guid="059d1a1e-11bc-4951-88f7-940cf1d1a66a"/>'.PHP_EOL, false];
        $result[] = [ExpressionKind::IntegerConstant(), 0, '<?xml version="1.0"?>'.PHP_EOL.'<Test Int="0"/>'.PHP_EOL, false];
        $result[] = [ExpressionKind::Path(), ['all', 'your', 'base', 'are', 'belong', 'to', 'us'], '<?xml version="1.0"?>'.PHP_EOL.'<Test Path="all/your/base/are/belong/to/us"/>'.PHP_EOL, false];
        $result[] = [ExpressionKind::StringConstant(), 'string', '<?xml version="1.0"?>'.PHP_EOL.'<Test String="string"/>'.PHP_EOL, false];
        $result[] = [ExpressionKind::TimeConstant(), new \DateTime('2000-01-01 01:02:03'), '<?xml version="1.0"?>'.PHP_EOL.'<Test Time="01:02:03.000000"/>'.PHP_EOL, false];
        $result[] = [ExpressionKind::EntitySetReference(), null, '<?xml version="1.0"?>'.PHP_EOL.'<Test/>'.PHP_EOL, false];

        return $result;
    }

    /**
     * @dataProvider writeInlineExpressionProvider
     *
     * @param ExpressionKind $kind
     * @param $payload
     * @param $expected
     * @param bool $kaboom
     * @throws \ReflectionException
     */
    public function testWriteInlineExpression(ExpressionKind $kind, $payload, $expected, bool $kaboom)
    {
        $writer = new \XMLWriter();
        $writer->openMemory();
        $writer->startDocument();
        $writer->setIndent(true);
        $writer->setIndentString('   ');
        $foo = $this->getSchemaWriterWithMock($writer);

        $expr = m::mock(IExpression::class)->makePartial();
        $expr->shouldReceive('getExpressionKind')->andReturn($kind);
        if ($kind != ExpressionKind::Path()) {
            $expr->shouldReceive('getValue')->andReturn($payload);
        } else {
            $expr->shouldReceive('getPath')->andReturn($payload);
        }

        $writer->startElement('Test');
        $foo->WriteInlineExpression($expr);
        $writer->endElement();

        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return EdmModelCsdlSchemaWriter
     */
    protected function getSchemaWriter(): EdmModelCsdlSchemaWriter
    {
        $model = m::mock(IModel::class)->makePartial();
        $mappings = [];
        $ver = Version::v3();
        $writer = new \XMLWriter();

        $foo = new EdmModelCsdlSchemaWriter($model, $mappings, $ver, $writer);
        return $foo;
    }

    /**
     * @return EdmModelCsdlSchemaWriter
     */
    protected function getSchemaWriterWithMock(\XMLWriter $writer): EdmModelCsdlSchemaWriter
    {
        $model = m::mock(IModel::class)->makePartial();
        $mappings = [];
        $ver = Version::v3();

        $foo = new EdmModelCsdlSchemaWriter($model, $mappings, $ver, $writer);
        return $foo;
    }
}
