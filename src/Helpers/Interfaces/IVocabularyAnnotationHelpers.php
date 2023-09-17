<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;

use AlgoWeb\ODataMetadata\Enums\EdmVocabularyAnnotationSerializationLocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;

interface IVocabularyAnnotationHelpers
{
    public function isInline(IModel $model): bool;

    public function targetString(): string;

    /**
     * Sets the location an annotation should be serialized in.
     *
     * @param IModel                                            $model    model containing the annotation
     * @param EdmVocabularyAnnotationSerializationLocation|null $location the location the annotation should appear
     */
    public function setSerializationLocation(IModel $model, ?EdmVocabularyAnnotationSerializationLocation $location): void;

    /**
     * Gets the location an annotation should be serialized in.
     *
     * @param  IModel                                            $model model containing the annotation
     * @return EdmVocabularyAnnotationSerializationLocation|null the location the annotation should be serialized at
     */
    public function getSerializationLocation(IModel $model): ?EdmVocabularyAnnotationSerializationLocation;

    /**
     * Sets the schema an annotation should appear in.
     *
     * @param IModel $model           model containing the annotation
     * @param string $schemaNamespace the schema the annotation belongs in
     */
    public function setSchemaNamespace(IModel $model, string $schemaNamespace): void;

    /**
     * Gets the schema an annotation should be serialized in.
     *
     * @param  IModel $model model containing the annotation
     * @return string name of the schema the annotation belongs to
     */
    public function getSchemaNamespace(IModel $model): string;
}
