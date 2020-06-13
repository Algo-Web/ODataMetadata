<?php


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\Interfaces\IEnumTypeReference;

/**
 * Trait EnumTypeReferenceHelpers
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait EnumTypeReferenceHelpers
{
    /**
     * Gets the definition of this enumeration reference.
     *
     * @return IEnumType The definition of this enumeration reference.
     */
    public function EnumDefinition(): IEnumType
    {
        /**
         * @var IEnumTypeReference $this;
         */
        $definition = $this->getDefinition();
        assert($definition instanceof IEnumType, 'Enum Type Reference should always wrap a IEnumType');
        return $definition;
    }

}