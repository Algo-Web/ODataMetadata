<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces\Annotations;

use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;

/**
 * Class IEdmDirectValueAnnotationBinding.
 *
 * Represents the combination of an EDM annotation with an immediate value and the element to which it is attached.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces\Annotations
 */
interface IDirectValueAnnotationBinding
{
    /**
     * @return IEdmElement Gets the element to which the annotation is attached
     */
    public function getElement(): IEdmElement;

    /**
     * @return string gets the namespace URI of the annotation
     */
    public function getNamespaceUri(): string;

    /**
     * @return string gets the local name of this annotation
     */
    public function getName(): string;

    /**
     * @return mixed gets the value of this annotation
     */
    public function getValue();
}
