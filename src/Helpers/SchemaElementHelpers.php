<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;

/**
 * Trait SchemaElementHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 * @mixin ISchemaElement
 */
trait SchemaElementHelpers
{
    public function FullName()
    {
        return ($this->getNamespace() ?? '') . ('.' . $this->getName() ?? '');
    }
}
