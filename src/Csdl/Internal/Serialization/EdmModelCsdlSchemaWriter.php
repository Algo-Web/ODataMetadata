<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Csdl\Internal\Serialization;

use AlgoWeb\ODataMetadata\Csdl\Internal\EdmValueWriter;
use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\EdmUtil;
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
use ReflectionNamedType;
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

    /**
     * @param  IValueTerm           $term
     * @param  bool                 $inlineType
     * @throws \ReflectionException
     */
    public function WriteValueTermElementHeader(IValueTerm $term, bool $inlineType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_ValueTerm);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $term->getName(),
            [EdmValueWriter::class, 'StringAsXml']
        );
        if ($inlineType && null !== $term->getType()) {
            $this->WriteRequiredAttribute(
                CsdlConstants::Attribute_Type,
                $term->getType(),
                [$this, 'typeReferenceAsXml']
            );
        }
    }

    /**
     * @param  INavigationProperty  $navigationProperty
     * @throws \ReflectionException
     */
    public function WriteAssociationElementHeader(INavigationProperty $navigationProperty): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Association);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $this->model->getAssociationName($navigationProperty),
            [EdmValueWriter::class, 'StringAsXml']
        );
    }

    /**
     * @param  IEntitySet           $entitySet
     * @param  INavigationProperty  $navigationProperty
     * @throws \ReflectionException
     */
    public function WriteAssociationSetElementHeader(
        IEntitySet $entitySet,
        INavigationProperty $navigationProperty
    ): void {
        $this->xmlWriter->startElement(CsdlConstants::Element_AssociationSet);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $this->model->getAssociationSetName($entitySet, $navigationProperty),
            [EdmValueWriter::class, 'StringAsXml']
        );
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Association,
            $this->model->getAssociationFullName($navigationProperty),
            [EdmValueWriter::class, 'StringAsXml']
        );
    }

    /**
     * @param  IComplexType         $complexType
     * @throws \ReflectionException
     */
    public function WriteComplexTypeElementHeader(IComplexType $complexType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_ComplexType);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $complexType->getName(),
            [EdmValueWriter::class, 'StringAsXml']
        );
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_BaseType,
            $complexType->BaseComplexType(),
            null,
            [$this, 'typeDefinitionAsXml']
        );
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_Abstract,
            $complexType->isAbstract(),
            CsdlConstants::Default_Abstract,
            [EdmValueWriter::class, 'BooleanAsXml']
        );
    }

    /**
     * @param  IEnumType            $enumType
     * @throws \ReflectionException
     */
    public function WriteEnumTypeElementHeader(IEnumType $enumType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_EnumType);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $enumType->getName(),
            [EdmValueWriter::class, 'StringAsXml']
        );
        if ($enumType->getUnderlyingType()->getPrimitiveKind() != PrimitiveTypeKind::Int32()) {
            $this->WriteRequiredAttribute(
                CsdlConstants::Attribute_UnderlyingType,
                $enumType->getUnderlyingType(),
                [$this, 'typeDefinitionAsXml']
            );
        }

        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_IsFlags,
            $enumType->isFlags(),
            CsdlConstants::Default_IsFlags,
            [EdmValueWriter::class, 'BooleanAsXml']
        );
    }

    public function WriteDocumentationElement(IDocumentation $documentation): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Documentation);

        $summary = $documentation->getSummary();
        if (null !== $summary && !empty($summary)) {
            $this->xmlWriter->startElement(CsdlConstants::Element_Summary);
            $this->xmlWriter->text($summary);
            $this->WriteEndElement();
        }

        $descript = $documentation->getDescription();
        if (null !== $descript && !empty($descript)) {
            $this->xmlWriter->startElement(CsdlConstants::Element_LongDescription);
            $this->xmlWriter->text($descript);
            $this->WriteEndElement();
        }

        $this->WriteEndElement();
    }

    /**
     * @param  IEntitySet           $entitySet
     * @param  INavigationProperty  $property
     * @throws \ReflectionException
     */
    public function WriteAssociationSetEndElementHeader(IEntitySet $entitySet, INavigationProperty $property): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_End);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Role,
            $this->model->getAssociationEndName($property),
            [EdmValueWriter::class, 'StringAsXml']
        );
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_EntitySet,
            $entitySet->getName(),
            [EdmValueWriter::class, 'StringAsXml']
        );
    }

    /**
     * @param  INavigationProperty  $associationEnd
     * @throws \ReflectionException
     */
    public function WriteAssociationEndElementHeader(INavigationProperty $associationEnd): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_End);
        $declaringType = $associationEnd->getDeclaringType();
        assert($declaringType instanceof IEntityType);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Type,
            $declaringType->FullName(),
            [EdmValueWriter::class, 'StringAsXml']
        );
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Role,
            $this->model->getAssociationEndName($associationEnd),
            [EdmValueWriter::class, 'StringAsXml']
        );
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Multiplicity,
            $associationEnd->Multiplicity(),
            [self::class, 'MultiplicityAsXml']
        );
    }

    /**
     * @param  IEntityContainer     $container
     * @throws \ReflectionException
     */
    public function WriteEntityContainerElementHeader(IEntityContainer $container): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_EntityContainer);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $container->getName(),
            [EdmValueWriter::class, 'StringAsXml']
        );
        if ($container->isDefault()) {
            $this->xmlWriter->writeAttributeNs(
                CsdlConstants::Prefix_ODataMetadata,
                CsdlConstants::Attribute_IsDefaultEntityContainer,
                null,
                'true'
            );
        }
        if ($container->isLazyLoadEnabled()) {
            $this->xmlWriter->writeAttributeNs(
                CsdlConstants::Prefix_Annotations,
                CsdlConstants::Attribute_LazyLoadingEnabled,
                null,
                'true'
            );
        }
    }

    /**
     * @param  IEntitySet           $entitySet
     * @throws \ReflectionException
     */
    public function WriteEntitySetElementHeader(IEntitySet $entitySet): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_EntitySet);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $entitySet->getName(),
            [EdmValueWriter::class, 'StringAsXml']
        );
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_EntityType,
            $entitySet->getElementType()->FullName(),
            [EdmValueWriter::class, 'StringAsXml']
        );
    }

    /**
     * @param  IEntityType          $entityType
     * @throws \ReflectionException
     */
    public function WriteEntityTypeElementHeader(IEntityType $entityType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_EntityType);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $entityType->getName(),
            [EdmValueWriter::class, 'StringAsXml']
        );
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_BaseType,
            $entityType->BaseEntityType(),
            null,
            [$this, 'typeDefinitionAsXml']
        );
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_Abstract,
            $entityType->isAbstract(),
            CsdlConstants::Default_Abstract,
            [EdmValueWriter::class, 'BooleanAsXml']
        );
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_OpenType,
            $entityType->isOpen(),
            CsdlConstants::Default_OpenType,
            [EdmValueWriter::class, 'BooleanAsXml']
        );
    }

    public function WriteDeclaredKeyPropertiesElementHeader(): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Key);
    }

    /**
     * @param  IStructuralProperty  $property
     * @throws \ReflectionException
     */
    public function WritePropertyRefElement(IStructuralProperty $property): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_PropertyRef);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $property->getName(),
            [EdmValueWriter::class, 'StringAsXml']
        );
        $this->WriteEndElement();
    }

    /**
     * @param  INavigationProperty  $member
     * @throws \ReflectionException
     */
    public function WriteNavigationPropertyElementHeader(INavigationProperty $member): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_NavigationProperty);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $member->getName(),
            [EdmValueWriter::class, 'StringAsXml']
        );
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Relationship,
            $this->model->getAssociationFullName($member),
            [EdmValueWriter::class, 'StringAsXml']
        );
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_ToRole,
            $this->model->getAssociationEndName($member->getPartner()),
            [EdmValueWriter::class, 'StringAsXml']
        );
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_FromRole,
            $this->model->getAssociationEndName($member),
            [EdmValueWriter::class, 'StringAsXml']
        );
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_ContainsTarget,
            $member->containsTarget(),
            CsdlConstants::Default_ContainsTarget,
            [EdmValueWriter::class, 'BooleanAsXml']
        );
    }

    /**
     * @param  string               $elementName
     * @param  OnDeleteAction       $operationAction
     * @throws \ReflectionException
     */
    public function WriteOperationActionElement(string $elementName, OnDeleteAction $operationAction): void
    {
        $this->xmlWriter->startElement($elementName);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Action,
            strval($operationAction),
            [EdmValueWriter::class, 'StringAsXml']
        );
        $this->WriteEndElement();
    }

    /**
     * @param  EdmSchema            $schema
     * @param  string|null          $alias
     * @param  array                $mappings
     * @throws \ReflectionException
     */
    public function WriteSchemaElementHeader(EdmSchema $schema, ?string $alias, array $mappings): void
    {
        $xmlNamespace = self::getCsdlNamespace($this->version);
        $this->xmlWriter->startElement(CsdlConstants::Element_Schema);
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_Namespace,
            $schema->getNamespace(),
            '',
            [EdmValueWriter::class, 'StringAsXml']
        );
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_Alias,
            $alias,
            null,
            [EdmValueWriter::class, 'StringAsXml']
        );
        foreach ($mappings as $mappingKey => $mappingValue) {
            $this->xmlWriter->writeAttributeNs(EdmConstants::XmlNamespacePrefix, $mappingKey, null, $mappingValue);
        }
    }

    /**
     * @param  string               $annotationsTarget
     * @throws \ReflectionException
     */
    public function WriteAnnotationsElementHeader(string $annotationsTarget): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Annotations);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Target,
            $annotationsTarget,
            [EdmValueWriter::class, 'StringAsXml']
        );
    }

    /**
     * @param  IStructuralProperty  $property
     * @param  bool                 $inlineType
     * @throws \ReflectionException
     */
    public function WriteStructuralPropertyElementHeader(IStructuralProperty $property, bool $inlineType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Property);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $property->getName(),
            [EdmValueWriter::class, 'StringAsXml']
        );
        if ($inlineType) {
            $this->WriteRequiredAttribute(
                CsdlConstants::Attribute_Type,
                $property->getType(),
                [$this, 'typeReferenceAsXml']
            );
        }

        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_ConcurrencyMode,
            $property->getConcurrencyMode(),
            CsdlConstants::$Default_ConcurrencyMode,
            [self::class, 'ConcurrencyModeAsXml']
        );
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_DefaultValue,
            $property->getDefaultValueString(),
            null,
            [EdmValueWriter::class, 'StringAsXml']
        );
    }

    /**
     * @param  IEnumMember          $member
     * @throws \ReflectionException
     */
    public function WriteEnumMemberElementHeader(IEnumMember $member): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Member);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $member->getName(),
            [EdmValueWriter::class, 'StringAsXml']
        );
        $isExplicit = $member->IsValueExplicit($this->model);
        if (null === $isExplicit || $isExplicit) {
            $this->WriteRequiredAttribute(
                CsdlConstants::Attribute_Value,
                $member->getValue(),
                [EdmValueWriter::class, 'PrimitiveValueAsXml']
            );
        }
    }

    /**
     * @param  ITypeReference       $reference
     * @throws \ReflectionException
     */
    public function WriteNullableAttribute(ITypeReference $reference): void
    {
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_Nullable,
            $reference->getNullable(),
            CsdlConstants::Default_Nullable,
            [EdmValueWriter::class, 'BooleanAsXml']
        );
    }

    /**
     * @param  IBinaryTypeReference $reference
     * @throws \ReflectionException
     */
    public function WriteBinaryTypeAttributes(IBinaryTypeReference $reference): void
    {
        if ($reference->isUnBounded()) {
            $this->WriteRequiredAttribute(
                CsdlConstants::Attribute_MaxLength,
                CsdlConstants::Value_Max,
                [EdmValueWriter::class, 'StringAsXml']
            );
        } else {
            $this->WriteOptionalAttribute(
                CsdlConstants::Attribute_MaxLength,
                $reference->getMaxLength(),
                null,
                [EdmValueWriter::class, 'IntAsXml']
            );
        }

        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_FixedLength,
            $reference->isFixedLength(),
            null,
            [EdmValueWriter::class, 'BooleanAsXml']
        );
    }

    /**
     * @param  IDecimalTypeReference $reference
     * @throws \ReflectionException
     */
    public function WriteDecimalTypeAttributes(IDecimalTypeReference $reference): void
    {
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_Precision,
            $reference->getPrecision(),
            null,
            [EdmValueWriter::class, 'IntAsXml']
        );
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_Scale,
            $reference->getScale(),
            null,
            [EdmValueWriter::class, 'IntAsXml']
        );
    }

    /**
     * @param  ISpatialTypeReference $reference
     * @throws \ReflectionException
     */
    public function WriteSpatialTypeAttributes(ISpatialTypeReference $reference): void
    {
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Srid,
            $reference->getSpatialReferenceIdentifier(),
            [self::class, 'sridAsXml']
        );
    }

    /**
     * @param  IStringTypeReference $reference
     * @throws \ReflectionException
     */
    public function WriteStringTypeAttributes(IStringTypeReference $reference): void
    {
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_Collation,
            $reference->getCollation(),
            null,
            [EdmValueWriter::class, 'StringAsXml']
        );
        if ($reference->isUnbounded()) {
            $this->WriteRequiredAttribute(
                CsdlConstants::Attribute_MaxLength,
                CsdlConstants::Value_Max,
                [EdmValueWriter::class, 'StringAsXml']
            );
        } else {
            $this->WriteOptionalAttribute(
                CsdlConstants::Attribute_MaxLength,
                $reference->getMaxLength(),
                null,
                [EdmValueWriter::class, 'IntAsXml']
            );
        }

        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_FixedLength,
            $reference->isFixedLength(),
            null,
            [EdmValueWriter::class, 'BooleanAsXml']
        );
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_Unicode,
            $reference->isUnicode(),
            null,
            [EdmValueWriter::class, 'BooleanAsXml']
        );
    }

    /**
     * @param  ITemporalTypeReference $reference
     * @throws \ReflectionException
     */
    public function WriteTemporalTypeAttributes(ITemporalTypeReference $reference): void
    {
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_Precision,
            $reference->getPrecision(),
            null,
            [EdmValueWriter::class, 'IntAsXml']
        );
    }

    public function WriteReferentialConstraintElementHeader(INavigationProperty $constraint): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_ReferentialConstraint);
    }

    /**
     * @param  INavigationProperty  $end
     * @throws \ReflectionException
     */
    public function WriteReferentialConstraintPrincipalEndElementHeader(INavigationProperty $end): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Principal);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Role,
            $this->model->getAssociationEndName($end),
            [EdmValueWriter::class, 'StringAsXml']
        );
    }

    /**
     * @param  INavigationProperty  $end
     * @throws \ReflectionException
     */
    public function WriteReferentialConstraintDependentEndElementHeader(INavigationProperty $end): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Dependent);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Role,
            $this->model->getAssociationEndName($end),
            [EdmValueWriter::class, 'StringAsXml']
        );
    }

    /**
     * @param  string               $usingNamespace
     * @param  string               $alias
     * @throws \ReflectionException
     */
    public function WriteNamespaceUsingElement(string $usingNamespace, string $alias): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Using);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Namespace,
            $usingNamespace,
            [EdmValueWriter::class, 'StringAsXml']
        );
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Alias, $alias, [EdmValueWriter::class, 'StringAsXml']);
        $this->WriteEndElement();
    }

    /**
     * @param  IDirectValueAnnotation                                 $annotation
     * @throws \AlgoWeb\ODataMetadata\Exception\NotSupportedException
     */
    public function WriteAnnotationStringAttribute(IDirectValueAnnotation $annotation): void
    {
        $edmValue = $annotation->getValue();
        if ($edmValue instanceof IPrimitiveValue) {
            $this->xmlWriter->writeAttributeNs(
                '',
                $annotation->getName(),
                $annotation->getNamespaceUri(),
                EdmValueWriter::PrimitiveValueAsXml($edmValue)
            );
        }
    }

    public function WriteAnnotationStringElement(IDirectValueAnnotation $annotation): void
    {
        $edmValue = $annotation->getValue();
        if ($edmValue instanceof IStringValue) {
            $this->xmlWriter->writeRaw($edmValue->getValue());
        }
    }

    /**
     * @param  IFunction            $function
     * @param  bool                 $inlineReturnType
     * @throws \ReflectionException
     */
    public function WriteFunctionElementHeader(IFunction $function, bool $inlineReturnType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Function);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $function->getName(),
            [EdmValueWriter::class, 'StringAsXml']
        );
        if ($inlineReturnType) {
            $this->WriteRequiredAttribute(
                CsdlConstants::Attribute_ReturnType,
                $function->getReturnType(),
                [$this, 'typeReferenceAsXml']
            );
        }
    }

    public function WriteDefiningExpressionElement(string $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_DefiningExpression);
        $this->xmlWriter->text($expression);
        $this->xmlWriter->endElement();
    }

    public function WriteReturnTypeElementHeader()
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_ReturnType);
    }

    /**
     * @param  IFunctionImport      $functionImport
     * @throws \ReflectionException
     */
    public function WriteFunctionImportElementHeader(IFunctionImport $functionImport): void
    {
        // functionImport can't be Composable and sideEffecting at the same time.
        if ($functionImport->isComposable() && $functionImport->isSideEffecting()) {
            throw new InvalidOperationException(
                StringConst::EdmModel_Validator_Semantic_ComposableFunctionImportCannotBeSideEffecting(
                    $functionImport->getName()
                )
            );
        }

        $this->xmlWriter->startElement(CsdlConstants::Element_FunctionImport);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $functionImport->getName(),
            [EdmValueWriter::class, 'StringAsXml']
        );
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_ReturnType,
            $functionImport->getReturnType(),
            null,
            [$this, 'typeReferenceAsXml']
        );

        // IsSideEffecting is optional, however its default applies to non-composable function imports only.
        // Composable function imports can't be side-effecting, so we don't emit false.
        if (!$functionImport->isComposable() &&
            $functionImport->isSideEffecting() != CsdlConstants::Default_IsSideEffecting) {
            $this->WriteRequiredAttribute(
                CsdlConstants::Attribute_IsSideEffecting,
                $functionImport->isSideEffecting(),
                [EdmValueWriter::class, 'BooleanAsXml']
            );
        }

        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_IsComposable,
            $functionImport->isComposable(),
            CsdlConstants::Default_IsComposable,
            [EdmValueWriter::class, 'BooleanAsXml']
        );
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_IsBindable,
            $functionImport->isBindable(),
            CsdlConstants::Default_IsBindable,
            [EdmValueWriter::class, 'BooleanAsXml']
        );
        $entitySetReference = $functionImport->getEntitySet();
        if (null !== $functionImport->getEntitySet()) {
            if ($entitySetReference instanceof IEntitySetReferenceExpression) {
                $this->WriteOptionalAttribute(
                    CsdlConstants::Attribute_EntitySet,
                    $entitySetReference->getReferencedEntitySet()->getName(),
                    null,
                    [EdmValueWriter::class, 'StringAsXml']
                );
            } else {
                $pathExpression = $functionImport->getEntitySet();
                if ($pathExpression instanceof IPathExpression) {
                    $this->WriteOptionalAttribute(
                        CsdlConstants::Attribute_EntitySetPath,
                        $pathExpression->getPath(),
                        null,
                        [self::class, 'PathAsXml']
                    );
                } else {
                    throw new InvalidOperationException(
                        StringConst::EdmModel_Validator_Semantic_FunctionImportEntitySetExpressionIsInvalid(
                            $functionImport->getName()
                        )
                    );
                }
            }
        }
    }

    /**
     * @param  IFunctionParameter   $parameter
     * @param  bool                 $inlineType
     * @throws \ReflectionException
     */
    public function WriteFunctionParameterElementHeader(IFunctionParameter $parameter, bool $inlineType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Parameter);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $parameter->getName(),
            [EdmValueWriter::class, 'StringAsXml']
        );
        if ($inlineType) {
            $this->WriteRequiredAttribute(
                CsdlConstants::Attribute_Type,
                $parameter->getType(),
                [$this, 'typeReferenceAsXml']
            );
        }

        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_Mode,
            $parameter->getMode(),
            CsdlConstants::$Default_FunctionParameterMode,
            [self::class, 'FunctionParameterModeAsXml']
        );
    }

    /**
     * @param  ICollectionType      $collectionType
     * @param  bool                 $inlineType
     * @throws \ReflectionException
     */
    public function WriteCollectionTypeElementHeader(ICollectionType $collectionType, bool $inlineType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_CollectionType);
        if ($inlineType) {
            $this->WriteRequiredAttribute(
                CsdlConstants::Attribute_ElementType,
                $collectionType->getElementType(),
                [$this, 'typeReferenceAsXml']
            );
        }
    }

    public function WriteRowTypeElementHeader(): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_RowType);
    }

    /**
     * @param  IExpression          $expression
     * @throws \ReflectionException
     */
    public function WriteInlineExpression(IExpression $expression): void
    {
        if (method_exists($expression, 'getValue')) {
            EdmUtil::checkArgumentNull($expression->getValue(), 'expression->getValue');
        }
        switch ($expression->getExpressionKind()) {
            case ExpressionKind::BinaryConstant():
                assert($expression instanceof IBinaryConstantExpression);
                $this->WriteRequiredAttribute(
                    CsdlConstants::Attribute_Binary,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'BinaryAsXml']
                );
                break;
            case ExpressionKind::BooleanConstant():
                assert($expression instanceof IBooleanConstantExpression);
                $this->WriteRequiredAttribute(
                    CsdlConstants::Attribute_Bool,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'BooleanAsXml']
                );
                break;
            case ExpressionKind::DateTimeConstant():
                assert($expression instanceof IDateTimeConstantExpression);
                $this->WriteRequiredAttribute(
                    CsdlConstants::Attribute_DateTime,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'DateTimeAsXml']
                );
                break;
            case ExpressionKind::DateTimeOffsetConstant():
                assert($expression instanceof IDateTimeOffsetConstantExpression);
                $this->WriteRequiredAttribute(
                    CsdlConstants::Attribute_DateTimeOffset,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'DateTimeOffsetAsXml']
                );
                break;
            case ExpressionKind::DecimalConstant():
                assert($expression instanceof IDecimalConstantExpression);
                $this->WriteRequiredAttribute(
                    CsdlConstants::Attribute_Decimal,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'DecimalAsXml']
                );
                break;
            case ExpressionKind::FloatingConstant():
                assert($expression instanceof IFloatingConstantExpression);
                $this->WriteRequiredAttribute(
                    CsdlConstants::Attribute_Float,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'FloatAsXml']
                );
                break;
            case ExpressionKind::GuidConstant():
                assert($expression instanceof IGuidConstantExpression);
                $this->WriteRequiredAttribute(
                    CsdlConstants::Attribute_Guid,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'GuidAsXml']
                );
                break;
            case ExpressionKind::IntegerConstant():
                assert($expression instanceof IIntegerConstantExpression);
                $this->WriteRequiredAttribute(
                    CsdlConstants::Attribute_Int,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'LongAsXml']
                );
                break;
            case ExpressionKind::Path():
                assert($expression instanceof IPathExpression);
                $this->WriteRequiredAttribute(
                    CsdlConstants::Attribute_Path,
                    $expression->getPath(),
                    [self::class, 'PathAsXml']
                );
                break;
            case ExpressionKind::StringConstant():
                assert($expression instanceof IStringConstantExpression);
                $this->WriteRequiredAttribute(
                    CsdlConstants::Attribute_String,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'StringAsXml']
                );
                break;
            case ExpressionKind::TimeConstant():
                assert($expression instanceof ITimeConstantExpression);
                $this->WriteRequiredAttribute(
                    CsdlConstants::Attribute_Time,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'TimeAsXml']
                );
                break;
            default:
                throw new InvalidOperationException(
                    StringConst::UnknownEnumVal_ExpressionKind($expression->getExpressionKind()->getKey())
                );
        }
    }

    /**
     * @param  IValueAnnotation     $annotation
     * @param  bool                 $isInline
     * @throws \ReflectionException
     */
    public function WriteValueAnnotationElementHeader(IValueAnnotation $annotation, bool $isInline): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_ValueAnnotation);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Term, $annotation->getTerm(), [$this, 'termAsXml']);
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_Qualifier,
            $annotation->getQualifier(),
            null,
            [EdmValueWriter::class, 'StringAsXml']
        );
        if ($isInline) {
            $this->WriteInlineExpression($annotation->getValue());
        }
    }

    /**
     * @param  ITypeAnnotation      $annotation
     * @throws \ReflectionException
     */
    public function WriteTypeAnnotationElementHeader(ITypeAnnotation $annotation): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_TypeAnnotation);
        $this->WriteRequiredAttribute(CsdlConstants::Attribute_Term, $annotation->getTerm(), [$this, 'termAsXml']);
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_Qualifier,
            $annotation->getQualifier(),
            null,
            [EdmValueWriter::class, 'StringAsXml']
        );
    }

    /**
     * @param  IPropertyValueBinding $value
     * @param  bool                  $isInline
     * @throws \ReflectionException
     */
    public function WritePropertyValueElementHeader(IPropertyValueBinding $value, bool $isInline): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_PropertyValue);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Property,
            $value->getBoundProperty()->getName(),
            [EdmValueWriter::class, 'StringAsXml']
        );
        if ($isInline) {
            $this->WriteInlineExpression($value->getValue());
        }
    }

    /**
     * @param  IRecordExpression    $expression
     * @throws \ReflectionException
     */
    public function WriteRecordExpressionElementHeader(IRecordExpression $expression)
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Record);
        $this->WriteOptionalAttribute(
            CsdlConstants::Attribute_Type,
            $expression->getDeclaredType(),
            null,
            [$this, 'typeReferenceAsXml']
        );
    }

    /**
     * @param  IPropertyConstructor $constructor
     * @param  bool                 $isInline
     * @throws \ReflectionException
     */
    public function WritePropertyConstructorElementHeader(IPropertyConstructor $constructor, bool $isInline): void
    {
        EdmUtil::checkArgumentNull($constructor->getName(), 'constructor->getName');
        $this->xmlWriter->startElement(CsdlConstants::Element_PropertyValue);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Property,
            $constructor->getName(),
            [EdmValueWriter::class, 'StringAsXml']
        );
        if ($isInline) {
            EdmUtil::checkArgumentNull($constructor->getValue(), 'constructor->getValue()');
            $this->WriteInlineExpression($constructor->getValue());
        }
    }

    public function WriteStringConstantExpressionElement(IStringConstantExpression $expression): void
    {
        EdmUtil::checkArgumentNull($expression->getValue(), 'expression->getValue');
        $this->xmlWriter->startElement(CsdlConstants::Element_String);
        $this->xmlWriter->text(EdmValueWriter::StringAsXml($expression->getValue()));
        $this->WriteEndElement();
    }

    public function WriteBinaryConstantExpressionElement(IBinaryConstantExpression $expression): void
    {
        EdmUtil::checkArgumentNull($expression->getValue(), 'expression->getValue');
        $this->xmlWriter->startElement(CsdlConstants::Element_String);
        $this->xmlWriter->text(EdmValueWriter::BinaryAsXml($expression->getValue()));
        $this->WriteEndElement();
    }

    public function WriteBooleanConstantExpressionElement(IBooleanConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Bool);
        $this->xmlWriter->text(EdmValueWriter::BooleanAsXml($expression->getValue()));
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
        $this->xmlWriter->text(EdmValueWriter::DateTimeAsXml($expression->getValue()));
        $this->WriteEndElement();
    }

    public function WriteDateTimeOffsetConstantExpressionElement(IDateTimeOffsetConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_DateTimeOffset);
        $this->xmlWriter->text(EdmValueWriter::DateTimeOffsetAsXml($expression->getValue()));
        $this->WriteEndElement();
    }

    public function WriteDecimalConstantExpressionElement(IDecimalConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Decimal);
        $this->xmlWriter->text(EdmValueWriter::DecimalAsXml($expression->getValue()));
        $this->WriteEndElement();
    }

    public function WriteFloatingConstantExpressionElement(IFloatingConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Float);
        $this->xmlWriter->text(EdmValueWriter::FloatAsXml($expression->getValue()));
        $this->WriteEndElement();
    }

    /**
     * @param  IApplyExpression     $expression
     * @param  bool                 $isFunction
     * @throws \ReflectionException
     */
    public function WriteFunctionApplicationElementHeader(IApplyExpression $expression, bool $isFunction): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Apply);
        if ($isFunction) {
            $appliedFunction = $expression->getAppliedFunction();
            assert($appliedFunction instanceof IFunctionReferenceExpression);
            $this->WriteRequiredAttribute(
                CsdlConstants::Attribute_Function,
                $appliedFunction->getReferencedFunction(),
                [$this, 'functionAsXml']
            );
        }
    }

    public function WriteGuidConstantExpressionElement(IGuidConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Guid);
        $this->xmlWriter->text(EdmValueWriter::GuidAsXml($expression->getValue()));
        $this->WriteEndElement();
    }

    public function WriteIntegerConstantExpressionElement(IIntegerConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Int);
        $this->xmlWriter->text(EdmValueWriter::LongAsXml($expression->getValue()));
        $this->WriteEndElement();
    }

    public function WritePathExpressionElement(IPathExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Path);
        $this->xmlWriter->text(self::PathAsXml($expression->getPath()));
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

    /**
     * @param  ILabeledExpression   $labeledElement
     * @throws \ReflectionException
     */
    public function WriteLabeledElementHeader(ILabeledExpression $labeledElement): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_LabeledElement);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $labeledElement->getName(),
            [EdmValueWriter::class, 'StringAsXml']
        );
    }

    /**
     * @param  IIsTypeExpression    $expression
     * @param  bool                 $inlineType
     * @throws \ReflectionException
     */
    public function WriteIsTypeExpressionElementHeader(IIsTypeExpression $expression, bool $inlineType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_IsType);
        if ($inlineType) {
            $this->WriteRequiredAttribute(
                CsdlConstants::Attribute_Type,
                $expression->getType(),
                [$this, 'typeReferenceAsXml']
            );
        }
    }

    /**
     * @param  IAssertTypeExpression $expression
     * @param  bool                  $inlineType
     * @throws \ReflectionException
     */
    public function WriteAssertTypeExpressionElementHeader(IAssertTypeExpression $expression, bool $inlineType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_AssertType);
        if ($inlineType) {
            $this->WriteRequiredAttribute(
                CsdlConstants::Attribute_Type,
                $expression->getType(),
                [$this, 'typeReferenceAsXml']
            );
        }
    }

    /**
     * @param  IEntitySetReferenceExpression $expression
     * @throws \ReflectionException
     */
    public function WriteEntitySetReferenceExpressionElement(IEntitySetReferenceExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_EntitySetReference);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $expression->getReferencedEntitySet(),
            [self::class, 'entitySetAsXml']
        );
        $this->WriteEndElement();
    }

    /**
     * @param  IParameterReferenceExpression $expression
     * @throws \ReflectionException
     */
    public function WriteParameterReferenceExpressionElement(IParameterReferenceExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_ParameterReference);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $expression->getReferencedParameter(),
            [self::class, 'ParameterAsXml']
        );
        $this->WriteEndElement();
    }

    /**
     * @param  IFunctionReferenceExpression $expression
     * @throws \ReflectionException
     */
    public function WriteFunctionReferenceExpressionElement(IFunctionReferenceExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_FunctionReference);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $expression->getReferencedFunction(),
            [$this, 'functionAsXml']
        );
        $this->WriteEndElement();
    }

    /**
     * @param  IEnumMemberReferenceExpression $expression
     * @throws \ReflectionException
     */
    public function WriteEnumMemberReferenceExpressionElement(IEnumMemberReferenceExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_EnumMemberReference);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $expression->getReferencedEnumMember(),
            [self::class, 'EnumMemberAsXml']
        );
        $this->WriteEndElement();
    }

    /**
     * @param  IPropertyReferenceExpression $expression
     * @throws \ReflectionException
     */
    public function WritePropertyReferenceExpressionElementHeader(IPropertyReferenceExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_PropertyReference);
        $this->WriteRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $expression->getReferencedProperty(),
            [self::class, 'PropertyAsXml']
        );
    }

    public function WriteEndElement(): void
    {
        $this->xmlWriter->endElement();
    }

    /**
     * @param  string               $attribute
     * @param  mixed                $value
     * @param  mixed                $defaultValue
     * @param  callable             $toXml
     * @throws \ReflectionException
     */
    public function WriteOptionalAttribute(string $attribute, $value, $defaultValue, callable $toXml): void
    {
        $stem = is_array($toXml) ? new ReflectionMethod(...$toXml) :
            new ReflectionFunction($toXml);
        /* @noinspection PhpUnhandledExceptionInspection suppressing exceptions for asserts.*/
        assert(
            1 === count(($stem)->getParameters()),
            '$toXml should be a callable taking one parameter of mixed type'
        );
        $stemType = $stem->getReturnType();
        $name     = $stemType instanceof ReflectionNamedType ?
            $stemType->getName() :
            strval($stemType);
        /* @noinspection PhpUnhandledExceptionInspection suppressing exceptions for asserts.*/
        assert(
            'string' === $name,
            '$toXml should be a callable returning a string'
        );
        if ($value !== $defaultValue) {
            $this->xmlWriter->writeAttribute($attribute, $toXml($value));
        }
    }

    /**
     * @param  string               $attribute
     * @param  mixed                $value
     * @param  callable             $toXml
     * @throws \ReflectionException
     */
    public function WriteRequiredAttribute(string $attribute, $value, callable $toXml): void
    {
        $stem = is_array($toXml) ? new ReflectionMethod(...$toXml) :
            new ReflectionFunction($toXml);
        /* @noinspection PhpUnhandledExceptionInspection suppressing exceptions for asserts.*/
        assert(
            1 === count($stem->getParameters()),
            '$toXml should be a callable taking one parameter of mixed type'
        );
        $stemType = $stem->getReturnType();
        $name     = $stemType instanceof ReflectionNamedType ?
            $stemType->getName() :
            strval($stemType);
        /* @noinspection PhpUnhandledExceptionInspection suppressing exceptions for asserts.*/
        assert(
            'string' === $name,
            '$toXml should be a callable returning a string'
        );
        $this->xmlWriter->writeAttribute($attribute, $toXml($value));
    }

    /**
     * @param  Multiplicity              $endKind
     * @throws InvalidOperationException
     * @return string
     */
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

    /**
     * @param  FunctionParameterMode     $mode
     * @throws InvalidOperationException
     * @return string
     */
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

    /**
     * @param  ConcurrencyMode           $mode
     * @throws InvalidOperationException
     * @return string
     */
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
        return $parameter->getName() ?? '';
    }

    private static function PropertyAsXml(IProperty $property): string
    {
        return $property->getName() ?? '';
    }

    private static function EnumMemberAsXml(IEnumMember $member): string
    {
        return $member->getDeclaringType()->FullName() . '/' . $member->getName();
    }

    private static function entitySetAsXml(IEntitySet $set): string
    {
        $stem = $set->getContainer() ? $set->getContainer()->FullName() : '';

        return $stem . '/' . $set->getName();
    }

    private static function sridAsXml(?int $i): string
    {
        return $i !== null ? strval($i) :  CsdlConstants::Value_SridVariable;
    }

    /**
     * @param  Version                   $edmVersion
     * @throws InvalidOperationException
     * @return string
     */
    private static function getCsdlNamespace(Version $edmVersion): string
    {
        $namespaces = CsdlConstants::versionToEdmNamespace($edmVersion);
        if ($namespaces !== null) {
            return $namespaces;
        }

        throw new InvalidOperationException(StringConst::Serializer_UnknownEdmVersion());
    }

    private function serializationName(ISchemaElement $element): string
    {
        EdmUtil::checkArgumentNull($element->getNamespace(), 'element->getNamespace');
        if ($this->namespaceAliasMappings != null) {
            if (array_key_exists($element->getNamespace(), $this->namespaceAliasMappings)) {
                return $this->namespaceAliasMappings[$element->getNamespace()] . '.' . $element->getName();
            }
        }

        return $element->FullName();
    }

    private function typeReferenceAsXml(ITypeReference $type): string
    {
        if ($type->isCollection()) {
            $collectionReference   = $type->asCollection();
            $elementTypeDefinition = $collectionReference->ElementType()->getDefinition();
            assert(
                $elementTypeDefinition instanceof ISchemaElement,
                'Cannot inline parameter type if not a named element or collection of named elements'
            );
            return CsdlConstants::Value_Collection . '(' . $this->serializationName($elementTypeDefinition) . ')';
        } elseif ($type->isEntityReference()) {
            $entityReferenceDefinitionType = $type->asEntityReference()->EntityReferenceDefinition()->getEntityType();
            return CsdlConstants::Value_Ref . '(' . $this->serializationName($entityReferenceDefinitionType) . ')';
        }
        $typeDefinition = $type->getDefinition();
        assert(
            $typeDefinition instanceof ISchemaElement,
            'Cannot inline parameter type if not a named element or collection of named elements'
        );
        return $this->serializationName($typeDefinition);
    }

    private function typeDefinitionAsXml(ISchemaType $type): string
    {
        return $this->serializationName($type);
    }

    private function functionAsXml(IFunction $function): string
    {
        return $this->serializationName($function);
    }

    private function termAsXml(?ITerm $term): string
    {
        if ($term == null) {
            return '';
        }

        return $this->serializationName($term);
    }
}
