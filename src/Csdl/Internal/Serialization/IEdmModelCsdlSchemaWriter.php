<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Csdl\Internal\Serialization;

use AlgoWeb\ODataMetadata\Enums\OnDeleteAction;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IPropertyValueBinding;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\ITypeAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IValueAnnotation;
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
use AlgoWeb\ODataMetadata\Interfaces\Expressions\INullExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IParameterReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPathExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPropertyReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IRecordExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IStringConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\RecordExpression\IPropertyConstructor;
use AlgoWeb\ODataMetadata\Interfaces\IBinaryTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\IComplexType;
use AlgoWeb\ODataMetadata\Interfaces\IDecimalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IDocumentation;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\ISpatialTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStringTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;

interface IEdmModelCsdlSchemaWriter
{
    public function writeValueTermElementHeader(IValueTerm $term, bool $inlineType): void;

    public function writeAssociationElementHeader(INavigationProperty $navigationProperty): void;

    public function writeAssociationSetElementHeader(IEntitySet $entitySet, INavigationProperty $navigationProperty): void;

    public function writeComplexTypeElementHeader(IComplexType $complexType): void;

    public function writeEnumTypeElementHeader(IEnumType $enumType): void;

    public function writeDocumentationElement(IDocumentation $documentation): void;

    public function writeAssociationSetEndElementHeader(IEntitySet $entitySet, INavigationProperty $property): void;

    public function writeAssociationEndElementHeader(INavigationProperty $associationEnd): void;

    public function writeEntityContainerElementHeader(IEntityContainer $container): void;

    public function writeEntitySetElementHeader(IEntitySet $entitySet): void;

    public function writeEntityTypeElementHeader(IEntityType $entityType): void;

    public function writeDeclaredKeyPropertiesElementHeader(): void;

    public function writePropertyRefElement(IStructuralProperty $property): void;

    public function writeNavigationPropertyElementHeader(INavigationProperty $member): void;

    public function writeOperationActionElement(string $elementName, OnDeleteAction $operationAction): void;

    public function writeSchemaElementHeader(EdmSchema $schema, ?string $alias, array $mappings): void;

    public function writeAnnotationsElementHeader(string $annotationsTarget): void;

    public function writeStructuralPropertyElementHeader(IStructuralProperty $property, bool $inlineType): void;

    public function writeEnumMemberElementHeader(IEnumMember $member): void;

    public function writeNullableAttribute(ITypeReference $reference): void;

    public function writeBinaryTypeAttributes(IBinaryTypeReference $reference): void;

    public function writeDecimalTypeAttributes(IDecimalTypeReference $reference): void;

    public function writeSpatialTypeAttributes(ISpatialTypeReference $reference): void;

    public function writeStringTypeAttributes(IStringTypeReference $reference): void;

    public function writeTemporalTypeAttributes(ITemporalTypeReference $reference): void;

    public function writeReferentialConstraintElementHeader(INavigationProperty $constraint): void;

    public function writeReferentialConstraintPrincipalEndElementHeader(INavigationProperty $end): void;

    public function writeReferentialConstraintDependentEndElementHeader(INavigationProperty $end): void;

    public function writeNamespaceUsingElement(string $usingNamespace, string $alias): void;

    public function writeAnnotationStringAttribute(IDirectValueAnnotation $annotation): void;

    public function writeAnnotationStringElement(IDirectValueAnnotation $annotation): void;

    public function writeFunctionElementHeader(IFunction $function, bool $inlineReturnType): void;

    public function writeDefiningExpressionElement(string $expression): void;

    public function writeReturnTypeElementHeader();

    public function writeFunctionImportElementHeader(IFunctionImport $functionImport): void;

    public function writeFunctionParameterElementHeader(IFunctionParameter $parameter, bool $inlineType): void;

    public function writeCollectionTypeElementHeader(ICollectionType $collectionType, bool $inlineType): void;

    public function writeRowTypeElementHeader(): void;

    public function writeInlineExpression(IExpression $expression): void;

    public function writeValueAnnotationElementHeader(IValueAnnotation $annotation, bool $isInline): void;

    public function writeTypeAnnotationElementHeader(ITypeAnnotation $annotation): void;

    public function writePropertyValueElementHeader(IPropertyValueBinding $value, bool $isInline): void;

    public function writeRecordExpressionElementHeader(IRecordExpression $expression);

    public function writePropertyConstructorElementHeader(IPropertyConstructor $constructor, bool $isInline): void;

    public function writeStringConstantExpressionElement(IStringConstantExpression $expression): void;

    public function writeBinaryConstantExpressionElement(IBinaryConstantExpression $expression): void;

    public function writeBooleanConstantExpressionElement(IBooleanConstantExpression $expression): void;

    public function writeNullConstantExpressionElement(INullExpression $expression): void;

    public function writeDateTimeConstantExpressionElement(IDateTimeConstantExpression $expression): void;

    public function writeDateTimeOffsetConstantExpressionElement(IDateTimeOffsetConstantExpression $expression): void;

    public function writeDecimalConstantExpressionElement(IDecimalConstantExpression $expression): void;

    public function writeFloatingConstantExpressionElement(IFloatingConstantExpression $expression): void;

    public function writeFunctionApplicationElementHeader(IApplyExpression $expression, bool $isFunction): void;

    public function writeGuidConstantExpressionElement(IGuidConstantExpression $expression): void;

    public function writeIntegerConstantExpressionElement(IIntegerConstantExpression $expression): void;

    public function writePathExpressionElement(IPathExpression $expression): void;

    public function writeIfExpressionElementHeader(IIfExpression $expression): void;

    public function writeCollectionExpressionElementHeader(ICollectionExpression $expression): void;

    public function writeLabeledElementHeader(ILabeledExpression $labeledElement): void;

    public function writeIsTypeExpressionElementHeader(IIsTypeExpression $expression, bool $inlineType): void;

    public function writeAssertTypeExpressionElementHeader(IAssertTypeExpression $expression, bool $inlineType): void;

    public function writeEntitySetReferenceExpressionElement(IEntitySetReferenceExpression $expression): void;

    public function writeParameterReferenceExpressionElement(IParameterReferenceExpression $expression): void;

    public function writeFunctionReferenceExpressionElement(IFunctionReferenceExpression $expression): void;

    public function writeEnumMemberReferenceExpressionElement(IEnumMemberReferenceExpression $expression): void;

    public function writePropertyReferenceExpressionElementHeader(IPropertyReferenceExpression $expression): void;

    public function writeEndElement(): void;

    public function writeOptionalAttribute(string $attribute, $value, $defaultValue, callable $toXml): void;

    public function writeRequiredAttribute(string $attribute, $value, callable $toXml): void;
}
