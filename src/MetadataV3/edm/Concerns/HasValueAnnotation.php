<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Annotations\ValueAnnotation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use DOMElement;

/**
 * Class HasValueAnnotation
 * @package AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns
 * @mixin EdmBase
 */
trait HasValueAnnotation
{
    /**
     * @var ValueAnnotation[] $valueAnnotation
     */
    private $valueAnnotation = [];

    /**
     * Adds as valueAnnotation
     *
     * @param ValueAnnotation $valueAnnotation
     *@return self
     */
    public function addToValueAnnotation(ValueAnnotation $valueAnnotation)
    {
        $this->valueAnnotation[] = $valueAnnotation;
        return $this;
    }

    /**
     * isset valueAnnotation
     *
     * @param int $index
     * @return bool
     */
    public function issetValueAnnotation(int $index): bool
    {
        return isset($this->valueAnnotation[$index]);
    }

    /**
     * unset valueAnnotation
     *
     * @param int $index
     * @return void
     */
    public function unsetValueAnnotation(int $index)
    {
        unset($this->valueAnnotation[$index]);
    }

    /**
     * Gets as valueAnnotation
     *
     * @return ValueAnnotation[]
     */
    public function getValueAnnotation(): array
    {
        return $this->valueAnnotation;
    }

    /**
     * Sets a new valueAnnotation
     *
     * @param ValueAnnotation[] $valueAnnotation
     * @return self
     */
    public function setValueAnnotation(array $valueAnnotation): self
    {
        $this->valueAnnotation = $valueAnnotation;
        return $this;
    }
    public function XmlSerializeHasValueAnnotation(DOMElement $thisNode): void
    {
        //TODO: add conext version check
        foreach ($this->getValueAnnotation() as $annotation) {
            $annotation->XmlSerialize($thisNode);
        }
    }
}
