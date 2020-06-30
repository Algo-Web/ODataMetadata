<?php

declare(strict_types=1);


namespace Unit\Util;

use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Util\XmlCharType;
use ReflectionClass;

class XmlCharTypeTest extends TestCase
{
    /**
     * @dataProvider IsStartNcNameCharProvider
     *
     * @param $char
     * @param $startChar
     * @param $withCache
     * @throws \ReflectionException
     */
    public function testIsStartNCNameChar($char, $startChar, $withCache)
    {
        $charType = XmlCharType::Instance();
        $this->assertEquals($startChar, $charType->IsStartNCNameChar($char));
    }

    public function IsStartNcNameCharProvider()
    {
        return[
            ['A', true,true],
            ['B', true,true],
            ['Z', true,true],
            ['A', true,true],
            [';', false, true],

        ];
    }
}
