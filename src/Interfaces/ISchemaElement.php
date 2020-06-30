<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Helpers\Interfaces\ISchemaElementHelpers;
use AlgoWeb\ODataMetadata\Helpers\SchemaElementHelpers;

/**
 * Interface IEdmSchemaElement.
 *
 * Common base interface for all named children of EDM schemata.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface ISchemaElement extends INamedElement, IVocabularyAnnotatable, ISchemaElementHelpers
{
    /**
     * @return SchemaElementKind gets the kind of this schema element
     */
    public function getSchemaElementKind(): SchemaElementKind;

    /**
     * @return string gets the namespace this schema element belongs to
     */
    public function getNamespace(): string;
}
