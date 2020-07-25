<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\Csdl\Internal\Serialization\EdmModelCsdlSerializationVisitor;
use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IApplyExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IAssertTypeExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IBinaryConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IBooleanConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ICollectionExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDateTimeConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDateTimeOffsetConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDecimalConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IEntitySetReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IEnumMemberReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IFloatingConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IFunctionReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IGuidConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIntegerConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIsTypeExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\INullExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IParameterReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPathExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPropertyReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IRecordExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IStringConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\RecordExpression\IPropertyConstructor;
use AlgoWeb\ODataMetadata\Interfaces\IDocumentation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Version;
use Mockery as m;

class ProcessExpressionsTest extends TestCase
{
    public function testProcessNullExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $writer  = $this->getWriter();
        $version = Version::v3();

        $foo = new EdmModelVisitor($model);

        $expression = m::mock(IExpression::class . ', ' . INullExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::Null());

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(1, $payload->count());
        $result  = iterable_to_array($payload);
        $current = $result[0];
        $this->assertEquals($expression, $current);
    }

    public function testProcessStringConstantExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $writer  = $this->getWriter();
        $version = Version::v3();

        $foo = new EdmModelVisitor($model);

        $expression = m::mock(IExpression::class . ', ' . IStringConstantExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::StringConstant());

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(1, $payload->count());
        $result = iterable_to_array($payload);

        $current = $result[0];
        $this->assertEquals($expression, $current);
    }

    public function testProcessBinaryConstantExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $writer  = $this->getWriter();
        $version = Version::v3();

        $foo = new EdmModelVisitor($model);

        $expression = m::mock(IExpression::class . ', ' . IBinaryConstantExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::BinaryConstant());

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(1, $payload->count());
        $result = iterable_to_array($payload);

        $current = $result[0];
        $this->assertEquals($expression, $current);
    }

    public function testProcessPathConstantExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $writer  = $this->getWriter();
        $version = Version::v3();

        $foo = new EdmModelVisitor($model);

        $expression = m::mock(IExpression::class . ', ' . IPathExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::Path());

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(1, $payload->count());
        $result = iterable_to_array($payload);

        $current = $result[0];
        $this->assertEquals($expression, $current);
    }

    public function testProcessParameterReferenceExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $foo = new EdmModelVisitor($model);

        $expression = m::mock(IExpression::class . ', ' . IParameterReferenceExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::ParameterReference());

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(1, $payload->count());
        $result = iterable_to_array($payload);

        $current = $result[0];
        $this->assertEquals($expression, $current);
    }

    public function testProcessIntegerConstantExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $foo = new EdmModelVisitor($model);

        $expression = m::mock(IExpression::class . ', ' . IIntegerConstantExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::IntegerConstant());

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(1, $payload->count());
        $result = iterable_to_array($payload);

        $current = $result[0];
        $this->assertEquals($expression, $current);
    }

    public function testProcessFunctionReferenceExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $foo = new EdmModelVisitor($model);

        $expression = m::mock(IExpression::class . ', ' . IFunctionReferenceExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::FunctionReference());

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(1, $payload->count());
        $result = iterable_to_array($payload);

        $current = $result[0];
        $this->assertEquals($expression, $current);
    }

    public function testProcessFloatingConstantExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $foo = new EdmModelVisitor($model);

        $expression = m::mock(IExpression::class . ', ' . IFloatingConstantExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::FloatingConstant());

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(1, $payload->count());
        $result = iterable_to_array($payload);

        $current = $result[0];
        $this->assertEquals($expression, $current);
    }

    public function testProcessGuidConstantExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $foo = new EdmModelVisitor($model);

        $expression = m::mock(IExpression::class . ', ' . IGuidConstantExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::GuidConstant());

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(1, $payload->count());
        $result = iterable_to_array($payload);

        $current = $result[0];
        $this->assertEquals($expression, $current);
    }

    public function testProcessEnumMemberReferenceExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $foo = new EdmModelVisitor($model);

        $expression = m::mock(IExpression::class . ', ' . IEnumMemberReferenceExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::EnumMemberReference());

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(1, $payload->count());
        $result = iterable_to_array($payload);

        $current = $result[0];
        $this->assertEquals($expression, $current);
    }

    public function testProcessEntitySetReferenceExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $foo = new EdmModelVisitor($model);

        $expression = m::mock(IExpression::class . ', ' . IEntitySetReferenceExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::EntitySetReference());

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(1, $payload->count());
        $result = iterable_to_array($payload);

        $current = $result[0];
        $this->assertEquals($expression, $current);
    }

    public function testProcessDecimalConstantExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $foo = new EdmModelVisitor($model);

        $expression = m::mock(IExpression::class . ', ' . IDecimalConstantExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::DecimalConstant());

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(1, $payload->count());
        $result = iterable_to_array($payload);

        $current = $result[0];
        $this->assertEquals($expression, $current);
    }

    public function testProcessDateTimeConstantExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $foo = new EdmModelVisitor($model);

        $expression = m::mock(IExpression::class . ', ' . IDateTimeConstantExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::DateTimeConstant());

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(1, $payload->count());
        $result = iterable_to_array($payload);

        $current = $result[0];
        $this->assertEquals($expression, $current);
    }

    public function testProcessDateTimeOffsetConstantExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $foo = new EdmModelVisitor($model);

        $expression = m::mock(IExpression::class . ', ' . IDateTimeOffsetConstantExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::DateTimeOffsetConstant());

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(1, $payload->count());
        $result = iterable_to_array($payload);

        $current = $result[0];
        $this->assertEquals($expression, $current);
    }

    public function testProcessBooleanConstantExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $foo = new EdmModelVisitor($model);

        $expression = m::mock(IExpression::class . ', ' . IBooleanConstantExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::BooleanConstant());

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(1, $payload->count());
        $result = iterable_to_array($payload);

        $current = $result[0];
        $this->assertEquals($expression, $current);
    }

    public function testProcessRecordExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $foo = new EdmModelVisitor($model);

        $def = m::mock(IType::class);
        $def->shouldReceive('getTypeKind')->andReturn(TypeKind::None());

        $decType = m::mock(IStructuredTypeReference::class);
        $decType->shouldReceive('getDefinition')->andReturn($def);

        $expr = m::mock(IExpression::class);
        $expr->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());

        $propCon = m::mock(IPropertyConstructor::class);
        $propCon->shouldReceive('getValue')->andReturn($expr)->atLeast(1);

        $expression = m::mock(IExpression::class . ', ' . IRecordExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::Record());
        $expression->shouldReceive('getDeclaredType')->andReturn($decType)->atLeast(1);
        $expression->shouldReceive('getProperties')->andReturn([$propCon])->atLeast(1);

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(4, $payload->count());
        $result = iterable_to_array($payload);
        $this->assertEquals($expression, $result[0]);
        $this->assertEquals($decType, $result[1]);
        $this->assertEquals($propCon, $result[2]);
        $this->assertEquals($expr, $result[3]);
    }

    public function testProcessPropertyReferenceExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $foo = new EdmModelVisitor($model);

        $expr = m::mock(IExpression::class);
        $expr->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());

        $expression = m::mock(IExpression::class . ', ' . IPropertyReferenceExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::PropertyReference());
        $expression->shouldReceive('getBase')->andReturn($expr);

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(2, $payload->count());
        $result = iterable_to_array($payload);
        $this->assertEquals($expression, $result[0]);
        $this->assertEquals($expr, $result[1]);
    }

    public function testProcessCollectionExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $foo = new EdmModelVisitor($model);

        $expr = m::mock(IExpression::class);
        $expr->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());

        $expression = m::mock(IExpression::class . ', ' . ICollectionExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::Collection());
        $expression->shouldReceive('getElements')->andReturn([$expr]);

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(2, $payload->count());
        $result = iterable_to_array($payload);
        $this->assertEquals($expression, $result[0]);
        $this->assertEquals($expr, $result[1]);
    }

    public function testProcessIsTypeExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $foo = new EdmModelVisitor($model);

        $def = m::mock(IType::class);
        $def->shouldReceive('getTypeKind')->andReturn(TypeKind::None());

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($def)->atLeast(1);

        $expr = m::mock(IExpression::class);
        $expr->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());

        $expression = m::mock(IExpression::class . ', ' . IIsTypeExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::IsType());
        $expression->shouldReceive('getType')->andReturn($typeRef)->atLeast(1);
        $expression->shouldReceive('getOperand')->andReturn($expr)->atLeast(1);

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(3, $payload->count());
        $result = iterable_to_array($payload);
        $this->assertEquals($expression, $result[0]);
        $this->assertEquals($typeRef, $result[1]);
        $this->assertEquals($expr, $result[2]);
    }

    public function testProcessAssertTypeExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $foo = new EdmModelVisitor($model);

        $def = m::mock(IType::class);
        $def->shouldReceive('getTypeKind')->andReturn(TypeKind::None());

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($def)->atLeast(1);

        $expr = m::mock(IExpression::class);
        $expr->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());

        $expression = m::mock(IExpression::class . ', ' . IAssertTypeExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::AssertType());
        $expression->shouldReceive('getType')->andReturn($typeRef)->atLeast(1);
        $expression->shouldReceive('getOperand')->andReturn($expr)->atLeast(1);

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(3, $payload->count());
        $result = iterable_to_array($payload);
        $this->assertEquals($expression, $result[0]);
        $this->assertEquals($typeRef, $result[1]);
        $this->assertEquals($expr, $result[2]);
    }

    public function testProcessFunctionApplicationExpression()
    {
        $doc   = $this->getMockDocumentation();
        $model = $this->getMockModel($doc);

        $foo = new EdmModelVisitor($model);

        $expr = m::mock(IExpression::class);
        $expr->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());

        $expression = m::mock(IExpression::class . ', ' . IApplyExpression::class);
        $expression->shouldReceive('getExpressionKind')
            ->andReturn(ExpressionKind::FunctionApplication());
        $expression->shouldReceive('getAppliedFunction')->andReturn($expr)->atLeast(1);
        $expression->shouldReceive('getArguments')->andReturn([])->atLeast(1);

        $foo->visitExpressions([$expression]);

        $reflec = new \ReflectionClass($foo);
        $prop   = $reflec->getProperty('cloneElementContainer');
        $prop->setAccessible(true);
        /** @var \SplObjectStorage $payload */
        $payload = $prop->getValue($foo);
        $this->assertEquals(2, $payload->count());
        $result = iterable_to_array($payload);
        $this->assertEquals($expression, $result[0]);
        $this->assertEquals($expr, $result[1]);
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
        $writer->setIndentString('    ');
        return $writer;
    }

    /**
     * @return m\Mock
     */
    protected function getMockDocumentation(): IDocumentation
    {
        $doc = m::mock(IDocumentation::class)->makePartial();
        $doc->shouldReceive('getSummary')->andReturn('');
        $doc->shouldReceive('getDescription')->andReturn('');
        return $doc;
    }

    /**
     * @param  m\Mock         $doc
     * @return IDocumentation
     */
    protected function getMockModel(IDocumentation $doc): IModel
    {
        $model = m::mock(IModel::class)->makePartial();
        $model->shouldReceive('GetNamespaceAliases')->andReturn([]);
        $model->shouldReceive('getDirectValueAnnotationsManager->GetDirectValueAnnotations')->andReturn([]);
        $model->shouldReceive('GetAnnotationValue')->andReturn($doc);
        return $model;
    }
}
