<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns;

use AlgoWeb\ODataMetadata\Helpers\ToTraceString;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;

trait SimpleBaseToString
{
    public function __toString(): string
    {
        /** @var SimpleICheckable|IEdmElement $self */
        $self = $this;
        assert(count($self->errors) !== 0);
        $error = $self->errors[0];
        assert($error !== null, 'error != null');
        $prefix = $error != null ?
            $error->getErrorCode()->getKey() . ':' . $error->getErrorCode()->getValue() . ':' : '';
        return $prefix . ToTraceString::ToTraceString($self);
    }
}
