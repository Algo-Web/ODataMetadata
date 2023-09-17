<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Enums;

use AlgoWeb\ODataMetadata\Enums\Multiplicity;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class MultiplicityTest extends TestCase
{
    public function keyStringProvider(): array
    {
        $result   = [];
        $result[] = [Multiplicity::Unknown(), 'Unknown'];
        $result[] = [Multiplicity::ZeroOrOne(), 'ZeroOrOne'];
        $result[] = [Multiplicity::One(), 'One'];
        $result[] = [Multiplicity::Many(), 'Many'];

        return $result;
    }

    /**
     * @dataProvider keyStringProvider
     *
     * @param Multiplicity $kind
     * @param string       $expected
     */
    public function testGetKey(Multiplicity $kind, string $expected)
    {
        $actual = $kind->getKey();
        $this->assertEquals($expected, $actual);
    }

    public function testGetStringConstForUnknownMultiplicity()
    {
        $multiplicity = Multiplicity::Unknown();

        $expected = 'Invalid multiplicity: \'Unknown\'';
        $actual   = StringConst::UnknownEnumVal_Multiplicity($multiplicity->getKey());

        $this->assertEquals($expected, $actual);
    }
}
