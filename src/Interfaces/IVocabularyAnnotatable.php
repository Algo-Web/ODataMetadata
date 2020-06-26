<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\VocabularyAnnotatableHelpers;

/**
 * Interface IEdmVocabularyAnnotatable.
 *
 * Represents an element that can be targeted by Vocabulary Annotations
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 * @mixin VocabularyAnnotatableHelpers
 */
interface IVocabularyAnnotatable extends IEdmElement
{
}
