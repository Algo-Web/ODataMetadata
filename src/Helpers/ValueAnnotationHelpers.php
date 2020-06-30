<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Helpers\Interfaces\IValueAnnotationHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;

/**
 * Trait ValueAnnotationHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait ValueAnnotationHelpers
{
    /**
     * Gets the value term of this value annotation.
     *
     * @return IValueTerm The value term of this value annotation
     */
    public function ValueTerm(): IValueTerm
    {
        $term = $this->getTerm();
        assert($term instanceof IValueTerm, 'Value Annotations should always use value terms');
        return $term;
    }
}
