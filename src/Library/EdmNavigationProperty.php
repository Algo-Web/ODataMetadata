<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Enums\Multiplicity;
use AlgoWeb\ODataMetadata\Enums\OnDeleteAction;
use AlgoWeb\ODataMetadata\Enums\PropertyKind;
use AlgoWeb\ODataMetadata\Exception\ArgumentException;
use AlgoWeb\ODataMetadata\Exception\ArgumentOutOfRangeException;
use AlgoWeb\ODataMetadata\Helpers\NavigationPropertyHelpers;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Library\Core\EdmCoreModel;
use AlgoWeb\ODataMetadata\StringConst;

class EdmNavigationProperty extends EdmProperty implements INavigationProperty
{
    use NavigationPropertyHelpers;
    /**
     * @var bool
     */
    private $containsTarget;
    /**
     * @var OnDeleteAction
     */
    private $onDelete;
    /**
     * @var EdmNavigationProperty
     */
    private $partner;
    /**
     * @var array<IStructuralProperty>
     */
    private $dependentProperties;

    public function __construct(
        IEntityType $declaringType,
        string $name,
        ITypeReference $type,
        ?array $dependentProperties,
        ?bool $containsTarget,
        ?OnDeleteAction $onDelete
    ) {
        parent::__construct($declaringType, $name, $type);
        $this->dependentProperties = $dependentProperties;
        $this->containsTarget      = $containsTarget ?? CsdlConstants::Default_ContainsTarget;
        $this->onDelete            = $onDelete ?? OnDeleteAction::None();
    }

    /**
     * @return INavigationProperty gets the partner of this navigation property
     */
    public function getPartner(): INavigationProperty
    {
        return $this->partner;
    }

    /**
     * @return OnDeleteAction gets the action to execute on the deletion of this end of a bidirectional association
     */
    public function getOnDelete(): OnDeleteAction
    {
        return $this->onDelete;
    }

    /**
     * @return bool gets whether this navigation property originates at the principal end of an association
     */
    public function isPrincipal(): bool
    {
        return $this->dependentProperties === null && $this->partner !== null &&
               $this->partner->dependentProperties !== null;
    }

    /**
     * @return IStructuralProperty[]|null gets the dependent properties of this navigation property, returning null if
     *                                    this is the principal end or if there is no referential constraint
     */
    public function getDependentProperties(): ?array
    {
        return $this->dependentProperties;
    }

    /**
     * @return bool gets a value indicating whether the navigation target is contained inside the navigation source
     */
    public function containsTarget(): bool
    {
        return $this->containsTarget;
    }

    /**
     * @return PropertyKind gets the kind of this property
     */
    public function getPropertyKind(): PropertyKind
    {
        return PropertyKind::Navigation();
    }

    /**
     * Creates two navigation properties representing an association between two entity types.
     *
     * @param  EdmNavigationPropertyInfo $propertyInfo information to create the navigation property
     * @param  EdmNavigationPropertyInfo $partnerInfo  information to create the partner navigation property
     * @return EdmNavigationProperty     created navigation property
     */
    public static function CreateNavigationPropertyWithPartnerFromInfo(
        EdmNavigationPropertyInfo $propertyInfo,
        EdmNavigationPropertyInfo $partnerInfo
    ): EdmNavigationProperty {
        EdmUtil::checkArgumentNull($propertyInfo->name, 'propertyInfo.Name');
        EdmUtil::checkArgumentNull($propertyInfo->target, 'propertyInfo.Target');
        EdmUtil::checkArgumentNull($partnerInfo->name, 'partnerInfo.Name');
        EdmUtil::checkArgumentNull($partnerInfo->target, 'partnerInfo.Target');

        $end1 = new EdmNavigationProperty(
            $partnerInfo->target,
            $propertyInfo->name,
            self::createNavigationPropertyType(
                $propertyInfo->target,
                $propertyInfo->targetMultiplicity
            ),
            $propertyInfo->dependentProperties,
            $propertyInfo->containsTarget,
            $propertyInfo->onDelete
        );

        $end2 = new EdmNavigationProperty(
            $propertyInfo->target,
            $partnerInfo->name,
            self::createNavigationPropertyType(
                $partnerInfo->target,
                $partnerInfo->targetMultiplicity
            ),
            $partnerInfo->dependentProperties,
            $partnerInfo->containsTarget,
            $partnerInfo->onDelete
        );

        $end1->partner = $end2;
        $end2->partner = $end1;
        return $end1;
    }


    /**
     * Creates two navigation properties representing an association between two entity types.
     *
     * @param  string                $propertyName               navigation property name
     * @param  ITypeReference        $propertyType               type of the navigation property
     * @param  IStructuralProperty[] $dependentProperties        dependent properties of the navigation source
     * @param  bool                  $containsTarget             a value indicating whether the navigation source logically contains the navigation target
     * @param  OnDeleteAction        $onDelete                   action to take upon deletion of an instance of the navigation source
     * @param  string                $partnerPropertyName        navigation partner property name
     * @param  ITypeReference        $partnerPropertyType        type of the navigation partner property
     * @param  IStructuralProperty[] $partnerDependentProperties dependent properties of the navigation target
     * @param  bool                  $partnerContainsTarget      a value indicating whether the navigation target logically contains the navigation source
     * @param  OnDeleteAction        $partnerOnDelete            action to take upon deletion of an instance of the navigation target
     * @return EdmNavigationProperty navigation property
     */
    public static function CreateNavigationPropertyWithPartner(
        string $propertyName,
        ITypeReference $propertyType,
        array $dependentProperties,
        bool $containsTarget,
        OnDeleteAction $onDelete,
        string $partnerPropertyName,
        ITypeReference $partnerPropertyType,
        array $partnerDependentProperties,
        bool $partnerContainsTarget,
        OnDeleteAction $partnerOnDelete
    ): EdmNavigationProperty {
        $declaringType = self::GetEntityType($partnerPropertyType);
        if ($declaringType == null) {
            throw new ArgumentException(
                StringConst::Constructable_EntityTypeOrCollectionOfEntityTypeExpected('partnerPropertyType')
            );
        }

        $partnerDeclaringType = self::GetEntityType($propertyType);
        if ($partnerDeclaringType == null) {
            throw new ArgumentException(
                StringConst::Constructable_EntityTypeOrCollectionOfEntityTypeExpected('propertyType')
            );
        }

        $end1 = new EdmNavigationProperty(
            $declaringType,
            $propertyName,
            $propertyType,
            $dependentProperties,
            $containsTarget,
            $onDelete
        );

        $end2 = new EdmNavigationProperty(
            $partnerDeclaringType,
            $partnerPropertyName,
            $partnerPropertyType,
            $partnerDependentProperties,
            $partnerContainsTarget,
            $partnerOnDelete
        );

        $end1->partner = $end2;
        $end2->partner = $end1;
        return $end1;
    }

    private static function GetEntityType(ITypeReference $type): ?IEntityType
    {
        $entityType = null;
        if ($type->isEntity()) {
            /** @var IEntityType $entityType */
            $entityType = $type->getDefinition();
        } elseif ($type->isCollection()) {
            $collectionDef = $type->getDefinition();
            assert($collectionDef instanceof ICollectionType);
            $type = $collectionDef->getElementType();
            if ($type->isEntity()) {
                /** @var IEntityType $entityType */
                $entityType = $type->getDefinition();
                assert($entityType instanceof IEntityType);
            }
        }

        return $entityType;
    }

    private static function createNavigationPropertyType(
        IEntityType $entityType,
        Multiplicity $multiplicity
    ): ITypeReference {
        switch ($multiplicity) {
            case Multiplicity::ZeroOrOne():
                return new EdmEntityTypeReference($entityType, true);

            case Multiplicity::One():
                return new EdmEntityTypeReference($entityType, false);

            case Multiplicity::Many():
                return EdmCoreModel::GetCollection(new EdmEntityTypeReference($entityType, false));

            default:
                throw new ArgumentOutOfRangeException(
                    StringConst::UnknownEnumVal_Multiplicity($multiplicity->getKey())
                );
        }
    }
}
