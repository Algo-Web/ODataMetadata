<?php


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Interfaces\ICheckable;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleICheckable;

/**
 *  Represents an invalid EDM element.
 * @package AlgoWeb\ODataMetadata\Library\Internal
 */
class BadElement implements IEdmElement, ICheckable, IVocabularyAnnotatable
{
    use SimpleICheckable;

    /**
     * BadElement constructor.
     * @param EdmError[] $errors
     */
    public function __construct(array $errors)
    {
        $this->errors = $errors;
    }
}