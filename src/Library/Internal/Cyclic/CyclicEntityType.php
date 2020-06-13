<?php


namespace AlgoWeb\ODataMetadata\Library\Internal\Cyclic;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadEntityType;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Represents an EDM entity type that cannot be determined due to a cyclic reference.
 *
 * @package AlgoWeb\ODataMetadata\Library\Internal\Cyclic
 */
class CyclicEntityType extends BadEntityType
{
    public function __construct(?string $qualifiedName, ILocation $location)
    {
        parent::__construct($qualifiedName, [new EdmError($location, EdmErrorCode::BadCyclicEntity(), StringConst::Bad_CyclicEntity($qualifiedName)) ]);
    }

}