<?php

declare(strict_types=1);


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

    public static function floatToString(float $f): string
    {
        if ($f == INF) {
            return 'INF';
        }
        if ($f == -INF) {
            return '-INF';
        }
        return strval($f);
    }

    /**
     * Start name character types - as defined in Namespaces XML 1.0 spec (second edition) production [6]
     * NCNameStartChar combined with the production [4] NameStartChar of XML 1.0 spec
     *
     * @param string $ch
     * @return bool
     */
    public static function IsStartNCNameChar(string $ch): bool
    {
        return XmlCharType::Instance()->IsStartNCNameChar($ch);

    }

    /**
     * Name character types - as defined in Namespaces XML 1.0 spec (second edition) production [6] NCNameStartChar
     * combined with the production [4] NameChar of XML 1.0 spec
     *
     * @param string $ch
     * @return bool
     */
    public static function IsNCNameChar(string $ch)
    {
        return XmlCharType::Instance()->IsNCNameChar($ch);
    }

    public static function VerifyNCName(string $name): bool{
        $length = strlen($name);
        for( $i = 1; $i < $length; $i++)
        {
            if(!self::IsNCNameChar($name[$i])){
                return false;
            }
        }
        return self::IsStartNCNameChar($name[0]);
    }
}
