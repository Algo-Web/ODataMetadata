<?php

namespace AlgoWeb\ODataMetadata\Tests;

use AlgoWeb\ODataMetadata\MetadataManager;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TNavigationPropertyType;

class MetadataManagerDummy extends MetadataManager
{
    public function createAssocationFromNavigationProperty(
        TEntityTypeType $principalType,
        TEntityTypeType $dependentType,
        TNavigationPropertyType $principalNavigationProperty,
        TNavigationPropertyType $dependentNavigationProperty = null,
        $principalMultiplicity,
        $dependentMultiplicity,
        array $principalConstraintProperty = null,
        array $dependentConstraintProperty = null
    ) {
        return parent::createAssocationFromNavigationProperty(
            $principalType,
            $dependentType,
            $principalNavigationProperty,
            $dependentNavigationProperty,
            $principalMultiplicity,
            $dependentMultiplicity,
            $principalConstraintProperty,
            $dependentConstraintProperty
        );
    }
}
