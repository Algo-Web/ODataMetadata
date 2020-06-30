<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Helpers\StructuredTypeHelpers;
use AlgoWeb\ODataMetadata\Interfaces\ICheckable;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;

/**
 * Represents a semantically invalid EDM structured type definition.
 *
 * @package AlgoWeb\ODataMetadata\Library\Internal\Bad
 */
abstract class BadStructuredType extends BadType implements IStructuredType, ICheckable
{
    use StructuredTypeHelpers;
    /**
     * BadStructuredType constructor.
     * @param EdmError[] $errors
     */
    public function __construct(array $errors)
    {
        parent::__construct($errors);
    }

    /**
     * @return bool gets a value indicating whether this type is abstract
     */
    public function isAbstract(): bool
    {
        return false;
    }

    /**
     * @return bool gets a value indicating whether this type is open
     */
    public function isOpen(): bool
    {
        return false;
    }

    /**
     * @return IStructuredType|null gets the base type of this type
     */
    public function getBaseType(): ?IStructuredType
    {
        return null;
    }

    /**
     * @return IProperty[] gets the properties declared immediately within this type
     */
    public function getDeclaredProperties(): array
    {
        return [];
    }

    /**
     * Searches for a structural or navigation property with the given name in this type and all base types and returns
     * null if no such property exists.
     *
     * @param  string         $name the name of the property being found
     * @return IProperty|null the requested property, or null if no such property exists
     */
    public function findProperty(string $name): ?IProperty
    {
        return null;
    }
}
