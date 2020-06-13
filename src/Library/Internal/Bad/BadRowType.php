<?php


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;


use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;

/**
 *  Represents a semantically invalid EDM row type.
 *
 * @package AlgoWeb\ODataMetadata\Library\Internal\Bad
 */
class BadRowType extends BadStructuredType implements IRowType
{
    public function getTypeKind(): TypeKind
    {
        return TypeKind::Row();
    }

}