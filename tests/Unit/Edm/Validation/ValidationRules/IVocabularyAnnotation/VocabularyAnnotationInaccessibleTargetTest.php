<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 4/07/20
 * Time: 12:11 AM
 */

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\IVocabularyAnnotation;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IVocabularyAnnotation\VocabularyAnnotationInaccessibleTarget;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
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

        $annotation = m::mock(IEdmElement::class . ', '. IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];

        $expected = 'The target \'FullName\' could not be found from the model being validated.';
        $actual = $error->getErrorMessage();
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

        $annotation = m::mock(IEdmElement::class . ', '. IVocabularyAnnotation::class);
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

        $annotation = m::mock(IEdmElement::class . ', '. IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];

        $expected = 'The target \'/Name\' could not be found from the model being validated.';
        $actual = $error->getErrorMessage();
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

        $annotation = m::mock(IEdmElement::class . ', '. IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];

        $expected = 'The target \'TNMN/Name\' could not be found from the model being validated.';
        $actual = $error->getErrorMessage();
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

        $annotation = m::mock(IEdmElement::class . ', '. IVocabularyAnnotation::class);
        $annotation->shouldReceive('getTarget')->andReturn($target);
        $annotation->shouldReceive('Location')->andReturn($loc);

        $foo = new VocabularyAnnotationInaccessibleTarget();

        $foo->__invoke($context, $annotation);

        $errors = $context->getErrors();
        $this->assertEquals(0, count($errors));
    }

    /**
     * @param $model
     * @return ValidationContext
     * @throws \ReflectionException
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
