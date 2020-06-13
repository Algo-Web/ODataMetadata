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
    public function WriteValueTermElementHeader(IValueTerm $term, bool $inlineType): void;

    public function WriteAssociationElementHeader(INavigationProperty $navigationProperty): void;

    public function WriteAssociationSetElementHeader(IEntitySet $entitySet, INavigationProperty $navigationProperty): void;

    public function WriteComplexTypeElementHeader(IComplexType $complexType): void;

    public function WriteEnumTypeElementHeader(IEnumType $enumType): void;

    public function WriteDocumentationElement(IDocumentation $documentation): void;

    public function WriteAssociationSetEndElementHeader(IEntitySet $entitySet, INavigationProperty $property): void;

    public function WriteAssociationEndElementHeader(INavigationProperty $associationEnd): void;

    public function WriteEntityContainerElementHeader(IEntityContainer $container): void;

    public function WriteEntitySetElementHeader(IEntitySet $entitySet): void;

    public function WriteEntityTypeElementHeader(IEntityType $entityType): void;

    public function WriteDelaredKeyPropertiesElementHeader(): void;

    public function WritePropertyRefElement(IStructuralProperty $property): void;

    public function WriteNavigationPropertyElementHeader(INavigationProperty $member): void;

    public function WriteOperationActionElement(string $elementName, OnDeleteAction $operationAction): void;

    public function WriteSchemaElementHeader(EdmSchema $schema, ?string $alias, array $mappings): void;

    public function WriteAnnotationsElementHeader(string $annotationsTarget): void;

    public function WriteStructuralPropertyElementHeader(IStructuralProperty $property, bool $inlineType): void;

    public function WriteEnumMemberElementHeader(IEnumMember $member): void;

    public function WriteNullableAttribute(ITypeReference $reference): void;

    public function WriteBinaryTypeAttributes(IBinaryTypeReference $reference): void;

    public function WriteDecimalTypeAttributes(IDecimalTypeReference $reference): void;

    public function WriteSpatialTypeAttributes(ISpatialTypeReference $reference): void;

    public function WriteStringTypeAttributes(IStringTypeReference $reference): void;

    public function WriteTemporalTypeAttributes(ITemporalTypeReference $reference): void;

    public function WriteReferentialConstraintElementHeader(INavigationProperty $constraint): void;

    public function WriteReferentialConstraintPrincipalEndElementHeader(INavigationProperty $end): void;

    public function WriteReferentialConstraintDependentEndElementHeader(INavigationProperty $end): void;

    public function WriteNamespaceUsingElement(string $usingNamespace, string $alias): void;

    public function WriteAnnotationStringAttribute(IDirectValueAnnotation $annotation): void;

    public function WriteAnnotationStringElement(IDirectValueAnnotation $annotation): void;

    public function WriteFunctionElementHeader(IFunction $function, bool $inlineReturnType): void;

    public function WriteDefiningExpressionElement(string $expression): void;

    public function WriteReturnTypeElementHeader();

    public function WriteFunctionImportElementHeader(IFunctionImport $functionImport): void;

    public function WriteFunctionParameterElementHeader(IFunctionParameter $parameter, bool $inlineType): void;

    public function WriteCollectionTypeElementHeader(ICollectionType $collectionType, bool $inlineType): void;

    public function WriteRowTypeElementHeader(): void;

    public function WriteInlineExpression(IExpression $expression): void;

    public function WriteValueAnnotationElementHeader(IValueAnnotation $annotation, bool $isInline): void;

    public function WriteTypeAnnotationElementHeader(ITypeAnnotation $annotation): void;

    public function WritePropertyValueElementHeader(IPropertyValueBinding $value, bool $isInline): void;

    public function WriteRecordExpressionElementHeader(IRecordExpression $expression);

    public function WritePropertyConstructorElementHeader(IPropertyConstructor $constructor, bool $isInline): void;

    public function WriteStringConstantExpressionElement(IStringConstantExpression $expression): void;

    public function WriteBinaryConstantExpressionElement(IBinaryConstantExpression $expression): void;

    public function WriteBooleanConstantExpressionElement(IBooleanConstantExpression $expression): void;

    public function WriteNullConstantExpressionElement(INullExpression $expression): void;

    public function WriteDateTimeConstantExpressionElement(IDateTimeConstantExpression $expression): void;

    public function WriteDateTimeOffsetConstantExpressionElement(IDateTimeOffsetConstantExpression $expression): void;

    public function WriteDecimalConstantExpressionElement(IDecimalConstantExpression $expression): void;

    public function WriteFloatingConstantExpressionElement(IFloatingConstantExpression $expression): void;

    public function WriteFunctionApplicationElementHeader(IApplyExpression $expression, bool $isFunction): void;

    public function WriteGuidConstantExpressionElement(IGuidConstantExpression $expression): void;

    public function WriteIntegerConstantExpressionElement(IIntegerConstantExpression $expression): void;

    public function WritePathExpressionElement(IPathExpression $expression): void;

    public function WriteIfExpressionElementHeader(IIfExpression $expression): void;

    public function WriteCollectionExpressionElementHeader(ICollectionExpression $expression): void;

    public function WriteLabeledElementHeader(ILabeledExpression $labeledElement): void;

    public function WriteIsTypeExpressionElementHeader(IIsTypeExpression $expression, bool $inlineType): void;

    public function WriteAssertTypeExpressionElementHeader(IAssertTypeExpression $expression, bool $inlineType): void;

    public function WriteEntitySetReferenceExpressionElement(IEntitySetReferenceExpression $expression): void;

    public function WriteParameterReferenceExpressionElement(IParameterReferenceExpression $expression): void;

    public function WriteFunctionReferenceExpressionElement(IFunctionReferenceExpression $expression): void;

    public function WriteEnumMemberReferenceExpressionElement(IEnumMemberReferenceExpression $expression): void;

    public function WritePropertyReferenceExpressionElementHeader(IPropertyReferenceExpression $expression): void;

    public function WriteEndElement(): void;

    public function WriteOptionalAttribute(string $attribute, $value, $defaultValue, callable $toXml): void;

    public function WriteRequiredAttribute(string $attribute, $value, callable $toXml): void;
}
