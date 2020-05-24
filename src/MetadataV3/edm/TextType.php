<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use DOMElement;

/**
 * Class representing TTextType
 *
 * 
 * XSD Type: TText
 */
class TextType extends EdmBase
{
    private $__value = null;
    private $name;
    public function __construct(string $name, string $value)
    {
        $this->__value = $value;
        $this->name = $name;
    }

    public function __toString()
    {
        return $this->__value;
    }
    public function getTextContent(): ?string
    {
        return strval($this);
    }
    /**
     * @return string
     */
    public function getDomName(): string
    {
        return $this->name;
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [];
    }
}

