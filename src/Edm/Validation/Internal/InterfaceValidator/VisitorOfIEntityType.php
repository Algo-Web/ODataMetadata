<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;

final class VisitorOfIEntityType extends VisitorOfT
{
    protected function VisitT($type, array &$followup, array &$references): iterable
    {
        assert($type instanceof IEntityType);
        $errors = null;
        if ($type->getDeclaredKey() != null) {
            InterfaceValidator::ProcessEnumerable($type, $type->getDeclaredKey(), 'DeclaredKey', $references, $errors);
        }

        return $errors;
    }

    public function forType(): string
    {
        return IEntityType::class;
    }
}
