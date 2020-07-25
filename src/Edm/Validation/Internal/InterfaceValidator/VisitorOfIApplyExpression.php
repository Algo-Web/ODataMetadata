<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IApplyExpression;

/**
 * Visitor Of Function Application Expression.
 * @package AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator
 */
class VisitorOfIApplyExpression extends VisitorOfT
{
    protected function visitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof IApplyExpression);
        $errors = [];

        if (null !== $expression->getAppliedFunction()) {
            $followup[] = $expression->getAppliedFunction();
        } else {
            InterfaceValidator::collectErrors(
                InterfaceValidator::createPropertyMustNotBeNullError(
                    $expression,
                    'AppliedFunction'
                ),
                $errors
            );
        }

        InterfaceValidator::processEnumerable(
            $expression,
            $expression->getArguments(),
            'Arguments',
            $followup,
            $errors
        );

        return $errors;
    }

    public function forType(): string
    {
        return IApplyExpression::class;
    }
}
