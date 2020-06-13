<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Internal\Ambiguous;

use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainerElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;

class AmbiguousEntityContainerBinding extends AmbiguousBinding implements IEntityContainer
{
    private $namespaceName;

    public function __construct(IEntityContainer $first, IEntityContainer $second)
    {
        parent::__construct($first, $second);
        // Ambiguous entity containers can be produced by either searching for full name or simple name.
        // This results in the reported NamespaceName being ambiguous so the first one is selected arbitrarily.
        $this->namespaceName = $first->getNamespace() ?? '';
    }

    /**
     * Gets a collection of the elements of this entity container.
     *
     * @return array|IEntityContainerElement[]
     */
    public function getElements(): array
    {
        return [];
    }

    /**
     *  Searches for an entity set with the given name in this entity container and returns null if no such set exists.
     *
     * @param  string          $setName The name of the element being found
     * @return IEntitySet|null the requested element, or null if the element does not exist
     */
    public function findEntitySet(string $setName): ?IEntitySet
    {
        return null;
    }

    /**
     * Searches for function imports with the given name in this entity container and returns empty enumerable if no
     * such function import exists.
     *
     * @param  string                  $functionName the name of the function import being found
     * @return array|IFunctionImport[] a group of the requested function imports, or an empty enumerable if no such function import exists
     */
    public function findFunctionImports(string $functionName): array
    {
        return null;
    }

    /**
     * Gets the kind of this schema element.
     *
     * @return SchemaElementKind
     */
    public function getSchemaElementKind(): SchemaElementKind
    {
        return SchemaElementKind::EntityContainer();
    }

    /**
     * Gets the namespace this schema element belongs to.
     *
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespaceName;
    }
}
