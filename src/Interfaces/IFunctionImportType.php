<?php

namespace AlgoWeb\ODataMetadata\Interfaces;

interface IFunctionImportType{
    /**
     * Gets as name
     *
     * @return string
     */
    public function getName();
    
        /**
     * Gets as returnType
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportReturnTypeType[]
     */
    public function getReturnType();
    
        /**
     * Adds as parameter
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionImportParameterType $parameter
     */
    public function addToParameter(TFunctionImportParameterType $parameter);
}