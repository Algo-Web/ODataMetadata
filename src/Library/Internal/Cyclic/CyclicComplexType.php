<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Internal\Bad\Cyclic;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadComplexType;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Represents an EDM complex type that cannot be determined due to a cyclic reference.
 *
 * @package AlgoWeb\ODataMetadata\Library\Internal\Bad
 */
class CyclicComplexType extends BadComplexType
{
    /**
     * CyclicComplexType constructor.
     * @param string|null $qualifiedName
     * @param ILocation   $location
     */
    public function __construct(?string $qualifiedName, ILocation $location)
    {
        $error = new EdmError(
            $location,
            EdmErrorCode::BadCyclicComplex(),
            StringConst::Bad_CyclicComplex($qualifiedName)
        );
        parent::__construct($qualifiedName, [$error]);
    }
}
