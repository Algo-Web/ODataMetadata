<?php


namespace AlgoWeb\ODataMetadata\Library\Values;

use AlgoWeb\ODataMetadata\Enums\ValueKind;
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
    /**
     * @var ITypeReference Type of the value.
     */
    private $type;

    /**
     * Initializes a new instance of the EdmValue class.
     *
     * @param ITypeReference $type Type of the value.
     */
    public function __construct(ITypeReference $type)
    {
        $this->type = $type;
    }


    /**
     * @return ITypeReference Gets the type of this value.
     */
    public function getType(): ITypeReference
    {
        return $this->type;
    }

    /**
     * @return ValueKind Gets the kind of this value.
     */
    public abstract function getValueKind(): ValueKind;
}