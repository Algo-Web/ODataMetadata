<?php


namespace AlgoWeb\ODataMetadata\Library;


use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;

class EdmTemporalTypeReference extends EdmPrimitiveTypeReference implements ITemporalTypeReference
{
    /**
     * @var int|null
     */
    private $precision;

    /**
     * Initializes a new instance of the EdmTemporalTypeReference class.
     *
     * @param IPrimitiveType $definition The type this reference refers to.
     * @param bool $isNullable Denotes whether the type can be nullable.
     * @param int|null $precision Precision of values with this type.
     */
    public function __construct(IPrimitiveType $definition, bool $isNullable, ?int $precision = null)
    {
        parent::__construct($definition, $isNullable);
        $this->precision = $precision;
    }

    /**

     * @return int|null Gets the precision of this temporal type.
     */
    public function getPrecision(): ?int
    {
        return $this->precision;
    }
}