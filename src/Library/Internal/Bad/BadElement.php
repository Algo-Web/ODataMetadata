<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Helpers\EdmElementHelpers;
use AlgoWeb\ODataMetadata\Helpers\VocabularyAnnotatableHelpers;
use AlgoWeb\ODataMetadata\Interfaces\ICheckable;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;

/**
 *  Represents an invalid EDM element.
 * @package AlgoWeb\ODataMetadata\Library\Internal
 */
class BadElement implements IEdmElement, ICheckable, IVocabularyAnnotatable
{
    use EdmElementHelpers;
    use VocabularyAnnotatableHelpers;

    /**
     * BadElement constructor.
     * @param EdmError[] $errors
     */
    public function __construct(iterable $errors)
    {
        $this->errors = $errors;
    }
}
