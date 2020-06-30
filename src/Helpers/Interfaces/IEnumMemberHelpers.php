<?php

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;

use AlgoWeb\ODataMetadata\Interfaces\IModel;

interface IEnumMemberHelpers
{
    /**
     *  Sets an annotation indicating whether the value of an enum member should be explicitly serialized.
     *
     * @param IModel $model model containing the member
     * @param bool|null $isExplicit If the value of the enum member should be explicitly serialized
     */
    public function SetIsValueExplicit(IModel $model, ?bool $isExplicit): void;

    /**
     * Gets an annotation indicating whether the value of an enum member should be explicitly serialized.
     *
     * @param IModel $model model containing the member
     * @return bool|null whether the member should have its value serialized
     */
    public function IsValueExplicit(IModel $model): ?bool;
}