<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Enums\ConcurrencyMode;

interface IStructuralProperty extends IProperty
{
    /**
     * @return string|null gets the default value of this property
     */
    public function getDefaultValueString(): ?string;

    /**
     * @return ConcurrencyMode gets the concurrency mode of this property
     */
    public function getConcurrencyMode(): ConcurrencyMode;
}
