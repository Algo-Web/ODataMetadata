<?php


namespace AlgoWeb\ODataMetadata\MetadataV3;


use MyCLabs\Enum\Enum;

class ConcurrencyMode extends Enum
{
    protected const None = "None";
    protected const Fixed = "Fixed";
}