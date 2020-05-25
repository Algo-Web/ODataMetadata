<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Documentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;

/**
 * Trait HasDocumentation.
 * @package AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns
 * @mixin EdmBase
 */
trait HasDocumentation
{
    /**
     * @var Documentation|null $documentation
     */
    private $documentation = null;

    /**
     * Gets as documentation.
     *
     * @return null|Documentation
     */
    public function getDocumentation(): ?Documentation
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation.
     *
     * @param  Documentation|null $documentation
     * @return self
     */
    public function setDocumentation(?Documentation $documentation): self
    {
        $this->documentation = $documentation;
        return $this;
    }

    public function XmlSerializeHasDocumentation(\DOMElement $thisNode)
    {
        null !== $this->getDocumentation() && $this->getDocumentation()->XmlSerialize($thisNode);
    }
}
