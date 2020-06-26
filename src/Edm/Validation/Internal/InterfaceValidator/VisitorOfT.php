<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

/**
 * !!! children are final classes to prevent any mocking.
 * @package AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator
 */
abstract class VisitorOfT
{
    public function Visit($item, array &$followup, array &$references):iterable
    {
        assert(is_a($item, $this->forType()));
        return $this->VisitT($item, $followup, $references);
    }

    protected abstract function VisitT($item, array &$followup, array &$references):iterable;

    abstract public function forType():string;
}