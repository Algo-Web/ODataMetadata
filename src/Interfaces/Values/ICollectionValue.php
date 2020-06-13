<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Values;

/**
 * Interface ICollectionValue
 *
 * Represents an EDM collection value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface ICollectionValue extends  IValue
{
    /**
     * @return IDelayedValue[] Gets the values stored in this collection.
     */
    public function getElements(): array;
}