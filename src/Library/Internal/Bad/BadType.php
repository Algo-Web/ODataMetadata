<?php


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;


use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleBaseToString;

class BadType extends BadElement implements IType
{
    use SimpleBaseToString;
    public function __construct(array $errors)
    {
        parent::__construct($errors);
    }

    /**
     * @return TypeKind Gets the kind of this type.
     */
    public function getTypeKind(): TypeKind
    {
        return TypeKind::None();
    }
}