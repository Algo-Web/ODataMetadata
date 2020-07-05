<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Internal\Ambiguous;

use AlgoWeb\ODataMetadata\Enums\ContainerElementKind;
use AlgoWeb\ODataMetadata\Helpers\FunctionImportHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

class AmbiguousFunctionImportBinding extends AmbiguousBinding implements IFunctionImport
{
    use FunctionImportHelpers;

    public function __construct(IFunctionImport $first, IFunctionImport $second)
    {
        parent::__construct($first, $second);
    }

    /**
     * Gets the kind of element of this container element.
     *
     * @return ContainerElementKind
     */
    public function getContainerElementKind(): ContainerElementKind
    {
        return ContainerElementKind::FunctionImport();
    }

    /**
     *  Gets the container that contains this element.
     *
     * @return IEntityContainer|null
     */
    public function getContainer(): ?IEntityContainer
    {
        /** @var IFunctionImport[] $bindings */
        $bindings = $this->getBindings();
        return count($bindings) === 0 ? null : $bindings[0]->getContainer();
    }

    /**
     * Gets the return type of this function.
     *
     * @return ITypeReference
     */
    public function getReturnType(): ?ITypeReference
    {
        return null;
    }

    /**
     * Gets the collection of parameters for this function.
     *
     * @return IFunctionParameter[]|null
     */
    public function getParameters(): ?array
    {
        /** @var IFunctionImport[] $bindings */
        $bindings = $this->getBindings();
        return count($bindings) === 0 ? null : $bindings[0]->getParameters();
    }

    /**
     * Searches for a parameter with the given name, and returns null if no such parameter exists.
     *
     * @param  string                  $name the name of the parameter being found
     * @return IFunctionParameter|null the requested parameter or null if no such parameter exists
     */
    public function findParameter(string $name): ?IFunctionParameter
    {
        /** @var IFunctionImport[] $bindings */
        $bindings = $this->getBindings();
        return count($bindings) === 0 ? null : $bindings[0]->findParameter($name);
    }

    /**
     *  Gets a value indicating whether this function import has side-effects.
     *  isSideEffecting cannot be return true if isComposable  also returns true.
     * @return bool
     */
    public function isSideEffecting(): bool
    {
        return true;
    }

    /**
     * Gets a value indicating whether this function import can be composed inside expressions.
     *
     * @return bool
     */
    public function isComposable(): bool
    {
        return false;
    }

    /**
     * Gets a value indicating whether this function import can be used as an extension method for the type of the
     * first parameter of this function import.
     *
     * @return bool
     */
    public function isBindable(): bool
    {
        return false;
    }

    /**
     * Gets the entity set containing entities returned by this function import.
     *
     * @return IExpression|null
     */
    public function getEntitySet(): ?IExpression
    {
        return null;
    }
}
