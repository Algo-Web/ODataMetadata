<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces\Annotations;

use AlgoWeb\ODataMetadata\Interfaces\INamedElement;

/**
 * Interface IEdmDirectValueAnnotation.
 *
 * Represents an EDM annotation with an immediate value.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces\Annotations
 */
interface IDirectValueAnnotation extends INamedElement
{
    /**
     * @return string gets the namespace Uri of the annotation
     */
    public function getNamespaceUri(): string;

    /**
     * @return mixed|null gets the value of this annotation
     */
    public function getValue();
}
