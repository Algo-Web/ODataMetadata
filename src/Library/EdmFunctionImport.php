<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Enums\ContainerElementKind;
use AlgoWeb\ODataMetadata\Helpers\FunctionImportHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

class EdmFunctionImport extends EdmFunctionBase implements IFunctionImport
{
    use FunctionImportHelpers;
    /**
     * @var IEntityContainer
     */
    private $container;
    /**
     * @var IExpression
     */
    private $entitySet;
    /**
     * @var bool
     */
    private $isSideEffecting;
    /**
     * @var bool
     */
    private $isComposable;
    /**
     * @var bool
     */
    private $isBindable;

    public function __construct(IEntityContainer $container, string $name, ?ITypeReference $returnType, IExpression $entitySet = null, bool $isSideEffecting = true, bool $isComposable = false, bool $isBindable = false)
    {
        parent::__construct($name, $returnType);
        $this->container       = $container;
        $this->entitySet       = $entitySet;
        $this->isBindable      = $isBindable;
        $this->isComposable    = $isComposable;
        $this->isSideEffecting = $isSideEffecting;
    }

    /**
     * @return ContainerElementKind gets the kind of element of this container element
     */
    public function getContainerElementKind(): ContainerElementKind
    {
        return ContainerElementKind::FunctionImport();
    }

    /**
     * @return IEntityContainer|null gets the container that contains this element
     */
    public function getContainer(): ?IEntityContainer
    {
        return $this->container;
    }

    /**
     * @return bool Gets a value indicating whether this function import has side-effects.
     *              isSideEffecting cannot be return true if isComposable also returns true
     */
    public function isSideEffecting(): bool
    {
        return $this->isSideEffecting;
    }

    /**
     * @return bool gets a value indicating whether this functon import can be composed inside expressions
     */
    public function isComposable(): bool
    {
        return $this->isComposable;
    }

    /**
     * @return bool gets a value indicating whether this function import can be used as an extension method for the
     *              type of the first parameter of this function import
     */
    public function isBindable(): bool
    {
        return $this->isBindable;
    }

    /**
     * @return IExpression gets the entity set containing entities returned by this function import
     */
    public function getEntitySet(): IExpression
    {
        return $this->entitySet;
    }
}
