<?php


namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;


use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\Enums\PropertyKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\IComplexType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainerElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Class VisitTypeDefinitions
 * @package AlgoWeb\ODataMetadata\ModelVisitorConcerns
 * @mixin EdmModelVisitor
 */
trait VisitTypeDefinitions
{
    public function VisitSchemaType(IType $definition):void
    {
        switch ($definition->getTypeKind())
        {
            case TypeKind::Complex():
                assert($definition instanceof IComplexType);
                $this->ProcessComplexType($definition);
                break;
            case TypeKind::Entity():
                assert($definition instanceof IEntityType);

                $this->ProcessEntityType($definition);
                break;
            case TypeKind::Enum():
                assert($definition instanceof IEnumType);

                $this->ProcessEnumType($definition);
                break;
            case TypeKind::None():
                $this->VisitSchemaType($definition);
                break;
            default:
                throw new InvalidOperationException(StringConst::UnknownEnumVal_TypeKind($definition->getTypeKind()->getKey()));
        }
    }

    abstract function ProcessComplexType(IComplexType $definition): void;

    abstract function ProcessEntityType(IEntityType $definition): void;

    abstract function ProcessEnumType(IEnumType $definition): void;

    /**
     * @param IProperty[] $properties
     */
    public function VisitProperties(array $properties): void
    {
        self::VisitCollection($properties, [$this, 'VisitProperty']);
    }

    public function VisitProperty(IProperty $property): void
    {
        switch ($property->getPropertyKind())
        {
            case PropertyKind::Navigation():
                assert($property instanceof INavigationProperty);
                $this->ProcessNavigationProperty($property);
                break;
            case PropertyKind::Structural():
                assert($property instanceof IStructuralProperty);

                $this->ProcessStructuralProperty($property);
                break;
            case PropertyKind::None():
                $this->ProcessProperty($property);
                break;
            default:
                throw new InvalidOperationException(StringConst::UnknownEnumVal_PropertyKind($property->getPropertyKind()->getKey()));
        }
    }

    abstract function ProcessProperty(IProperty $property): void;

    abstract function ProcessNavigationProperty(INavigationProperty $property): void;

    abstract function ProcessStructuralProperty(IStructuralProperty $property): void;

    /**
     * @param IEnumMember[] $enumMembers
     */
    public function VisitEnumMembers(array $enumMembers): void
    {
        self::VisitCollection($enumMembers, [$this, 'VisitEnumMember']);
    }

    public function VisitEnumMember(IEnumMember $enumMember):void
    {
        $this->ProcessEnumMember($enumMember);
    }

    abstract function ProcessEnumMember(IEnumMember $enumMember): void;
}