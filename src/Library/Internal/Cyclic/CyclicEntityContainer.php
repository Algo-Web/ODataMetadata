<?php


namespace AlgoWeb\ODataMetadata\Library\Internal\Cyclic;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadEntityContainer;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Represents an EDM entity container that cannot be determined due to a cyclic reference.
 *
 * @package AlgoWeb\ODataMetadata\Library\Internal\Cyclic
 */
class CyclicEntityContainer extends BadEntityContainer
{
    public function __construct(string $name, ILocation $location)
    {
        parent::__construct($name, [new EdmError($location, EdmErrorCode::BadCyclicEntityContainer(), StringConst::Bad_CyclicEntityContainer($name))]);
    }

}