<?php


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Enums\PropertyKind;

/**
 * Interface IEdmProperty
 *
 * Represents an EDM property.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IProperty extends INamedElement, IVocabularyAnnotatable
{
    /**
     * @return PropertyKind Gets the kind of this property.
     */
    public function getPropertyKind(): PropertyKind;

    /**
     * @return ITypeReference Gets the type of this property.
     */
    public function getType(): ITypeReference;

    /**
     * @return IStructuredType Gets the type that this property belongs to.
     */
    public function getDeclaringType(): IStructuredType;
}