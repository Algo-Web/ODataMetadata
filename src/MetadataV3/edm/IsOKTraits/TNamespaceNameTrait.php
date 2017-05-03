<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TQualifiedNameTrait;

trait TNamespaceNameTrait
{
    use TQualifiedNameTrait;

    public function isTNamespaceNameValid($string)
    {
        if (!$this->isTQualifiedNameValid($string)) {
            return false;
        }
        return 512 >= strlen($string);
    }
}
