<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Csdl\Internal\Serialization;

use AlgoWeb\ODataMetadata\Csdl\Internal\Serialization\EdmModelCsdlSchemaWriter;
use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\Enums\ConcurrencyMode;
use AlgoWeb\ODataMetadata\Enums\FunctionParameterMode;
use AlgoWeb\ODataMetadata\Enums\Multiplicity;
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
}
