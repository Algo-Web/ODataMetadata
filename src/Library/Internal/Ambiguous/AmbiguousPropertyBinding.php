<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Internal\Ambiguous;

use AlgoWeb\ODataMetadata\Enums\PropertyKind;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadType;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadTypeReference;

class AmbiguousPropertyBinding extends AmbiguousBinding implements IProperty
{
    /**
     * @var IStructuredType
     */
    private $declaringType;

    public function __construct(IStructuredType $declaringType, IProperty $first, IProperty $second)
    {
        parent::__construct($first, $second);
        $this->declaringType = $declaringType;
    }

    /**
     * Gets the kind of this property.
     *
     * @return PropertyKind
     */
    public function getPropertyKind(): PropertyKind
    {
        return PropertyKind::None();
    }

    /**
     * Gets the type of this property.
     *
     * @return ITypeReference|null
     */
    public function getType(): ?ITypeReference
    {
        return new BadTypeReference(new BadType($this->getErrors()), true);
    }

    /**
     * Gets the type that this property belongs to.
     *
     * @return IStructuredType
     */
    public function getDeclaringType(): IStructuredType
    {
        return $this->declaringType;
    }
}
