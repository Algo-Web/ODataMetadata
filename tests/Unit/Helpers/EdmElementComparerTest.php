<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 1/07/20
 * Time: 9:23 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Helpers;

use AlgoWeb\ODataMetadata\Helpers\EdmElementComparer;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class EdmElementComparerTest extends TestCase
{
    public function testNotEquivalentWhenBothNull()
    {
        $expected = false;
        $actual = EdmElementComparer::isEquivalentTo(null, null);
        $this->assertEquals($expected, $actual);
    }
}
