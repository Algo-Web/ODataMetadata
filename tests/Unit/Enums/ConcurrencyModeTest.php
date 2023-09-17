<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Enums;

use AlgoWeb\ODataMetadata\Enums\ConcurrencyMode;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class ConcurrencyModeTest extends TestCase
{
    public function keyStringProvider(): array
    {
        $result   = [];
        $result[] = [ConcurrencyMode::None(), 'None'];
        $result[] = [ConcurrencyMode::Fixed(), 'Fixed'];

        return $result;
    }

    /**
     * @dataProvider keyStringProvider
     *
     * @param ConcurrencyMode $kind
     * @param string          $expected
     */
    public function testGetKey(ConcurrencyMode $kind, string $expected)
    {
        $actual = $kind->getKey();
        $this->assertEquals($expected, $actual);
    }
}
