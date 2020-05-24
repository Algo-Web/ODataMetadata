<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns;

use AlgoWeb\ODataMetadata\MetadataV3\AccessorType;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use DOMElement;

/**
 * Trait HasAccessors
 * @mixin EdmBase
 */
trait HasAccessors
{
    /**
     * @var AccessorType $setterAccess
     */
    private $setterAccess = null;

    /**
     * @var AccessorType $getterAccess
     */
    private $getterAccess = null;
    /**
     * Gets as setterAccess
     *
     * @return string
     */
    public function getSetterAccess()
    {
        return $this->setterAccess;
    }

    /**
     * Sets a new setterAccess
     *
     * @param AccessorType $setterAccess
     * @return self
     */
    public function setSetterAccess(?AccessorType $setterAccess): self
    {
        $this->setterAccess = $setterAccess;
        return $this;
    }

    /**
     * Gets as getterAccess
     *
     * @return AccessorType|null
     */
    public function getGetterAccess(): ?AccessorType
    {
        return $this->getterAccess;
    }

    /**
     * Sets a new getterAccess
     *
     * @param AccessorType $getterAccess
     * @return self
     */
    public function setGetterAccess(?AccessorType$getterAccess): self
    {
        $this->getterAccess = $getterAccess;
        return $this;
    }

    public function XmlSerializeHasAccessors(DOMElement $thisNode)
    {
        $this->XmlSerializeNullableAttribute($thisNode, 'cg:SetterAccess', $this->getSetterAccess());
        $this->XmlSerializeNullableAttribute($thisNode, 'cg:GetterAccess', $this->getGetterAccess());
    }
    public function getAttributesHasAccessors(): array
    {
        return [
            new AttributeContainer('cg:SetterAccess', $this->getSetterAccess(), true),
            new AttributeContainer('cg:GetterAccess', $this->getGetterAccess(), true)
        ];
    }
}
