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
     * NCNameStartChar combined with the production [4] NameStartChar of XML 1.0 spec.
     *
     * @param  string $ch
     * @return bool
     */
    public static function isStartNCNameChar(string $ch): bool
    {
        return XmlCharType::instance()->isStartNCNameChar($ch);
    }

    /**
     * Name character types - as defined in Namespaces XML 1.0 spec (second edition) production [6] NCNameStartChar
     * combined with the production [4] NameChar of XML 1.0 spec.
     *
     * @param  string $ch
     * @return bool
     */
    public static function isNCNameChar(string $ch)
    {
        return XmlCharType::instance()->isNCNameChar($ch);
    }

    public static function verifyNCName(string $name): bool
    {
        $length = mb_strlen($name);
        for ($i = 1; $i < $length; $i++) {
            if (!self::isNCNameChar($name[$i])) {
                return false;
            }
        }
        return self::isStartNCNameChar($name[0]);
    }
}
