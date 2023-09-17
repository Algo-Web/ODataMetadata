<?php


namespace AlgoWeb\ODataMetadata\Helpers;


use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Enums\EdmVocabularyAnnotationSerializationLocation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;

trait VocabularyAnnotationHelpers
{
    public function IsInline( IModel $model): bool
    {
        /**
         * @var IVocabularyAnnotation $annotation
         */
        $annotation = $this;
        return $annotation->GetSerializationLocation($model) == EdmVocabularyAnnotationSerializationLocation::Inline || $annotation->TargetString() == null;
    }

    public function TargetString():string
    {
        /**
         * @var IVocabularyAnnotation $annotation
         */
        $annotation = $this;
        return EdmUtil::FullyQualifiedName($annotation->getTarget());
    }

    /**
     * Sets the location an annotation should be serialized in.
     *
     * @param IModel $model Model containing the annotation.
     * @param EdmVocabularyAnnotationSerializationLocation|null $location The location the annotation should appear.
     */
    public function SetSerializationLocation( IModel $model, ?EdmVocabularyAnnotationSerializationLocation $location): void
    {
        /**
         * @var IVocabularyAnnotation $annotation
         */
        $annotation = $this;
        $model->SetAnnotationValue($annotation, EdmConstants::InternalUri, CsdlConstants::AnnotationSerializationLocationAnnotation, (object)$location);
    }

    /**
     * Gets the location an annotation should be serialized in.
     *
     * @param IModel $model Model containing the annotation.
     * @return EdmVocabularyAnnotationSerializationLocation|null The location the annotation should be serialized at.
     */
    public function GetSerializationLocation(IModel $model): ?EdmVocabularyAnnotationSerializationLocation
    {
        /**
         * @var IVocabularyAnnotation $annotation
         */
        $annotation = $this;
        $location = $model->GetAnnotationValue(EdmVocabularyAnnotationSerializationLocation::class, $annotation, EdmConstants::InternalUri, CsdlConstants::AnnotationSerializationLocationAnnotation);
            return $location instanceof EdmVocabularyAnnotationSerializationLocation ? $location : null;
        }

    /**
     * Sets the schema an annotation should appear in.
     *
     * @param IModel $model Model containing the annotation.
     * @param string $schemaNamespace The schema the annotation belongs in.
     */
    public function SetSchemaNamespace(IModel $model, string $schemaNamespace): void
    {
        /**
         * @var IVocabularyAnnotation $annotation
         */
        $annotation = $this;
        $model->SetAnnotationValue($annotation, EdmConstants::InternalUri, CsdlConstants::SchemaNamespaceAnnotation, $schemaNamespace);
    }
    /**
     * Gets the schema an annotation should be serialized in.
     *
     * @param IModel $model Model containing the annotation.
     * @return string Name of the schema the annotation belongs to.
     */
    public function GetSchemaNamespace(IModel $model): string
    {
        /**
         * @var IVocabularyAnnotation $annotation
         */
        $annotation = $this;
        return $model->GetAnnotationValue('string', $annotation, EdmConstants::InternalUri, CsdlConstants::SchemaNamespaceAnnotation);
    }
}