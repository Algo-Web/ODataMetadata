<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/07/20
 * Time: 5:25 PM.
 */

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportUnsupportedReturnTypeAfterV1;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRuleSet;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Version;
use Mockery as m;

class ValidationRuleSetTest extends TestCase
{
    public function testGetRuleSetBadVersion()
    {
        $version = m::mock(Version::class);

        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Unknown Edm version.');

        ValidationRuleSet::getEdmModelRuleSet($version);
    }

    public function ruleSetProvider(): array
    {
        $result   = [];
        $result[] = [Version::v1(), 110];
        $result[] = [Version::v1_1(), 107];
        $result[] = [Version::v1_2(), 106];
        $result[] = [Version::v2(), 107];
        $result[] = [Version::v3(), 95];

        return $result;
    }

    /**
     * @dataProvider ruleSetProvider
     *
     * @param Version $version
     * @param int     $expected
     */
    public function testGetRuleSetGoodModel(Version $version, int $expected)
    {
        $result = ValidationRuleSet::getEdmModelRuleSet($version);

        $actual = 0;
        foreach ($result as $rule) {
            $actual++;
        }
        $this->assertEquals($expected, $actual);
    }

    public function testAddRuleCatchCollision()
    {
        $version = Version::v3();

        $result = ValidationRuleSet::getEdmModelRuleSet($version);
        $rule   =  new FunctionImportUnsupportedReturnTypeAfterV1();

        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The same rule cannot be in the same rule set twice.');

        new ValidationRuleSet($result, [$rule]);
    }
}
