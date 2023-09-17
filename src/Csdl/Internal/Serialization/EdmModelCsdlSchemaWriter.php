<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Csdl\Internal\Serialization;

use AlgoWeb\ODataMetadata\Csdl\Internal\EdmValueWriter;
use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\Enums\ConcurrencyMode;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\FunctionParameterMode;
use AlgoWeb\ODataMetadata\Enums\Multiplicity;
use AlgoWeb\ODataMetadata\Enums\OnDeleteAction;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
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
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ITimeConstantExpression;
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
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\ISpatialTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStringTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPrimitiveValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IStringValue;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Version;
use ReflectionFunction;
use ReflectionMethod;
use XMLWriter;

class EdmModelCsdlSchemaWriter implements IEdmModelCsdlSchemaWriter
{
    /**
     * @var XMLWriter
     */
    protected $xmlWriter;
    /**
     * @var Version
     */
    protected $version;
    /**
     * @var array<string, string>
     */
    private $namespaceAliasMappings;
    /**
     * @var IModel
     */
    private $model;

    /**
     * EdmModelCsdlSchemaWriter constructor.
     * @param IModel    $model
     * @param array     $namespaceAliasMappings
     * @param Version   $version
     * @param XMLWriter $xmlWriter
     */
    public function __construct(IModel $model, array $namespaceAliasMappings, Version $version, XMLWriter $xmlWriter)
    {
        $this->xmlWriter              = $xmlWriter;
        $this->version                = $version;
        $this->namespaceAliasMappings = $namespaceAliasMappings;
        $this->model                  = $model;
    }


    public function WriteValueTermElementHeader(IValueTerm $term, bool $inlineType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_ValueTerm);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $term->getName(), [EdmValueWriter::class, 'StringAsXml']);
        if ($inlineType && $term->getType() != null) {
            $this->WriteRequiredAttribute(CsdlConstants::Attribute_Type, $term->getType(), [$this, 'TypeReferenceAsXml']);
        }
    }

    public function WriteAssociationElementHeader(INavigationProperty $navigationProperty): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Association);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $this->model->GetAssociationName($navigationProperty), [EdmValueWriter::class, 'StringAsXml']);
    }

    public function WriteAssociationSetElementHeader(IEntitySet $entitySet, INavigationProperty $navigationProperty): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_AssociationSet);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $this->model->GetAssociationSetName($entitySet, $navigationProperty), [EdmValueWriter::class,'StringAsXml']);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Association, $this->model->GetAssociationFullName($navigationProperty), [EdmValueWriter::class,'StringAsXml']);
    }

    public function WriteComplexTypeElementHeader(IComplexType $complexType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_ComplexType);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $complexType->getName(), [EdmValueWriter::class,'StringAsXml']);
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_BaseType, $complexType->BaseComplexType(), null, [$this, 'TypeDefinitionAsXml']);
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_Abstract, $complexType->isAbstract(), CsdlConstants::Default_Abstract, [EdmValueWriter::class,'BooleanAsXml']);
    }

    public function WriteEnumTypeElementHeader(IEnumType $enumType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_EnumType);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $enumType->getName(), [EdmValueWriter::class,'StringAsXml']);
        if ($enumType->getUnderlyingType()->getPrimitiveKind() != PrimitiveTypeKind::Int32()) {
            $this->WriteRequiredAttribute(CsdlConstants::Attribute_UnderlyingType, $enumType->getUnderlyingType(), [$this, 'TypeDefinitionAsXml']);
        }

        $this->WriteOptionalAttribute(CsdlConstants::Attribute_IsFlags, $enumType->isFlags(), CsdlConstants::Default_IsFlags, [EdmValueWriter::class,'BooleanAsXml']);
    }

    public function WriteDocumentationElement(IDocumentation $documentation): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Documentation);
        if ($documentation->getSummary() != null) {
            $this->xmlWriter->startElement(CsdlConstants::Element_Summary);
            $this->xmlWriter->writeCdata($documentation->getSummary());
            $this->WriteEndElement();
        }

        if ($documentation->getDescription() != null) {
            $this->xmlWriter->startElement(CsdlConstants::Element_LongDescription);
            $this->xmlWriter->writeCdata($documentation->getDescription());
            $this->WriteEndElement();
        }

        $this->WriteEndElement();
    }

    public function WriteAssociationSetEndElementHeader(IEntitySet $entitySet, INavigationProperty $property): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_End);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Role, $this->model->GetAssociationEndName($property), [EdmValueWriter::class,'StringAsXml']);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_EntitySet, $entitySet->getName(), [EdmValueWriter::class,'StringAsXml']);
    }

    public function WriteAssociationEndElementHeader(INavigationProperty $associationEnd): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_End);
        $declaringType = $associationEnd->getDeclaringType();
        assert($declaringType instanceof IEntityType);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Type, $declaringType->FullName(), [EdmValueWriter::class,'StringAsXml']);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Role, $this->model->GetAssociationEndName($associationEnd), [EdmValueWriter::class,'StringAsXml']);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Multiplicity, $associationEnd->Multiplicity(), [self::class, 'MultiplicityAsXml']);
    }

    public function WriteEntityContainerElementHeader(IEntityContainer $container): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_EntityContainer);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $container->getName(), [EdmValueWriter::class,'StringAsXml']);
        if ($container->isDefault()) {
            $this->xmlWriter->writeAttributeNs(CsdlConstants::Prefix_ODataMetadata, CsdlConstants::Attribute_IsDefaultEntityContainer, null, 'true');
        }
        if ($container->isLazyLoadEnabled()) {
            $this->xmlWriter->writeAttributeNs(CsdlConstants::Prefix_Annotations, CsdlConstants::Attribute_LazyLoadingEnabled, null, 'true');
        }
    }

    public function WriteEntitySetElementHeader(IEntitySet $entitySet): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_EntitySet);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $entitySet->getName(), [EdmValueWriter::class,'StringAsXml']);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_EntityType, $entitySet->getElementType()->FullName(), [EdmValueWriter::class,'StringAsXml']);
    }

    public function WriteEntityTypeElementHeader(IEntityType $entityType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_EntityType);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $entityType->getName(), [EdmValueWriter::class,'StringAsXml']);
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_BaseType, $entityType->BaseEntityType(), null, [$this, 'TypeDefinitionAsXml']);
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_Abstract, $entityType->isAbstract(), CsdlConstants::Default_Abstract, [EdmValueWriter::class, 'BooleanAsXml']);
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_OpenType, $entityType->isOpen(), CsdlConstants::Default_OpenType, [EdmValueWriter::class,'BooleanAsXml']);
    }

    public function WriteDeclaredKeyPropertiesElementHeader(): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Key);
    }

    public function WritePropertyRefElement(IStructuralProperty $property): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_PropertyRef);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $property->getName(), [EdmValueWriter::class,'StringAsXml']);
        $this->WriteEndElement();
    }

    public function WriteNavigationPropertyElementHeader(INavigationProperty $member): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_NavigationProperty);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $member->getName(), [EdmValueWriter::class,'StringAsXml']);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Relationship, $this->model->GetAssociationFullName($member), [EdmValueWriter::class,'StringAsXml']);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_ToRole, $this->model->GetAssociationEndName($member->getPartner()), [EdmValueWriter::class,'StringAsXml']);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_FromRole, $this->model->GetAssociationEndName($member), [EdmValueWriter::class,'StringAsXml']);
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_ContainsTarget, $member->containsTarget(), CsdlConstants::Default_ContainsTarget, [EdmValueWriter::class,'BooleanAsXml']);
    }

    public function WriteOperationActionElement(string $elementName, OnDeleteAction $operationAction): void
    {
        $this->xmlWriter->startElement($elementName);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Action, strval($operationAction), [EdmValueWriter::class,'StringAsXml']);
        $this->WriteEndElement();
    }

    public function WriteSchemaElementHeader(EdmSchema $schema, ?string $alias, array $mappings): void
    {
        $xmlNamespace = self::GetCsdlNamespace($this->version);
        $this->xmlWriter->startElement(CsdlConstants::Element_Schema);
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_Namespace, $schema->getNamespace(), '', [EdmValueWriter::class,'StringAsXml']);
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_Alias, $alias, null, [EdmValueWriter::class,'StringAsXml']);
        foreach ($mappings as $mappingKey => $mappingValue) {
            $this->xmlWriter->writeAttributeNs(EdmConstants::XmlNamespacePrefix, $mappingKey, null, $mappingValue);
        }
    }

    public function WriteAnnotationsElementHeader(string $annotationsTarget): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Annotations);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Target, $annotationsTarget, [EdmValueWriter::class,'StringAsXml']);
    }

    public function WriteStructuralPropertyElementHeader(IStructuralProperty $property, bool $inlineType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Property);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $property->getName(), [EdmValueWriter::class,'StringAsXml']);
        if ($inlineType) {
            $this->WriteRequiredAttribute(CsdlConstants::Attribute_Type, $property->getType(), [$this, 'TypeReferenceAsXml']);
        }

        $this->WriteOptionalAttribute(CsdlConstants::Attribute_ConcurrencyMode, $property->getConcurrencyMode(), CsdlConstants::$Default_ConcurrencyMode, [self::class, 'ConcurrencyModeAsXml']);
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_DefaultValue, $property->getDefaultValueString(), null, [EdmValueWriter::class,'StringAsXml']);
    }

    public function WriteEnumMemberElementHeader(IEnumMember $member): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Member);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $member->getName(), [EdmValueWriter::class,'StringAsXml']);
        $isExplicit = $member->IsValueExplicit($this->model);
        if (null === $isExplicit || $isExplicit) {
            $this->WriteRequiredAttribute(CsdlConstants::Attribute_Value, $member->getValue(), [EdmValueWriter::class, 'PrimitiveValueAsXml']);
        }
    }

    public function WriteNullableAttribute(ITypeReference $reference): void
    {
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_Nullable, $reference->getNullable(), CsdlConstants::Default_Nullable, [EdmValueWriter::class,'BooleanAsXml']);
    }

    public function WriteBinaryTypeAttributes(IBinaryTypeReference $reference): void
    {
        if ($reference->isUnBounded()) {
            $this->WriteRequiredAttribute(CsdlConstants::Attribute_MaxLength, CsdlConstants::Value_Max, [EdmValueWriter::class,'StringAsXml']);
        } else {
            $this->WriteOptionalAttribute(CsdlConstants::Attribute_MaxLength, $reference->getMaxLength(), null, [EdmValueWriter::class, 'IntAsXml']);
        }

        $this->WriteOptionalAttribute(CsdlConstants::Attribute_FixedLength, $reference->isFixedLength(), null, [EdmValueWriter::class,'BooleanAsXml']);
    }

    public function WriteDecimalTypeAttributes(IDecimalTypeReference $reference): void
    {
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_Precision, $reference->getPrecision(), null, [EdmValueWriter::class,'IntAsXml']);
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_Scale, $reference->getScale(), null, [EdmValueWriter::class,'IntAsXml']);
    }

    public function WriteSpatialTypeAttributes(ISpatialTypeReference $reference): void
    {
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Srid, $reference->getSpatialReferenceIdentifier(), [self::class, 'SridAsXml']);
    }

    public function WriteStringTypeAttributes(IStringTypeReference $reference): void
    {
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_Collation, $reference->getCollation(), null, [EdmValueWriter::class,'StringAsXml']);
        if ($reference->isUnbounded()) {
            $this->WriteRequiredAttribute(CsdlConstants::Attribute_MaxLength, CsdlConstants::Value_Max, [EdmValueWriter::class,'StringAsXml']);
        } else {
            $this->WriteOptionalAttribute(CsdlConstants::Attribute_MaxLength, $reference->getMaxLength(), null, [EdmValueWriter::class,'IntAsXml']);
        }

        $this->WriteOptionalAttribute(CsdlConstants::Attribute_FixedLength, $reference->isFixedLength(), null, [EdmValueWriter::class,'BooleanAsXml']);
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_Unicode, $reference->isUnicode(), null, [EdmValueWriter::class,'BooleanAsXml']);
    }

    public function WriteTemporalTypeAttributes(ITemporalTypeReference $reference): void
    {
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_Precision, $reference->getPrecision(), null, [EdmValueWriter::class,'IntAsXml']);
    }

    public function WriteReferentialConstraintElementHeader(INavigationProperty $constraint): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_ReferentialConstraint);
    }

    public function WriteReferentialConstraintPrincipalEndElementHeader(INavigationProperty $end): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Principal);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Role, $this->model->GetAssociationEndName($end), [EdmValueWriter::class,'StringAsXml']);
    }

    public function WriteReferentialConstraintDependentEndElementHeader(INavigationProperty $end): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Dependent);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Role, $this->model->GetAssociationEndName($end), [EdmValueWriter::class,'StringAsXml']);
    }

    public function WriteNamespaceUsingElement(string $usingNamespace, string $alias): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Using);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Namespace, $usingNamespace, [EdmValueWriter::class,'StringAsXml']);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Alias, $alias, [EdmValueWriter::class,'StringAsXml']);
        $this->WriteEndElement();
    }

    public function WriteAnnotationStringAttribute(IDirectValueAnnotation $annotation): void
    {
        $edmValue = $annotation->getValue();
        if ($annotation->getValue() instanceof IPrimitiveValue) {
            $this->xmlWriter->writeAttributeNs('', $annotation->getName(), $annotation->getNamespaceUri(), EdmValueWriter::PrimitiveValueAsXml($edmValue));
        }
    }

    public function WriteAnnotationStringElement(IDirectValueAnnotation $annotation): void
    {
        $edmValue = $annotation->getValue();
        if ($edmValue instanceof IStringValue) {
            $this->xmlWriter->writeRaw($edmValue->getValue());
        }
    }

    public function WriteFunctionElementHeader(IFunction $function, bool $inlineReturnType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Function);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $function->getName(), [EdmValueWriter::class,'StringAsXml']);
        if ($inlineReturnType) {
            $this->WriteRequiredAttribute(CsdlConstants::Attribute_ReturnType, $function->getReturnType(), [$this, 'TypeReferenceAsXml']);
        }
    }

    public function WriteDefiningExpressionElement(string $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_DefiningExpression);
        $this->xmlWriter->writeCdata($expression);
        $this->xmlWriter->endElement();
    }

    public function WriteReturnTypeElementHeader()
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_ReturnType);
    }

    public function WriteFunctionImportElementHeader(IFunctionImport $functionImport): void
    {
        // functionImport can't be Composable and sideEffecting at the same time.
        if ($functionImport->isComposable() && $functionImport->isSideEffecting()) {
            throw new InvalidOperationException(StringConst::EdmModel_Validator_Semantic_ComposableFunctionImportCannotBeSideEffecting($functionImport->getName()));
        }

        $this->xmlWriter->startElement(CsdlConstants::Element_FunctionImport);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $functionImport->getName(), [EdmValueWriter::class,'StringAsXml']);
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_ReturnType, $functionImport->getReturnType(), null, [$this,'TypeReferenceAsXml']);

        // IsSideEffecting is optional, however its default applies to non-composable function imports only.
        // Composable function imports can't be side-effecting, so we don't emit false.
        if (!$functionImport->isComposable() && $functionImport->isSideEffecting() != CsdlConstants::Default_IsSideEffecting) {
            $this->WriteRequiredAttribute(CsdlConstants::Attribute_IsSideEffecting, $functionImport->isSideEffecting(), [EdmValueWriter::class,'BooleanAsXml']);
        }

        $this->WriteOptionalAttribute(CsdlConstants::Attribute_IsComposable, $functionImport->isComposable(), CsdlConstants::Default_IsComposable, [EdmValueWriter::class,'BooleanAsXml']);
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_IsBindable, $functionImport->isBindable(), CsdlConstants::Default_IsBindable, [EdmValueWriter::class,'BooleanAsXml']);
        $entitySetReference = $functionImport->getEntitySet();
        if ($functionImport->getEntitySet() != null) {
            if ($entitySetReference instanceof IEntitySetReferenceExpression) {
                $this->WriteOptionalAttribute(CsdlConstants::Attribute_EntitySet, $entitySetReference->getReferencedEntitySet()->getName(), null, [EdmValueWriter::class,'StringAsXml']);
            } else {
                $pathExpression = $functionImport->getEntitySet();
                if ($pathExpression instanceof IPathExpression) {
                    $this->WriteOptionalAttribute(CsdlConstants::Attribute_EntitySetPath, $pathExpression->getPath(), null, [self::class, 'PathAsXml']);
                } else {
                    throw new InvalidOperationException(StringConst::EdmModel_Validator_Semantic_FunctionImportEntitySetExpressionIsInvalid($functionImport->getName()));
                }
            }
        }
    }

    public function WriteFunctionParameterElementHeader(IFunctionParameter $parameter, bool $inlineType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Parameter);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $parameter->getName(), [EdmValueWriter::class,'StringAsXml']);
        if ($inlineType) {
            $this->WriteRequiredAttribute(CsdlConstants::Attribute_Type, $parameter->getType(), [$this,'TypeReferenceAsXml']);
        }

        $this->WriteOptionalAttribute(CsdlConstants::Attribute_Mode, $parameter->getMode(), CsdlConstants::$Default_FunctionParameterMode, [self::class, 'FunctionParameterModeAsXml']);
    }

    public function WriteCollectionTypeElementHeader(ICollectionType $collectionType, bool $inlineType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_CollectionType);
        if ($inlineType) {
            $this->WriteRequiredAttribute(CsdlConstants::Attribute_ElementType, $collectionType->getElementType(), [$this,'TypeReferenceAsXml']);
        }
    }

    public function WriteRowTypeElementHeader(): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_RowType);
    }

    public function WriteInlineExpression(IExpression $expression): void
    {
        switch ($expression->getExpressionKind()) {
            case ExpressionKind::BinaryConstant():
                assert($expression instanceof IBinaryConstantExpression);
                $this->WriteRequiredAttribute(CsdlConstants::Attribute_Binary, $expression->getValue(), [EdmValueWriter::class, 'BinaryAsXml']);
                break;
            case ExpressionKind::BooleanConstant():
                assert($expression instanceof IBooleanConstantExpression);
                $this->WriteRequiredAttribute(CsdlConstants::Attribute_Bool, $expression->getValue(), [EdmValueWriter::class,'BooleanAsXml']);
                break;
            case ExpressionKind::DateTimeConstant():
                assert($expression instanceof IDateTimeConstantExpression);
                $this->WriteRequiredAttribute(CsdlConstants::Attribute_DateTime, $expression->getValue(), [EdmValueWriter::class, 'DateTimeAsXml']);
                break;
            case ExpressionKind::DateTimeOffsetConstant():
                assert($expression instanceof IDateTimeOffsetConstantExpression);
                $this->WriteRequiredAttribute(CsdlConstants::Attribute_DateTimeOffset, $expression->getValue(), [EdmValueWriter::class, 'DateTimeOffsetAsXml']);
                break;
            case ExpressionKind::DecimalConstant():
                assert($expression instanceof IDecimalConstantExpression);
                $this->WriteRequiredAttribute(CsdlConstants::Attribute_Decimal, $expression->getValue(), [EdmValueWriter::class, 'DecimalAsXml']);
                break;
            case ExpressionKind::FloatingConstant():
                assert($expression instanceof IFloatingConstantExpression);
                $this->WriteRequiredAttribute(CsdlConstants::Attribute_Float, $expression->getValue(), [EdmValueWriter::class,  'FloatAsXml']);
                break;
            case ExpressionKind::GuidConstant():
                assert($expression instanceof IGuidConstantExpression);
                $this->WriteRequiredAttribute(CsdlConstants::Attribute_Guid, $expression->getValue(), [EdmValueWriter::class, 'GuidAsXml']);
                break;
            case ExpressionKind::IntegerConstant():
                assert($expression instanceof IIntegerConstantExpression);
                $this->WriteRequiredAttribute(CsdlConstants::Attribute_Int, $expression->getValue(), [EdmValueWriter::class, 'LongAsXml']);
                break;
            case ExpressionKind::Path():
                assert($expression instanceof IPathExpression);
                $this->WriteRequiredAttribute(CsdlConstants::Attribute_Path, $expression->getPath(), [self::class, 'PathAsXml']);
                break;
            case ExpressionKind::StringConstant():
                assert($expression instanceof IStringConstantExpression);
                $this->WriteRequiredAttribute(CsdlConstants::Attribute_String, $expression->getValue(), [EdmValueWriter::class,'StringAsXml']);
                break;
            case ExpressionKind::TimeConstant():
                assert($expression instanceof ITimeConstantExpression);
                $this->WriteRequiredAttribute(CsdlConstants::Attribute_Time, $expression->getValue(), [EdmValueWriter::class, 'TimeAsXml']);
                break;
            default:
                assert(false, 'Attempted to inline an expression that was not one of the expected inlineable types.');
                break;
        }
    }

    public function WriteValueAnnotationElementHeader(IValueAnnotation $annotation, bool $isInline): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_ValueAnnotation);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Term, $annotation->getTerm(), [$this, 'TermAsXml']);
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_Qualifier, $annotation->getQualifier(), null, [EdmValueWriter::class,'StringAsXml']);
        if ($isInline) {
            $this->WriteInlineExpression($annotation->getValue());
        }
    }

    public function WriteTypeAnnotationElementHeader(ITypeAnnotation $annotation): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_TypeAnnotation);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Term, $annotation->getTerm(), [$this, 'TermAsXml']);
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_Qualifier, $annotation->getQualifier(), null, [EdmValueWriter::class,'StringAsXml']);
    }

    public function WritePropertyValueElementHeader(IPropertyValueBinding $value, bool $isInline): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_PropertyValue);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Property, $value->getBoundProperty()->getName(), [EdmValueWriter::class,'StringAsXml']);
        if ($isInline) {
            $this->WriteInlineExpression($value->getValue());
        }
    }

    public function WriteRecordExpressionElementHeader(IRecordExpression $expression)
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Record);
        $this->WriteOptionalAttribute(CsdlConstants::Attribute_Type, $expression->getDeclaredType(), null, [$this,'TypeReferenceAsXml']);
    }

    public function WritePropertyConstructorElementHeader(IPropertyConstructor $constructor, bool $isInline): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_PropertyValue);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Property, $constructor->getName(), [EdmValueWriter::class,'StringAsXml']);
        if ($isInline) {
            $this->WriteInlineExpression($constructor->getValue());
        }
    }

    public function WriteStringConstantExpressionElement(IStringConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_String);
        $this->xmlWriter->writeCdata(EdmValueWriter::StringAsXml($expression->getValue()));
        $this->WriteEndElement();
    }

    public function WriteBinaryConstantExpressionElement(IBinaryConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_String);
        $this->xmlWriter->writeCdata(EdmValueWriter::BinaryAsXml($expression->getValue()));
        $this->WriteEndElement();
    }

    public function WriteBooleanConstantExpressionElement(IBooleanConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Bool);
        $this->xmlWriter->writeCdata(EdmValueWriter::BooleanAsXml($expression->getValue()));
        $this->WriteEndElement();
    }

    public function WriteNullConstantExpressionElement(INullExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Null);
        $this->WriteEndElement();
    }

    public function WriteDateTimeConstantExpressionElement(IDateTimeConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_DateTime);
        $this->xmlWriter->writeCdata(EdmValueWriter::DateTimeAsXml($expression->getValue()));
        $this->WriteEndElement();
    }

    public function WriteDateTimeOffsetConstantExpressionElement(IDateTimeOffsetConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_DateTimeOffset);
        $this->xmlWriter->writeCdata(EdmValueWriter::DateTimeOffsetAsXml($expression->getValue()));
        $this->WriteEndElement();
    }

    public function WriteDecimalConstantExpressionElement(IDecimalConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Decimal);
        $this->xmlWriter->writeCdata(EdmValueWriter::DecimalAsXml($expression->getValue()));
        $this->WriteEndElement();
    }

    public function WriteFloatingConstantExpressionElement(IFloatingConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Float);
        $this->xmlWriter->writeCdata(EdmValueWriter::FloatAsXml($expression->getValue()));
        $this->WriteEndElement();
    }

    public function WriteFunctionApplicationElementHeader(IApplyExpression $expression, bool $isFunction): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Apply);
        if ($isFunction) {
            $appliedFunction = $expression->getAppliedFunction();
            assert($appliedFunction instanceof IFunctionReferenceExpression);
            $this->WriteRequiredAttribute(CsdlConstants::Attribute_Function, $appliedFunction->getReferencedFunction(), [$this, 'FunctionAsXml']);
        }
    }

    public function WriteGuidConstantExpressionElement(IGuidConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Guid);
        $this->xmlWriter->writeCdata(EdmValueWriter::GuidAsXml($expression->getValue()));
        $this->WriteEndElement();
    }

    public function WriteIntegerConstantExpressionElement(IIntegerConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Int);
        $this->xmlWriter->writeCdata(EdmValueWriter::LongAsXml($expression->getValue()));
        $this->WriteEndElement();
    }

    public function WritePathExpressionElement(IPathExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Path);
        $this->xmlWriter->writeCdata(self::PathAsXml($expression->getPath()));
        $this->WriteEndElement();
    }

    public function WriteIfExpressionElementHeader(IIfExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_If);
    }

    public function WriteCollectionExpressionElementHeader(ICollectionExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Collection);
    }

    public function WriteLabeledElementHeader(ILabeledExpression $labeledElement): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_LabeledElement);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $labeledElement->getName(), [EdmValueWriter::class,'StringAsXml']);
    }

    public function WriteIsTypeExpressionElementHeader(IIsTypeExpression $expression, bool $inlineType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_IsType);
        if ($inlineType) {
            $this->WriteRequiredAttribute(CsdlConstants::Attribute_Type, $expression->getType(), [$this,'TypeReferenceAsXml']);
        }
    }

    public function WriteAssertTypeExpressionElementHeader(IAssertTypeExpression $expression, bool $inlineType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_AssertType);
        if ($inlineType) {
            $this->WriteRequiredAttribute(CsdlConstants::Attribute_Type, $expression->getType(), [$this,'TypeReferenceAsXml']);
        }
    }

    public function WriteEntitySetReferenceExpressionElement(IEntitySetReferenceExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_EntitySetReference);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $expression->getReferencedEntitySet(), [self::class, 'EntitySetAsXml']);
        $this->WriteEndElement();
    }

    public function WriteParameterReferenceExpressionElement(IParameterReferenceExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_ParameterReference);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $expression->getReferencedParameter(), [self::class, 'ParameterAsXml']);
        $this->WriteEndElement();
    }

    public function WriteFunctionReferenceExpressionElement(IFunctionReferenceExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_FunctionReference);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $expression->getReferencedFunction(), [$this, 'FunctionAsXml']);
        $this->WriteEndElement();
    }

    public function WriteEnumMemberReferenceExpressionElement(IEnumMemberReferenceExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_EnumMemberReference);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $expression->getReferencedEnumMember(), [self::class, 'EnumMemberAsXml']);
        $this->WriteEndElement();
    }

    public function WritePropertyReferenceExpressionElementHeader(IPropertyReferenceExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_PropertyReference);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Name, $expression->getReferencedProperty(), [self::class, 'PropertyAsXml']);
    }

    public function WriteEndElement(): void
    {
        $this->xmlWriter->endElement();
    }

    public function WriteOptionalAttribute(string $attribute, $value, $defaultValue, callable $toXml): void
    {
        /* @noinspection PhpUnhandledExceptionInspection suppressing exceptions for asserts.*/
        assert(
            count((is_array($toXml) ? new ReflectionMethod(...$toXml) : new ReflectionFunction($toXml))->getParameters()) === 1,
            '$toXml should be a callable takeing one paramater of mixed type'
        );
        /* @noinspection PhpUnhandledExceptionInspection suppressing exceptions for asserts.*/
        assert(
            (is_array($toXml) ? new ReflectionMethod(...$toXml) : new ReflectionFunction($toXml))->getReturnType()->getName() === 'string',
            '$toXml should be a callable returning a string'
        );
        if ($value !== $defaultValue) {
            $this->xmlWriter->writeAttribute($attribute, $toXml($value));
        }
    }

    public function WriteRequiredAttribute(string $attribute, $value, callable $toXml): void
    {
        /* @noinspection PhpUnhandledExceptionInspection suppressing exceptions for asserts.*/
        assert(
            count((is_array($toXml) ? new ReflectionMethod(...$toXml) : new ReflectionFunction($toXml))->getParameters()) === 1,
            '$toXml should be a callable takeing one paramater of mixed type'
        );
        /* @noinspection PhpUnhandledExceptionInspection suppressing exceptions for asserts.*/
        assert(
            (is_array($toXml) ? new ReflectionMethod(...$toXml) : new ReflectionFunction($toXml))->getReturnType()->getName() === 'string',
            '$toXml should be a callable returning a string'
        );
        $this->xmlWriter->writeAttribute($attribute, $toXml($value));
    }

    private static function MultiplicityAsXml(Multiplicity $endKind): string
    {
        switch ($endKind) {
            case Multiplicity::Many():
                return CsdlConstants::Value_EndMany;
            case Multiplicity::One():
                return CsdlConstants::Value_EndRequired;
            case Multiplicity::ZeroOrOne():
                return CsdlConstants::Value_EndOptional;
            default:
                throw new InvalidOperationException(StringConst::UnknownEnumVal_Multiplicity($endKind->getKey()));
        }
    }

    private static function FunctionParameterModeAsXml(FunctionParameterMode $mode): string
    {
        switch ($mode) {
            case FunctionParameterMode::In():
                return CsdlConstants::Value_ModeIn;
            case FunctionParameterMode::InOut():
                return CsdlConstants::Value_ModeInOut;
            case FunctionParameterMode::Out():
                return CsdlConstants::Value_ModeOut;
            default:
                throw new InvalidOperationException(StringConst::UnknownEnumVal_FunctionParameterMode($mode->getKey()));
        }
    }

    private static function ConcurrencyModeAsXml(ConcurrencyMode $mode): string
    {
        switch ($mode) {
            case ConcurrencyMode::Fixed():
                return CsdlConstants::Value_Fixed;
            case ConcurrencyMode::None():
                return CsdlConstants::Value_None;
            default:
                throw new InvalidOperationException(StringConst::UnknownEnumVal_ConcurrencyMode($mode->getKey()));
        }
    }

    /**
     * @param  string[] $path
     * @return string
     */
    private static function PathAsXml(array $path): string
    {
        return implode('/', $path);
    }

    private static function ParameterAsXml(IFunctionParameter $parameter): string
    {
        return $parameter->getName();
    }

    private static function PropertyAsXml(IProperty $property): string
    {
        return $property->getName();
    }

    private static function EnumMemberAsXml(IEnumMember $member): string
    {
        return $member->getDeclaringType()->FullName() . '/' . $member->getName();
    }

    private static function EntitySetAsXml(IEntitySet $set): string
    {
        return $set->getContainer()->FullName() . '/' . $set->getName();
    }

    private static function SridAsXml(?int $i): string
    {
        return $i !== null ? strval($i) :  CsdlConstants::Value_SridVariable;
    }

    private static function GetCsdlNamespace(Version $edmVersion): string
    {
        $namespaces = CsdlConstants::versionToEdmNamespace($edmVersion);
        if ($namespaces !== null) {
            return $namespaces;
        }

        throw new InvalidOperationException(StringConst::Serializer_UnknownEdmVersion());
    }

    private function SerializationName(ISchemaElement $element): string
    {
        if ($this->namespaceAliasMappings != null) {
            if (array_key_exists($element->getNamespace(), $this->namespaceAliasMappings)) {
                return $this->namespaceAliasMappings[$element->getNamespace()] . '.' . $element->getName();
            }
        }

        return $element->FullName();
    }

    private function TypeReferenceAsXml(ITypeReference $type): string
    {
        if ($type->IsCollection()) {
            $collectionReference   = $type->AsCollection();
            $elementTypeDefinition = $collectionReference->ElementType()->getDefinition();
            assert($elementTypeDefinition instanceof ISchemaElement, 'Cannot inline parameter type if not a named element or collection of named elements');
            return CsdlConstants::Value_Collection . '(' . $this->SerializationName($elementTypeDefinition) . ')';
        } elseif ($type->IsEntityReference()) {
            $entityReferenceDefinitionType = $type->AsEntityReference()->EntityReferenceDefinition()->getEntityType();
            return CsdlConstants::Value_Ref . '(' . $this->SerializationName($entityReferenceDefinitionType) . ')';
        }
        $typeDefinition = $type->getDefinition();
        Assert($typeDefinition instanceof ISchemaElement, 'Cannot inline parameter type if not a named element or collection of named elements');
        return $this->SerializationName($typeDefinition);
    }

    private function TypeDefinitionAsXml(ISchemaType $type): string
    {
        return $this->SerializationName($type);
    }

    private function FunctionAsXml(IFunction $function): string
    {
        return $this->SerializationName($function);
    }

    private function TermAsXml(?ITerm $term): string
    {
        if ($term == null) {
            return '';
        }

        return $this->SerializationName($term);
    }
}
