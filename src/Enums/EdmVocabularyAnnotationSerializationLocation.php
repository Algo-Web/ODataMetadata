<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Represents whether a vocabulary annotation should be serialized within the element it applies to or in a
 * separate section of the CSDL.
 *
 * @package AlgoWeb\ODataMetadata\Enums
 */
class EdmVocabularyAnnotationSerializationLocation extends Enum
{
    /**
     * The annotation should be serialized within the element being annotated.
     */
    protected const Inline = 1;
    /**
     * The annotation should be serialized in a separate section.
     */
    protected const OutOfLine = 2;
}
