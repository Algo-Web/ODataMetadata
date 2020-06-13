<?php


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;

/**
 * Represents a definition of an EDM row type.
 * @package AlgoWeb\ODataMetadata\Library
 */
class EdmRowType extends EdmStructuredType implements IRowType
{
    public function __construct()
    {
        parent::__construct(false, false, null);
    }

    /**
     * @return TypeKind Gets the kind of this type.
     */
    function getTypeKind(): TypeKind
    {
        return TypeKind::Row();
    }
}