<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;
use AlgoWeb\ODataMetadata\Interfaces\IModel;

trait EnumMemberHelpers
{
    /**
     *  Sets an annotation indicating whether the value of an enum member should be explicitly serialized.
     *
     * @param IModel    $model      model containing the member
     * @param bool|null $isExplicit If the value of the enum member should be explicitly serialized
     */
    public function setIsValueExplicit(IModel $model, ?bool $isExplicit): void
    {
        $self = $this;
        assert($self instanceof IEnumMember);
        $model->setAnnotationValue($self, EdmConstants::InternalUri, CsdlConstants::IsEnumMemberValueExplicitAnnotation, $isExplicit);
    }

    /**
     * Gets an annotation indicating whether the value of an enum member should be explicitly serialized.
     *
     * @param  IModel    $model model containing the member
     * @return bool|null whether the member should have its value serialized
     */
    public function isValueExplicit(IModel $model): ?bool
    {
        $self = $this;
        assert($self instanceof IEnumMember);
        return $model->getAnnotationValue('?bool', $self, EdmConstants::InternalUri, CsdlConstants::IsEnumMemberValueExplicitAnnotation);
    }
}
