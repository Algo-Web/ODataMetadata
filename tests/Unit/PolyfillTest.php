<?php

declare(strict_types=1);


namespace Unit;

use AlgoWeb\ODataMetadata\Tests\TestCase;

class PolyfillTest extends TestCase
{
    public function testOrd()
    {
        $this->assertSame(0x20BB7, mb_ord("\xF0\xA0\xAE\xB7"));
        $this->assertSame(0xE9, mb_ord("\xE9", 'CP1252'));
    }
}
