<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 22/07/20
 * Time: 10:26 PM
 */

namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;

trait ModelHelpersVocabularyAnnotation
{
    /**
     * Gets an annotatable element's vocabulary annotations that bind a particular term.
     *
     * @param IVocabularyAnnotatable $element  Element to check for annotations.
     * @param ITerm|string $term Term to search for. OR Name of the term to search for.
     * @param string|null $qualifier Qualifier to apply.
     * @param string|null $type Type of the annotation being returned.
     * @return iterable|IVocabularyAnnotation[] Annotations attached to the element by this model or by models
     * referenced by this model that bind the term with the given qualifier.
     */
    public function FindVocabularyAnnotations(
        IVocabularyAnnotatable $element,
        $term = null,
        string $qualifier = null,
        string $type = null
    ): iterable {
        assert($term instanceof ITerm || is_string($term), '$term should be a string or instanceof iTerm');
        if (null === $term) {
            return $this->processNullVocabularyAnnotationTerm($element, $qualifier, $type);
        }
        if (is_string($term)) {
            $termName = $term;
            // Look up annotations on the element by name. There's no particular advantage in searching for a term first.
            $name = null;
            $namespaceName = null;

            if (EdmUtil::TryGetNamespaceNameFromQualifiedName($termName, $namespaceName, $name)) {
                /**
                 * @var IVocabularyAnnotation $annotation
                 */
                foreach ($this->FindVocabularyAnnotations($element) as $annotation) {
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
     * @param IVocabularyAnnotatable $element Element to check for annotations.
     * @return IVocabularyAnnotation[] Annotations attached to the element (or, if the element is a type, to its base
     * types) by this model or by models referenced by this model.
     */
    public function FindVocabularyAnnotationsIncludingInheritedAnnotations(IVocabularyAnnotatable $element): array
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
     * @param IVocabularyAnnotatable $element
     * @param string $qualifier
     * @param string $type
     * @return IVocabularyAnnotation[]|array
     */
    protected function processNullVocabularyAnnotationTerm(
        IVocabularyAnnotatable $element,
        string $qualifier,
        string $type
    ): array {
        assert(null === $qualifier);
        assert(null === $type);
        $result = $this->FindVocabularyAnnotationsIncludingInheritedAnnotations($element);
        foreach ($this->getReferencedModels() as $referencedModel) {
            $result = array_merge(
                $result,
                $referencedModel->FindVocabularyAnnotationsIncludingInheritedAnnotations($element)
            );
        }
        return $result;
    }

    /**
     * @param IVocabularyAnnotatable $element
     * @param $term
     * @param string $qualifier
     * @param string $type
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
        foreach ($this->FindVocabularyAnnotations($element) as $annotation) {
            if (null !== $type && !is_a($annotation, $type)) {
                continue;
            }

            if ($annotation->getTerm() == $term &&
                (
                    null === $qualifier ||
                    $qualifier == $annotation->getQualifier()
                )
            ) {
                if (null === $result) {
                    $result = [];
                }

                $result[] = $annotation;
            }
        }

        return $result;
    }
}
