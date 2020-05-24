<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets;


use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use DOMElement;

/**
 * Trait HasUnicode
 *
 * 5.3.6 The edm:Unicode Attribute
 *
 * A string property MAY define a [boolean][csdl19] value for the edm:Unicode attribute.
 *
 * A true value assigned to this attribute indicates that the value of the property is encoded with Unicode.
 * A false value assigned to this attribute indicates that the value of the property is encoded with ASCII.
 *
 * If no value is defined for this attribute, the value defaults to true.
 *
 * @linkhttps://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl5.3.6
 * @mixin EdmBase
 */
trait HasUnicode
{
    /**
     * @var bool $unicode
     */
    private $unicode = true;

    /**
     * Gets as unicode
     *
     * @return bool
     */
    public function getUnicode(): bool
    {
        return $this->unicode;
    }

    /**
     * Sets a new unicode
     *
     * @param bool $unicode
     * @return self
     */
    public function setUnicode(bool $unicode): self
    {
        $this->unicode = $unicode;
        return $this;
    }

    public function getAttributesHasUnicode(): array{
        if(method_exists($this, 'getType')){
            if($this->getType() != 'String'){
                return [];
            }
        }
        return [new AttributeContainer('Unicode', $this->getUnicode(), true)];
    }
}