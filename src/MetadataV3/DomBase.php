<?php


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
    public abstract function getDomName(): string;
    /**
     * @return array|AttributeContainer[]
     */
    public abstract function getAttributes(): array ;

    /**
     * @return array|DomBase[]
     */
    public abstract function getChildElements(): array ;

}