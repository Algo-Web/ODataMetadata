<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;


use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;

final class VisitorOfIEntityContainer extends VisitorOfT
{

    protected function VisitT($item, array &$followup, array &$references): iterable
    {
        assert($item instanceof IEntityContainer);
        $errors = null;
        InterfaceValidator::ProcessEnumerable($item, $item->getElements(), "Elements", $followup, $errors);
        return $errors;
    }

    public function forType(): string
    {
        return IEntityContainer::class;
    }
}