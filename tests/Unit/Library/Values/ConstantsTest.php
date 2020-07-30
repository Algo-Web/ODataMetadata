<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 24/06/20
 * Time: 1:59 AM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Library\Values;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Interfaces\IBinaryTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;
use AlgoWeb\ODataMetadata\Library\Values\EdmBinaryConstant;
use AlgoWeb\ODataMetadata\Library\Values\EdmBooleanConstant;
use AlgoWeb\ODataMetadata\Library\Values\EdmDateTimeConstant;
use AlgoWeb\ODataMetadata\Library\Values\EdmDateTimeOffsetConstant;
use AlgoWeb\ODataMetadata\Library\Values\EdmDecimalConstant;
use AlgoWeb\ODataMetadata\Library\Values\EdmFloatingConstant;
use AlgoWeb\ODataMetadata\Library\Values\EdmGuidConstant;
use AlgoWeb\ODataMetadata\Library\Values\EdmIntegerConstant;
use AlgoWeb\ODataMetadata\Library\Values\EdmStringConstant;
use AlgoWeb\ODataMetadata\Library\Values\EdmTimeConstant;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class ConstantsTest extends TestCase
{
    public function constantProvider(): array
    {
        $result   = [];
        $result[] = [EdmBinaryConstant::class, IBinaryTypeReference::class, ['a'], ExpressionKind::BinaryConstant(), ValueKind::Binary()];
        $result[] = [EdmBooleanConstant::class, IPrimitiveTypeReference::class, true, ExpressionKind::BooleanConstant(), ValueKind::Boolean()];
        $result[] = [EdmDateTimeConstant::class, ITemporalTypeReference::class, new \DateTime(), ExpressionKind::DateTimeConstant(), ValueKind::DateTime()];
        $result[] = [EdmDateTimeOffsetConstant::class, ITemporalTypeReference::class, new \DateTime(), ExpressionKind::DateTimeOffsetConstant(), ValueKind::DateTimeOffset()];
        $result[] = [EdmDecimalConstant::class, IPrimitiveTypeReference::class, 0.1, ExpressionKind::DecimalConstant(), ValueKind::Decimal()];
        $result[] = [EdmFloatingConstant::class, IPrimitiveTypeReference::class, 0.1, ExpressionKind::FloatingConstant(), ValueKind::Floating()];
        $result[] = [EdmGuidConstant::class, IPrimitiveTypeReference::class, 'abc', ExpressionKind::GuidConstant(), ValueKind::Guid()];
        $result[] = [EdmIntegerConstant::class, IPrimitiveTypeReference::class, 1, ExpressionKind::IntegerConstant(), ValueKind::Integer()];
        $result[] = [EdmStringConstant::class, IPrimitiveTypeReference::class, 'abc', ExpressionKind::StringConstant(), ValueKind::String()];
        $result[] = [EdmTimeConstant::class, ITemporalTypeReference::class, new \DateTime(), ExpressionKind::TimeConstant(), ValueKind::Time()];

        return $result;
    }

    /**
     * @dataProvider constantProvider
     *
     * @param string $class
     * @param string $typeRef
     * @param $value
     * @param ExpressionKind $expressionKind
     * @param ValueKind      $valueKind
     */
    public function testEdmConstant(
        string $class,
        string $typeRef,
        $value,
        ExpressionKind $expressionKind,
        ValueKind $valueKind
    ) {
        $type = m::mock($typeRef)->makePartial();
        $this->assertTrue($type instanceof $typeRef);

        $foo = new $class($value, $type);

        $this->assertEquals($value, $foo->getValue());

        $this->assertEquals($expressionKind, $foo->getExpressionKind());

        $this->assertEquals($valueKind, $foo->getValueKind());
    }
}
