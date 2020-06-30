<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 29/06/20
 * Time: 8:18 PM.
 */
namespace AlgoWeb\ODataMetadata\Tests\Unit\Csdl\Internal\Serialization;

use AlgoWeb\ODataMetadata\Csdl\Internal\Serialization\EdmModelCsdlSerializationVisitor;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\FunctionParameterMode;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IPropertyValueBinding;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\ITypeAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\IComplexType;
use AlgoWeb\ODataMetadata\Interfaces\IDocumentation;
use AlgoWeb\ODataMetadata\Interfaces\IEntityTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Interfaces\Values\IIntegerValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPrimitiveValue;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Version;
use Mockery as m;

class EdmModelCsdlSerializationVisitorReflectionTest extends TestCase
{
    public function testProcessComplexType()
    {
        $model = $this->getModel();

        $writer  = $this->getWriter();
        $version = Version::v3();

        $element = m::mock(IComplexType::class)->makePartial();
        $element->shouldReceive('getName')->andReturn('name');
        $element->shouldReceive('BaseComplexType')->andReturn(null);
        $element->shouldReceive('isAbstract')->andReturn(false);
        $element->shouldReceive('getDeclaredProperties')->andReturn([]);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new \ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessComplexType');
        $method->setAccessible(true);

        $method->invoke($foo, $element);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<ComplexType Name="name">' . PHP_EOL . '<Documentation/>' . PHP_EOL;
        $expected .= '</ComplexType>' . PHP_EOL;
        $actual = $writer->outputMemory(true);

        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    public function testProcessEnumType()
    {
        $model = $this->getModel();

        $writer  = $this->getWriter();
        $version = Version::v3();

        $primType = m::mock(IPrimitiveType::class);
        $primType->shouldReceive('getPrimitiveKind')->andReturn(PrimitiveTypeKind::Int32());

        $primVal = m::mock(IPrimitiveValue::class . ', ' . IIntegerValue::class);
        $primVal->shouldReceive('getValueKind')->andReturn(ValueKind::Integer());
        $primVal->shouldReceive('getValue')->andReturn(11);

        $mem = m::mock(IEnumMember::class);
        $mem->shouldReceive('getName')->andReturn('member');
        $mem->shouldReceive('IsValueExplicit')->andReturn(true);
        $mem->shouldReceive('getValue')->andReturn($primVal);

        $element = m::mock(IEnumType::class)->makePartial();
        $element->shouldReceive('getName')->andReturn('name');
        $element->shouldReceive('getUnderlyingType')->andReturn($primType);
        $element->shouldReceive('isAbstract')->andReturn(false);
        $element->shouldReceive('getDeclaredProperties')->andReturn([]);
        $element->shouldReceive('isFlags')->andReturn(false);
        $element->shouldReceive('getMembers')->andReturn([$mem]);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new \ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessEnumType');
        $method->setAccessible(true);

        $method->invoke($foo, $element);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<EnumType Name="name">' . PHP_EOL . '<Documentation/>' . PHP_EOL
                    . '<Member Name="member" Value="11">' . PHP_EOL;
        $expected .= '<Documentation/>' . PHP_EOL . '</Member>' . PHP_EOL;
        $expected .= '</EnumType>' . PHP_EOL;
        $actual = $writer->outputMemory(true);

        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    public function testProcessValueTerm()
    {
        $model = $this->getModel();

        $writer  = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn(null);
        $typeRef->shouldReceive('IsEntityReference')->andReturn(false);
        $typeRef->shouldReceive('IsCollection')->andReturn(false);

        $element = m::mock(IValueTerm::class)->makePartial();
        $element->shouldReceive('getName')->andReturn('name');
        $element->shouldReceive('isAbstract')->andReturn(false);
        $element->shouldReceive('getDeclaredProperties')->andReturn([]);
        $element->shouldReceive('getType')->andReturn($typeRef);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new \ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessValueTerm');
        $method->setAccessible(true);

        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Invalid type kind: \'null\'');

        $method->invoke($foo, $element);
    }

    public function testProcessFunctionNoReturnTypeNoDefiningExpression()
    {
        $model = $this->getModel();

        $writer  = $this->getWriter();
        $version = Version::v3();

        $element = m::mock(IFunction::class)->makePartial();
        $element->shouldReceive('getName')->andReturn('name');
        $element->shouldReceive('getReturnType')->andReturn(null);
        $element->shouldReceive('getDefiningExpression')->andReturn(null);
        $element->shouldReceive('getParameters')->andReturn([]);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new \ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessFunction');
        $method->setAccessible(true);

        $method->invoke($foo, $element);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<Function Name="name">' . PHP_EOL . '<Documentation/>' . PHP_EOL;
        $expected .= '</Function>' . PHP_EOL;
        $actual = $writer->outputMemory(true);

        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    public function testProcessFunctionNoReturnTypeWithDefiningExpression()
    {
        $model = $this->getModel();

        $writer  = $this->getWriter();
        $version = Version::v3();

        $element = m::mock(IFunction::class)->makePartial();
        $element->shouldReceive('getName')->andReturn('name');
        $element->shouldReceive('getReturnType')->andReturn(null);
        $element->shouldReceive('getDefiningExpression')->andReturn('OH NOES!');
        $element->shouldReceive('getParameters')->andReturn([]);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new \ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessFunction');
        $method->setAccessible(true);

        $method->invoke($foo, $element);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<Function Name="name">' . PHP_EOL . '<Documentation/>' . PHP_EOL;
        $expected .= '<DefiningExpression>OH NOES!</DefiningExpression>';
        $expected .= '</Function>' . PHP_EOL;
        $actual = $writer->outputMemory(true);

        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    public function testProcessFunctionReturnTypeWithNoDefiningExpression()
    {
        $model = $this->getModel();

        $writer  = $this->getWriter();
        $version = Version::v3();

        $rPrim = m::mock(IPrimitiveTypeReference::class);
        $rPrim->shouldReceive('PrimitiveKind')->andReturn(PrimitiveTypeKind::Int32());

        $rType = m::mock(IType::class);
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);
        $typeRef->shouldReceive('IsEntityReference')->andReturn(false);
        $typeRef->shouldReceive('IsCollection')->andReturn(false);
        $typeRef->shouldReceive('AsPrimitive')->andReturn($rPrim);

        $element = m::mock(IFunction::class)->makePartial();
        $element->shouldReceive('getName')->andReturn('name');
        $element->shouldReceive('getReturnType')->andReturn($typeRef);
        $element->shouldReceive('getDefiningExpression')->andReturn(null);
        $element->shouldReceive('getParameters')->andReturn([]);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new \ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessFunction');
        $method->setAccessible(true);

        $method->invoke($foo, $element);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<Function Name="name">' . PHP_EOL . '<Documentation/>' . PHP_EOL;
        $expected .= '<ReturnType/>' . PHP_EOL;
        $expected .= '</Function>' . PHP_EOL;
        $actual = $writer->outputMemory(true);

        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    public function testProcessFunctionParameter()
    {
        $model = $this->getModel();

        $writer  = $this->getWriter();
        $version = Version::v3();

        $rPrim = m::mock(IPrimitiveTypeReference::class);
        $rPrim->shouldReceive('PrimitiveKind')->andReturn(PrimitiveTypeKind::Int32());

        $rType = m::mock(IType::class);
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);
        $typeRef->shouldReceive('IsEntityReference')->andReturn(false);
        $typeRef->shouldReceive('IsCollection')->andReturn(false);
        $typeRef->shouldReceive('AsPrimitive')->andReturn($rPrim);

        $mode = FunctionParameterMode::InOut();

        $element = m::mock(IFunctionParameter::class)->makePartial();
        $element->shouldReceive('getName')->andReturn('name');
        $element->shouldReceive('getType')->andReturn($typeRef);
        $element->shouldReceive('getMode')->andReturn($mode);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new \ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessFunctionParameter');
        $method->setAccessible(true);

        $method->invoke($foo, $element);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<Parameter Mode="InOut" Name="name">' . PHP_EOL . '<Documentation/>' . PHP_EOL;
        $expected .= '</Parameter>' . PHP_EOL;
        $actual = $writer->outputMemory(true);

        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    public function testProcessCollectionType()
    {
        $model = $this->getModel();

        $writer  = $this->getWriter();
        $version = Version::v3();

        $rPrim = m::mock(IPrimitiveTypeReference::class);
        $rPrim->shouldReceive('PrimitiveKind')->andReturn(PrimitiveTypeKind::Int32());

        $rType = m::mock(IType::class);
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);
        $typeRef->shouldReceive('IsEntityReference')->andReturn(false);
        $typeRef->shouldReceive('IsCollection')->andReturn(false);
        $typeRef->shouldReceive('AsPrimitive')->andReturn($rPrim);

        $mode = FunctionParameterMode::InOut();

        $element = m::mock(ICollectionType::class)->makePartial();
        $element->shouldReceive('getName')->andReturn('name');
        $element->shouldReceive('getElementType')->andReturn($typeRef);
        $element->shouldReceive('getMode')->andReturn($mode);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new \ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessCollectionType');
        $method->setAccessible(true);

        $method->invoke($foo, $element);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<CollectionType>' . PHP_EOL . '<Documentation/>' . PHP_EOL;
        $expected .= '</CollectionType>' . PHP_EOL;
        $actual = $writer->outputMemory(true);

        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    public function testProcessRowType()
    {
        $model = $this->getModel();

        $writer  = $this->getWriter();
        $version = Version::v3();

        $element = m::mock(IRowType::class)->makePartial();
        $element->shouldReceive('getDeclaredProperties')->andReturn([]);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new \ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessRowType');
        $method->setAccessible(true);

        $method->invoke($foo, $element);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<RowType/>' . PHP_EOL;
        $actual   = $writer->outputMemory(true);

        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    public function testProcessFunctionImportNotInlinedType()
    {
        $model = $this->getModel();

        $writer  = $this->getWriter();
        $version = Version::v3();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn(null);
        $typeRef->shouldReceive('IsEntityReference')->andReturn(false);
        $typeRef->shouldReceive('IsCollection')->andReturn(false);

        $element = m::mock(IFunctionImport::class)->makePartial();
        $element->shouldReceive('getReturnType')->andReturn($typeRef);
        $element->shouldReceive('getContainer->FullName')->andReturn('FullName');
        $element->shouldReceive('getName')->andReturn('Name');

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new \ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessFunctionImport');
        $method->setAccessible(true);

        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The function import \'FullName/Name\' could not be serialized because its return type cannot be represented inline.');

        $method->invoke($foo, $element);
    }

    public function testProcessFunctionImportInlinedType()
    {
        $model = $this->getModel();

        $writer  = $this->getWriter();
        $version = Version::v3();

        $schema = m::mock(ISchemaElement::class);
        $schema->shouldReceive('FullName')->andReturn('FullName');

        $entRef = m::mock(IEntityTypeReference::class);
        $entRef->shouldReceive('EntityReferenceDefinition->getEntityType')->andReturn($schema);

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('getDefinition')->andReturn(null);
        $typeRef->shouldReceive('IsEntityReference')->andReturn(true);
        $typeRef->shouldReceive('IsCollection')->andReturn(false);
        $typeRef->shouldReceive('AsEntityReference')->andReturn($entRef);

        $element = m::mock(IFunctionImport::class)->makePartial();
        $element->shouldReceive('getReturnType')->andReturn($typeRef);
        $element->shouldReceive('getContainer->FullName')->andReturn('FullName');
        $element->shouldReceive('getName')->andReturn('Name');
        $element->shouldReceive('isComposable')->andReturn(true);
        $element->shouldReceive('isSideEffecting')->andReturn(false);
        $element->shouldReceive('isBindable')->andReturn(true);
        $element->shouldReceive('getEntitySet')->andReturn(null);
        $element->shouldReceive('getParameters')->andReturn([]);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new \ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessFunctionImport');
        $method->setAccessible(true);

        $method->invoke($foo, $element);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<FunctionImport IsBindable="true" IsComposable="true" Name="Name" ReturnType="Ref(FullName)">' . PHP_EOL;
        $expected .= '<Documentation/>' . PHP_EOL . '</FunctionImport>';
        $actual = $writer->outputMemory(true);

        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    public function testProcessValueAnnotation()
    {
        $model = $this->getModel();

        $writer  = $this->getWriter();
        $version = Version::v3();

        $expr = m::mock(IExpression::class);
        $expr->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());

        $term = m::mock(ITerm::class);
        $term->shouldReceive('FullName')->andReturn('FullName');

        $element = m::mock(IValueAnnotation::class)->makePartial();
        $element->shouldReceive('getValue')->andReturn($expr);
        $element->shouldReceive('getTerm')->andReturn($term);
        $element->shouldReceive('getQualifier')->andReturn(null);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new \ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessValueAnnotation');
        $method->setAccessible(true);

        $method->invoke($foo, $element);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<ValueAnnotation Term="FullName">' . PHP_EOL;
        $expected .= '<Documentation/>' . PHP_EOL . '</ValueAnnotation>';
        $actual = $writer->outputMemory(true);

        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    public function testProcessTypeAnnotation()
    {
        $model = $this->getModel();

        $writer  = $this->getWriter();
        $version = Version::v3();

        $expr = m::mock(IExpression::class);
        $expr->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());

        $term = m::mock(ITerm::class);
        $term->shouldReceive('FullName')->andReturn('FullName');

        $element = m::mock(ITypeAnnotation::class)->makePartial();
        $element->shouldReceive('getPropertyValueBindings')->andReturn([]);
        $element->shouldReceive('getValue')->andReturn($expr);
        $element->shouldReceive('getTerm')->andReturn($term);
        $element->shouldReceive('getQualifier')->andReturn(null);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new \ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessTypeAnnotation');
        $method->setAccessible(true);

        $method->invoke($foo, $element);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<TypeAnnotation Term="FullName">' . PHP_EOL;
        $expected .= '<Documentation/>' . PHP_EOL . '</TypeAnnotation>';
        $actual = $writer->outputMemory(true);

        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    public function testProcessPropertyValueBinding()
    {
        $model = $this->getModel();

        $writer  = $this->getWriter();
        $version = Version::v3();

        $expr = m::mock(IExpression::class);
        $expr->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());

        $prop = m::mock(IProperty::class);
        $prop->shouldReceive('getName')->andReturn('Name');

        $element = m::mock(IPropertyValueBinding::class)->makePartial();
        $element->shouldReceive('getValue')->andReturn($expr);
        $element->shouldReceive('getBoundProperty')->andReturn($prop);

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new \ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessPropertyValueBinding');
        $method->setAccessible(true);

        $method->invoke($foo, $element);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<PropertyValue Property="Name">' . PHP_EOL;
        $expected .= '<Documentation/>' . PHP_EOL . '</PropertyValue>';
        $actual = $writer->outputMemory(true);

        $this->assertXmlStringEqualsXmlString($expected, $actual);
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
     * @return IModel
     */
    protected function getModel(): IModel
    {
        $doc = m::mock(IDocumentation::class)->makePartial();
        $doc->shouldReceive('getSummary')->andReturn('');
        $doc->shouldReceive('getDescription')->andReturn('');

        $model = m::mock(IModel::class)->makePartial();
        $model->shouldReceive('GetNamespaceAliases')->andReturn([]);
        $model->shouldReceive('getDirectValueAnnotationsManager->GetDirectValueAnnotations')->andReturn([]);
        $model->shouldReceive('findDeclaredVocabularyAnnotations')->andReturn([]);
        $model->shouldReceive('GetAnnotationValue')->andReturn($doc);
        return $model;
    }
}
