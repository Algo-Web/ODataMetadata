<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns;

use AlgoWeb\ODataMetadata\Helpers\ToTraceString;
use AlgoWeb\ODataMetadata\Interfaces\ICheckable;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;

trait SimpleBaseToString
{
    public function __toString(): string
    {
        /** @var ICheckable|IEdmElement $self */
        $self = $this;
        $errors = $self->getErrors();
        assert(count($errors) !== 0);
        $error = $errors[0];
        assert(null !== $error, 'error != null');
        $prefix = null !== $error ?
            strval($error->getErrorCode()->getKey()) . ':' . $error->getErrorCode()->getValue() . ':' : '';
        return $prefix . ToTraceString::ToTraceString($self);
    }
}
