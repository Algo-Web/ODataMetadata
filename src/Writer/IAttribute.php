<?php


namespace AlgoWeb\ODataMetadata\Writer;


use AlgoWeb\ODataMetadata\OdataVersions;


interface IAttribute
{
    public function getAttributeValue(): ?string;

    public function getAttributeNullCheck():bool ;

    public function getAttributeForVersion(): OdataVersions;

    public function getAttributeProhibitedVersion(): array;

    public function getAttributePrefix(): ?string;

    public function getAttributeName():string;
}