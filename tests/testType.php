<?php

namespace AlgoWeb\ODataMetadata\Tests;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;
use AlgoWeb\ODataMetadata\StringTraits\XMLStringTrait;

class testType extends IsOK
{
    use XMLStringTrait, TSimpleIdentifierTrait;

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

    public function isValidArray(array $arr = null, $instanceOf, $minCount = -1, $maxCount = -1)
    {
        return parent::isValidArray($arr, $instanceOf, $minCount, $maxCount);
    }

    public function isChildArrayOK(array $arr = null, &$msg)
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

    public function isObjectNullOrOK(IsOK $object = null, &$msg = null)
    {
        return parent::isObjectNullOrOK($object, $msg);
    }

    public function isValidArrayOK(array $arr = null, $instanceOf, &$msg = null, $minCount = -1, $maxCount = -1)
    {
        return parent::isValidArrayOK($arr, $instanceOf, $msg, $minCount, $maxCount);
    }
}
