<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 4/07/20
 * Time: 12:11 AM.
 */

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\IVocabularyAnnotation;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IVocabularyAnnotation\VocabularyAnnotationInaccessibleTarget;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionBase;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class VocabularyAnnotationInaccessibleTargetTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testInvokeEntityContainerGoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $model = m::mock(IModel::class);
        $model->shouldReceive('FindEntityContainer')->andReturn(null);

        $context = $this->getContext($model);

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . IEntityContainer::class);
        $target->shouldReceive('getName')->andReturn('Name');
        $target->shouldReceive('FullName')->andReturn('FullName');

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];

        $expected = 'The target \'FullName\' could not be found from the model being validated.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokeEntityContainerNoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $cont = m::mock(IEntityContainer::class);

        $model = m::mock(IModel::class);
        $model->shouldReceive('FindEntityContainer')->andReturn($cont);

        $context = $this->getContext($model);

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . IEntityContainer::class);
        $target->shouldReceive('getName')->andReturn('Name');
        $target->shouldReceive('FullName')->andReturn('FullName');

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(0, count($errors));
    }

    public function testInvokeEntitySetNoContainerGoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $model = m::mock(IModel::class);

        $context = $this->getContext($model);

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . IEntitySet::class);
        $target->shouldReceive('getContainer')->andReturn(null)->once();
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];

        $expected = 'The target \'/Name\' could not be found from the model being validated.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }

    public function testInvokeEntitySetCantFindContainerGoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $model = m::mock(IModel::class);

        $context = $this->getContext($model);

        $cont = m::mock(IEntityContainer::class)->makePartial();
        $cont->shouldReceive('FullName')->andReturn('TNMN');
        $cont->shouldReceive('FindEntitySet')->andReturn(null)->once();

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . IEntitySet::class);
        $target->shouldReceive('getContainer')->andReturn($cont)->once();
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];

        $expected = 'The target \'TNMN/Name\' could not be found from the model being validated.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }

    public function testInvokeEntitySetCanFindContainerNoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $model = m::mock(IModel::class);

        $context = $this->getContext($model);

        $eSet = m::mock(IEntitySet::class);

        $cont = m::mock(IEntityContainer::class)->makePartial();
        $cont->shouldReceive('FullName')->andReturn('TNMN');
        $cont->shouldReceive('FindEntitySet')->andReturn($eSet)->once();

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . IEntitySet::class);
        $target->shouldReceive('getContainer')->andReturn($cont)->once();
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(0, count($errors));
    }

    public function testInvokeSchemaTypeCantFindGoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $model = m::mock(IModel::class);
        $model->shouldReceive('FindType')->andReturn(null)->once();

        $context = $this->getContext($model);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . ISchemaType::class);
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];

        $expected = 'The target \'FullName\' could not be found from the model being validated.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }

    public function testInvokeSchemaTypeCanFindNoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $type = m::mock(IType::class . ', ' . ISchemaType::class);

        $model = m::mock(IModel::class);
        $model->shouldReceive('FindType')->andReturn($type)->once();

        $context = $this->getContext($model);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . ISchemaType::class);
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(0, count($errors));
    }

    public function testInvokeTermCantFindGoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $model = m::mock(IModel::class);
        $model->shouldReceive('FindValueTerm')->andReturn(null)->once();

        $context = $this->getContext($model);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . ITerm::class);
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];

        $expected = 'The target \'FullName\' could not be found from the model being validated.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }

    public function testInvokeTermCanFindNoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $type = m::mock(IValueTerm::class);

        $model = m::mock(IModel::class);
        $model->shouldReceive('FindValueTerm')->andReturn($type)->once();

        $context = $this->getContext($model);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . ITerm::class);
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(0, count($errors));
    }

    public function testInvokeFunctionCantFindGoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $model = m::mock(IModel::class);
        $model->shouldReceive('FindFunctions')->andReturn([])->once();

        $context = $this->getContext($model);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . IFunction::class);
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');
        $target->shouldReceive('getParameters')->andReturn([])->once();
        $target->shouldReceive('getNamespace')->andReturn('Namespace');

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];

        $expected = 'The target \'Namespace.Name()\' could not be found from the model being validated.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }

    public function testInvokeFunctionCanFindNoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $type = m::mock(IFunction::class);
        $type->shouldReceive('getParameters')->andReturn([])->once();

        $model = m::mock(IModel::class);
        $model->shouldReceive('FindFunctions')->andReturn([$type])->once();

        $context = $this->getContext($model);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . IFunction::class);
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(0, count($errors));
    }

    public function testInvokeFunctionImportCantFindGoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $model = m::mock(IModel::class);

        $context = $this->getContext($model);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $cont = m::mock(IEntityContainer::class);
        $cont->shouldReceive('FullName')->andReturn('TNMN');
        $cont->shouldReceive('findFunctionImports')->andReturn([])->once();

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . IFunctionImport::class);
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');
        $target->shouldReceive('getContainer')->andReturn($cont)->atLeast(1);
        $target->shouldReceive('getParameters')->andReturn([])->once();

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);


        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];

        $expected = 'The target \'TNMN/Name()\' could not be found from the model being validated.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }

    public function testInvokeFunctionImportCanFindNoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $type = m::mock(IValueTerm::class);

        $model = m::mock(IModel::class);
        $model->shouldReceive('findFunctionImports')->andReturn([$type])->once();

        $context = $this->getContext($model);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . IFunctionImport::class);
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');
        $target->shouldReceive('getContainer->findFunctionImports')->andReturn([$type])->once();

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(0, count($errors));
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokePropertyNoModelTypeGoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $decType = m::mock(ISchemaType::class . ', ' . IStructuredType::class);
        $decType->shouldReceive('FullName')->andReturn('TNMN');

        $model = m::mock(IModel::class);
        $model->shouldReceive('FindType')->andReturn(null)->once();

        $context = $this->getContext($model);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . IProperty::class);
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');
        $target->shouldReceive('getDeclaringType')->andReturn($decType);

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];

        $expected = 'The target \'TNMN/Name\' could not be found from the model being validated.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokePropertyCantFindGoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $decType = m::mock(ISchemaType::class . ', ' . IStructuredType::class);
        $decType->shouldReceive('FullName')->andReturn('TNMN');

        $iType = m::mock(IType::class . ', ' . ISchemaType::class);
        $iType->shouldReceive('FindProperty')->andReturn(null);

        $model = m::mock(IModel::class);
        $model->shouldReceive('FindType')->andReturn($iType)->once();

        $context = $this->getContext($model);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . IProperty::class);
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');
        $target->shouldReceive('getDeclaringType')->andReturn($decType);

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];

        $expected = 'The target \'TNMN/Name\' could not be found from the model being validated.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokePropertyCanFindNoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $decType = m::mock(ISchemaType::class . ', ' . IStructuredType::class);
        $decType->shouldReceive('FullName')->andReturn('TNMN');

        $iProp = m::mock(IProperty::class);

        $iType = m::mock(IType::class . ', ' . ISchemaType::class . ', ' . IStructuredType::class);
        $iType->shouldReceive('findProperty')->andReturn($iProp)->once();

        $model = m::mock(IModel::class);
        $model->shouldReceive('FindType')->andReturn($iType)->once();

        $context = $this->getContext($model);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . IProperty::class);
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');
        $target->shouldReceive('getDeclaringType')->andReturn($decType);

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(0, count($errors));
    }

    public function testInvokeFunctionParameterWithBadDeclaringFunctionType()
    {
        $loc = m::mock(ILocation::class);

        $model = m::mock(IModel::class);

        $context = $this->getContext($model);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $funcImport = m::mock(IFunctionBase::class);

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . IFunctionParameter::class);
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');
        $target->shouldReceive('getDeclaringFunction')->andReturn($funcImport);

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];

        $expected = 'The target \'\' could not be found from the model being validated.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }

    public function testInvokeFunctionParameterWithDeclaringFunctionTypeFunctionNoParms()
    {
        $loc = m::mock(ILocation::class);

        $model = m::mock(IModel::class);
        $model->shouldReceive('FindFunctions')->andReturn([]);

        $context = $this->getContext($model);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $funcImport = m::mock(IFunction::class);
        $funcImport->shouldReceive('FullName')->andReturn('FullName');
        $funcImport->shouldReceive('getParameters')->andReturn([]);
        $funcImport->shouldReceive('getNamespace')->andReturn('TNMN');
        $funcImport->shouldReceive('getName')->andReturn('FuncName');

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . IFunctionParameter::class);
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');
        $target->shouldReceive('getDeclaringFunction')->andReturn($funcImport);

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];

        $expected = 'The target \'TNMN.FuncName()/Name\' could not be found from the model being validated.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }

    public function testInvokeFunctionParameterWithDeclaringFunctionTypeFunctionOneParmsCantFindGoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $findFunc = m::mock(IFunction::class);
        $findFunc->shouldReceive('findParameter')->andReturn(null);

        $model = m::mock(IModel::class);
        $model->shouldReceive('FindFunctions')->andReturn([$findFunc]);

        $context = $this->getContext($model);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $funcImport = m::mock(IFunction::class);
        $funcImport->shouldReceive('FullName')->andReturn('FullName');
        $funcImport->shouldReceive('getParameters')->andReturn([]);
        $funcImport->shouldReceive('getNamespace')->andReturn('TNMN');
        $funcImport->shouldReceive('getName')->andReturn('FuncName');

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . IFunctionParameter::class);
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');
        $target->shouldReceive('getDeclaringFunction')->andReturn($funcImport);

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];

        $expected = 'The target \'TNMN.FuncName()/Name\' could not be found from the model being validated.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }

    public function testInvokeFunctionParameterWithDeclaringFunctionTypeFunctionOneParmsCanFindNoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $findParm = m::mock(IFunctionParameter::class);

        $findFunc = m::mock(IFunction::class);
        $findFunc->shouldReceive('findParameter')->andReturn($findParm);

        $model = m::mock(IModel::class);
        $model->shouldReceive('FindFunctions')->andReturn([$findFunc]);

        $context = $this->getContext($model);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $funcImport = m::mock(IFunction::class);
        $funcImport->shouldReceive('FullName')->andReturn('FullName');
        $funcImport->shouldReceive('getParameters')->andReturn([]);
        $funcImport->shouldReceive('getNamespace')->andReturn('TNMN');
        $funcImport->shouldReceive('getName')->andReturn('FuncName');

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . IFunctionParameter::class);
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');
        $target->shouldReceive('getDeclaringFunction')->andReturn($funcImport);

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(0, count($errors));
    }

    public function testInvokeFunctionParameterWithDeclaringFunctionTypeFunctionImportNoParmsGoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $model = m::mock(IModel::class);
        $model->shouldReceive('FindFunctions')->andReturn([]);

        $container = m::mock(IEntityContainer::class);
        $container->shouldReceive('findFunctionImports')->andReturn([])->atLeast(1);
        $container->shouldReceive('FullName')->andReturn('Container');

        $context = $this->getContext($model);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $funcImport = m::mock(IFunctionImport::class);
        $funcImport->shouldReceive('FullName')->andReturn('FullName');
        $funcImport->shouldReceive('getParameters')->andReturn([]);
        $funcImport->shouldReceive('getNamespace')->andReturn('TNMN');
        $funcImport->shouldReceive('getName')->andReturn('FuncName');
        $funcImport->shouldReceive('getContainer')->andReturn($container)->once();

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . IFunctionParameter::class);
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');
        $target->shouldReceive('getDeclaringFunction')->andReturn($funcImport);

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];

        $expected = 'The target \'Container/FuncName()/Name\' could not be found from the model being validated.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }

    public function testInvokeFunctionParameterWithDeclaringFunctionTypeFunctionImportCantFindGoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $model = m::mock(IModel::class);
        $model->shouldReceive('FindFunctions')->andReturn([]);

        $funcImp = m::mock(IFunctionImport::class);
        $funcImp->shouldReceive('findParameter')->andReturn(null)->atLeast(1);

        $container = m::mock(IEntityContainer::class);
        $container->shouldReceive('findFunctionImports')->andReturn([$funcImp])->atLeast(1);
        $container->shouldReceive('FullName')->andReturn('Container');

        $context = $this->getContext($model);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $funcImport = m::mock(IFunctionImport::class);
        $funcImport->shouldReceive('FullName')->andReturn('FullName');
        $funcImport->shouldReceive('getParameters')->andReturn([]);
        $funcImport->shouldReceive('getNamespace')->andReturn('TNMN');
        $funcImport->shouldReceive('getName')->andReturn('FuncName');
        $funcImport->shouldReceive('getContainer')->andReturn($container)->once();

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . IFunctionParameter::class);
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');
        $target->shouldReceive('getDeclaringFunction')->andReturn($funcImport);

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];

        $expected = 'The target \'Container/FuncName()/Name\' could not be found from the model being validated.';
        $actual   = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }

    public function testInvokeFunctionParameterWithDeclaringFunctionTypeFunctionImportCanFindNoKaboom()
    {
        $loc = m::mock(ILocation::class);

        $model = m::mock(IModel::class);
        $model->shouldReceive('FindFunctions')->andReturn([]);

        $funcParm = m::mock(IFunctionParameter::class);

        $funcImp = m::mock(IFunctionImport::class);
        $funcImp->shouldReceive('findParameter')->andReturn($funcParm)->atLeast(1);

        $container = m::mock(IEntityContainer::class);
        $container->shouldReceive('findFunctionImports')->andReturn([$funcImp])->atLeast(1);
        $container->shouldReceive('FullName')->andReturn('Container');

        $context = $this->getContext($model);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $funcImport = m::mock(IFunctionImport::class);
        $funcImport->shouldReceive('FullName')->andReturn('FullName');
        $funcImport->shouldReceive('getParameters')->andReturn([]);
        $funcImport->shouldReceive('getNamespace')->andReturn('TNMN');
        $funcImport->shouldReceive('getName')->andReturn('FuncName');
        $funcImport->shouldReceive('getContainer')->andReturn($container)->once();

        $target = m::mock(IVocabularyAnnotatable::class . ', ' . IFunctionParameter::class);
        $target->shouldReceive('FullName')->andReturn('FullName');
        $target->shouldReceive('getName')->andReturn('Name');
        $target->shouldReceive('getDeclaringFunction')->andReturn($funcImport);

        $annotation = m::mock(IEdmElement::class . ', ' . IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(0, count($errors));
    }

    /**
     * @param $model
     * @throws \ReflectionException
     * @return ValidationContext
     */
    protected function getContext($model): ValidationContext
    {
        $context = new ValidationContext(
            $model,
            function (IEdmElement $one): bool {
                return false;
            }
        );
        return $context;
    }
}
