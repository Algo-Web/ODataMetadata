<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Edm\Internal\Cache;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Enums\ConcurrencyMode;
use AlgoWeb\ODataMetadata\Enums\PropertyKind;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleBaseToString;

/**
 * Represents a semantically invalid EDM property.
 *
 * @package AlgoWeb\ODataMetadata\Library\Internal\Bad
 */
class BadProperty extends BadElement implements IStructuralProperty
{
    use SimpleBaseToString;
    /**
     * @var string
     */
    private $name;
    /**
     * @var IStructuredType
     */
    private $declaringType;


    // Type cache.
    /**
     * @var Cache
     */
    private $type;

    /**
     * BadProperty constructor.
     * @param IStructuredType $declaringType
     * @param string          $name
     * @param EdmError[]      $errors
     */
    public function __construct(IStructuredType $declaringType, ?string $name, array $errors)
    {
        parent::__construct($errors);
        $this->type          = new Cache(BadProperty::class, ITypeReference::class);
        $this->name          = $name ?? '';
        $this->declaringType = $declaringType;
    }

    /**
     * @return string gets the name of this element
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return PropertyKind gets the kind of this property
     */
    public function getPropertyKind(): PropertyKind
    {
        return PropertyKind::None();
    }

    /**
     * @return ITypeReference|null gets the type of this property
     */
    public function getType(): ?ITypeReference
    {
        return $this->type->getValue($this, [$this, 'computeType']);
    }

    /**
     * @return IStructuredType gets the type that this property belongs to
     */
    public function getDeclaringType(): IStructuredType
    {
        return $this->declaringType;
    }

    /**
     * @return string|null gets the default value of this property
     */
    public function getDefaultValueString(): ?string
    {
        return null;
    }

    /**
     * @return ConcurrencyMode gets the concurrency mode of this property
     */
    public function getConcurrencyMode(): ConcurrencyMode
    {
        return ConcurrencyMode::None();
    }

    private function computeType(): ITypeReference
    {
        return new BadTypeReference(new BadType($this->getErrors()), true);
    }
}
