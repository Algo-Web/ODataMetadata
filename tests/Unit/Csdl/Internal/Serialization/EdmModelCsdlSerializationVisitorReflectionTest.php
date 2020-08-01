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
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\FunctionParameterMode;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\TermKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IPropertyValueBinding;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\ITypeAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IFunctionReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\RecordExpression\IPropertyConstructor;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\IComplexType;
use AlgoWeb\ODataMetadata\Interfaces\IDocumentation;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Interfaces\Values\IIntegerValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPrimitiveValue;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Version;
use Mockery as m;
use ReflectionClass;
use ReflectionException;

class EdmModelCsdlSerializationVisitorReflectionTest extends TestCase
{
    /**
     * @param $element
     * @param string $methodName
     * @param $expected
     * @dataProvider processElementProvider
     */
    public function testProcessElement($element, string $methodName, $expected)
    {
        $model = $this->getModel();

        $writer  = $this->getWriter();
        $version = Version::v3();

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);
        try {
            $reflec = new ReflectionClass($foo);
            $method = $reflec->getMethod($methodName);
        } catch (ReflectionException $exception) {
            $this->fail($exception->getMessage());
        }
        $method->setAccessible(true);

        $method->invoke($foo, $element);

        $actual = $writer->outputMemory(true);

        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    public function processElementProvider()
    {
        return[
            'Complex Type' => $this->complexTypeData(),
            'Enum Type' => $this->enumTypeData(),
            'Function No Return Type No Defining Expression' => $this->functionNoReturnTypeNoDefiningExpressionData(),
            'Function No Return Type With Defining Expression' =>$this->functionNoReturnTypeWithDefiningExpressionData(),
            'Function Return Type With No Defining Expression' => $this->functionReturnTypeWithNoDefiningExpressionData(),
            'Function Parameter' => $this->functionParameterData(),
            'Collection Type' => $this->collectionTypeData(),
            'Row Type' => $this->rowTypeData(),
            'Function Import Inlined Type' => $this->functionImportInlinedTypeData(),
            'Value Annotation' => $this->valueAnnotationData(),
            'Type Annotation' => $this->typeAnnotationData(),
            'Property Value Binding' => $this->propertyValueBindingData()
        ];
    }

    protected function complexTypeData()
    {
        $element = m::mock(IComplexType::class)->makePartial();
        $element->shouldReceive('getName')->andReturn('name');
        $element->shouldReceive('BaseComplexType')->andReturn(null);
        $element->shouldReceive('isAbstract')->andReturn(false);
        $element->shouldReceive('getDeclaredProperties')->andReturn([]);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<ComplexType Name="name">' . PHP_EOL . '<Documentation/>' . PHP_EOL;
        $expected .= '</ComplexType>' . PHP_EOL;

        return [$element, 'ProcessComplexType', $expected];
    }

    protected function enumTypeData()
    {
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

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<EnumType Name="name">' . PHP_EOL . '<Documentation/>' . PHP_EOL
            . '<Member Name="member" Value="11">' . PHP_EOL;
        $expected .= '<Documentation/>' . PHP_EOL . '</Member>' . PHP_EOL;
        $expected .= '</EnumType>' . PHP_EOL;

        return [$element, 'ProcessEnumType', $expected];
    }

    protected function functionNoReturnTypeNoDefiningExpressionData()
    {
        $element = m::mock(IFunction::class)->makePartial();
        $element->shouldReceive('getName')->andReturn('name');
        $element->shouldReceive('getReturnType')->andReturn(null);
        $element->shouldReceive('getDefiningExpression')->andReturn(null);
        $element->shouldReceive('getParameters')->andReturn([]);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<Function Name="name">' . PHP_EOL . '<Documentation/>' . PHP_EOL;
        $expected .= '</Function>' . PHP_EOL;

        return [$element, 'ProcessFunction', $expected];
    }

    protected function functionNoReturnTypeWithDefiningExpressionData()
    {
        $element = m::mock(IFunction::class)->makePartial();
        $element->shouldReceive('getName')->andReturn('name');
        $element->shouldReceive('getReturnType')->andReturn(null);
        $element->shouldReceive('getDefiningExpression')->andReturn('OH NOES!');
        $element->shouldReceive('getParameters')->andReturn([]);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<Function Name="name">' . PHP_EOL . '<Documentation/>' . PHP_EOL;
        $expected .= '<DefiningExpression>OH NOES!</DefiningExpression>';
        $expected .= '</Function>' . PHP_EOL;

        return [$element, 'ProcessFunction', $expected];
    }

    protected function functionReturnTypeWithNoDefiningExpressionData()
    {
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

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<Function Name="name">' . PHP_EOL . '<Documentation/>' . PHP_EOL;
        $expected .= '<ReturnType/>' . PHP_EOL;
        $expected .= '</Function>' . PHP_EOL;

        return [$element, 'ProcessFunction', $expected];
    }

    protected function functionParameterData()
    {
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

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<Parameter Mode="InOut" Name="name">' . PHP_EOL . '<Documentation/>' . PHP_EOL;
        $expected .= '</Parameter>' . PHP_EOL;

        return [$element, 'ProcessFunctionParameter', $expected];
    }

    protected function collectionTypeData()
    {
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


        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<CollectionType>' . PHP_EOL . '<Documentation/>' . PHP_EOL;
        $expected .= '</CollectionType>' . PHP_EOL;

        return [$element, 'ProcessCollectionType', $expected];
    }

    protected function rowTypeData()
    {
        $element = m::mock(IRowType::class)->makePartial();
        $element->shouldReceive('getDeclaredProperties')->andReturn([]);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<RowType/>' . PHP_EOL;

        return [$element, 'ProcessRowType', $expected];
    }

    public function functionImportInlinedTypeData()
    {
        $schema = m::mock(ISchemaElement::class . ', ' . IEntityType::class);
        $schema->shouldReceive('FullName')->andReturn('FullName');
        $schema->shouldReceive('getNamespace')->andReturn('namespace');

        $eType = m::mock(IEntityReferenceType::class)->makePartial();
        $eType->shouldReceive('getEntityType')->andReturn($schema);

        $entRef = m::mock(IEntityReferenceTypeReference::class)->makePartial();
        $entRef->shouldReceive('EntityReferenceDefinition')->andReturn($eType);

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


        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<FunctionImport IsBindable="true" IsComposable="true" Name="Name" ReturnType="Ref(FullName)">' . PHP_EOL;
        $expected .= '<Documentation/>' . PHP_EOL . '</FunctionImport>';
        return [$element, 'ProcessFunctionImport', $expected];
    }

    public function valueAnnotationData()
    {
        $expr = m::mock(IExpression::class);
        $expr->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());

        $term = m::mock(ITerm::class);
        $term->shouldReceive('FullName')->andReturn('FullName');
        $term->shouldReceive('getNamespace')->andReturn('namespace');

        $element = m::mock(IValueAnnotation::class)->makePartial();
        $element->shouldReceive('getValue')->andReturn($expr);
        $element->shouldReceive('getTerm')->andReturn($term);
        $element->shouldReceive('getQualifier')->andReturn(null);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<ValueAnnotation Term="FullName">' . PHP_EOL;
        $expected .= '<Documentation/>' . PHP_EOL . '</ValueAnnotation>';

        return [$element, 'ProcessValueAnnotation', $expected];
    }

    public function typeAnnotationData()
    {
        $expr = m::mock(IExpression::class);
        $expr->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());

        $term = m::mock(ITerm::class);
        $term->shouldReceive('FullName')->andReturn('FullName');
        $term->shouldReceive('getNamespace')->andReturn('namespace');

        $element = m::mock(ITypeAnnotation::class)->makePartial();
        $element->shouldReceive('getPropertyValueBindings')->andReturn([]);
        $element->shouldReceive('getValue')->andReturn($expr);
        $element->shouldReceive('getTerm')->andReturn($term);
        $element->shouldReceive('getQualifier')->andReturn(null);


        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<TypeAnnotation Term="FullName">' . PHP_EOL;
        $expected .= '<Documentation/>' . PHP_EOL . '</TypeAnnotation>';

        return [$element, 'ProcessTypeAnnotation', $expected];
    }

    public function propertyValueBindingData()
    {
        $expr = m::mock(IExpression::class);
        $expr->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());

        $prop = m::mock(IProperty::class);
        $prop->shouldReceive('getName')->andReturn('Name');

        $element = m::mock(IPropertyValueBinding::class)->makePartial();
        $element->shouldReceive('getValue')->andReturn($expr);
        $element->shouldReceive('getBoundProperty')->andReturn($prop);


        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<PropertyValue Property="Name">' . PHP_EOL;
        $expected .= '<Documentation/>' . PHP_EOL . '</PropertyValue>';

        return [$element, 'ProcessPropertyValueBinding', $expected];
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

        $reflec = new ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessValueTerm');
        $method->setAccessible(true);

        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Invalid type kind: \'null\'');

        $method->invoke($foo, $element);
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

        $reflec = new ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessFunctionImport');
        $method->setAccessible(true);

        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The function import \'FullName/Name\' could not be serialized because its return type cannot be represented inline.');

        $method->invoke($foo, $element);
    }

    /**
     * @param $model
     * @param $thisSet
     * @param $thisProp
     * @param $thatSet
     * @param $thatProp
     * @param $expected
     * @dataProvider sharesAssociationSetProvider
     */
    public function testSharesAssociationSet($model, $thisSet, $thisProp, $thatSet, $thatProp, $expected)
    {
        $writer  = $this->getWriter();
        $version = Version::v3();
        $foo     = new EdmModelCsdlSerializationVisitor($model, $writer, $version);
        try {
            $reflec = new ReflectionClass($foo);
            $method = $reflec->getMethod('SharesAssociationSet');
        } catch (ReflectionException $exception) {
            $this->fail($exception->getMessage());
        }
        $method->setAccessible(true);

        $actual = $method->invoke($foo, $thisSet, $thisProp, $thatSet, $thatProp);
        $this->assertEquals($expected, $actual);
    }


    public function sharesAssociationSetProvider()
    {
        $thisSet  = m::mock(IEntitySet::class);
        $thisProp = m::mock(INavigationProperty::class);
        $thatSet  = m::mock(IEntitySet::class);
        $thatProp = m::mock(INavigationProperty::class);

        $nuSet       = m::mock(IEntitySet::class);
        $setNamedFoo = (function () {
            $thisSet  = m::mock(IEntitySet::class);
            $thisSet->shouldReceive('getName')->andReturn('foo')->times(1);
            return $thisSet;
        })->bindTo($this);
        ;

        $setNamedFooNavTarget = (function ($nuSet = null) use ($setNamedFoo) {
            $thisSet  = $setNamedFoo();
            $thisSet->shouldReceive('findNavigationTarget')->andReturn($nuSet)->once();
            return $thisSet;
        })->bindTo($this);
        ;



        $fullnameModel = (function () {
            $m = $this->getModel();
            $m->shouldReceive('GetAssociationSetName')->andReturn('foo')->times(2);
            $m->shouldReceive('GetAssociationFullName')->andReturn('foo', 'bar')->times(2);
            return $m;
        })->bindTo($this);

        $differentModel = (function () {
            $m = $this->getModel();
            $m->shouldReceive('GetAssociationSetName')->andReturn('foo')->times(2);
            $m->shouldReceive('GetAssociationFullName')->andReturn('bar')->times(2);
            $m->shouldReceive('GetAssociationEndName')->andReturn('foo', 'bar')->times(2);
            return $m;
        })->bindTo($this);

        $nullModelAndMismatch = (function ($endName = ['foo'], $endTimes = 2) {
            $model = $this->getModel();
            $model->shouldReceive('GetAssociationSetName')->andReturn('foo')->times(2);
            $model->shouldReceive('GetAssociationFullName')->andReturn('bar')->times(2);
            $model->shouldReceive('GetAssociationEndName')->andReturn(...$endName)->times($endTimes);
            $model->shouldReceive('GetAssociationSetAnnotations')->andReturn(null)->times(2);
            return $model;
        })->bindTo($this);

        $propPartnerSelf = (function () {
            $associationOtherSetsNotNullEndNamesDifferentThisProp = m::mock(INavigationProperty::class);
            $associationOtherSetsNotNullEndNamesDifferentThisProp->shouldReceive('getPartner')->andReturn($associationOtherSetsNotNullEndNamesDifferentThisProp);
            return $associationOtherSetsNotNullEndNamesDifferentThisProp;
        })->bindTo($this);

        $associationSetNameDifferentModel = $this->getModel();
        $associationSetNameDifferentModel->shouldReceive('GetAssociationSetName')->andReturn('foo', 'bar')->times(2);


        return[
            'Identity' =>
                [
                    /** $model */$this->getModel(),
                    /** $thisSet */$thisSet,
                    /** $thisProp */$thisProp,
                    /** $thatSet */$thisSet,
                    /** $thatProp */$thisProp,
                    /** $expected */true
                ],
            'Association Set Name Different Model' =>
                [
                    /** $model */$associationSetNameDifferentModel,
                    /** $thisSet */$thisSet,
                    /** $thisProp */$thisProp,
                    /** $thatSet */$thatSet,
                    /** $thatProp */$thatProp,
                    /** $expected */false
                ],
            'Association Set Name Different' =>
                [
                    /** $model */$fullnameModel(),
                    /** $thisSet */$thisSet,
                    /** $thisProp */$thisProp,
                    /** $thatSet */$thatSet,
                    /** $thatProp */$thatProp,
                    /** $expected */false
                ],
            'Association Full Name Different Model' =>
                [
                    /** $model */$fullnameModel(),
                    /** $thisSet */$thisSet,
                    /** $thisProp */$thisProp,
                    /** $thatSet */$thatSet,
                    /** $thatProp */$thatProp,
                    /** $expected */false
                ],
            'Association End Name Different' =>
                [
                    /** $model */$differentModel(),
                    /** $thisSet */$thisSet,
                    /** $thisProp */$thisProp,
                    /** $thatSet */$thatSet,
                    /** $thatProp */$thatProp,
                    /** $expected */false
                ],
            'Association End Name Same Set Name Different' =>
                [
                    /** $model */$differentModel(),
                    /** $thisSet */$setNamedFoo(),
                    /** $thisProp */$thisProp,
                    /** $thatSet */$setNamedFoo(),
                    /** $thatProp */$thatProp,
                    /** $expected */false
                ],
            'Association Both Other Sets Null' =>
                [
                    /** $model */$nullModelAndMismatch(),
                    /** $thisSet */$setNamedFooNavTarget(),
                    /** $thisProp */$thisProp,
                    /** $thatSet */$setNamedFooNavTarget(),
                    /** $thatProp */$thatProp,
                    /** $expected */true
                ],
            'Association Other Sets Nullity Mismatch' =>
                [
                    /** $model */$nullModelAndMismatch(),
                    /** $thisSet */$setNamedFooNavTarget($nuSet),
                    /** $thisProp */$thisProp,
                    /** $thatSet */$setNamedFooNavTarget(null),
                    /** $thatProp */$thatProp,
                    /** $expected */false
                ],
            'Association Other Sets Nullity Mismatch Reverse' =>
                [
                    /** $model */$nullModelAndMismatch(),
                    /** $thisSet */$setNamedFooNavTarget(null),
                    /** $thisProp */$thisProp,
                    /** $thatSet */$setNamedFooNavTarget($nuSet),
                    /** $thatProp */$thatProp,
                    /** $expected */false
                ],
            'Association Other Sets Not Null End Names Different' =>
                [
                    /** $model */$nullModelAndMismatch(['foobar', 'foobar', 'foo', 'bar'], 4),
                    /** $thisSet */$setNamedFooNavTarget($nuSet),
                    /** $thisProp */$propPartnerSelf(),
                    /** $thatSet */$setNamedFooNavTarget($nuSet),
                    /** $thatProp */$propPartnerSelf(),
                    /** $expected */false
                ],
        ];
    }

    public function testSharesReferentialConstraintEndCountMismatch()
    {
        $model   = $this->getModel();
        $writer  = $this->getWriter();
        $version = Version::v3();
        $foo     = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new ReflectionClass($foo);
        $method = $reflec->getMethod('SharesReferentialConstraintEnd');
        $method->setAccessible(true);

        $theseProp = [];

        $struct2  = m::mock(IStructuralProperty::class);
        $thatProp = [$struct2];

        $expected = false;
        $actual   = $method->invoke($foo, $theseProp, $thatProp);
        $this->assertEquals($expected, $actual);
    }

    public function testSharesReferentialConstraintEndNameMismatch()
    {
        $model   = $this->getModel();
        $writer  = $this->getWriter();
        $version = Version::v3();
        $foo     = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new ReflectionClass($foo);
        $method = $reflec->getMethod('SharesReferentialConstraintEnd');
        $method->setAccessible(true);

        $struct1 = m::mock(IStructuralProperty::class);
        $struct1->shouldReceive('getName')->andReturn('foo');
        $theseProp = [$struct1];

        $struct2 = m::mock(IStructuralProperty::class);
        $struct2->shouldReceive('getName')->andReturn('bar');
        $thatProp = [$struct2];

        $expected = false;
        $actual   = $method->invoke($foo, $theseProp, $thatProp);
        $this->assertEquals($expected, $actual);
    }

    public function testSharesReferentialConstraintEndNameMatch()
    {
        $model   = $this->getModel();
        $writer  = $this->getWriter();
        $version = Version::v3();
        $foo     = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new ReflectionClass($foo);
        $method = $reflec->getMethod('SharesReferentialConstraintEnd');
        $method->setAccessible(true);

        $struct1 = m::mock(IStructuralProperty::class);
        $struct1->shouldReceive('getName')->andReturn('foo');
        $theseProp = [$struct1];

        $struct2 = m::mock(IStructuralProperty::class);
        $struct2->shouldReceive('getName')->andReturn('foo');
        $thatProp = [$struct2];

        $expected = true;
        $actual   = $method->invoke($foo, $theseProp, $thatProp);
        $this->assertEquals($expected, $actual);
    }

    public function testVisitElementVocabularyAnnotationsBadKind()
    {
        $model   = $this->getModel();
        $writer  = $this->getWriter();
        $version = Version::v3();
        $foo     = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new ReflectionClass($foo);
        $method = $reflec->getMethod('VisitElementVocabularyAnnotations');
        $method->setAccessible(true);

        $termKind = m::mock(TermKind::class);
        $termKind->shouldReceive('getKey')->andReturn(null);

        $vocab = m::mock(IVocabularyAnnotation::class);
        $vocab->shouldReceive('getTerm->getTermKind')->andReturn($termKind);


        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Invalid term kind: \'\'');

        $method->invoke($foo, [$vocab]);
    }

    public function testVisitElementVocabularyAnnotations()
    {
        $model   = $this->getModel();
        $writer  = $this->getWriter();
        $version = Version::v3();
        $foo     = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new ReflectionClass($foo);
        $method = $reflec->getMethod('VisitElementVocabularyAnnotations');
        $method->setAccessible(true);

        $term = m::mock(ITerm::class);
        $term->shouldReceive('getTermKind')->andReturn(TermKind::None());
        $term->shouldReceive('getNamespace')->andReturn('namespace');
        $term->shouldReceive('FullName')->andReturn('FullName');
        $vocab = m::mock(IVocabularyAnnotation::class);
        $vocab->shouldReceive('getTerm')->andReturn($term);

        $term1 = m::mock(ITerm::class);
        $term1->shouldReceive('getTermKind')->andReturn(TermKind::Type());
        $term1->shouldReceive('getNamespace')->andReturn('namespace');
        $term1->shouldReceive('FullName')->andReturn('FullName');
        $vocab1 = m::mock(IVocabularyAnnotation::class . ', ' . ITypeAnnotation::class);
        $vocab1->shouldReceive('getTerm')->andReturn($term1);
        $vocab1->shouldReceive('getQualifier')->andReturn('qual');
        $vocab1->shouldReceive('getPropertyValueBindings')->andReturn([]);

        $expr = m::mock(IExpression::class);
        $expr->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());
        $term2 = m::mock(ITerm::class);
        $term2->shouldReceive('getTermKind')->andReturn(TermKind::Value());
        $term2->shouldReceive('getNamespace')->andReturn('namespace');
        $term2->shouldReceive('FullName')->andReturn('FullName');
        $vocab2 = m::mock(IVocabularyAnnotation::class . ', ' . IValueAnnotation::class);
        $vocab2->shouldReceive('getTerm')->andReturn($term2);
        $vocab2->shouldReceive('getValue')->andReturn($expr);
        $vocab2->shouldReceive('getQualifier')->andReturn('qual');

        $method->invoke($foo, [$vocab, $vocab1, $vocab2]);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<TypeAnnotation Term="FullName" Qualifier="qual">' . PHP_EOL;
        $expected .= '    <Documentation/>' . PHP_EOL . '</TypeAnnotation>' . PHP_EOL;
        $expected .= '<ValueAnnotation Term="FullName" Qualifier="qual">' . PHP_EOL;
        $expected .= '    <Documentation/>' . PHP_EOL . '</ValueAnnotation>' . PHP_EOL;
        $writer->endDocument();
        $actual = $writer->outputMemory(true);
        $this->assertEquals(self::normalizeLineEndings($expected), self::normalizeLineEndings($actual));
    }

    public function testProcessAnnotationsNameMismatch()
    {
        $model   = $this->getModel();
        $writer  = $this->getWriter();
        $version = Version::v3();
        $foo     = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessAnnotations');
        $method->setAccessible(true);

        $expr = m::mock(IExpression::class);
        $expr->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());

        $annotate = m::mock(IDirectValueAnnotation::class);
        $annotate->shouldReceive('getNamespaceUri')->andReturn(EdmConstants::DocumentationUri);
        $annotate->shouldReceive('getValue')->andReturn($expr);
        $annotate->shouldReceive('getName')->andReturn('name');

        $method->invoke($foo, [$annotate]);

        $expected = '<?xml version="1.0"?>' . PHP_EOL;
        $writer->endDocument();
        $actual = $writer->outputMemory(true);
        $this->assertEquals(self::normalizeLineEndings($expected), self::normalizeLineEndings($actual));
    }

    public function testProcessAnnotationsNameMatch()
    {
        $model   = $this->getModel();
        $writer  = $this->getWriter();
        $version = Version::v3();
        $foo     = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessAnnotations');
        $method->setAccessible(true);

        $expr = m::mock(IExpression::class . ', ' . IDocumentation::class);
        $expr->shouldReceive('getExpressionKind')->andReturn(ExpressionKind::None());
        $expr->shouldReceive('getSummary')->andReturn(null);
        $expr->shouldReceive('getDescription')->andReturn(null);

        $annotate = m::mock(IDirectValueAnnotation::class);
        $annotate->shouldReceive('getNamespaceUri')->andReturn(EdmConstants::DocumentationUri);
        $annotate->shouldReceive('getValue')->andReturn($expr);
        $annotate->shouldReceive('getName')->andReturn(EdmConstants::DocumentationAnnotation);

        $method->invoke($foo, [$annotate]);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<Documentation/>' . PHP_EOL;
        $writer->endDocument();
        $actual = $writer->outputMemory(true);
        $this->assertEquals(self::normalizeLineEndings($expected), self::normalizeLineEndings($actual));
    }

    public function testProcessReferentialConstraintWithDependentProperties()
    {
        $model = $this->getModel();
        $model->shouldReceive('GetAssociationEndName')->andReturn('endName');

        $writer  = $this->getWriter();
        $version = Version::v3();
        $foo     = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessReferentialConstraint');
        $method->setAccessible(true);

        $keyStruct = m::mock(IStructuralProperty::class);
        $keyStruct->shouldReceive('getName')->andReturn('id');
        $declareType = m::mock(IEntityType::class);
        $declareType->shouldReceive('Key')->andReturn([$keyStruct]);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('getDependentProperties')->andReturn([]);
        $element->shouldReceive('getPartner')->andReturn($element);
        $element->shouldReceive('getDeclaringType')->andReturn($declareType);
        $annotations = [];

        $method->invoke($foo, $element, $annotations);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<ReferentialConstraint>' . PHP_EOL;
        $expected .= '    <Principal Role="endName">' . PHP_EOL . '        <PropertyRef Name="id"/>' . PHP_EOL;
        $expected .= '    </Principal>' . PHP_EOL . '    <Dependent Role="endName"/>' . PHP_EOL;
        $expected .= '</ReferentialConstraint>' . PHP_EOL;
        $writer->endDocument();
        $actual = $writer->outputMemory(true);
        $this->assertEquals(self::normalizeLineEndings($expected), self::normalizeLineEndings($actual));
    }

    public function testProcessPropertyConstructor()
    {
        $model = $this->getModel();

        $writer  = $this->getWriter();
        $version = Version::v3();
        $foo     = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $reflec = new ReflectionClass($foo);
        $method = $reflec->getMethod('ProcessPropertyConstructor');
        $method->setAccessible(true);

        $kind = ExpressionKind::FunctionReference();

        $func = m::mock(IFunction::class);
        $func->shouldReceive('getNamespace')->andReturn('theNamespaceWithNoName');
        $func->shouldReceive('FullName')->andReturn('TNMN');

        $expr = m::mock(IExpression::class . ', ' . IFunctionReferenceExpression::class);
        $expr->shouldReceive('getExpressionKind')->andReturn($kind);
        $expr->shouldReceive('getReferencedFunction')->andReturn($func);

        $element = m::mock(IPropertyConstructor::class);
        $element->shouldReceive('getValue')->andReturn($expr);
        $element->shouldReceive('getName')->andReturn('name');

        $method->invoke($foo, $element);

        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<PropertyValue Property="name">' . PHP_EOL;
        $expected .= '    <Documentation/>' . PHP_EOL . '    <FunctionReference Name="TNMN"/>' . PHP_EOL;
        $expected .= '</PropertyValue>' . PHP_EOL;
        $writer->endDocument();
        $actual = $writer->outputMemory(true);
        $this->assertEquals(self::normalizeLineEndings($expected), self::normalizeLineEndings($actual));
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
     * @return IModel| m\Mock
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
