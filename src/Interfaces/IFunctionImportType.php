<?php

namespace AlgoWeb\ODataMetadata\Interfaces;

interface IFunctionImportType
{
    /**
     * Gets as name.
     *
     * @return string
     */
    public function getName();
    
    /**
     * Gets as returnType.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportReturnTypeType[]
     */
    public function getReturnType();
    
    /**
     * Adds as parameter.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportParameterType $parameter
     * @return self
     */
    public function addToParameter(TFunctionImportParameterType $parameter);
}
