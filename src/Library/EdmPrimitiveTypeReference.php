<?php


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Helpers\PrimitiveTypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IType;

class EdmPrimitiveTypeReference extends EdmTypeReference implements IPrimitiveTypeReference
{
    use PrimitiveTypeReferenceHelpers;

    /**
     * @return bool Gets a value indicating whether this type is nullable.
     */
    public function getNullable(): bool
    {
        return parent::getNullable();
    }

    /**
     * @return IPrimitiveType|null Gets the definition to which this type refers.
     */
    public function getDefinition(): ?IType
    {
        $def = parent::getDefinition();
        assert(null === $def || $def instanceof IPrimitiveType, 'All primitive type reference should reference primate types');
        return $def;
    }
}