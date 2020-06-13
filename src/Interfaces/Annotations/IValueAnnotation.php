<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Annotations;

use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;

/**
 * Interface IEdmValueAnnotation
 *
 * Represents an EDM value annotation.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Annotations
 */
interface IValueAnnotation extends IVocabularyAnnotation
{
    /**
     * @return IExpression Gets the expression producing the value of the annotation.
     */
    public function getValue(): IExpression;
}