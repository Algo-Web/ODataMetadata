<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 7/07/20
 * Time: 11:04 PM.
 */

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Library\Annotations;

use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotationBinding;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Library\Annotations\EdmDirectValueAnnotationsManager;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class EdmDirectValueAnnotationsManagerTest extends TestCase
{
    public function testSetGetAnnotationValueRoundTrip()
    {
        $element = m::mock(IEdmElement::class);

        $foo = new EdmDirectValueAnnotationsManager();

        $expected = 42;
        $inter    = $foo->setAnnotationValue($element, 'namespace', 'name', $expected);
        $actual   = $foo->getAnnotationValue($element, 'namespace', 'name');
        $this->assertEquals($expected, $actual);
    }

    public function testSetGetValueAnnotationsRoundTrip()
    {
        $element = m::mock(IEdmElement::class);
        $binding = m::mock(IDirectValueAnnotationBinding::class);
        $binding->shouldReceive('getNamespaceUri')->andReturn('namespace');
        $binding->shouldReceive('getName')->andReturn('name');
        $binding->shouldReceive('getValue')->andReturn(42);
        $binding->shouldReceive('getElement')->andReturn($element);

        $foo = new EdmDirectValueAnnotationsManager();

        $expected = [42];

        $foo->setAnnotationValues([$binding]);
        $actual = $foo->getAnnotationValues([$binding]);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws \ReflectionException
     */
    public function testIsDeadOnBlankArray()
    {
        $reflec = new \ReflectionClass(EdmDirectValueAnnotationsManager::class);

        $method = $reflec->getMethod('isDead');
        $method->setAccessible(true);

        $namespace = 'namespace';
        $name      = 'name';
        $annotate  = [];

        $expected = false;
        $actual   = $method->invoke(null, $namespace, $name, $annotate);
        $this->assertEquals($expected, $actual);
    }

    public function testIsDeadOnNonEmptyArrayMatches()
    {
        $reflec = new \ReflectionClass(EdmDirectValueAnnotationsManager::class);

        $method = $reflec->getMethod('isDead');
        $method->setAccessible(true);

        $namespace = 'namespace';
        $name      = 'name';

        $element = m::mock(IDirectValueAnnotation::class);
        $element->shouldReceive('getNamespaceUri')->andReturn('namespace');
        $element->shouldReceive('getName')->andReturn('name');
        $annotate = [$element];

        $expected = true;
        $actual   = $method->invoke(null, $namespace, $name, $annotate);
        $this->assertEquals($expected, $actual);
    }

    public function testIsDeadOnNonEmptyArrayNoMatches()
    {
        $reflec = new \ReflectionClass(EdmDirectValueAnnotationsManager::class);

        $method = $reflec->getMethod('isDead');
        $method->setAccessible(true);

        $namespace = 'namespace';
        $name      = 'name';

        $element = m::mock(IDirectValueAnnotation::class);
        $element->shouldReceive('getNamespaceUri')->andReturn('name');
        $element->shouldReceive('getName')->andReturn('name');
        $annotate = [$element];

        $expected = false;
        $actual   = $method->invoke(null, $namespace, $name, $annotate);
        $this->assertEquals($expected, $actual);
    }

    public function testRemoveTransientAnnotationOnNull()
    {
        $reflec = new \ReflectionClass(EdmDirectValueAnnotationsManager::class);

        $method = $reflec->getMethod('removeTransientAnnotation');
        $method->setAccessible(true);

        $namespace = 'namespace';
        $name      = 'name';

        $annotate = null;

        $actual = $method->invokeArgs(null, [&$annotate, $namespace, $name]);
        $this->assertNull($annotate);
    }

    public function testRemoveTransientAnnotationOnEmpty()
    {
        $reflec = new \ReflectionClass(EdmDirectValueAnnotationsManager::class);

        $method = $reflec->getMethod('removeTransientAnnotation');
        $method->setAccessible(true);

        $namespace = 'namespace';
        $name      = 'name';

        $annotate = [];

        $actual = $method->invokeArgs(null, [&$annotate, $namespace, $name]);
        $this->assertEquals([], $annotate);
    }

    public function testRemoveTransientAnnotationOnSingletonMatch()
    {
        $reflec = new \ReflectionClass(EdmDirectValueAnnotationsManager::class);

        $method = $reflec->getMethod('removeTransientAnnotation');
        $method->setAccessible(true);

        $namespace = 'namespace';
        $name      = 'name';

        $element = m::mock(IDirectValueAnnotation::class);
        $element->shouldReceive('getNamespaceUri')->andReturn('namespace');
        $element->shouldReceive('getName')->andReturn('name');

        $annotate = $element;

        $actual = $method->invokeArgs(null, [&$annotate, $namespace, $name]);
        $this->assertNull($annotate);
    }

    public function testRemoveTransientAnnotationOnSingletonNoMatch()
    {
        $reflec = new \ReflectionClass(EdmDirectValueAnnotationsManager::class);

        $method = $reflec->getMethod('removeTransientAnnotation');
        $method->setAccessible(true);

        $namespace = 'namespace';
        $name      = 'name';

        $element = m::mock(IDirectValueAnnotation::class);
        $element->shouldReceive('getNamespaceUri')->andReturn('name');
        $element->shouldReceive('getName')->andReturn('name');

        $annotate = $element;

        $actual = $method->invokeArgs(null, [&$annotate, $namespace, $name]);
        $this->assertEquals($element, $annotate);
    }

    public function testRemoveTransientAnnotationOnArraySingletonMatch()
    {
        $reflec = new \ReflectionClass(EdmDirectValueAnnotationsManager::class);

        $method = $reflec->getMethod('removeTransientAnnotation');
        $method->setAccessible(true);

        $namespace = 'namespace';
        $name      = 'name';

        $element = m::mock(IDirectValueAnnotation::class);
        $element->shouldReceive('getNamespaceUri')->andReturn('namespace');
        $element->shouldReceive('getName')->andReturn('name');

        $annotate = [$element];

        $expected = [];
        $actual   = $method->invokeArgs(null, [&$annotate, $namespace, $name]);
        $this->assertEquals($expected, $annotate);
    }

    public function testRemoveTransientAnnotationOnDoubleArraySingletonMatch()
    {
        $reflec = new \ReflectionClass(EdmDirectValueAnnotationsManager::class);

        $method = $reflec->getMethod('removeTransientAnnotation');
        $method->setAccessible(true);

        $namespace = 'namespace';
        $name      = 'name';

        $element = m::mock(IDirectValueAnnotation::class);
        $element->shouldReceive('getNamespaceUri')->andReturn('namespace');
        $element->shouldReceive('getName')->andReturn('name');

        $annotate = [$element];

        $expected = [];
        $actual   = $method->invokeArgs(null, [&$annotate, $namespace, $name]);
        $this->assertEquals($expected, $annotate);
    }

    public function testRemoveTransientAnnotationOnArraySingletonNoMatch()
    {
        $reflec = new \ReflectionClass(EdmDirectValueAnnotationsManager::class);

        $method = $reflec->getMethod('removeTransientAnnotation');
        $method->setAccessible(true);

        $namespace = 'namespace';
        $name      = 'name';

        $element = m::mock(IDirectValueAnnotation::class);
        $element->shouldReceive('getNamespaceUri')->andReturn('name');
        $element->shouldReceive('getName')->andReturn('name');

        $annotate = [$element];

        $expected = [$element];
        $actual   = $method->invokeArgs(null, [&$annotate, $namespace, $name]);
        $this->assertEquals($expected, $annotate);
    }
}
