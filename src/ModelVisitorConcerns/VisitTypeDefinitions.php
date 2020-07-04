<?php

declare(strict_types=1);


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
 * Class VisitTypeDefinitions.
 * @package AlgoWeb\ODataMetadata\ModelVisitorConcerns
 */
trait VisitTypeDefinitions
{
    public function VisitSchemaType(IType $definition): void
    {
        /*
         * @var EdmModelVisitor $this
         */
        switch ($definition->getTypeKind()) {
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
                throw new InvalidOperationException(
                    StringConst::UnknownEnumVal_TypeKind(
                    $definition->getTypeKind()->getKey()
                )
                );
        }
    }

    /**
     * @param IProperty[] $properties
     */
    public function VisitProperties(array $properties): void
    {
        /*
         * @var EdmModelVisitor $this
         */
        self::VisitCollection($properties, [$this, 'VisitProperty']);
    }

    public function VisitProperty(IProperty $property): void
    {
        /*
         * @var EdmModelVisitor $this
         */
        switch ($property->getPropertyKind()) {
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
                throw new InvalidOperationException(
                    StringConst::UnknownEnumVal_PropertyKind(
                    $property->getPropertyKind()->getKey()
                )
                );
        }
    }


    /**
     * @param IEnumMember[] $enumMembers
     */
    public function VisitEnumMembers(array $enumMembers): void
    {
        /*
         * @var EdmModelVisitor $this
         */
        self::VisitCollection($enumMembers, [$this, 'VisitEnumMember']);
    }

    public function VisitEnumMember(IEnumMember $enumMember): void
    {
        /*
         * @var EdmModelVisitor $this
         */
        $this->ProcessEnumMember($enumMember);
    }
}
