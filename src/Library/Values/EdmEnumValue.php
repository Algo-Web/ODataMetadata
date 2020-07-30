<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Values;

use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Helpers\ValueHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;
use AlgoWeb\ODataMetadata\Interfaces\IEnumTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\Values\IEnumValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPrimitiveValue;

class EdmEnumValue extends EdmValue implements IEnumValue
{
    use ValueHelpers;
    private $value;

    /**
     * Initializes a new instance of the EdmBooleanConstant class.
     *
     * @param IEnumMember|IPrimitiveValue $value the enumeration or underlying type value
     * @param IEnumTypeReference|null     $type  Type of the boolean. A reference to the enumeration type that describes this value.
     */
    public function __construct($value, ?IEnumTypeReference $type = null)
    {
        parent::__construct($type);
        $value = $value instanceof IEnumMember ? $value->getValue() : $value;
        assert($value instanceof IPrimitiveValue);
        $this->value = $value;
    }

    /**
     * @return IPrimitiveValue gets the definition of this binary value
     */
    public function getValue(): IPrimitiveValue
    {
        return $this->value;
    }

    /**
     * @return ValueKind gets the kind of this value
     */
    public function getValueKind(): ValueKind
    {
        return ValueKind::Enum();
    }
}
