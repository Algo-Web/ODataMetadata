<?php

namespace AlgoWeb\ODataMetadata\IsOKTraits;

use AlgoWeb\ODataMetadata\IsOK;

trait IsOKToolboxTrait
{
    protected function isStringNotNullOrEmpty($str)
    {
        if (!$this->isStringNotNull($str)) {
            return false;
        }
        if (empty(trim($str))) {
            return false;
        }
        return true;
    }

    protected function isStringNotNull($str)
    {
        if (null == $str) {
            return false;
        }
        if (!is_string($str)) {
            return false;
        }
        return true;
    }

    protected function isNotNullInstanceOf($var, $instanceOf)
    {
        if (null == $var) {
            return false;
        }
        if (!($var instanceof $instanceOf)) {
            return false;
        }
        return true;
    }

    protected function isNullInstanceOf($var, $instanceOf)
    {
        if (null == $var) {
            return true;
        }
        if (!($var instanceof $instanceOf)) {
            return false;
        }
        return false;
    }

    protected function isValidArray(array $arr, $instanceOf, $minCount = -1, $maxCount = -1)
    {
        $numberOfItem = count($arr);
        if (-1 != $minCount && $numberOfItem < $minCount) {
            return false;
        }
        if (-1 != $maxCount && $numberOfItem > $maxCount) {
            return false;
        }
        foreach ($arr as $item) {
            if (!($item instanceof $instanceOf)) {
                return false;
            }
        }
        return true;
    }

    protected function isChildArrayOK(array $arr, &$msg)
    {
        foreach ($arr as $item) {
            if (!($item instanceof IsOK)) {
                $msg = "Child item is not an instance of IsOK";
                return false;
            }
            if (!$item->isOK($msg)) {
                return false;
            }
        }
        return true;
    }

    protected function isURLValid($url)
    {
        if (!$this->isStringNotNull($url)) {
            return false;
        }
        if (false === filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }
        return true;
    }

    protected function isObjectNullOrOK(IsOK $object = null, &$msg = null)
    {
        if (null == $object) {
            return true;
        }
        return $object->isOK($msg);
    }

    protected function isValidArrayOK(array $arr, $instanceOf, &$msg = null, $minCount = -1, $maxCount = -1)
    {
        $result = $this->isValidArray($arr, $instanceOf, $minCount, $maxCount);
        if (!$result) {
            $msg = "Supplied array not a valid array";
            return false;
        }

        return $this->isChildArrayOK($arr, $msg);
    }
}
