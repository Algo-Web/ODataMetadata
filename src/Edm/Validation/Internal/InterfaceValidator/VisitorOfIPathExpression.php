<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPathExpression;

class VisitorOfIPathExpression extends VisitorOfT
{
    protected function VisitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof IPathExpression);
        $errors = null;

        $segments = [];
        InterfaceValidator::ProcessEnumerable($expression, $expression->getPath(), 'Path', $segments, $errors);

        return $errors;
    }

    public function forType(): string
    {
        return IPathExpression::class;
    }
}
