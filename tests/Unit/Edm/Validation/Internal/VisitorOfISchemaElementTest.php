<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 5/07/20
 * Time: 3:44 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\Internal;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator\VisitorOfISchemaElement;
use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class VisitorOfISchemaElementTest extends TestCase
{
    public function testVisitNullNamespace()
    {
        $item = m::mock(ISchemaElement::class)->makePartial();
        $item->shouldReceive('getNamespace')->andReturn(null)->atLeast(1);
        $item->shouldReceive('getSchemaElementKind')->andReturn(SchemaElementKind::None())->atLeast(1);

        $foo = new VisitorOfISchemaElement();
        $followUp   = [];
        $references = [];

        $result = $foo->Visit($item, $followUp, $references);
        $this->assertTrue(is_array($result));
        $this->assertEquals(1, count($result));
    }
}
