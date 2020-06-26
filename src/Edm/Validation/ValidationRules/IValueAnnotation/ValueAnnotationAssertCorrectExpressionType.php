<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IValueAnnotation;


use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Util\ExpressionTypeChecker;

/**
 * Validates that if a value annotation declares a type, the expression for that annotation has the correct type.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IValueAnnotation
 */
class ValueAnnotationAssertCorrectExpressionType extends ValueAnnotationRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $annotation)
    {
        assert($annotation instanceof IValueAnnotation);
        $errors = null;
        $term = $annotation->getTerm();
        assert($term instanceof IValueTerm);
        if (!ExpressionTypeChecker::tryAssertType( $annotation->getValue(),$term->getType(), $errors))
        {
            foreach ($errors as $error)
            {
                $context->AddRawError($error);
            }
        }
    }
}