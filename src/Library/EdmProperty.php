<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Edm\Internal\IDependent;
use AlgoWeb\ODataMetadata\Enums\PropertyKind;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

/**
 * Class EdmProperty.
 *
 * Represents an EDM property.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
abstract class EdmProperty extends EdmNamedElement implements IProperty
{
    /***
     * @var IStructuredType
     */
    private $declaringType;
    /**
     * @var array<IDependent>
     */
    protected $dependents =[];
    /**
     * @var ITypeReference
     */
    private $type;

    /**
     * Initializes a new instance of the EdmProperty class.
     *
     * @param IStructuredType $declaringType the type that declares this property
     * @param string          $name          name of the property
     * @param ITypeReference  $type          type of the property
     */
    public function __construct(IStructuredType $declaringType, string $name, ITypeReference $type)
    {
        parent::__construct($name);
        $this->declaringType = $declaringType;
        $this->type          = $type;
    }

    /**
     * @return PropertyKind gets the kind of this property
     */
    abstract public function getPropertyKind(): PropertyKind;

    /**
     * @return ITypeReference gets the type of this property
     */
    public function getType(): ITypeReference
    {
        return $this->type;
    }

    /**
     * @return IStructuredType gets the type that this property belongs to
     */
    public function getDeclaringType(): IStructuredType
    {
        return $this->declaringType;
    }
}
