<?php

declare(strict_types=1);

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
        $error = new EdmError(
            $location,
            EdmErrorCode::BadCyclicEntity(),
            StringConst::Bad_CyclicEntity($qualifiedName)
        );
        parent::__construct($qualifiedName, [$error]);
    }
}
