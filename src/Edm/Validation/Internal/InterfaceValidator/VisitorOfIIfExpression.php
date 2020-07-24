<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIfExpression;

class VisitorOfIIfExpression extends VisitorOfT
{
    protected function VisitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof IIfExpression);
        $errors = [];

        $followup[] = $expression->getTestExpression();

        $followup[] = $expression->getTrueExpression();

        $followup[] = $expression->getFalseExpression();

        return $errors;
    }

    public function forType(): string
    {
        return IIfExpression::class;
    }
}
