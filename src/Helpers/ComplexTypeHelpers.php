<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\IComplexType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;

/**
 * Trait ComplexTypeHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait ComplexTypeHelpers
{
    /**
     * Gets the base type of this references definition.
     *
     * @return IComplexType|null the base type of this references definition
     */
    public function baseComplexType(): ?IComplexType
    {
        /** @var IComplexType $this */
        $base = $this->getBaseType();
        assert(null === $base || $base instanceof IComplexType, 'the base type of a complex type should always be another complex type');
        return $base;
    }

    /**
     * Gets the base type of this type.
     *
     * @return IStructuredType|null
     */
    abstract public function getBaseType(): ?IStructuredType;
}
