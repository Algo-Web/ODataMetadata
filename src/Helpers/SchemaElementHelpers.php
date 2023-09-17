<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers;

/**
 * Trait SchemaElementHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait SchemaElementHelpers
{
    public function fullName(): string
    {
        return ($this->getNamespace() ?? '') . ('.' . $this->getName() ?? '');
    }

    /**
     * @return string|null gets the name of this element
     */
    abstract public function getName(): ?string;

    /**
     * @return string|null gets the namespace this schema element belongs to
     */
    abstract public function getNamespace(): ?string;
}
