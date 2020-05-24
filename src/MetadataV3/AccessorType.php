<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3;


use MyCLabs\Enum\Enum;

class AccessorType extends Enum
{
    protected const Public = "Public";
    protected const Internal = "Internal";
    protected const Protected = "Protected";
    protected const Private = "Private";

    public static $cgNamespace = "http://schemas.microsoft.com/ado/2006/04/codegeneration";
}