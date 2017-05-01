<?php

namespace AlgoWeb\ODataMetadata\Tests;

use AlgoWeb\ODataMetadata\IsOK;

class testType extends IsOK
{
    public function isStringNotNullOrEmpty($str)
    {
        return parent::isStringNotNullOrEmpty($str);
    }

    public function isStringNotNull($str)
    {
        return parent::isStringNotNull($str);
    }

    public function isNotNullInstanceOf($var, $instanceOf)
    {
        return parent::isNotNullInstanceOf($var, $instanceOf);
    }

    public function isNullInstanceOf($var, $instanceOf)
    {
        return parent::isNullInstanceOf($var, $instanceOf);
    }

    public function isValidArray(array $arr, $instanceOf, $minCount = -1, $maxCount = -1)
    {
        return parent::isValidArray($arr, $instanceOf, $minCount, $maxCount);
    }

    public function isChildArrayOK(array $arr, &$msg)
    {
        return parent::isChildArrayOK($arr, $msg);
    }

    public function isURLValid($url)
    {
        return parent::isURLValid($url);
    }

    public function isOK(&$msg = null)
    {
        return true;
    }
}