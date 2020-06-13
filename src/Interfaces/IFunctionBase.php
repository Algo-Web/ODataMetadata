<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmFunctionBase.
 *
 * Represents the common base type of EDM functions and function imports.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IFunctionBase extends INamedElement, IVocabularyAnnotatable
{
    /**
     * Gets the return type of this function.
     *
     * @return ITypeReference
     */
    public function getReturnType(): ITypeReference;

    /**
     * Gets the collection of parameters for this function.
     *
     * @return IFunctionParameter[]|null
     */
    public function getParameters(): ?array;

    /**
     * Searches for a parameter with the given name, and returns null if no such parameter exists.
     *
     * @param  string                  $name the name of the parameter being found
     * @return IFunctionParameter|null the requested parameter or null if no such parameter exists
     */
    public function findParameter(string $name): ?IFunctionParameter;
}
