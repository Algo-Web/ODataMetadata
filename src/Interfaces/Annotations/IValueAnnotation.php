<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces\Annotations;

use AlgoWeb\ODataMetadata\Helpers\Interfaces\IValueAnnotationHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;

/**
 * Interface IEdmValueAnnotation.
 *
 * Represents an EDM value annotation.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Annotations
 */
interface IValueAnnotation extends IVocabularyAnnotation, IValueAnnotationHelpers
{
    /**
     * @return IExpression gets the expression producing the value of the annotation
     */
    public function getValue(): IExpression;
}
