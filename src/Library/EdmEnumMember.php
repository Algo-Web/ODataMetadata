<?php


namespace AlgoWeb\ODataMetadata\Library;


use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPrimitiveValue;

/**
 *  Represents a member of an EDM enumeration type.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
class EdmEnumMember extends EdmNamedElement implements IEnumMember
{
    /**
     * @var IEnumType
     */
    private $declaringType;
    /**
     * @var IPrimitiveValue
     */
    private $value;

    /**
     * Initializes a new instance of the EdmEnumMember class.
     *
     * @param IEnumType $declaringType The type that declares this member.
     * @param string $name Name of this enumeration member.
     * @param IPrimitiveValue $value Value of this enumeration member.
     */
    public function __construct(IEnumType $declaringType, string $name, IPrimitiveValue $value)
    {
        parent::__construct($name);
        $this->declaringType = $declaringType;
        $this->value = $value;
    }

    /**
     * @return IPrimitiveValue Gets the value of this enumeration type member.
     */
    public function getValue(): IPrimitiveValue
    {
        return $this->value;
    }

    /**
     * @return IEnumType Gets the type that this member belongs to.
     */
    public function getDeclaringType(): IEnumType
    {
        return $this->declaringType;
    }
}