<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadElement;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class BadElementTest extends TestCase
{
    public function testAssignErrors()
    {
        $err = m::mock(EdmError::class);

        $foo = new BadElement([$err]);

        $result = $foo->getErrors();
        $this->assertTrue(is_array($result));
        $this->assertEquals(0, count($result));
    }
}
