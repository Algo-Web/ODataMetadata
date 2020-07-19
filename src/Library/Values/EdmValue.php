<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Values;

use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Helpers\EdmElementHelpers;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\Values\IDelayedValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IValue;

/**
 * Represents an EDM value.
 *
 * @package AlgoWeb\ODataMetadata\Library\Values
 */
abstract class EdmValue implements IValue, IDelayedValue
{
    use EdmElementHelpers;
    /**
     * @var ITypeReference type of the value
     */
    private $type;

    /**
     * Initializes a new instance of the EdmValue class.
     *
     * @param ITypeReference $type type of the value
     */
    public function __construct(?ITypeReference $type)
    {
        $this->type = $type;
    }


    /**
     * @return ITypeReference gets the type of this value
     */
    public function getType(): ?ITypeReference
    {
        return $this->type;
    }

    /**
     * @return ValueKind gets the kind of this value
     */
    abstract public function getValueKind(): ValueKind;

public function getValue()
{
    return $this;
}
}
