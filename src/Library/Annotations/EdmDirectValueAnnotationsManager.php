<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Annotations;

use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotationBinding;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotationsManager;
use AlgoWeb\ODataMetadata\Interfaces\IDocumentation;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\StringConst;
use SplObjectStorage;

/**
 * Direct-value annotations manager provides services for setting and getting transient annotations on elements.
 *
 * @package AlgoWeb\ODataMetadata\Library\Annotations
 *
 *  An object representing transient annotations is in one of these states:
 *    1) Null, if the element has no transient annotations.
 *    2) An EdmAnnotation, if the element has exactly one annotation.
 *    3) A list of EdmAnnotation, if the element has more than one annotation.
 * If the speed of annotation lookup for elements with many annotations becomes a concern, another option
 * including a dictionary is possible.
 */
class EdmDirectValueAnnotationsManager implements IDirectValueAnnotationsManager
{
    /**
     * @var SplObjectStorage|array<IEdmElement, mixed>  keeps track of transient annotations on elements
     */
    private $annotationsDictionary;

    /**
     * @var array elements for which normal comparison failed to produce a valid result, arbitrarily ordered to enable stable comparisons
     */
    private $unsortedElements = [];

    /**
     * Initializes a new instance of the EdmDirectValueAnnotationsManager class.
     */
    public function __construct()
    {
        $this->annotationsDictionary = new SplObjectStorage();
    }

    /**
     * Gets annotations associated with an element.
     *
     * @param  IEdmElement              $element the annotated element
     * @return IDirectValueAnnotation[] The direct value annotations for the element
     */
    public function getDirectValueAnnotations(IEdmElement $element): iterable
    {
        // Fetch the annotations dictionary once and only once, because this.annotationsDictionary might get updated by another thread.
        $annotationsDictionary = $this->annotationsDictionary;

        $immutableAnnotations = $this->getAttachedAnnotations($element);
        $transientAnnotations = self::getTransientAnnotations($element, $annotationsDictionary);

        if ($immutableAnnotations != null) {
            /**
             * @var IDirectValueAnnotation $existingAnnotation
             */
            foreach ($immutableAnnotations as $existingAnnotation) {
                if (!self::isDead($existingAnnotation->getNamespaceUri(), $existingAnnotation->getName(), $transientAnnotations)) {
                    yield $existingAnnotation;
                }
            }
        }
        /**
         * @var IDirectValueAnnotation $existingAnnotation
         */
        foreach (self::transientAnnotations($transientAnnotations) as $existingAnnotation) {
            yield  $existingAnnotation;
        }
    }

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
    public function setAnnotationValue(IEdmElement $element, string $namespaceName, string $localName, $value): IDirectValueAnnotationsManager
    {
        $annotationsDictionary         = $this->annotationsDictionary;
        $transientAnnotations          = self::getTransientAnnotations($element, $annotationsDictionary);
        $transientAnnotationsBeforeSet = clone $transientAnnotations;
        self::setAnnotation($this->getAttachedAnnotations($element), $transientAnnotations, $namespaceName, $localName, $value);

        // There is at least one case (removing an annotation that was not present to begin with) where the transient annotations are not changed,
        // so test to see if updating the dictionary is necessary.
        if ($transientAnnotations != $transientAnnotationsBeforeSet) {
            $annotationsDictionary = $annotationsDictionary->offsetSet($element, $transientAnnotations);
        }
        $this->annotationsDictionary = $annotationsDictionary;
        return $this;
    }

    /**
     * Sets a set of annotation values. If a supplied value is null, no annotation is added and an existing annotation
     * with the same name is removed.
     * @param  IDirectValueAnnotationBinding[] $annotations The annotations to set
     * @return IDirectValueAnnotationsManager  self
     */
    public function setAnnotationValues(array $annotations): IDirectValueAnnotationsManager
    {
        /**
         * @var IDirectValueAnnotationBinding $annotation
         */
        foreach ($annotations as $annotation) {
            $this->SetAnnotationValue($annotation->getElement(), $annotation->getNamespaceUri(), $annotation->getName(), $annotation->getValue());
        }
        return $this;
    }

    /**
     * @param  IEdmElement $element       the annotated element
     * @param  string      $namespaceName namespace that the annotation belongs to
     * @param  string      $localName     local name of the annotation
     * @return mixed       Returns the annotation value that corresponds to the provided name. Returns null if no
     *                                   annotation with the given name exists for the given element.
     */
    public function getAnnotationValue(IEdmElement $element, string $namespaceName, string $localName)
    {
        $annotationsDictionary = $this->annotationsDictionary;
        $annotation            = self::findTransientAnnotation(self::getTransientAnnotations($element, $annotationsDictionary), $namespaceName, $localName);
        if ($annotation != null) {
            return $annotation->getValue();
        }

        $immutableAnnotations = $this->getAttachedAnnotations($element);
        if ($immutableAnnotations != null) {
            /**
             * @var IDirectValueAnnotation $existingAnnotation
             */
            foreach ($immutableAnnotations as $existingAnnotation) {
                if ($existingAnnotation->getNamespaceUri() == $namespaceName && $existingAnnotation->getName() == $localName) {
                    // No need to check that the immutable annotation isn't Dead, because if it were
                    // the tombstone would have been found in the transient annotations.
                    return $existingAnnotation->getValue();
                }
            }
        }

        return null;
    }

    /**
     * Retrieves a set of annotation values. For each requested value, returns null if no annotation with the given
     * name exists for the given element.
     *
     * @param  IDirectValueAnnotationBinding[] $annotations The set of requested annotations
     * @return array                           Returns values that correspond to the provided annotations. A value is null if no annotation with
     *                                                     the given name exists for the given element.
     */
    public function getAnnotationValues(array $annotations): ?iterable
    {
        $values = [];

        $index = 0;
        foreach ($annotations as $annotation) {
            $values[$index++] = $this->getAnnotationValue($annotation->getElement(), $annotation->getNamespaceUri(), $annotation->getName());
        }

        return $values;
    }

    /**
     * Retrieves the annotations that are directly attached to an element.
     *
     * @param  IEdmElement   $element the element in question
     * @return iterable|null the annotations that are directly attached to an element (outside the control of the manager)
     */
    protected function getAttachedAnnotations(IEdmElement $element): ?iterable
    {
        return null;
    }


    /**
     * Retrieves the transient annotations for an EDM element.
     *
     * @param  IEdmElement      $element               the annotated element
     * @param  SplObjectStorage $annotationsDictionary the dictionary for looking up the element's annotations
     * @return mixed|null       The transient annotations for the element, in a form managed by the annotations manager.
     *                                                This method is static to guarantee that the annotati ons dictionary is not fetched more than once per lookup operation.
     */
    private static function getTransientAnnotations(IEdmElement $element, SplObjectStorage $annotationsDictionary)
    {
        return $annotationsDictionary->offsetExists($element) ? $annotationsDictionary->offsetGet($element) : null;
    }

    private static function removeTransientAnnotation(&$transientAnnotations, $namespaceName, string $localName)
    {
        if ($transientAnnotations != null) {
            $singleAnnotation = $transientAnnotations;
            if ($singleAnnotation instanceof IDirectValueAnnotation) {
                if ($singleAnnotation->getNamespaceUri() == $namespaceName && $singleAnnotation->getName() == $localName) {
                    $transientAnnotations = null;
                    return;
                }
            } else {
                $annotationsList = $transientAnnotations;
                assert(is_array(
                    $annotationsList
                ));
                for ($index = 0; $index < count($annotationsList); $index++) {
                    $existingAnnotation = $annotationsList[$index];
                    assert($existingAnnotation instanceof IDirectValueAnnotation);
                    if ($existingAnnotation->getNamespaceUri() == $namespaceName && $existingAnnotation->getName() == $localName) {
                        unset($annotationsList[$index]);
                        if (count($annotationsList) === 1) {
                            $transientAnnotations = array_pop($annotationsList);
                        } else {
                            $transientAnnotations = $annotationsList;
                        }

                        return;
                    }
                }
            }
        }
    }
    private static function transientAnnotations($transientAnnotations): iterable
    {
        if ($transientAnnotations == null) {
            return [];
        }

        $singleAnnotation = $transientAnnotations;
        if ($singleAnnotation instanceof IDirectValueAnnotation) {
            if ($singleAnnotation->getValue() != null) {
                yield $singleAnnotation;
            }

            return [];
        }

        $annotationsList = $transientAnnotations;
        assert(is_iterable($annotationsList));
        /**
         * @var IDirectValueAnnotation $existingAnnotation
         */
        foreach ($annotationsList as $existingAnnotation) {
            if ($existingAnnotation->getValue() != null) {
                yield $existingAnnotation;
            }
        }
    }

    private static function isDead(string $namespaceName, string $localName, $transientAnnotations): bool
    {
        return self::findTransientAnnotation($transientAnnotations, $namespaceName, $localName) != null;
    }

    private static function setAnnotation(?iterable $immutableAnnotations, &$transientAnnotations, string $namespaceName, string $localName, $value): void
    {
        $needTombstone = false;
        if ($immutableAnnotations != null) {
            $filtered = false;
            foreach ($immutableAnnotations as $exitingAnnotation) {
                if ($exitingAnnotation->getNamespaceUri() == $namespaceName && $exitingAnnotation->getName() == $localName) {
                    $filtered = true;
                    break;
                }
            }
            if ($filtered) {
                $needTombstone = true;
            }
        }

        if ($value == null) {
            // "Removing" an immutable annotation leaves behind a transient annotation with a null value
            // as a tombstone to hide the immutable annotation. The normal logic below makes this happen.
            // Removing a transient annotation actually takes the annotation away.
            if (!$needTombstone) {
                self::removeTransientAnnotation($transientAnnotations, $namespaceName, $localName);
                return;
            }
        }

        if ($namespaceName == EdmConstants::DocumentationUri && $value != null && !($value instanceof IDocumentation)) {
            throw new InvalidOperationException(StringConst::Annotations_DocumentationPun(get_class($value)));
        }

        $newAnnotation = $value != null ?
            new EdmDirectValueAnnotation($namespaceName, $localName, $value) :
            new EdmDirectValueAnnotation($namespaceName, $localName);

        if ($transientAnnotations == null) {
            $transientAnnotations = $newAnnotation;
            return;
        }

        $singleAnnotation = $transientAnnotations;
        if ($singleAnnotation instanceof IDirectValueAnnotation) {
            if ($singleAnnotation->getNamespaceUri() == $namespaceName && $singleAnnotation->getName() == $localName) {
                $transientAnnotations = $newAnnotation;
            } else {
                $transientAnnotations = [$singleAnnotation, $newAnnotation];
            }

            return;
        }

        $annotationsList = $transientAnnotations;
        assert(is_countable($annotationsList));
        for ($index = 0; $index < count($annotationsList); $index++) {
            /**
             * @var IDirectValueAnnotation $existingAnnotation
             */
            $existingAnnotation = $annotationsList[$index];
            if ($existingAnnotation->getNamespaceUri() == $namespaceName && $existingAnnotation->getName() == $localName) {
                unset($annotationsList[$index]);
                break;
            }
        }
        $annotationsList[]    = $newAnnotation;
        $transientAnnotations = $annotationsList;
    }


    private static function findTransientAnnotation($transientAnnotations, string $namespaceName, string $localName): ?IDirectValueAnnotation
    {
        if ($transientAnnotations != null) {
            if ($transientAnnotations instanceof IDirectValueAnnotation) {
                if ($transientAnnotations->getNamespaceUri() == $namespaceName && $transientAnnotations->getName() == $localName) {
                    return ${$transientAnnotations};
                }
            } else {
                $annotationsList = $transientAnnotations;
                assert(is_array($annotationsList));
                $filtered = array_filter($annotationsList, function (IDirectValueAnnotation $existingAnnotation) use ($namespaceName, $localName) {
                    return $existingAnnotation->getNamespaceUri() == $namespaceName && $existingAnnotation->getNamespaceUri() == $localName;
                });
                if (count($filtered) === 0) {
                    return null;
                }
                return $annotationsList[0];
            }
        }

        return null;
    }
}
