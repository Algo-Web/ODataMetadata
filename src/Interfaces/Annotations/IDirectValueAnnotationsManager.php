<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces\Annotations;

use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;

/**
 * Interface IEdmDirectValueAnnotationsManager.
 *
 * Manages getting and setting direct value annotations on EDM elements.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Annotations
 */
interface IDirectValueAnnotationsManager
{
    /**
     * Gets annotations associated with an element.
     *
     * @param  IEdmElement              $element the annotated element
     * @return IDirectValueAnnotation[] The direct value annotations for the element
     */
    public function getDirectValueAnnotations(IEdmElement $element): iterable;

    /**
     * Sets an annotation value for an EDM element. If the value is null, no annotation is added and an existing
     * annotation with the same name is removed.
     *
     * @param  IEdmElement                    $element       the annotated element
     * @param  string                         $namespaceName namespace that the annotation belongs to
     * @param  string                         $localName     name of the annotation within the namespace
     * @param  mixed                          $value         the value of the annotation
     * @return IDirectValueAnnotationsManager self
     */
    public function setAnnotationValue(IEdmElement $element, string $namespaceName, string $localName, $value): self;

    /**
     * Sets a set of annotation values. If a supplied value is null, no annotation is added and an existing annotation
     * with the same name is removed.
     * @param  IDirectValueAnnotationBinding[] $annotations The annotations to set
     * @return IDirectValueAnnotationsManager  self
     */
    public function setAnnotationValues(array $annotations): self;

    /**
     * @param  IEdmElement $element       the annotated element
     * @param  string      $namespaceName namespace that the annotation belongs to
     * @param  string      $localName     local name of the annotation
     * @return mixed       Returns the annotation value that corresponds to the provided name. Returns null if no
     *                                   annotation with the given name exists for the given element.
     */
    public function getAnnotationValue(IEdmElement $element, string $namespaceName, string $localName);

    /**
     * Retrieves a set of annotation values. For each requested value, returns null if no annotation with the given
     * name exists for the given element.
     *
     * @param  IDirectValueAnnotationBinding[] $annotations The set of requested annotations
     * @return array                           Returns values that correspond to the provided annotations. A value is null if no annotation with
     *                                                     the given name exists for the given element.
     */
    public function getAnnotationValues(array $annotations): ?iterable;
}
