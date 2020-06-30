<?php

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;


use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;

/**
 * Trait ValueAnnotationHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface IValueAnnotationHelpers
{
    /**
     * Gets the value term of this value annotation.
     *
     * @return IValueTerm The value term of this value annotation
     */
    public function ValueTerm(): IValueTerm;
}