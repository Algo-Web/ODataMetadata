<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3;

use AlgoWeb\ODataMetadata\OdataVersions;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use AlgoWeb\ODataMetadata\Writer\IAttribute;

abstract class DomBase
{
    public function requiredVersion(): OdataVersions
    {
        return OdataVersions::ONE();
    }

    public function getTextContent(): ?string
    {
        return method_exists($this, '__toString') ? strval($this) : null;
    }

    /**
     * @return string
     */
    abstract public function getDomName(): string;
    /**
     * @return array|AttributeContainer[]
     */
    abstract public function getAttributes(): array ;

    /**
     * @return array|DomBase[]
     */
    abstract public function getChildElements(): array ;
}
