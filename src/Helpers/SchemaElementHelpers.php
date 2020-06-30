<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Helpers\Interfaces\ISchemaElementHelpers;

/**
 * Trait SchemaElementHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait SchemaElementHelpers
{
    public function FullName()
    {
        return ($this->getNamespace() ?? '') . ('.' . $this->getName() ?? '');
    }
}
