<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\Interfaces\IEnumTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IType;

/**
 * Trait EnumTypeReferenceHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait EnumTypeReferenceHelpers
{
    /**
     * Gets the definition of this enumeration reference.
     *
     * @return IEnumType the definition of this enumeration reference
     */
    public function EnumDefinition(): IEnumType
    {
        /** @var IEnumTypeReference $this */
        $definition = $this->getDefinition();
        assert($definition instanceof IEnumType, 'Enum Type Reference should always wrap a IEnumType');
        return $definition;
    }

    abstract public function getDefinition(): ?IType;
}
