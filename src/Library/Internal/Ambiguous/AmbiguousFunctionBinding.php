<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Internal\Ambiguous;

use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Helpers\FunctionImportHelpers;
use AlgoWeb\ODataMetadata\Helpers\SchemaElementHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

class AmbiguousFunctionBinding extends AmbiguousBinding implements IFunction
{
    use SchemaElementHelpers, FunctionImportHelpers;

    public function __construct(IFunction $first, IFunction $second)
    {
        parent::__construct($first, $second);
    }


    /**
     * Gets the defining expression of this function.
     *
     * @return string
     */
    public function getDefiningExpression(): string
    {
        return null;
    }

    /**
     * Gets the return type of this function.
     *
     * @return ITypeReference
     */
    public function getReturnType(): ITypeReference
    {
        return null;
    }

    /**
     * Gets the collection of parameters for this function.
     *
     * @return IFunctionParameter[]
     */
    public function getParameters(): array
    {
        /**
         * @var IFunction[] $bindings
         */
        $bindings = $this->getBindings();
        return count($bindings) === 0 ? [] : $bindings[0]->getParameters();
    }

    /**
     * Searches for a parameter with the given name, and returns null if no such parameter exists.
     *
     * @param  string             $name the name of the parameter being found
     * @return IFunctionParameter the requested parameter or null if no such parameter exists
     */
    public function findParameter(string $name): ?IFunctionParameter
    {
        /**
         * @var IFunction[] $bindings
         */
        $bindings = $this->getBindings();
        return count($bindings) === 0 ? null : $bindings[0]->findParameter($name);
    }

    /**
     * Gets the kind of this schema element.
     *
     * @return SchemaElementKind
     */
    public function getSchemaElementKind(): SchemaElementKind
    {
        return SchemaElementKind::Function();
    }

    /**
     * Gets the namespace this schema element belongs to.
     *
     * @return string
     */
    public function getNamespace(): string
    {
        /**
         * @var IFunction[] $bindings
         */
        $bindings = $this->getBindings();
        return count($bindings) === 0 ? '' : $bindings[0]->getNamespace();
    }
}
