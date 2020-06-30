<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

/**
 * The general shape of a validation visitor is
 *      Visit(IXYZInterface $item, array $followup, array $references): EdmError[]
 * Each visitor may return a null or empty collection of errors.
 * Note that if a visitor returns errors, followup and references will be ignored.
 * @package AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator
 */
abstract class VisitorBase
{
    abstract public function Visit($item, array &$followup, array &$references): iterable;
}
