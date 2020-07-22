<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 22/07/20
 * Time: 8:21 PM
 */

namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\ValidationHelper;
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IModel;

trait ValueHelpers
{
    /**
     * Sets an annotation indicating if the value should be serialized as an element.
     * @param IModel $model Model containing the value.
     * @param bool $isSerializedAsElement Value indicating if the value should be serialized as an element.
     */
    public function SetIsSerializedAsElement(IModel $model, bool $isSerializedAsElement): void
    {
        /** @var IEdmElement $self */
        $self = $this;
        assert($self instanceof IEdmElement);
        if ($isSerializedAsElement) {
            $error = null;
            if (!ValidationHelper::ValidateValueCanBeWrittenAsXmlElementAnnotation(
                $self,
                null,
                null,
                $error
            )
            ) {
                throw new InvalidOperationException(strval($error));
            }
        }

        $model->SetAnnotationValue(
            $self,
            EdmConstants::InternalUri,
            CsdlConstants::IsSerializedAsElementAnnotation,
            $isSerializedAsElement
        );
    }

    /**
     * Gets an annotation indicating if the value should be serialized as an element.
     * @param IModel $model  Model containing the value.
     * @return bool Value indicating if the string should be serialized as an element.
     */
    public function IsSerializedAsElement(IModel $model): bool
    {
        $self = $this;
        assert($self instanceof IEdmElement);
        $value = $model->GetAnnotationValue(
            'boolean',
            $self,
            EdmConstants::InternalUri,
            CsdlConstants::IsSerializedAsElementAnnotation
        );
        return is_bool($value) ? $value : false;
    }
}
