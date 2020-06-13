<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Helpers\EntityContainerHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainerElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;

/**
 * Represents a semantically invalid EDM entity container.
 *
 * @package AlgoWeb\ODataMetadata\Library\Internal\Bad
 */
class BadEntityContainer extends BadElement implements IEntityContainer
{
    use EntityContainerHelpers;
    private $namespaceName;
    private $name;
    public function __construct(?string $qualifiedName, array $errors)
    {
        parent::__construct($errors);
        $qualifiedName = $qualifiedName ?? '';
        EdmUtil::TryGetNamespaceNameFromQualifiedName($qualifiedName, $this->namespaceName, $this->name);
    }

    /**
     * @return array|IEntityContainerElement[] gets a collection of the elements of this entity container
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
     * @return string gets the name of this element
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return SchemaElementKind gets the kind of this schema element
     */
    public function getSchemaElementKind(): SchemaElementKind
    {
        return SchemaElementKind::EntityContainer();
    }

    /**
     * @return string gets the namespace this schema element belongs to
     */
    public function getNamespace(): string
    {
        return $this->namespaceName;
    }
}
