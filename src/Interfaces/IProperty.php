<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Enums\PropertyKind;

/**
 * Interface IEdmProperty.
 *
 * Represents an EDM property.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IProperty extends INamedElement, IVocabularyAnnotatable
{
    /**
     * @return PropertyKind gets the kind of this property
     */
    public function getPropertyKind(): PropertyKind;

    /**
     * @return ITypeReference gets the type of this property
     */
    public function getType(): ITypeReference;

    /**
     * @return IStructuredType gets the type that this property belongs to
     */
    public function getDeclaringType(): IStructuredType;
}
