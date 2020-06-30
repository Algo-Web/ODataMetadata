<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Helpers\EdmElementHelpers;
use AlgoWeb\ODataMetadata\Helpers\VocabularyAnnotatableHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;

/**
 *  Common base class for all EDM elements.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
abstract class EdmElement implements IEdmElement
{
    use EdmElementHelpers;
}
