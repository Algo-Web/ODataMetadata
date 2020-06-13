<?php


namespace AlgoWeb\ODataMetadata\Library;


use AlgoWeb\ODataMetadata\Helpers\ToTraceString;
use AlgoWeb\ODataMetadata\Helpers\TypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

/**
 * Represents a reference to an EDM type.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
abstract class EdmTypeReference extends EdmElement implements ITypeReference
{
    use TypeReferenceHelpers;

    private $definition;
    private $isNullable;

    /**
     * Initializes a new instance of the EdmTypeReference class.
     *
     * @param IType $definition Type that describes this value.
     * @param bool $isNullable Denotes whether the type can be nullable.
     */
    public function __construct(IType $definition, bool $isNullable)
    {
        $this->definition = $definition;
        $this->isNullable = $isNullable;
    }

    /**
     * @return bool Gets a value indicating whether this type is nullable.
     */
    public function getNullable(): bool
    {
        return $this->isNullable;
    }

    /**
     * @return IType|null Gets the definition to which this type refers.
     */
    public function getDefinition(): ?IType
    {
        return $this->definition;
    }

    public function __toString():string
    {
        return ToTraceString::ToTraceString($this);
    }
}