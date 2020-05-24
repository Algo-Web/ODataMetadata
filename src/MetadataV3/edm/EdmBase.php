<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;


use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\OdataVersions;
use AlgoWeb\ODataMetadata\Writer\WritterContext;
use DOMElement;

abstract class EdmBase extends DomBase
{
    protected function completelyMatchesPattern($str, $pattern){
        return preg_match($pattern, $str, $matches) === 1 && $matches[0] === $str;
    }

    protected function elementToNamedArray (array $raw){
        return array_reduce($raw, function($carry, $item) {

            if (!method_exists($item, 'getName')) {
                throw new \InvalidArgumentException('attempted to a none named element to a named array');
            }
            $carry[$item->getName()] = $item;
            return $carry;
        },
        []);
    }
}