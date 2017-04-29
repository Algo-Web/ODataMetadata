<?php
namespace AlgoWeb\ODataMetadata;

abstract class IsOK
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

    protected function isNotNullInstanceOf($var, $insanceOf)
    {
        if (null == $var) {
            return false;
        }
        if (!($var instanceof $insanceOf)) {
            return false;
        }
        return true;
    }

    protected function isNullInstanceOf($var, $insanceOf)
    {
        if (null == $var) {
            return true;
        }
        if (!($var instanceof $insanceOf)) {
            return false;
        }
        return false;
    }

    protected function isValidArray($arr, $instanceOf, $minCount = -1, $maxCount = -1)
    {
        if (null == $arr) {
            return false;
        }
        if (!is_array($arr)) {
            return false;
        }
        $numberOfItem = count($arr);
        if ($minCount != -1 && $numberOfItem < $minCount) {
            return false;
        }
        if ($maxCount != -1 && $numberOfItem > $maxCount) {
            return false;
        }
        foreach ($arr as $item) {
            if (!($item instanceof $instanceOf)) {
                return false;
            }
        }
        return true;
    }

    protected function IsChildArrayOK(array $arr, &$msg)
    {

        foreach ($arr as $item) {
            if (!($item instanceof IsOK)) {
                $msg = "Child Item is not an instance of IsOK";
                return false;
            }
            if (!$item->IsOK($msg)) {
                return false;
            }
        }
    }

    abstract protected function IsOK(&$msg);
}
