<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Enums\TermKind;

/**
 * Interface IEdmTerm.
 *
 * Term to which an annotation can bind.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface ITerm extends ISchemaElement
{
    /**
     * Gets the kind of a term.
     *
     * @return TermKind
     */
    public function getTermKind(): TermKind;
}
