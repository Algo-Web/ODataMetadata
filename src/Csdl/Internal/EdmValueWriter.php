<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Csdl\Internal;

use AlgoWeb\ODataMetadata\EdmUtil;
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

    public static function primitiveValueAsXml(IPrimitiveValue $v): string
    {
        if (method_exists($v, 'getValue')) {
            EdmUtil::checkArgumentNull($v->getValue(), 'v->getValue');
        }

        switch ($v->getValueKind()) {
            case ValueKind::Boolean():
                assert($v instanceof IBooleanValue);
                return self::booleanAsXml($v->getValue());
            case ValueKind::Integer():
                assert($v instanceof IIntegerValue);
                return self::longAsXml($v->getValue());
            case ValueKind::Floating():
                assert($v instanceof IFloatingValue);
                return self::floatAsXml($v->getValue());
            case ValueKind::Guid():
                assert($v instanceof IGuidValue);
                return self::guidAsXml($v->getValue());
            case ValueKind::Binary():
                assert($v instanceof IBinaryValue);
                return self::binaryAsXml(/** @scrutinizer ignore-type */$v->getValue());
            case ValueKind::Decimal():
                assert($v instanceof IDecimalValue);
                return self::decimalAsXml($v->getValue());
            case ValueKind::String():
                assert($v instanceof IStringValue);
                return self::stringAsXml(/** @scrutinizer ignore-type */$v->getValue());
            case ValueKind::DateTime():
                assert($v instanceof IDateTimeValue);
                return self::dateTimeAsXml($v->getValue());
            case ValueKind::DateTimeOffset():
                assert($v instanceof IDateTimeOffsetValue);
                return self::dateTimeOffsetAsXml($v->getValue());
            case ValueKind::Time():
                assert($v instanceof ITimeValue);
                return self::timeAsXml($v->getValue());
            default:
                /* @noinspection PhpUnhandledExceptionInspection */
                throw new NotSupportedException(StringConst::ValueWriter_NonSerializableValue($v->getValueKind()->getKey()));
        }
    }

    public static function stringAsXml(string $s): string
    {
        return $s;
    }

    public static function binaryAsXml(array $binary): string
    {
        $chars       = [];
        $numElements = count($binary);
        for ($i = 0; $i < $numElements; ++$i) {
            $chars[$i << 1]     = self::$Hex[$binary[$i] >> 4];
            $chars[$i << 1 | 1] = self::$Hex[$binary[$i] & 0x0F];
        }

        return implode('', $chars);
    }

    public static function booleanAsXml(bool $b): string
    {
        return XmlConvert::boolToString($b);
    }


    public static function intAsXml(int $i): string
    {
        return XmlConvert::intToString($i);
    }


    public static function longAsXml(int $l): string
    {
        return XmlConvert::intToString($l);
    }

    public static function floatAsXml(float $f): string
    {
        return XmlConvert::floatToString($f) . 'F';
    }

    public static function decimalAsXml(float $d): string
    {
        return XmlConvert::floatToString($d) . 'M';
    }

    public static function dateTimeAsXml(DateTime $d): string
    {
        return $d->format('Y-m-d\TH:i:s.u') . '000';
    }

    public static function timeAsXml(DateTime $d): string
    {
        return $d->format("h\:i\:s\.u");
    }

    public static function dateTimeOffsetAsXml(DateTime $d): string
    {
        return $d->format('Y-m-d\TH:i:s.v\ZP');
    }

    public static function guidAsXml(string $g): string
    {
        return $g;
    }
}
