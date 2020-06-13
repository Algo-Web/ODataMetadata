<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Csdl\Internal;

use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Exception\NotSupportedException;
use AlgoWeb\ODataMetadata\Interfaces\Values\IBinaryValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IBooleanValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IDateTimeOffsetValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IDateTimeValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IDecimalValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IFloatingValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IGuidValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IIntegerValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPrimitiveValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IStringValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\ITimeValue;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Util\XmlConvert;
use DateTime;

abstract class EdmValueWriter
{
    private static $Hex = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F'];

    public static function PrimitiveValueAsXml(IPrimitiveValue $v): string
    {
        switch ($v->getValueKind()) {
            case ValueKind::Boolean():
                assert($v instanceof IBooleanValue);
                return self::BooleanAsXml($v->getValue());
            case ValueKind::Integer():
                assert($v instanceof IIntegerValue);
                return self::LongAsXml($v->getValue());
            case ValueKind::Floating():
                assert($v instanceof IFloatingValue);
                return self::FloatAsXml($v->getValue());
            case ValueKind::Guid():
                assert($v instanceof IGuidValue);
                return self::GuidAsXml($v->getValue());
            case ValueKind::Binary():
                assert($v instanceof IBinaryValue);
                return self::BinaryAsXml($v->getValue());
            case ValueKind::Decimal():
                assert($v instanceof IDecimalValue);
                return self::DecimalAsXml($v->getValue());
            case ValueKind::String():
                assert($v instanceof IStringValue);
                return self::StringAsXml($v->getValue());
            case ValueKind::DateTime():
                assert($v instanceof IDateTimeValue);
                return self::DateTimeAsXml($v->getValue());
            case ValueKind::DateTimeOffset():
                assert($v instanceof IDateTimeOffsetValue);
                return self::DateTimeOffsetAsXml($v->getValue());
            case ValueKind::Time():
                assert($v instanceof ITimeValue);
                return self::TimeAsXml($v->getValue());
            default:
                /* @noinspection PhpUnhandledExceptionInspection */
                throw new NotSupportedException(StringConst::ValueWriter_NonSerializableValue($v->getValueKind()->getKey()));
        }
    }

    public static function StringAsXml(string $s): string
    {
        return $s;
    }

    public static function BinaryAsXml(array $binary): string
    {
        $chars = [];
        for ($i = 0; $i < count($binary); ++$i) {
            $chars[$i << 1]     = self::$Hex[$binary[$i] >> 4];
            $chars[$i << 1 | 1] = self::$Hex[$binary[$i] & 0x0F];
        }

        return implode('', $chars);
    }

    public static function BooleanAsXml(bool $b): string
    {
        return XmlConvert::boolToString($b);
    }


    public static function IntAsXml(int $i): string
    {
        return XmlConvert::intToString($i);
    }


    public static function LongAsXml(int $l): string
    {
        return XmlConvert::intToString($l);
    }

    public static function FloatAsXml(float $f): string
    {
        return XmlConvert::floatToString($f);
    }

    public static function DecimalAsXml(float $d): string
    {
        return XmlConvert::floatToString($d);
    }

    public static function DateTimeAsXml(DateTime $d): string
    {
        return $d->format('y-n-jTG:i:s:u') . '000';
    }

    public static function TimeAsXml(DateTime $d): string
    {
        return $d->format("hh\:mm\:ss\.uuu");
    }

    public static function DateTimeOffsetAsXml(DateTime $d): string
    {
        return $d->format('Z');
    }

    public static function GuidAsXml(string $g): string
    {
        return $g;
    }
}
