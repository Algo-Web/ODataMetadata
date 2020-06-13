<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Csdl\Internal\Serialization\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;

class AssociationAnnotations
{
    /**
     * @var IDirectValueAnnotation
     */
    public $Annotations ;
    /**
     * @var IDirectValueAnnotation
     */
    public $End1Annotations ;
    /**
     * @var IDirectValueAnnotation
     */
    public $End2Annotations;
    /**
     * @var IDirectValueAnnotation
     */
    public $ConstraintAnnotations ;
}
