<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 21/06/20
 * Time: 4:34 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\Csdl\Internal\Serialization\EdmModelCsdlSerializationVisitor;
use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
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
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIfExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIntegerConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIsTypeExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpressionReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\INullExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IParameterReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPathExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPropertyReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IRecordExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IStringConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ITimeConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IValueTermReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\IDocumentation;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Version;
use Mockery as m;

class VisitExpressionsTest extends TestCase
{
    public function testVisitAssertTypeExpressionNoDefinition()
    {
        $model = m::mock(IModel::class)->makePartial();
        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn(null);


        $expression = m::mock(IExpression::class . ', ' . IAssertTypeExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::AssertType());
        $expression->shouldReceive('getType')->andReturn($typeRef);

        $foo = new EdmModelVisitor($model);

        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Invalid type kind: \'null\'');

        $foo->VisitExpression($expression);
    }

    public function testVisitAssertTypeExpressionHasEmptyDefinition()
    {
        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(m::mock(TypeKind::class)->makePartial());

        $model = m::mock(IModel::class)->makePartial();
        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $expression = m::mock(IExpression::class . ', ' . IAssertTypeExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::AssertType());
        $expression->shouldReceive('getType')->andReturn($typeRef);

        $foo = new EdmModelVisitor($model);

        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Invalid type kind: \'\'');

        $foo->VisitExpression($expression);
    }

    public function testVisitBinaryTypeExpressionHasNonEmptyDefinition()
    {
        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());

        $model = m::mock(IModel::class)->makePartial();
        $model->shouldReceive('GetNamespaceAliases')->andReturn([]);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $expression = m::mock(IExpression::class . ', ' . IBinaryConstantExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::BinaryConstant());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getValue')->andReturn([]);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.'<String><![CDATA[]]></String>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitBooleanTypeExpressionHasNonEmptyDefinition()
    {
        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());

        $model = m::mock(IModel::class)->makePartial();
        $model->shouldReceive('GetNamespaceAliases')->andReturn([]);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $expression = m::mock(IExpression::class . ', ' . IBooleanConstantExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::BooleanConstant());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getValue')->andReturn(true);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.'<Bool><![CDATA[true]]></Bool>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitCollectionExpressionHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Collection());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $expression = m::mock(IExpression::class . ', ' . ICollectionExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::Collection());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getElements')->andReturn([]);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.'<Collection>'.PHP_EOL.'    <Documentation/>'.PHP_EOL.'</Collection>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitDateTimeConstantExpressionHasNonEmptyDefinition()
    {
        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());

        $model = m::mock(IModel::class)->makePartial();
        $model->shouldReceive('GetNamespaceAliases')->andReturn([]);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $time = new \DateTime('2000-01-01');

        $expression = m::mock(IExpression::class . ', ' . IDateTimeConstantExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::DateTimeConstant());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getValue')->andReturn($time);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.'<DateTime><![CDATA[2000-01-01T00:00:00.000000000]]></DateTime>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitDateTimeOffsetConstantExpressionHasNonEmptyDefinition()
    {
        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());

        $model = m::mock(IModel::class)->makePartial();
        $model->shouldReceive('GetNamespaceAliases')->andReturn([]);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $tz = new \DateTimeZone('Australia/Brisbane');
        $time = new \DateTime('2000-01-01', $tz);

        $expression = m::mock(IExpression::class . ', ' . IDateTimeOffsetConstantExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::DateTimeOffsetConstant());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getValue')->andReturn($time);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.
                    '<DateTimeOffset><![CDATA[2000-01-01T00:00:00.000Z+10:00]]></DateTimeOffset>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitDecimalConstantExpressionHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $expression = m::mock(IExpression::class . ', ' . IDecimalConstantExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::DecimalConstant());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getValue')->andReturn(0.1);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.
                    '<Decimal><![CDATA[0.1M]]></Decimal>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitEntitySetReferenceExpressionHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::EntityReference());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $iSet = m::mock(IEntitySet::class)->makePartial();
        $iSet->shouldReceive('getContainer')->andReturn(null);
        $iSet->shouldReceive('getName')->andReturn('Name');

        $expression = m::mock(IExpression::class . ', ' . IEntitySetReferenceExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::EntitySetReference());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getReferencedEntitySet')->andReturn($iSet);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.
                    '<EntitySetReference Name="/Name"/>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitEnumMemberReferenceExpressionHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Enum());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $enumType = m::mock(IEnumType::class);
        $enumType->shouldReceive('FullName')->andReturn('FullName');

        $mem = m::mock(IEnumMember::class)->makePartial();
        $mem->shouldReceive('getDeclaringType')->andReturn($enumType);
        $mem->shouldReceive('getName')->andReturn('Name');

        $expression = m::mock(IExpression::class . ', ' . IEnumMemberReferenceExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::EnumMemberReference());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getReferencedEnumMember')->andReturn($mem);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.
                    '<EnumMemberReference Name="FullName/Name"/>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitFloatingConstantExpressionHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $expression = m::mock(IExpression::class . ', ' . IFloatingConstantExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::FloatingConstant());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getValue')->andReturn(0.1);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.
                    '<Float><![CDATA[0.1F]]></Float>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitFunctionApplicationExpressionHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Entity());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $func = m::mock(IExpression::class)->makePartial();
        $func->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());

        $expression = m::mock(IExpression::class . ', ' . IApplyExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::FunctionApplication());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getAppliedFunction')->andReturn($func);
        $expression->shouldReceive('getArguments')->andReturn([]);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.
                    '<Apply>'.PHP_EOL.'    <Documentation/>'.PHP_EOL.'</Apply>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitFunctionReferenceExpressionHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Entity());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $func = m::mock(IFunction::class)->makePartial();
        $func->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());
        $func->shouldReceive('FullName')->andReturn('FullName');

        $expression = m::mock(IExpression::class . ', ' . IFunctionReferenceExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::FunctionReference());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getReferencedFunction')->andReturn($func);
        $expression->shouldReceive('getArguments')->andReturn([]);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.
                    '<FunctionReference Name="FullName"/>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitGuidConstantExpressionHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $expression = m::mock(IExpression::class . ', ' . IGuidConstantExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::GuidConstant());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getValue')->andReturn('059d1a1e-11bc-4951-88f7-940cf1d1a66a');

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.
                    '<Guid><![CDATA[059d1a1e-11bc-4951-88f7-940cf1d1a66a]]></Guid>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitIfExpressionHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Entity());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $func = m::mock(IFunction::class)->makePartial();
        $func->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());
        $func->shouldReceive('FullName')->andReturn('FullName');

        $iExp = m::mock(IExpression::class)->makePartial();
        $iExp->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());

        $expression = m::mock(IExpression::class . ', ' . IIfExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::If());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getReferencedFunction')->andReturn($func);
        $expression->shouldReceive('getArguments')->andReturn([]);
        $expression->shouldReceive('getTestExpression')->andReturn($iExp);
        $expression->shouldReceive('getTrueExpression')->andReturn($iExp);
        $expression->shouldReceive('getFalseExpression')->andReturn($iExp);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.
                    '<If>'.PHP_EOL.'    <Documentation/>'.PHP_EOL.'</If>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitIntegerConstantExpressionHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $expression = m::mock(IExpression::class . ', ' . IIntegerConstantExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::IntegerConstant());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getValue')->andReturn(1);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.
                    '<Int><![CDATA[1]]></Int>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitIsTypeExpressionHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $primRef = m::mock(IPrimitiveTypeReference::class)->makePartial();
        $primRef->shouldReceive('PrimitiveKind')->andReturn(PrimitiveTypeKind::None());

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);
        $typeRef->shouldReceive('IsEntityReference')->andReturn(false);
        $typeRef->shouldReceive('IsCollection')->andReturn(false);
        $typeRef->shouldReceive('AsPrimitive')->andReturn($primRef);

        $operand = m::mock(IExpression::class)->makePartial();
        $operand->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());

        $expression = m::mock(IExpression::class . ', ' . IIsTypeExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::IsType());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getOperand')->andReturn($operand);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.
                    '<IsType>'.PHP_EOL.'    <Documentation/>'.PHP_EOL.'</IsType>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitParameterReferenceExpressionHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Entity());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $func = m::mock(IFunctionParameter::class)->makePartial();
        $func->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());
        $func->shouldReceive('FullName')->andReturn('FullName');
        $func->shouldReceive('getName')->andReturn('Name');

        $expression = m::mock(IExpression::class . ', ' . IParameterReferenceExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::ParameterReference());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getReferencedParameter')->andReturn($func);
        $expression->shouldReceive('getArguments')->andReturn([]);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.
                    '<ParameterReference Name="Name"/>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitLabeledExpressionReferenceHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Entity());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $func = m::mock(IFunctionParameter::class)->makePartial();
        $func->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());
        $func->shouldReceive('FullName')->andReturn('FullName');
        $func->shouldReceive('getName')->andReturn('Name');

        $expression = m::mock(IExpression::class . ', ' . ILabeledExpressionReferenceExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::LabeledExpressionReference());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getReferencedParameter')->andReturn($func);
        $expression->shouldReceive('getArguments')->andReturn([]);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitLabeledExpressionHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Entity());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $func = m::mock(IExpression::class)->makePartial();
        $func->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());
        $func->shouldReceive('FullName')->andReturn('FullName');

        $expression = m::mock(IExpression::class . ', ' . ILabeledExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::Labeled());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getExpression')->andReturn($func);
        $expression->shouldReceive('getArguments')->andReturn([]);
        $expression->shouldReceive('getName')->andReturn('Name');

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.
                    '<LabeledElement Name="Name">'.PHP_EOL.
                    '    <Documentation/>'.PHP_EOL
                    .'</LabeledElement>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitNullExpressionHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $func = m::mock(IExpression::class)->makePartial();
        $func->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());
        $func->shouldReceive('FullName')->andReturn('FullName');

        $expression = m::mock(IExpression::class . ', ' . INullExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::Null());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getExpression')->andReturn($func);
        $expression->shouldReceive('getArguments')->andReturn([]);
        $expression->shouldReceive('getName')->andReturn('Name');

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.
                    '<Null/>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitPathExpressionHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $func = m::mock(IExpression::class)->makePartial();
        $func->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());
        $func->shouldReceive('FullName')->andReturn('FullName');

        $expression = m::mock(IExpression::class . ', ' . IPathExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::Path());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getExpression')->andReturn($func);
        $expression->shouldReceive('getPath')->andReturn([]);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.
                    '<Path><![CDATA[]]></Path>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitPropertyReferenceExpressionHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Entity());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $func = m::mock(IProperty::class)->makePartial();
        $func->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());
        $func->shouldReceive('FullName')->andReturn('FullName');
        $func->shouldReceive('getName')->andReturn('Name');

        $base = m::mock(IExpression::class)->makePartial();
        $base->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());

        $expression = m::mock(IExpression::class . ', ' . IPropertyReferenceExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::PropertyReference());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getReferencedProperty')->andReturn($func);
        $expression->shouldReceive('getArguments')->andReturn([]);
        $expression->shouldReceive('getBase')->andReturn($base);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.
                    '<PropertyReference Name="Name">'.PHP_EOL.'    <Documentation/>'.PHP_EOL.
                    '</PropertyReference>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitRecordHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $func = m::mock(IExpression::class)->makePartial();
        $func->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());
        $func->shouldReceive('FullName')->andReturn('FullName');

        $expression = m::mock(IExpression::class . ', ' . IRecordExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::Record());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getDeclaredType')->andReturn(null);
        $expression->shouldReceive('getProperties')->andReturn([]);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.
                    '<Record>'.PHP_EOL.'    <Documentation/>'.PHP_EOL.'</Record>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitStringConstantExpressionHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $expression = m::mock(IExpression::class . ', ' . IStringConstantExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::StringConstant());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getValue')->andReturn('foo');

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.
                    '<String><![CDATA[foo]]></String>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitTimeConstantExpressionHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $time = new \DateTime('2000-01-01 01:01:01');

        $expression = m::mock(IExpression::class . ', ' . ITimeConstantExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::TimeConstant());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getValue')->andReturn($time);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitValueTermReferenceHasNonEmptyDefinition()
    {
        $doc = $this->getMockDocumentation();

        $rType = m::mock(IType::class)->makePartial();
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());

        $model = $this->getMockModel($doc);

        $writer = $this->getWriter();
        $version = Version::v3();

        $prop = m::mock(IProperty::class)->makePartial();
        $prop->shouldReceive('getName')->andReturn('Name');

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $func = m::mock(IExpression::class)->makePartial();
        $func->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());
        $func->shouldReceive('FullName')->andReturn('FullName');

        $base = m::mock(IExpression::class)->makePartial();
        $base->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());

        $expression = m::mock(IExpression::class . ', ' . IPropertyReferenceExpression::class);
        $expression->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::ValueTermReference());
        $expression->shouldReceive('getType')->andReturn($typeRef);
        $expression->shouldReceive('getReferencedProperty')->andReturn($prop);
        $expression->shouldReceive('getProperties')->andReturn([]);
        $expression->shouldReceive('getBase')->andReturn($base);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $foo->VisitExpressions([$expression]);

        $expected = '<?xml version="1.0"?>'.PHP_EOL.
                    '<PropertyReference Name="Name">'.PHP_EOL.'    <Documentation/>'.PHP_EOL.
                    '</PropertyReference>'.PHP_EOL;
        $actual = $writer->outputMemory(true);
        $this->assertEquals($expected, $actual);
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
     * @param m\Mock $doc
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