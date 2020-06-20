<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Enums\Multiplicity;
use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Enums\TermKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Exception\ArgumentException;
use AlgoWeb\ODataMetadata\Helpers\EntityTypeHelpers;
use AlgoWeb\ODataMetadata\Helpers\SchemaElementHelpers;
use AlgoWeb\ODataMetadata\Helpers\TypeHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\StringConst;

class EdmEntityType extends EdmStructuredType implements IEntityType
{
    use TypeHelpers;
    use SchemaElementHelpers;
    use EntityTypeHelpers;
    /**
     * @var string
     */
    private $namespaceName;
    /**
     * @var string
     */
    private $name;
    /**
     * @var array<IStructuralProperty>
     */
    private $declaredKey = [];

    /**
     * Initializes a new instance of the EdmEntityType class.
     *
     * @param string      $namespaceName      namespace the entity belongs to
     * @param string      $name               name of the entity
     * @param bool        $isAbstract         denotes an entity that cannot be instantiated
     * @param bool        $isOpen             denotes if the type is open
     * @param IEntityType $baseStructuredType the base type of this entity type
     */
    public function __construct(string $namespaceName, string $name, bool $isAbstract =false, bool $isOpen= true, IEntityType $baseStructuredType = null)
    {
        parent::__construct($isAbstract, $isOpen, $baseStructuredType);
        $this->namespaceName = $namespaceName;
        $this->name          = $name;
    }

    /**
     * @return TypeKind gets the kind of this type
     */
    public function getTypeKind(): TypeKind
    {
        return TypeKind::Entity();
    }

    /**
     * @return array|IStructuralProperty[] gets the structural properties of the entity type that make up the entity key
     */
    public function getDeclaredKey(): ?array
    {
        return $this->declaredKey;
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
     * @return string gets the namespace this schema element belongs to
     */
    public function getNamespace(): string
    {
        return $this->namespaceName;
    }

    /**
     * Gets the kind of a term.
     *
     * @return TermKind
     */
    public function getTermKind(): TermKind
    {
        return TermKind::Type();
    }

    /**
     * Adds the keyProperties to the key of this entity type.
     *
     * @param array ...$keyProperties
     */
    public function AddKeys(array ...$keyProperties): void
    {
        foreach ($keyProperties as $property) {
            if ($this->declaredKey === null) {
                $this->declaredKey = [];
            }

            $this->declaredKey[] = $property;
        }
    }

    /**
     * Creates and adds a unidirectional navigation property to this type.
     * Navigation property partner is created, but not added to the navigation target type.
     *
     * @param  EdmNavigationPropertyInfo      $propertyInfo information to create the navigation property
     * @param  EdmNavigationPropertyInfo|null $partnerInfo  information to create the partner navigation property
     * @return EdmNavigationProperty          created navigation property
     */
    public function AddUnidirectionalNavigation(EdmNavigationPropertyInfo $propertyInfo, EdmNavigationPropertyInfo $partnerInfo = null): EdmNavigationProperty
    {
        $partnerInfo = $partnerInfo ?? $this->FixUpDefaultPartnerInfo($propertyInfo, null);

        $property = EdmNavigationProperty::CreateNavigationPropertyWithPartnerFromInfo($propertyInfo, $this->FixUpDefaultPartnerInfo($propertyInfo, $partnerInfo));

        $this->AddProperty($property);
        return $property;
    }

    /**
     * Creates and adds a navigation property to this type and adds its navigation partner to the navigation target type.
     *
     * @param  EdmNavigationPropertyInfo $propertyInfo information to create the navigation property
     * @param  EdmNavigationPropertyInfo $partnerInfo  information to create the partner navigation property
     * @return EdmNavigationProperty     created navigation property
     */
    public function AddBidirectionalNavigation(EdmNavigationPropertyInfo $propertyInfo, EdmNavigationPropertyInfo $partnerInfo): EdmNavigationProperty
    {
        EdmUtil::CheckArgumentNull($propertyInfo->target, 'propertyInfo.Target');

        if (!$propertyInfo->target instanceof EdmEntityType) {
            throw new ArgumentException(StringConst::Constructable_TargetMustBeStock(EdmEntityType::class));
        }

        $property = EdmNavigationProperty::CreateNavigationPropertyWithPartnerFromInfo($propertyInfo, $this->FixUpDefaultPartnerInfo($propertyInfo, $partnerInfo));

        $this->AddProperty($property);
        $propertyInfo->target->AddProperty($property->getPartner());
        return $property;
    }


    /**
     * The purpose of this method is to make sure that some of the partnerInfo fields are set to valid partner defaults.
     * For example if partnerInfo.Target is null, it will be set to this entity type. If partnerInfo.TargetMultiplicity
     * is unknown, it will be set to 0..1, etc.
     * Whenever this method applies new values to partnerInfo, it will return a copy of it (thus won't modify the original).
     * If partnerInfo is null, a new info object will be produced.
     *
     * @param  EdmNavigationPropertyInfo $propertyInfo primary navigation property info
     * @param  EdmNavigationPropertyInfo $partnerInfo  Partner navigation property info. May be null.
     * @return EdmNavigationPropertyInfo Partner info
     */
    private function FixUpDefaultPartnerInfo(EdmNavigationPropertyInfo $propertyInfo, EdmNavigationPropertyInfo $partnerInfo): EdmNavigationPropertyInfo
    {
        $partnerInfoOverride = null;

        if ($partnerInfo == null) {
            $partnerInfo = $partnerInfoOverride = new EdmNavigationPropertyInfo();
        }

        if ($partnerInfo->name == null) {
            if ($partnerInfoOverride == null) {
                $partnerInfoOverride = $partnerInfo->clone();
            }

            $partnerInfoOverride->name = $propertyInfo->name ?? '' . 'Partner';
        }

        if ($partnerInfo->target == null) {
            if ($partnerInfoOverride == null) {
                $partnerInfoOverride = $partnerInfo->clone();
            }

            $partnerInfoOverride->target = $this;
        }

        if ($partnerInfo->targetMultiplicity == Multiplicity::Unknown()) {
            if ($partnerInfoOverride == null) {
                $partnerInfoOverride = $partnerInfo->clone();
            }

            $partnerInfoOverride->targetMultiplicity = Multiplicity::ZeroOrOne();
        }

        return $partnerInfoOverride ?? $partnerInfo;
    }
}
