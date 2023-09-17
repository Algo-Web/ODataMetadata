<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 22/07/20
 * Time: 10:26 PM.
 */

namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;

trait ModelHelpersVocabularyAnnotation
{
    /**
     * Gets an annotatable element's vocabulary annotations that bind a particular term.
     *
     * @param  IVocabularyAnnotatable           $element   element to check for annotations
     * @param  ITerm|string|null                $term      Term to search for. OR Name of the term to search for.
     * @param  string|null                      $qualifier qualifier to apply
     * @param  string|null                      $type      type of the annotation being returned
     * @return iterable|IVocabularyAnnotation[] annotations attached to the element by this model or by models
     *                                                    referenced by this model that bind the term with the given
     *                                                    qualifier
     */
    public function findVocabularyAnnotations(
        IVocabularyAnnotatable $element,
        $term = null,
        string $qualifier = null,
        string $type = null
    ): iterable {
        assert(
            null === $term || $term instanceof ITerm || is_string($term),
            '$term should be a string or instanceof iTerm'
        );
        if (null === $term) {
            return $this->processNullVocabularyAnnotationTerm($element);
        }
        if (is_string($term)) {
            $termName = $term;
            // Look up annotations on the element by name. There's no particular advantage in searching for a term first.
            $name          = null;
            $namespaceName = null;

            if (EdmUtil::tryGetNamespaceNameFromQualifiedName($termName, $namespaceName, $name)) {
                /**
                 * @var IVocabularyAnnotation $annotation
                 */
                foreach ($this->findVocabularyAnnotations($element) as $annotation) {
                    if (null !== $type && !is_a($annotation, $type)) {
                        continue;
                    }
                    $annotationTerm = $annotation->getTerm();
                    if ($annotationTerm->getNamespace() === $namespaceName &&
                        $annotationTerm->getName() === $name &&
                        (
                            null === $qualifier ||
                            $qualifier == $annotation->getQualifier()
                        )
                    ) {
                        yield $annotation;
                    }
                }
            }
        } else {
            return $this->processTermVocabularyAnnotationTerm($element, $term, $qualifier, $type);
        }
    }

    /**
     * Gets an annotatable element's vocabulary annotations defined in a specific model and models referenced by
     * that model.
     * @param  IVocabularyAnnotatable  $element element to check for annotations
     * @return IVocabularyAnnotation[] annotations attached to the element (or, if the element is a type, to its base
     *                                         types) by this model or by models referenced by this model
     */
    public function findVocabularyAnnotationsIncludingInheritedAnnotations(IVocabularyAnnotatable $element): array
    {
        /**
         * @var IVocabularyAnnotation[] $result
         */
        $result = $this->FindDeclaredVocabularyAnnotations($element);

        if ($element instanceof IStructuredType) {
            $typeElement = $element;
            assert($typeElement instanceof IStructuredType);
            $typeElement = $typeElement->getBaseType();
            while (null !== $typeElement) {
                if ($typeElement instanceof IVocabularyAnnotatable) {
                    $result = array_merge($result, $this->FindDeclaredVocabularyAnnotations($typeElement));
                }

                $typeElement = $typeElement->getBaseType();
            }
        }

        return $result;
    }

    /**
     * @param  IVocabularyAnnotatable        $element
     * @return IVocabularyAnnotation[]|array
     */
    protected function processNullVocabularyAnnotationTerm(
        IVocabularyAnnotatable $element
    ): array {
        $result = $this->findVocabularyAnnotationsIncludingInheritedAnnotations($element);
        foreach ($this->getReferencedModels() as $referencedModel) {
            $result = array_merge(
                $result,
                $referencedModel->findVocabularyAnnotationsIncludingInheritedAnnotations($element)
            );
        }
        return $result;
    }

    /**
     * @param  IVocabularyAnnotatable $element
     * @param  ITerm                  $term
     * @param  string                 $qualifier
     * @param  string                 $type
     * @return array
     */
    protected function processTermVocabularyAnnotationTerm(
        IVocabularyAnnotatable $element,
        ITerm $term,
        string $qualifier = null,
        string $type = null
    ): array {
        $result = [];
        /**
         * @var IVocabularyAnnotation $annotation
         */
        foreach ($this->findVocabularyAnnotations($element) as $annotation) {
            if (null !== $type && !is_a($annotation, $type)) {
                continue;
            }

            if ($annotation->getTerm() == $term && (null === $qualifier || $qualifier == $annotation->getQualifier())) {
                $result[] = $annotation;
            }
        }

        return $result;
    }

    /**
     * @return IModel[] gets the collection of models referred to by this model
     */
    abstract public function getReferencedModels(): array;
}
