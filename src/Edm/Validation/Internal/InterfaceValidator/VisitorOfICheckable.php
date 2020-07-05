<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\ICheckable;

final class VisitorOfICheckable extends VisitorOfT
{
    /**
     * @param  ICheckable $item
     * @param  array      $followup
     * @param  array      $references
     * @return iterable
     */
    protected function VisitT($item, array &$followup, array &$references): iterable
    {
        $checkableErrors = [];
        $errors          = [];
        InterfaceValidator::ProcessEnumerable($item, $item->getErrors(), 'Errors', $checkableErrors, $errors);
        return $errors ?? $checkableErrors;
    }

    public function forType(): string
    {
        return ICheckable::class;
    }
}
