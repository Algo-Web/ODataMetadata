<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Enums\EdmVocabularyAnnotationSerializationLocation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;

trait VocabularyAnnotationHelpers
{
    public function IsInline(IModel $model): bool
    {
        /** @var IVocabularyAnnotation $annotation */
        $annotation = $this;
        return $annotation->GetSerializationLocation($model) ==
               EdmVocabularyAnnotationSerializationLocation::Inline() || null === $annotation->TargetString();
    }

    public function TargetString(): string
    {
        /** @var IVocabularyAnnotation $annotation */
        $annotation = $this;
        EdmUtil::checkArgumentNull($annotation->getTarget(), 'annotation->getTarget');
        return EdmUtil::FullyQualifiedName($annotation->getTarget());
    }

    /**
     * Sets the location an annotation should be serialized in.
     *
     * @param IModel                                            $model    model containing the annotation
     * @param EdmVocabularyAnnotationSerializationLocation|null $location the location the annotation should appear
     */
    public function SetSerializationLocation(
        IModel $model,
        ?EdmVocabularyAnnotationSerializationLocation $location
    ): void {
        /** @var IVocabularyAnnotation $annotation */
        $annotation = $this;
        $model->setAnnotationValue(
            $annotation,
            EdmConstants::InternalUri,
            CsdlConstants::AnnotationSerializationLocationAnnotation,
            (object)$location
        );
    }

    /**
     * Gets the location an annotation should be serialized in.
     *
     * @param  IModel                                            $model model containing the annotation
     * @return EdmVocabularyAnnotationSerializationLocation|null the location the annotation should be serialized at
     */
    public function GetSerializationLocation(IModel $model): ?EdmVocabularyAnnotationSerializationLocation
    {
        /** @var IVocabularyAnnotation $annotation */
        $annotation = $this;
        $location   = $model->getAnnotationValue(
            EdmVocabularyAnnotationSerializationLocation::class,
            $annotation,
            EdmConstants::InternalUri,
            CsdlConstants::AnnotationSerializationLocationAnnotation
        );
        return $location instanceof EdmVocabularyAnnotationSerializationLocation ? $location : null;
    }

    /**
     * Sets the schema an annotation should appear in.
     *
     * @param IModel $model           model containing the annotation
     * @param string $schemaNamespace the schema the annotation belongs in
     */
    public function SetSchemaNamespace(IModel $model, string $schemaNamespace): void
    {
        /** @var IVocabularyAnnotation $annotation */
        $annotation = $this;
        $model->setAnnotationValue(
            $annotation,
            EdmConstants::InternalUri,
            CsdlConstants::SchemaNamespaceAnnotation,
            $schemaNamespace
        );
    }
    /**
     * Gets the schema an annotation should be serialized in.
     *
     * @param  IModel $model model containing the annotation
     * @return string name of the schema the annotation belongs to
     */
    public function GetSchemaNamespace(IModel $model): string
    {
        /** @var IVocabularyAnnotation $annotation */
        $annotation = $this;
        return $model->getAnnotationValue(
            'string',
            $annotation,
            EdmConstants::InternalUri,
            CsdlConstants::SchemaNamespaceAnnotation
        );
    }
}
