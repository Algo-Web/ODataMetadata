<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Writer;

use AlgoWeb\ODataMetadata\OdataVersions;

class AttributeContainer implements IAttribute
{
    /**
     * @var bool
     */
    private $nullCheck;
    /**
     * @var string
     */
    private $value;
    /**
     * @var string|null
     */
    private $prefix;
    /**
     * @var string
     */
    private $name;
    /**
     * @var OdataVersions
     */
    private $forVersion;
    /**
     * @var array|OdataVersions[]
     */
    private $prohibitedVersion;

    public function getAttributeNullCheck(): bool
    {
        return $this->nullCheck;
    }

    public function getAttributeForVersion(): OdataVersions
    {
        return $this->forVersion ?? OdataVersions::ONE();
    }

    public function getAttributeProhibitedVersion(): array
    {
        return $this->prohibitedVersion;
    }

    public function getAttributePrefix(): ?string
    {
        return $this->prefix;
    }

    public function getAttributeName(): string
    {
        return $this->name;
    }
    /**
     * @return string|null
     */
    public function getAttributeValue(): ?string
    {
        return $this->value;
    }
    /**
     * @param  bool               $nullCheck
     * @return AttributeContainer
     */
    public function setAttributeNullCheck(bool $nullCheck): AttributeContainer
    {
        $this->nullCheck = $nullCheck;
        return $this;
    }

    /**
     * @param  string|null        $value
     * @return AttributeContainer
     */
    public function setAttributeValue(?string $value): AttributeContainer
    {
        $this->value = $value;
        return $this;
    }
    /**
     * AttributeContainer constructor.
     * @param string                $name
     * @param string                $value
     * @param bool                  $nullCheck
     * @param OdataVersions|null    $forVersion
     * @param array|OdataVersions[] $prohibitedVersions
     */
    public function __construct(
        string $name,
        $value,
        bool $nullCheck = false,
        OdataVersions $forVersion = null,
        array $prohibitedVersions = []
    ) {
        $this
            ->setAttributeName($name)
            ->setAttributeForVersion($forVersion)
            ->setAttributeProhibitedVersion($prohibitedVersions)
            ->setAttributeNullCheck($nullCheck)
            ->setAttributeValue($this->strval($value));
    }

    private function strval($value):string
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        return strval($value);
    }


    /**
     * @param  string             $prefix
     * @return AttributeContainer
     */
    public function setAttributePrefix(string $prefix): AttributeContainer
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * @param  string             $name
     * @return AttributeContainer
     */
    public function setAttributeName(string $name): AttributeContainer
    {
        $prefix = null;
        if (strpos($name, ':') !== false) {
            list($prefix, $name) = explode(':', $name);
        }
        $this->name = $name;
        $this->prefix = $prefix;
        return $this;
    }


    /**
     * @param  OdataVersions      $forVersion
     * @return AttributeContainer
     */
    public function setAttributeForVersion(?OdataVersions $forVersion): AttributeContainer
    {
        $this->forVersion = $forVersion;
        return $this;
    }

    /**
     * @param  array              $prohibitedVersion
     * @return AttributeContainer
     */
    public function setAttributeProhibitedVersion(array $prohibitedVersion): AttributeContainer
    {
        $this->prohibitedVersion = $prohibitedVersion;
        return $this;
    }

    public function apply(\DOMElement $node, WriterContext $context)
    {
        if ($this->nullCheck && empty($this->value)) {
            return;
        }
        if (null === $this->prefix) {
            $node->setAttribute($this->name, $this->value);
        } else {
            $node->setAttributeNS($context->getNamespaceForPrefix($this->prefix), $this->prefix . ':' . $this->name, $this->value);
        }
    }
}
