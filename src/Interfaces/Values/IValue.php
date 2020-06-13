<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces\Values;

use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

/**
 * Interface IValue.
 *
 *  Represents an EDM value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface IValue extends IEdmElement
{
    /**
     * @return ITypeReference gets the type of this value
     */
    public function getType(): ITypeReference;

    /**
     * @return ValueKind gets the kind of this value
     */
    public function getValueKind(): ValueKind;
}
