<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Enums\ConcurrencyMode;
use AlgoWeb\ODataMetadata\Enums\PropertyKind;
use AlgoWeb\ODataMetadata\Helpers\VocabularyAnnotatableHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

/**
 * Represents an EDM structural (i.e. non-navigation) property.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
class EdmStructuralProperty extends EdmProperty implements IStructuralProperty
{
    use VocabularyAnnotatableHelpers;
    /**
     * @var string|null
     */
    private $defaultValueString;
    /**
     * @var ConcurrencyMode
     */
    private $concurrencyMode;

    /**
     * Initializes a new instance of the EdmStructuralProperty class.
     *
     * @param IStructuredType      $declaringType      the type that declares this property
     * @param string               $name               name of the property
     * @param ITypeReference       $type               the type of the property
     * @param string|null          $defaultValueString the default value of this property
     * @param ConcurrencyMode|null $concurrencyMode    the concurrency mode of this property
     */
    public function __construct(IStructuredType $declaringType, string $name, ITypeReference $type, string $defaultValueString = null, ConcurrencyMode $concurrencyMode = null)
    {
        parent::__construct($declaringType, $name, $type);
        $this->defaultValueString = $defaultValueString;
        $this->concurrencyMode    = $concurrencyMode ?? ConcurrencyMode::None();
    }

    /**
     * @return PropertyKind gets the kind of this property
     */
    public function getPropertyKind(): PropertyKind
    {
        return PropertyKind::Structural();
    }

    /**
     * @return string gets the default value of this property
     */
    public function getDefaultValueString(): ?string
    {
        return $this->defaultValueString;
    }

    /**
     * @return ConcurrencyMode gets the concurrency mode of this property
     */
    public function getConcurrencyMode(): ConcurrencyMode
    {
        return $this->concurrencyMode;
    }
}
