<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;

use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;

/**
 * Trait FunctionImportHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface IFunctionImportHelpers
{
    /**
     * Analyzes IFunctionImport::EntitySet expression and returns a static IEdmEntitySet reference if available.
     *
     * @param  IEntitySet|null $entitySet the static entity set of the function import
     * @return bool            true if the entity set expression of the functionImport contains a static reference to
     *                                   an IEntitySet, otherwise false
     */
    public function TryGetStaticEntitySet(IEntitySet &$entitySet = null): bool;

    /**
     * Analyzes IFunctionImport::EntitySet expression and returns a relative path to an IEntitySet if available.
     * The path starts with the parameter and may have optional sequence of NavigationProperty and type casts segments.
     *
     * @param  IModel                     $model     the model containing the function import
     * @param  IFunctionParameter|null    $parameter the function import parameter from which the relative entity set
     *                                               path starts
     * @param  INavigationProperty[]|null $path      the optional sequence of navigation properties
     * @return bool                       true if the entity set expression of the functionImport contains a relative
     *                                              path an IEntitySet, otherwise false
     */
    public function TryGetRelativeEntitySetPath(
        IModel $model,
        IFunctionParameter &$parameter = null,
        array &$path = null
    ): bool;
}
