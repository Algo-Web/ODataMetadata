<?php

namespace AlgoWeb\ODataMetadata\Interfaces;

interface IEntityType
{
    /**
     * Gets as name.
     *
     * @return string
     */
    public function getName();
    /**
     * Gets as baseType.
     *
     * @return string
     */
    public function getBaseType();
    /**
     * Gets as abstract.
     *
     * @return bool
     */
    public function getAbstract();
}
