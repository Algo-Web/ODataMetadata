<?php


namespace AlgoWeb\ODataMetadata\Util;


class XmlConvert
{
    public static function boolToString(bool $b): string
    {
        return $b ? 'true' : 'false';
    }

    public static function intToString(int $i): string
    {
        return strval($i);
    }

    public static function floatToString(float $f): string{
        if($f == INF){
            return 'INF';
        }
        if($f == -INF){
            return '-INF';
        }
        return strval($f);
    }
}