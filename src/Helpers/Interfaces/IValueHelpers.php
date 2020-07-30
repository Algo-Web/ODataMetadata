<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 22/07/20
 * Time: 8:13 PM.
 */

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;

use AlgoWeb\ODataMetadata\Interfaces\IModel;

interface IValueHelpers
{
    /**
     * Sets an annotation indicating if the value should be serialized as an element.
     * @param IModel $model                 model containing the value
     * @param bool   $isSerializedAsElement value indicating if the value should be serialized as an element
     */
    public function setIsSerializedAsElement(IModel $model, bool $isSerializedAsElement): void;

    /**
     * Gets an annotation indicating if the value should be serialized as an element.
     * @param  IModel $model model containing the value
     * @return bool   value indicating if the string should be serialized as an element
     */
    public function isSerializedAsElement(IModel $model): bool;
}
