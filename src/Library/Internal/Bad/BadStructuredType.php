<?php


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
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
    /**
     * BadStructuredType constructor.
     * @param EdmError[] $errors
     */
    public function __construct(array $errors)
    {
        parent::__construct($errors);
    }

    /**
     * @return bool Gets a value indicating whether this type is abstract.
     */
    public function isAbstract(): bool
    {
        return false;
    }

    /**
     * @return bool Gets a value indicating whether this type is open.
     */
    public function isOpen(): bool
    {
        return false;
    }

    /**
     * @return IStructuredType|null Gets the base type of this type.
     */
    public function getBaseType(): ?IStructuredType
    {
        return null;
    }

    /**
     * @return IProperty[] Gets the properties declared immediately within this type.
     */
    public function getDeclaredProperties(): array
    {
        return [];
    }

    /**
     * Searches for a structural or navigation property with the given name in this type and all base types and returns
     * null if no such property exists.
     *
     * @param string $name The name of the property being found.
     * @return IProperty|null The requested property, or null if no such property exists.
     */
    public function findProperty(string $name): ?IProperty
    {
        return null;
    }
}