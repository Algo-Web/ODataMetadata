<?php


namespace AlgoWeb\ODataMetadata\Library;


use AlgoWeb\ODataMetadata\Interfaces\IDecimalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;

class EdmDecimalTypeReference extends EdmPrimitiveTypeReference implements IDecimalTypeReference
{
    private $precision;
    private $scale;

    /**
     * Initializes a new instance of the EdmDecimalTypeReference class.
     * @param IPrimitiveType $definition The type this reference refers to.
     * @param bool $isNullable Denotes whether the type can be nullable.
     * @param int|null $precision Precision of values with this type.
     * @param int|null $scale Scale of values with this type.
     */
    public function __construct(IPrimitiveType $definition, bool $isNullable, ?int $precision = null, ?int $scale = null)
    {
        parent::__construct($definition, $isNullable);
        $this->precision = $precision;
        $this->scale = $scale;
    }

    /**
     * @return int|null Gets the precision of this type.
     */
    public function getPrecision(): ?int
    {
        return $this->precision;
    }

    /**
     * @return int|null Gets the scale of this type.
     */
    public function getScale(): ?int
    {
        return $this->scale;
    }
}