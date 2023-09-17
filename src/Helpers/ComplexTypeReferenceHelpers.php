<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\IComplexType;
use AlgoWeb\ODataMetadata\Interfaces\IComplexTypeReference;

/**
 * Class ComplexTypeReferenceHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait ComplexTypeReferenceHelpers
{
    /**
     * Gets the definition of this reference typed as an IComplexTypeDefinition.
     *
     * @return IComplexType The definition of this reference
     */
    public function complexDefinition(): IComplexType
    {
        /** @var IComplexTypeReference $this */
        $definition = $this->getDefinition();
        assert($definition instanceof IComplexType, 'ComplexType References should always wrap a complex type');
        return $definition;
    }

    /**
     * Gets the base type of this reference.
     *
     * @return IComplexType the base type of this reference
     */
    public function baseComplexType(): IComplexType
    {
        return $this->complexDefinition()->baseComplexType();
    }
}
