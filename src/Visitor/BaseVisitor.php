<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Visitor;

use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IPropertyValueBinding;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\ITypeAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IApplyExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IAssertTypeExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IBinaryConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IBooleanConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ICollectionExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDateTimeConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDateTimeOffsetConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDecimalConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IEntitySetReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IEnumMemberReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IFloatingConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IFunctionReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IGuidConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIfExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIntegerConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIsTypeExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpressionReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\INullExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IParameterReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPathExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPropertyReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IRecordExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IStringConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ITimeConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\RecordExpression\IPropertyConstructor;
use AlgoWeb\ODataMetadata\Interfaces\IBinaryTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IComplexType;
use AlgoWeb\ODataMetadata\Interfaces\IComplexTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IDecimalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainerElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\Interfaces\IEnumTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionBase;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\INamedElement;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\IRowTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\ISpatialTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStringTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;

abstract class BaseVisitor implements IVisitor
{
    public function startVocabularyAnnotation(IVocabularyAnnotation $annotation): void
    {
    }

    public function endVocabularyAnnotation(IVocabularyAnnotation $annotation): void
    {
    }

    public function startImmediateValueAnnotation(IDirectValueAnnotation $annotation): void
    {
    }

    public function endImmediateValueAnnotation(IDirectValueAnnotation $annotation): void
    {
    }

    public function startValueAnnotation(IValueAnnotation $annotation): void
    {
    }

    public function endValueAnnotation(IValueAnnotation $annotation): void
    {
    }

    public function startTypeAnnotation(ITypeAnnotation $annotation): void
    {
    }

    public function endTypeAnnotation(ITypeAnnotation $annotation): void
    {
    }

    public function startPropertyValueBinding(IPropertyValueBinding $binding): void
    {
    }

    public function endPropertyValueBinding(IPropertyValueBinding $binding): void
    {
    }

    public function startElement(IEdmElement $element): void
    {
    }

    public function endElement(IEdmElement $element): void
    {
    }

    public function startNamedElement(INamedElement $element): void
    {
    }

    public function endNamedElement(INamedElement $element): void
    {
    }

    public function startSchemaElement(ISchemaElement $element): void
    {
    }

    public function endSchemaElement(ISchemaElement $element): void
    {
    }

    public function startVocabularyAnnotatable(IVocabularyAnnotatable $annotatable): void
    {
    }

    public function endVocabularyAnnotatable(IVocabularyAnnotatable $annotatable): void
    {
    }

    public function startEntityContainer(IEntityContainer $container): void
    {
    }

    public function endEntityContainer(IEntityContainer $container): void
    {
    }

    public function startEntityContainerElement(IEntityContainerElement $element): void
    {
    }

    public function endEntityContainerElement(IEntityContainerElement $element): void
    {
    }

    public function startEntitySet(IEntitySet $set): void
    {
    }

    public function endEntitySet(IEntitySet $set): void
    {
    }

    public function startNavigationProperty(INavigationProperty $property): void
    {
    }

    public function endNavigationProperty(INavigationProperty $property): void
    {
    }

    public function startStructuralProperty(IStructuralProperty $property): void
    {
    }

    public function endStructuralProperty(IStructuralProperty $property): void
    {
    }

    public function startProperty(IProperty $property): void
    {
    }

    public function endProperty(IProperty $property): void
    {
    }

    public function startEnumMember(IEnumMember $enumMember): void
    {
    }

    public function endEnumMember(IEnumMember $enumMember): void
    {
    }

    public function startExpression(IExpression $expression): void
    {
    }

    public function endExpression(IExpression $expression): void
    {
    }

    public function startStringConstantExpression(IStringConstantExpression $expression): void
    {
    }

    public function endStringConstantExpression(IStringConstantExpression $expression): void
    {
    }

    public function startBinaryConstantExpression(IBinaryConstantExpression $expression): void
    {
    }

    public function endBinaryConstantExpression(IBinaryConstantExpression $expression): void
    {
    }

    public function startRecordExpression(IRecordExpression $expression): void
    {
    }

    public function endRecordExpression(IRecordExpression $expression): void
    {
    }

    public function startPropertyReferenceExpression(IPropertyReferenceExpression $expression): void
    {
    }

    public function endPropertyReferenceExpression(IPropertyReferenceExpression $expression): void
    {
    }

    public function startPathExpression(IPathExpression $expression): void
    {
    }

    public function endPathExpression(IPathExpression $expression): void
    {
    }

    public function startParameterReferenceExpression(IParameterReferenceExpression $expression): void
    {
    }

    public function endParameterReferenceExpression(IParameterReferenceExpression $expression): void
    {
    }

    public function startCollectionExpression(ICollectionExpression $expression): void
    {
    }

    public function endCollectionExpression(ICollectionExpression $expression): void
    {
    }

    public function startLabeledExpressionReferenceExpression(ILabeledExpressionReferenceExpression $expression): void
    {
    }

    public function endLabeledExpressionReferenceExpression(ILabeledExpressionReferenceExpression $expression): void
    {
    }

    public function startIsTypeExpression(IIsTypeExpression $expression): void
    {
    }

    public function endIsTypeExpression(IIsTypeExpression $expression): void
    {
    }

    public function startIntegerConstantExpression(IIntegerConstantExpression $expression): void
    {
    }

    public function endIntegerConstantExpression(IIntegerConstantExpression $expression): void
    {
    }

    public function startIfExpression(IIfExpression $expression): void
    {
    }

    public function endIfExpression(IIfExpression $expression): void
    {
    }

    public function startFunctionReferenceExpression(IFunctionReferenceExpression $expression): void
    {
    }

    public function endFunctionReferenceExpression(IFunctionReferenceExpression $expression): void
    {
    }

    public function startFunctionApplicationExpression(IApplyExpression $expression): void
    {
    }

    public function endFunctionApplicationExpression(IApplyExpression $expression): void
    {
    }

    public function startFloatingConstantExpression(IFloatingConstantExpression $expression): void
    {
    }

    public function endFloatingConstantExpression(IFloatingConstantExpression $expression): void
    {
    }

    public function startGuidConstantExpression(IGuidConstantExpression $expression): void
    {
    }

    public function endGuidConstantExpression(IGuidConstantExpression $expression): void
    {
    }

    public function startEnumMemberReferenceExpression(IEnumMemberReferenceExpression $expression): void
    {
    }

    public function endEnumMemberReferenceExpression(IEnumMemberReferenceExpression $expression): void
    {
    }

    public function startEntitySetReferenceExpression(IEntitySetReferenceExpression $expression): void
    {
    }

    public function endEntitySetReferenceExpression(IEntitySetReferenceExpression $expression): void
    {
    }

    public function startDecimalConstantExpression(IDecimalConstantExpression $expression): void
    {
    }

    public function endDecimalConstantExpression(IDecimalConstantExpression $expression): void
    {
    }

    public function startDateTimeConstantExpression(IDateTimeConstantExpression $expression): void
    {
    }

    public function endDateTimeConstantExpression(IDateTimeConstantExpression $expression): void
    {
    }

    public function startDateTimeOffsetConstantExpression(IDateTimeOffsetConstantExpression $expression): void
    {
    }

    public function endDateTimeOffsetConstantExpression(IDateTimeOffsetConstantExpression $expression): void
    {
    }

    public function startTimeConstantExpression(ITimeConstantExpression $expression): void
    {
    }

    public function endTimeConstantExpression(ITimeConstantExpression $expression): void
    {
    }

    public function startBooleanConstantExpression(IBooleanConstantExpression $expression): void
    {
    }

    public function endBooleanConstantExpression(IBooleanConstantExpression $expression): void
    {
    }

    public function startAssertTypeExpression(IAssertTypeExpression $expression): void
    {
    }

    public function endAssertTypeExpression(IAssertTypeExpression $expression): void
    {
    }

    public function startLabeledExpression(ILabeledExpression $element): void
    {
    }

    public function endLabeledExpression(ILabeledExpression $element): void
    {
    }

    public function startPropertyConstructor(IPropertyConstructor $constructor): void
    {
    }

    public function endPropertyConstructor(IPropertyConstructor $constructor): void
    {
    }

    public function startNullConstantExpression(INullExpression $expression): void
    {
    }

    public function endNullConstantExpression(INullExpression $expression): void
    {
    }

    public function startFunction(IFunction $function): void
    {
    }

    public function endFunction(IFunction $function): void
    {
    }

    public function startFunctionImport(IFunctionImport $functionImport): void
    {
    }

    public function endFunctionImport(IFunctionImport $functionImport): void
    {
    }

    public function startFunctionBase(IFunctionBase $functionBase): void
    {
    }

    public function endFunctionBase(IFunctionBase $functionBase): void
    {
    }

    public function startFunctionParameter(IFunctionParameter $parameter): void
    {
    }

    public function endFunctionParameter(IFunctionParameter $parameter): void
    {
    }

    public function startTerm(ITerm $term): void
    {
    }

    public function endTerm(ITerm $term): void
    {
    }

    public function startValueTerm(IValueTerm $term): void
    {
    }

    public function endValueTerm(IValueTerm $term): void
    {
    }

    public function startComplexType(IComplexType $definition): void
    {
    }

    public function endComplexType(IComplexType $definition): void
    {
    }

    public function startEntityType(IEntityType $definition): void
    {
    }

    public function endEntityType(IEntityType $definition): void
    {
    }

    public function startRowType(IRowType $definition): void
    {
    }

    public function endRowType(IRowType $definition): void
    {
    }

    public function startCollectionType(ICollectionType $definition): void
    {
    }

    public function endCollectionType(ICollectionType $definition): void
    {
    }

    public function startEnumType(IEnumType $definition): void
    {
    }

    public function endEnumType(IEnumType $definition): void
    {
    }

    public function startEntityReferenceType(IEntityReferenceType $definition): void
    {
    }

    public function endEntityReferenceType(IEntityReferenceType $definition): void
    {
    }

    public function startStructuredType(IStructuredType $definition): void
    {
    }

    public function endStructuredType(IStructuredType $definition): void
    {
    }

    public function startSchemaType(ISchemaType $type): void
    {
    }

    public function endSchemaType(ISchemaType $type): void
    {
    }

    public function startType(IType $definition): void
    {
    }

    public function endType(IType $definition): void
    {
    }

    public function startComplexTypeReference(IComplexTypeReference $reference): void
    {
    }

    public function endComplexTypeReference(IComplexTypeReference $reference): void
    {
    }

    public function startEntityTypeReference(IEntityTypeReference $reference): void
    {
    }

    public function endEntityTypeReference(IEntityTypeReference $reference): void
    {
    }

    public function startEntityReferenceTypeReference(IEntityReferenceTypeReference $reference): void
    {
    }

    public function endEntityReferenceTypeReference(IEntityReferenceTypeReference $reference): void
    {
    }

    public function startRowTypeReference(IRowTypeReference $reference): void
    {
    }

    public function endRowTypeReference(IRowTypeReference $reference): void
    {
    }

    public function startCollectionTypeReference(ICollectionTypeReference $reference): void
    {
    }

    public function endCollectionTypeReference(ICollectionTypeReference $reference): void
    {
    }

    public function startEnumTypeReference(IEnumTypeReference $reference): void
    {
    }

    public function endEnumTypeReference(IEnumTypeReference $reference): void
    {
    }

    public function startBinaryTypeReference(IBinaryTypeReference $reference): void
    {
    }

    public function endBinaryTypeReference(IBinaryTypeReference $reference): void
    {
    }

    public function startDecimalTypeReference(IDecimalTypeReference $reference): void
    {
    }

    public function endDecimalTypeReference(IDecimalTypeReference $reference): void
    {
    }

    public function startSpatialTypeReference(ISpatialTypeReference $reference): void
    {
    }

    public function endSpatialTypeReference(ISpatialTypeReference $reference): void
    {
    }

    public function startStringTypeReference(IStringTypeReference $reference): void
    {
    }

    public function endStringTypeReference(IStringTypeReference $reference): void
    {
    }

    public function startTemporalTypeReference(ITemporalTypeReference $reference): void
    {
    }

    public function endTemporalTypeReference(ITemporalTypeReference $reference): void
    {
    }

    public function startPrimitiveTypeReference(IPrimitiveTypeReference $reference): void
    {
    }

    public function endPrimitiveTypeReference(IPrimitiveTypeReference $reference): void
    {
    }

    public function startStructuredTypeReference(IStructuredTypeReference $reference): void
    {
    }

    public function endStructuredTypeReference(IStructuredTypeReference $reference): void
    {
    }

    public function startTypeReference(ITypeReference $element): void
    {
    }

    public function endTypeReference(ITypeReference $element): void
    {
    }
}
