<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Enums;

use AlgoWeb\ODataMetadata\Enums\TermKind;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class TermKindTest extends TestCase
{
    public function keyStringProvider(): array
    {
        $result   = [];
        $result[] = [TermKind::None(), 'None'];
        $result[] = [TermKind::Type(), 'Type'];
        $result[] = [TermKind::Value(), 'Value'];

        return $result;
    }

    /**
     * @dataProvider keyStringProvider
     *
     * @param TermKind $kind
     * @param string   $expected
     */
    public function testGetKey(TermKind $kind, string $expected)
    {
        $actual = $kind->getKey();
        $this->assertEquals($expected, $actual);
    }
}
