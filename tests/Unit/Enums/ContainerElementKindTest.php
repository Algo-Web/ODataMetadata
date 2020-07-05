<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Enums;

use AlgoWeb\ODataMetadata\Enums\ContainerElementKind;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class ContainerElementKindTest extends TestCase
{
    public function keyStringProvider(): array
    {
        $result = [];
        $result[] = [ContainerElementKind::None(), 'None'];
        $result[] = [ContainerElementKind::EntitySet(), 'EntitySet'];
        $result[] = [ContainerElementKind::FunctionImport(), 'FunctionImport'];

        return $result;
    }

    /**
     * @dataProvider keyStringProvider
     *
     * @param ContainerElementKind $kind
     * @param string $expected
     */
    public function testGetKey(ContainerElementKind $kind, string $expected)
    {
        $actual = $kind->getKey();
        $this->assertEquals($expected, $actual);
    }
}
