<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;

final class VisitorOfIEdmElement extends VisitorOfT
{
    protected function visitT($item, array &$followup, array &$references): ?iterable
    {
        return null;
    }

    public function forType(): string
    {
        return IEdmElement::class;
    }
}
