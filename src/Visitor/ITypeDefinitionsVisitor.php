<?php


namespace AlgoWeb\ODataMetadata\Visitor;


use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\IComplexType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\IType;

interface ITypeDefinitionsVisitor
{
    public function startComplexType(IComplexType $definition): void;
    public function endComplexType(IComplexType $definition): void;
    public function startEntityType(IEntityType $definition): void;
    public function endEntityType(IEntityType $definition): void;
    public function startRowType(IRowType $definition): void;
    public function endRowType(IRowType $definition): void;
    public function startCollectionType(ICollectionType $definition): void;
    public function endCollectionType(ICollectionType $definition): void;
    public function startEnumType(IEnumType $definition): void;
    public function endEnumType(IEnumType $definition): void;
    public function startEntityReferenceType(IEntityReferenceType $definition): void;
    public function endEntityReferenceType(IEntityReferenceType $definition): void;
    public function startStructuredType(IStructuredType $definition): void;
    public function endStructuredType(IStructuredType $definition): void;
    public function startSchemaType(ISchemaType $type): void;
    public function endSchemaType(ISchemaType $type): void;
    public function startType(IType $definition): void;
    public function endType(IType $definition): void;

}