<?php

namespace AlgoWeb\ODataMetadata\EntityStoreSchemaGenerator;

trait TSourceTypeTrait
{
    public function isTSourceTypeValid($string)
    {
        return 'Tables' == $string || 'Views' == $string;
    }
}
