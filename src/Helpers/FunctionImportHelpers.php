<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPathExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;

/**
 * Trait FunctionImportHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait FunctionImportHelpers
{
    /**
     * Analyzes IFunctionImport::EntitySet expression and returns a static IEdmEntitySet reference if available.
     *
     * @param  IEntitySet $entitySet the static entity set of the function import
     * @return bool       true if the entity set expression of the functionImport contains a static reference to an IEntitySet, otherwise false
     */
    public function tryGetStaticEntitySet(IEntitySet &$entitySet = null): bool
    {
        /** @var IFunctionImport $this */
        $entitySetReference = $this->getEntitySet();
        $entitySet          = ($entitySetReference !== null && $entitySetReference instanceof IEntitySet) ? $entitySetReference : null;
        return $entitySet !== null;
    }

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
    public function tryGetRelativeEntitySetPath(
        IModel $model,
        IFunctionParameter &$parameter = null,
        array &$path = null
    ): bool {
        /**
         * @var IFunctionImport $this
         */
        $parameter = null;
        $path      = null;

        $entitySetPath = $this->getEntitySet();
        $entitySetPath = $entitySetPath instanceof IPathExpression ? $entitySetPath : null;
        if ($entitySetPath === null) {
            return false;
        }

        $pathToResolve = $entitySetPath->getPath();
        $numSegments   = count($pathToResolve);
        if (0 === $numSegments) {
            return false;
        }

        // Resolve the first segment as a parameter.
        $parameter = $this->findParameter($pathToResolve[0]);
        if ($parameter === null) {
            return false;
        }

        if (1 === $numSegments) {
            $path = [];
            return true;
        } else {
            // Get the entity type of the parameter, treat the rest of the path as a sequence of navprops.
            assert($parameter instanceof IFunctionParameter);
            /**
             * @var IEntityType $entityType
             */
            $entityType = Helpers::getPathSegmentEntityType($parameter->getType());
            /**
             * @var INavigationProperty[] $pathList
             */
            $pathList = [];
            for ($i = 1; $i < $numSegments; ++$i) {
                $segment = $pathToResolve[$i];
                if (EdmUtil::isQualifiedName($segment)) {
                    if ($i == count($pathToResolve) - 1) {
                        // The last segment must not be type cast.
                        return false;
                    }
                    /**
                     * @var IEntityType|null $subType ;
                     */
                    $subType = $model->findDeclaredType($segment);
                    $subType = $subType instanceof IEntityType ? $subType : null;
                    if ($subType == null || !$subType->isOrInheritsFrom($entityType)) {
                        return false;
                    }

                    $entityType = $subType;
                } else {
                    $navProp = $entityType->findProperty($segment);
                    $navProp = $navProp instanceof INavigationProperty ? $navProp : null;
                    if ($navProp == null) {
                        return false;
                    }

                    $pathList[] = $navProp;
                    $entityType = Helpers::getPathSegmentEntityType($navProp->getType());
                }
            }

            $path = $pathList;
            return true;
        }
    }

    /**
     * @return IExpression|null gets the entity set containing entities returned by this function import
     */
    abstract public function getEntitySet(): ?IExpression;
}
