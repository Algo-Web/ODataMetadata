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

    protected function isObjectNullOrType($instanceOf, IsOK $object = null, &$msg = null)
    {
        if (null == $object) {
            return true;
        }
        if (!$object instanceof $instanceOf) {
            $msg = "Supplied object not an instance of ".$instanceOf;
            return false;
        }
        return $object->isOK($msg);
    }

    protected function isValidArrayOK(array $arr = null, $instanceOf, &$msg = null, $minCount = -1, $maxCount = -1)
    {
        $result = $this->isValidArray($arr, $instanceOf, $minCount, $maxCount);
        if (!$result) {
            $msg = "Supplied array not a valid array";
            return false;
        }

        return $this->isChildArrayOK($arr, $msg);
    }

    protected function isValidArray(array $arr = null, $instanceOf, $minCount = -1, $maxCount = -1)
    {
        if (null == $arr && 0 >= $minCount) {
            return true;
        }
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

    protected function isChildArrayOK(array $arr = null, &$msg)
    {
        if ($arr == null || empty($arr)) {
            return true;
        }
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
}
