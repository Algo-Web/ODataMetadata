<?php
namespace AlgoWeb\ODataMetadata;

abstract class IsOK
{
    abstract protected function IsOK(&$msg);

    protected function isStringNotNullOrEmpty($str){
        if($this->isStringNull($str)){
            return false;
        }
        if(empty(trim($str))){
           return false;
        }
        return true;
    }

    protected function isStringNotNull($str)
    {
        if(null == $str){
           return false;
        }
        if(!is_string($str)){
           return false;
        }
        return true;
    }

    protected  function isNotNullIstanceOf($var, $insanceOf){
        if(null == $var){
            return false;
        }
        if(!($var instanceof $insanceOf)){
            return false;
        }
        return true;
    }

    protected function isValidArray($arr, $insanceOf, $minCount = -1, $maxCount = -1){
        if(null == $arr){
            return false;
        }
        if(!is_array ($arr)){
            return false;
        }
        if($minCount != -1 && count($arr) < $minCount){
            return false;
        }
        if($maxCount != -1 && count($arr) > $maxCount){
            return false;
        }
        foreach($arr as $item){
            if(!($item instanceof $insanceOf)){
                return false;
            }
        }
        return true;
    }
}
