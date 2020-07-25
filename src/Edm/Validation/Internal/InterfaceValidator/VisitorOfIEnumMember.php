<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;

class VisitorOfIEnumMember extends VisitorOfT
{
    protected function visitT($member, array &$followup, array &$references): ?iterable
    {
        assert($member instanceof IEnumMember);
        $errors = [];

        $references[] = $member->getDeclaringType();

        $followup[] = $member->getValue();

        return $errors;
    }

    public function forType(): string
    {
        return IEnumMember::class;
    }
}
