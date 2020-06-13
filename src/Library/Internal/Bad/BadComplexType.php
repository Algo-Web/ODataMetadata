<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Enums\TermKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Interfaces\IComplexType;

class BadComplexType extends BadNamedStructuredType implements IComplexType
{
    public function __construct(?string $qualifiedName, array $errors)
    {
        parent::__construct($qualifiedName, $errors);
    }

    public function getTypeKind(): TypeKind
    {
        return TypeKind::Complex();
    }

    public function getTermKind(): TermKind
    {
        return TermKind::Type();
    }
}
