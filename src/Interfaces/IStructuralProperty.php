<?php


namespace AlgoWeb\ODataMetadata\Interfaces;


use AlgoWeb\ODataMetadata\Enums\ConcurrencyMode;

interface IStructuralProperty extends IProperty
{
    /**
     * @return string|null Gets the default value of this property.
     */
    public function getDefaultValueString(): ?string;

    /**
     * @return ConcurrencyMode Gets the concurrency mode of this property.
     */
    public function getConcurrencyMode(): ConcurrencyMode;

}