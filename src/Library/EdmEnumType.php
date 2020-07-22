<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Helpers\SchemaElementHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPrimitiveValue;
use AlgoWeb\ODataMetadata\Library\Core\EdmCoreModel;

class EdmEnumType extends EdmType implements IEnumType
{
    use SchemaElementHelpers;
    /**
     * @var IPrimitiveType
     */
    private $underlyingType;
    /**
     * @var string
     */
    private $namespaceName;
    /**
     * @var string
     */
    private $name;
    /**
     * @var bool
     */
    private $isFlags;
    /**
     * @var array<IEnumMember>
     */
    private $members = [];

    /**
     * EdmEnumType constructor.
     * @param string                                $namespaceName
     * @param string                                $name
     * @param PrimitiveTypeKind|IPrimitiveType|null $underlyingType
     * @param bool|null                             $isFlags
     */
    public function __construct(string $namespaceName, string $name, $underlyingType = null, ?bool $isFlags = false)
    {
        $underlyingType = $underlyingType ?? PrimitiveTypeKind::Int32();
        if ($underlyingType instanceof PrimitiveTypeKind) {
            $underlyingType = EdmCoreModel::getInstance()->GetPrimitive($underlyingType, false);
        }
        assert($underlyingType instanceof IPrimitiveType);
        $this->namespaceName  = $namespaceName;
        $this->name           = $name;
        $this->underlyingType = $underlyingType;
        $this->isFlags        = $isFlags;
    }

    /**
     * @return IPrimitiveType gets the underlying type of this enumeration type
     */
    public function getUnderlyingType(): IPrimitiveType
    {
        return $this->underlyingType;
    }

    /**
     * @return IEnumMember[] gets the members of this enumeration type
     */
    public function getMembers(): array
    {
        return $this->members;
    }

    /**
     * @return bool gets a value indicating whether the enumeration type can be treated as a bit field
     */
    public function isFlags(): bool
    {
        return $this->isFlags;
    }

    /**
     * @return string|null gets the name of this element
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return SchemaElementKind gets the kind of this schema element
     */
    public function getSchemaElementKind(): SchemaElementKind
    {
        return SchemaElementKind::TypeDefinition();
    }

    /**
     * @return string|null gets the namespace this schema element belongs to
     */
    public function getNamespace(): ?string
    {
        return $this->namespaceName;
    }

    /**
     * @return TypeKind gets the kind of this type
     */
    public function getTypeKind(): TypeKind
    {
        return TypeKind::Enum();
    }


    /**
     * Adds a new member to this enum type.
     *
     * @param IEnumMember $member the member to add
     */
    public function AddRawMember(IEnumMember $member): void
    {
        $this->members[] = $member;
    }

    /**
     * Creates and adds a new member to this enum type.
     *
     * @param  string          $name  name of the member
     * @param  IPrimitiveValue $value value of the member
     * @return EdmEnumMember   created member
     */
    public function AddMember(string $name, IPrimitiveValue $value): EdmEnumMember
    {
        $member = new EdmEnumMember($this, $name, $value);
        $this->AddRawMember($member);
        return $member;
    }
}
