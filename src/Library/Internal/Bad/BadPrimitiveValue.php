<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Helpers\ValueHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPrimitiveValue;

class BadPrimitiveValue extends BadElement implements IPrimitiveValue
{
    use ValueHelpers;
    /**
     * @var IPrimitiveTypeReference
     */
    private $type;

    public function __construct(IPrimitiveTypeReference $type, array $errors)
    {
        parent::__construct($errors);
        $this->type = $type;
    }

    /**
     * @return ITypeReference gets the type of this value
     */
    public function getType(): ITypeReference
    {
        return $this->type;
    }

    /**
     * @return ValueKind gets the kind of this value
     */
    public function getValueKind(): ValueKind
    {
        return ValueKind::None();
    }
}
