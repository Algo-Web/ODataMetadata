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
    public function writeValueTermElementHeader(IValueTerm $term, bool $inlineType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_ValueTerm);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $term->getName(),
            [EdmValueWriter::class, 'stringAsXml']
        );
        if ($inlineType && null !== $term->getType()) {
            $this->writeRequiredAttribute(
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
    public function writeAssociationElementHeader(INavigationProperty $navigationProperty): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Association);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $this->model->getAssociationName($navigationProperty),
            [EdmValueWriter::class, 'stringAsXml']
        );
    }

    /**
     * @param  IEntitySet           $entitySet
     * @param  INavigationProperty  $navigationProperty
     * @throws \ReflectionException
     */
    public function writeAssociationSetElementHeader(
        IEntitySet $entitySet,
        INavigationProperty $navigationProperty
    ): void {
        $this->xmlWriter->startElement(CsdlConstants::Element_AssociationSet);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $this->model->getAssociationSetName($entitySet, $navigationProperty),
            [EdmValueWriter::class, 'stringAsXml']
        );
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Association,
            $this->model->getAssociationFullName($navigationProperty),
            [EdmValueWriter::class, 'stringAsXml']
        );
    }

    /**
     * @param  IComplexType         $complexType
     * @throws \ReflectionException
     */
    public function writeComplexTypeElementHeader(IComplexType $complexType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_ComplexType);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $complexType->getName(),
            [EdmValueWriter::class, 'stringAsXml']
        );
        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_BaseType,
            $complexType->BaseComplexType(),
            null,
            [$this, 'typeDefinitionAsXml']
        );
        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_Abstract,
            $complexType->isAbstract(),
            CsdlConstants::Default_Abstract,
            [EdmValueWriter::class, 'booleanAsXml']
        );
    }

    /**
     * @param  IEnumType            $enumType
     * @throws \ReflectionException
     */
    public function writeEnumTypeElementHeader(IEnumType $enumType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_EnumType);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $enumType->getName(),
            [EdmValueWriter::class, 'stringAsXml']
        );
        if ($enumType->getUnderlyingType()->getPrimitiveKind() != PrimitiveTypeKind::Int32()) {
            $this->writeRequiredAttribute(
                CsdlConstants::Attribute_UnderlyingType,
                $enumType->getUnderlyingType(),
                [$this, 'typeDefinitionAsXml']
            );
        }

        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_IsFlags,
            $enumType->isFlags(),
            CsdlConstants::Default_IsFlags,
            [EdmValueWriter::class, 'booleanAsXml']
        );
    }

    public function writeDocumentationElement(IDocumentation $documentation): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Documentation);

        $summary = $documentation->getSummary();
        if (null !== $summary && !empty($summary)) {
            $this->xmlWriter->startElement(CsdlConstants::Element_Summary);
            $this->xmlWriter->text($summary);
            $this->writeEndElement();
        }

        $descript = $documentation->getDescription();
        if (null !== $descript && !empty($descript)) {
            $this->xmlWriter->startElement(CsdlConstants::Element_LongDescription);
            $this->xmlWriter->text($descript);
            $this->writeEndElement();
        }

        $this->writeEndElement();
    }

    /**
     * @param  IEntitySet           $entitySet
     * @param  INavigationProperty  $property
     * @throws \ReflectionException
     */
    public function writeAssociationSetEndElementHeader(IEntitySet $entitySet, INavigationProperty $property): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_End);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Role,
            $this->model->getAssociationEndName($property),
            [EdmValueWriter::class, 'stringAsXml']
        );
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_EntitySet,
            $entitySet->getName(),
            [EdmValueWriter::class, 'stringAsXml']
        );
    }

    /**
     * @param  INavigationProperty  $associationEnd
     * @throws \ReflectionException
     */
    public function writeAssociationEndElementHeader(INavigationProperty $associationEnd): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_End);
        $declaringType = $associationEnd->getDeclaringType();
        assert($declaringType instanceof IEntityType);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Type,
            $declaringType->FullName(),
            [EdmValueWriter::class, 'stringAsXml']
        );
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Role,
            $this->model->getAssociationEndName($associationEnd),
            [EdmValueWriter::class, 'stringAsXml']
        );
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Multiplicity,
            $associationEnd->Multiplicity(),
            [self::class, 'multiplicityAsXml']
        );
    }

    /**
     * @param  IEntityContainer     $container
     * @throws \ReflectionException
     */
    public function writeEntityContainerElementHeader(IEntityContainer $container): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_EntityContainer);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $container->getName(),
            [EdmValueWriter::class, 'stringAsXml']
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
    public function writeEntitySetElementHeader(IEntitySet $entitySet): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_EntitySet);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $entitySet->getName(),
            [EdmValueWriter::class, 'stringAsXml']
        );
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_EntityType,
            $entitySet->getElementType()->FullName(),
            [EdmValueWriter::class, 'stringAsXml']
        );
    }

    /**
     * @param  IEntityType          $entityType
     * @throws \ReflectionException
     */
    public function writeEntityTypeElementHeader(IEntityType $entityType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_EntityType);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $entityType->getName(),
            [EdmValueWriter::class, 'stringAsXml']
        );
        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_BaseType,
            $entityType->BaseEntityType(),
            null,
            [$this, 'typeDefinitionAsXml']
        );
        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_Abstract,
            $entityType->isAbstract(),
            CsdlConstants::Default_Abstract,
            [EdmValueWriter::class, 'booleanAsXml']
        );
        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_OpenType,
            $entityType->isOpen(),
            CsdlConstants::Default_OpenType,
            [EdmValueWriter::class, 'booleanAsXml']
        );
    }

    public function writeDeclaredKeyPropertiesElementHeader(): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Key);
    }

    /**
     * @param  IStructuralProperty  $property
     * @throws \ReflectionException
     */
    public function writePropertyRefElement(IStructuralProperty $property): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_PropertyRef);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $property->getName(),
            [EdmValueWriter::class, 'stringAsXml']
        );
        $this->writeEndElement();
    }

    /**
     * @param  INavigationProperty  $member
     * @throws \ReflectionException
     */
    public function writeNavigationPropertyElementHeader(INavigationProperty $member): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_NavigationProperty);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $member->getName(),
            [EdmValueWriter::class, 'stringAsXml']
        );
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Relationship,
            $this->model->getAssociationFullName($member),
            [EdmValueWriter::class, 'stringAsXml']
        );
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_ToRole,
            $this->model->getAssociationEndName($member->getPartner()),
            [EdmValueWriter::class, 'stringAsXml']
        );
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_FromRole,
            $this->model->getAssociationEndName($member),
            [EdmValueWriter::class, 'stringAsXml']
        );
        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_ContainsTarget,
            $member->containsTarget(),
            CsdlConstants::Default_ContainsTarget,
            [EdmValueWriter::class, 'booleanAsXml']
        );
    }

    /**
     * @param  string               $elementName
     * @param  OnDeleteAction       $operationAction
     * @throws \ReflectionException
     */
    public function writeOperationActionElement(string $elementName, OnDeleteAction $operationAction): void
    {
        $this->xmlWriter->startElement($elementName);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Action,
            strval($operationAction),
            [EdmValueWriter::class, 'stringAsXml']
        );
        $this->writeEndElement();
    }

    /**
     * @param  EdmSchema            $schema
     * @param  string|null          $alias
     * @param  array                $mappings
     * @throws \ReflectionException
     */
    public function writeSchemaElementHeader(EdmSchema $schema, ?string $alias, array $mappings): void
    {
        $xmlNamespace = self::getCsdlNamespace($this->version);
        $this->xmlWriter->startElement(CsdlConstants::Element_Schema);
        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_Namespace,
            $schema->getNamespace(),
            '',
            [EdmValueWriter::class, 'stringAsXml']
        );
        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_Alias,
            $alias,
            null,
            [EdmValueWriter::class, 'stringAsXml']
        );
        foreach ($mappings as $mappingKey => $mappingValue) {
            $this->xmlWriter->writeAttributeNs(EdmConstants::XmlNamespacePrefix, $mappingKey, null, $mappingValue);
        }
    }

    /**
     * @param  string               $annotationsTarget
     * @throws \ReflectionException
     */
    public function writeAnnotationsElementHeader(string $annotationsTarget): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Annotations);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Target,
            $annotationsTarget,
            [EdmValueWriter::class, 'stringAsXml']
        );
    }

    /**
     * @param  IStructuralProperty  $property
     * @param  bool                 $inlineType
     * @throws \ReflectionException
     */
    public function writeStructuralPropertyElementHeader(IStructuralProperty $property, bool $inlineType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Property);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $property->getName(),
            [EdmValueWriter::class, 'stringAsXml']
        );
        if ($inlineType) {
            $this->writeRequiredAttribute(
                CsdlConstants::Attribute_Type,
                $property->getType(),
                [$this, 'typeReferenceAsXml']
            );
        }

        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_ConcurrencyMode,
            $property->getConcurrencyMode(),
            CsdlConstants::$Default_ConcurrencyMode,
            [self::class, 'concurrencyModeAsXml']
        );
        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_DefaultValue,
            $property->getDefaultValueString(),
            null,
            [EdmValueWriter::class, 'stringAsXml']
        );
    }

    /**
     * @param  IEnumMember          $member
     * @throws \ReflectionException
     */
    public function writeEnumMemberElementHeader(IEnumMember $member): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Member);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $member->getName(),
            [EdmValueWriter::class, 'stringAsXml']
        );
        $isExplicit = $member->IsValueExplicit($this->model);
        if (null === $isExplicit || $isExplicit) {
            $this->writeRequiredAttribute(
                CsdlConstants::Attribute_Value,
                $member->getValue(),
                [EdmValueWriter::class, 'primitiveValueAsXml']
            );
        }
    }

    /**
     * @param  ITypeReference       $reference
     * @throws \ReflectionException
     */
    public function writeNullableAttribute(ITypeReference $reference): void
    {
        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_Nullable,
            $reference->getNullable(),
            CsdlConstants::Default_Nullable,
            [EdmValueWriter::class, 'booleanAsXml']
        );
    }

    /**
     * @param  IBinaryTypeReference $reference
     * @throws \ReflectionException
     */
    public function writeBinaryTypeAttributes(IBinaryTypeReference $reference): void
    {
        if ($reference->isUnBounded()) {
            $this->writeRequiredAttribute(
                CsdlConstants::Attribute_MaxLength,
                CsdlConstants::Value_Max,
                [EdmValueWriter::class, 'stringAsXml']
            );
        } else {
            $this->writeOptionalAttribute(
                CsdlConstants::Attribute_MaxLength,
                $reference->getMaxLength(),
                null,
                [EdmValueWriter::class, 'intAsXml']
            );
        }

        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_FixedLength,
            $reference->isFixedLength(),
            null,
            [EdmValueWriter::class, 'booleanAsXml']
        );
    }

    /**
     * @param  IDecimalTypeReference $reference
     * @throws \ReflectionException
     */
    public function writeDecimalTypeAttributes(IDecimalTypeReference $reference): void
    {
        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_Precision,
            $reference->getPrecision(),
            null,
            [EdmValueWriter::class, 'intAsXml']
        );
        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_Scale,
            $reference->getScale(),
            null,
            [EdmValueWriter::class, 'intAsXml']
        );
    }

    /**
     * @param  ISpatialTypeReference $reference
     * @throws \ReflectionException
     */
    public function writeSpatialTypeAttributes(ISpatialTypeReference $reference): void
    {
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Srid,
            $reference->getSpatialReferenceIdentifier(),
            [self::class, 'sridAsXml']
        );
    }

    /**
     * @param  IStringTypeReference $reference
     * @throws \ReflectionException
     */
    public function writeStringTypeAttributes(IStringTypeReference $reference): void
    {
        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_Collation,
            $reference->getCollation(),
            null,
            [EdmValueWriter::class, 'stringAsXml']
        );
        if ($reference->isUnbounded()) {
            $this->writeRequiredAttribute(
                CsdlConstants::Attribute_MaxLength,
                CsdlConstants::Value_Max,
                [EdmValueWriter::class, 'stringAsXml']
            );
        } else {
            $this->writeOptionalAttribute(
                CsdlConstants::Attribute_MaxLength,
                $reference->getMaxLength(),
                null,
                [EdmValueWriter::class, 'intAsXml']
            );
        }

        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_FixedLength,
            $reference->isFixedLength(),
            null,
            [EdmValueWriter::class, 'booleanAsXml']
        );
        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_Unicode,
            $reference->isUnicode(),
            null,
            [EdmValueWriter::class, 'booleanAsXml']
        );
    }

    /**
     * @param  ITemporalTypeReference $reference
     * @throws \ReflectionException
     */
    public function writeTemporalTypeAttributes(ITemporalTypeReference $reference): void
    {
        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_Precision,
            $reference->getPrecision(),
            null,
            [EdmValueWriter::class, 'intAsXml']
        );
    }

    public function writeReferentialConstraintElementHeader(INavigationProperty $constraint): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_ReferentialConstraint);
    }

    /**
     * @param  INavigationProperty  $end
     * @throws \ReflectionException
     */
    public function writeReferentialConstraintPrincipalEndElementHeader(INavigationProperty $end): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Principal);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Role,
            $this->model->getAssociationEndName($end),
            [EdmValueWriter::class, 'stringAsXml']
        );
    }

    /**
     * @param  INavigationProperty  $end
     * @throws \ReflectionException
     */
    public function writeReferentialConstraintDependentEndElementHeader(INavigationProperty $end): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Dependent);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Role,
            $this->model->getAssociationEndName($end),
            [EdmValueWriter::class, 'stringAsXml']
        );
    }

    /**
     * @param  string               $usingNamespace
     * @param  string               $alias
     * @throws \ReflectionException
     */
    public function writeNamespaceUsingElement(string $usingNamespace, string $alias): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Using);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Namespace,
            $usingNamespace,
            [EdmValueWriter::class, 'stringAsXml']
        );
        $this->writeRequiredAttribute(CsdlConstants::Attribute_Alias, $alias, [EdmValueWriter::class, 'stringAsXml']);
        $this->writeEndElement();
    }

    /**
     * @param  IDirectValueAnnotation                                 $annotation
     * @throws \AlgoWeb\ODataMetadata\Exception\NotSupportedException
     */
    public function writeAnnotationStringAttribute(IDirectValueAnnotation $annotation): void
    {
        $edmValue = $annotation->getValue();
        if ($edmValue instanceof IPrimitiveValue) {
            $this->xmlWriter->writeAttributeNs(
                '',
                $annotation->getName(),
                $annotation->getNamespaceUri(),
                EdmValueWriter::primitiveValueAsXml($edmValue)
            );
        }
    }

    public function writeAnnotationStringElement(IDirectValueAnnotation $annotation): void
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
    public function writeFunctionElementHeader(IFunction $function, bool $inlineReturnType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Function);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $function->getName(),
            [EdmValueWriter::class, 'stringAsXml']
        );
        if ($inlineReturnType) {
            $this->writeRequiredAttribute(
                CsdlConstants::Attribute_ReturnType,
                $function->getReturnType(),
                [$this, 'typeReferenceAsXml']
            );
        }
    }

    public function writeDefiningExpressionElement(string $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_DefiningExpression);
        $this->xmlWriter->text($expression);
        $this->xmlWriter->endElement();
    }

    public function writeReturnTypeElementHeader()
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_ReturnType);
    }

    /**
     * @param  IFunctionImport      $functionImport
     * @throws \ReflectionException
     */
    public function writeFunctionImportElementHeader(IFunctionImport $functionImport): void
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
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $functionImport->getName(),
            [EdmValueWriter::class, 'stringAsXml']
        );
        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_ReturnType,
            $functionImport->getReturnType(),
            null,
            [$this, 'typeReferenceAsXml']
        );

        // IsSideEffecting is optional, however its default applies to non-composable function imports only.
        // Composable function imports can't be side-effecting, so we don't emit false.
        if (!$functionImport->isComposable() &&
            $functionImport->isSideEffecting() != CsdlConstants::Default_IsSideEffecting) {
            $this->writeRequiredAttribute(
                CsdlConstants::Attribute_IsSideEffecting,
                $functionImport->isSideEffecting(),
                [EdmValueWriter::class, 'booleanAsXml']
            );
        }

        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_IsComposable,
            $functionImport->isComposable(),
            CsdlConstants::Default_IsComposable,
            [EdmValueWriter::class, 'booleanAsXml']
        );
        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_IsBindable,
            $functionImport->isBindable(),
            CsdlConstants::Default_IsBindable,
            [EdmValueWriter::class, 'booleanAsXml']
        );
        $entitySetReference = $functionImport->getEntitySet();
        if (null !== $functionImport->getEntitySet()) {
            if ($entitySetReference instanceof IEntitySetReferenceExpression) {
                $this->writeOptionalAttribute(
                    CsdlConstants::Attribute_EntitySet,
                    $entitySetReference->getReferencedEntitySet()->getName(),
                    null,
                    [EdmValueWriter::class, 'stringAsXml']
                );
            } else {
                $pathExpression = $functionImport->getEntitySet();
                if ($pathExpression instanceof IPathExpression) {
                    $this->writeOptionalAttribute(
                        CsdlConstants::Attribute_EntitySetPath,
                        $pathExpression->getPath(),
                        null,
                        [self::class, 'pathAsXml']
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
    public function writeFunctionParameterElementHeader(IFunctionParameter $parameter, bool $inlineType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Parameter);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $parameter->getName(),
            [EdmValueWriter::class, 'stringAsXml']
        );
        if ($inlineType) {
            $this->writeRequiredAttribute(
                CsdlConstants::Attribute_Type,
                $parameter->getType(),
                [$this, 'typeReferenceAsXml']
            );
        }

        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_Mode,
            $parameter->getMode(),
            CsdlConstants::$Default_FunctionParameterMode,
            [self::class, 'functionParameterModeAsXml']
        );
    }

    /**
     * @param  ICollectionType      $collectionType
     * @param  bool                 $inlineType
     * @throws \ReflectionException
     */
    public function writeCollectionTypeElementHeader(ICollectionType $collectionType, bool $inlineType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_CollectionType);
        if ($inlineType) {
            $this->writeRequiredAttribute(
                CsdlConstants::Attribute_ElementType,
                $collectionType->getElementType(),
                [$this, 'typeReferenceAsXml']
            );
        }
    }

    public function writeRowTypeElementHeader(): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_RowType);
    }

    /**
     * @param  IExpression          $expression
     * @throws \ReflectionException
     */
    public function writeInlineExpression(IExpression $expression): void
    {
        if (method_exists($expression, 'getValue')) {
            EdmUtil::checkArgumentNull($expression->getValue(), 'expression->getValue');
        }
        switch ($expression->getExpressionKind()) {
            case ExpressionKind::BinaryConstant():
                assert($expression instanceof IBinaryConstantExpression);
                $this->writeRequiredAttribute(
                    CsdlConstants::Attribute_Binary,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'binaryAsXml']
                );
                break;
            case ExpressionKind::BooleanConstant():
                assert($expression instanceof IBooleanConstantExpression);
                $this->writeRequiredAttribute(
                    CsdlConstants::Attribute_Bool,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'booleanAsXml']
                );
                break;
            case ExpressionKind::DateTimeConstant():
                assert($expression instanceof IDateTimeConstantExpression);
                $this->writeRequiredAttribute(
                    CsdlConstants::Attribute_DateTime,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'dateTimeAsXml']
                );
                break;
            case ExpressionKind::DateTimeOffsetConstant():
                assert($expression instanceof IDateTimeOffsetConstantExpression);
                $this->writeRequiredAttribute(
                    CsdlConstants::Attribute_DateTimeOffset,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'dateTimeOffsetAsXml']
                );
                break;
            case ExpressionKind::DecimalConstant():
                assert($expression instanceof IDecimalConstantExpression);
                $this->writeRequiredAttribute(
                    CsdlConstants::Attribute_Decimal,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'decimalAsXml']
                );
                break;
            case ExpressionKind::FloatingConstant():
                assert($expression instanceof IFloatingConstantExpression);
                $this->writeRequiredAttribute(
                    CsdlConstants::Attribute_Float,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'floatAsXml']
                );
                break;
            case ExpressionKind::GuidConstant():
                assert($expression instanceof IGuidConstantExpression);
                $this->writeRequiredAttribute(
                    CsdlConstants::Attribute_Guid,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'guidAsXml']
                );
                break;
            case ExpressionKind::IntegerConstant():
                assert($expression instanceof IIntegerConstantExpression);
                $this->writeRequiredAttribute(
                    CsdlConstants::Attribute_Int,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'longAsXml']
                );
                break;
            case ExpressionKind::Path():
                assert($expression instanceof IPathExpression);
                $this->writeRequiredAttribute(
                    CsdlConstants::Attribute_Path,
                    $expression->getPath(),
                    [self::class, 'pathAsXml']
                );
                break;
            case ExpressionKind::StringConstant():
                assert($expression instanceof IStringConstantExpression);
                $this->writeRequiredAttribute(
                    CsdlConstants::Attribute_String,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'stringAsXml']
                );
                break;
            case ExpressionKind::TimeConstant():
                assert($expression instanceof ITimeConstantExpression);
                $this->writeRequiredAttribute(
                    CsdlConstants::Attribute_Time,
                    $expression->getValue(),
                    [EdmValueWriter::class, 'timeAsXml']
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
    public function writeValueAnnotationElementHeader(IValueAnnotation $annotation, bool $isInline): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_ValueAnnotation);
        $this->writeRequiredAttribute(CsdlConstants::Attribute_Term, $annotation->getTerm(), [$this, 'termAsXml']);
        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_Qualifier,
            $annotation->getQualifier(),
            null,
            [EdmValueWriter::class, 'stringAsXml']
        );
        if ($isInline) {
            $this->writeInlineExpression($annotation->getValue());
        }
    }

    /**
     * @param  ITypeAnnotation      $annotation
     * @throws \ReflectionException
     */
    public function writeTypeAnnotationElementHeader(ITypeAnnotation $annotation): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_TypeAnnotation);
        $this->writeRequiredAttribute(CsdlConstants::Attribute_Term, $annotation->getTerm(), [$this, 'termAsXml']);
        $this->writeOptionalAttribute(
            CsdlConstants::Attribute_Qualifier,
            $annotation->getQualifier(),
            null,
            [EdmValueWriter::class, 'stringAsXml']
        );
    }

    /**
     * @param  IPropertyValueBinding $value
     * @param  bool                  $isInline
     * @throws \ReflectionException
     */
    public function writePropertyValueElementHeader(IPropertyValueBinding $value, bool $isInline): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_PropertyValue);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Property,
            $value->getBoundProperty()->getName(),
            [EdmValueWriter::class, 'stringAsXml']
        );
        if ($isInline) {
            $this->writeInlineExpression($value->getValue());
        }
    }

    /**
     * @param  IRecordExpression    $expression
     * @throws \ReflectionException
     */
    public function writeRecordExpressionElementHeader(IRecordExpression $expression)
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Record);
        $this->writeOptionalAttribute(
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
    public function writePropertyConstructorElementHeader(IPropertyConstructor $constructor, bool $isInline): void
    {
        EdmUtil::checkArgumentNull($constructor->getName(), 'constructor->getName');
        $this->xmlWriter->startElement(CsdlConstants::Element_PropertyValue);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Property,
            $constructor->getName(),
            [EdmValueWriter::class, 'stringAsXml']
        );
        if ($isInline) {
            EdmUtil::checkArgumentNull($constructor->getValue(), 'constructor->getValue()');
            $this->writeInlineExpression($constructor->getValue());
        }
    }

    public function writeStringConstantExpressionElement(IStringConstantExpression $expression): void
    {
        EdmUtil::checkArgumentNull($expression->getValue(), 'expression->getValue');
        $this->xmlWriter->startElement(CsdlConstants::Element_String);
        $this->xmlWriter->text(EdmValueWriter::stringAsXml($expression->getValue()));
        $this->writeEndElement();
    }

    public function writeBinaryConstantExpressionElement(IBinaryConstantExpression $expression): void
    {
        EdmUtil::checkArgumentNull($expression->getValue(), 'expression->getValue');
        $this->xmlWriter->startElement(CsdlConstants::Element_String);
        $this->xmlWriter->text(EdmValueWriter::binaryAsXml($expression->getValue()));
        $this->writeEndElement();
    }

    public function writeBooleanConstantExpressionElement(IBooleanConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Bool);
        $this->xmlWriter->text(EdmValueWriter::booleanAsXml($expression->getValue()));
        $this->writeEndElement();
    }

    public function writeNullConstantExpressionElement(INullExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Null);
        $this->writeEndElement();
    }

    public function writeDateTimeConstantExpressionElement(IDateTimeConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_DateTime);
        $this->xmlWriter->text(EdmValueWriter::dateTimeAsXml($expression->getValue()));
        $this->writeEndElement();
    }

    public function writeDateTimeOffsetConstantExpressionElement(IDateTimeOffsetConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_DateTimeOffset);
        $this->xmlWriter->text(EdmValueWriter::dateTimeOffsetAsXml($expression->getValue()));
        $this->writeEndElement();
    }

    public function writeDecimalConstantExpressionElement(IDecimalConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Decimal);
        $this->xmlWriter->text(EdmValueWriter::decimalAsXml($expression->getValue()));
        $this->writeEndElement();
    }

    public function writeFloatingConstantExpressionElement(IFloatingConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Float);
        $this->xmlWriter->text(EdmValueWriter::floatAsXml($expression->getValue()));
        $this->writeEndElement();
    }

    /**
     * @param  IApplyExpression     $expression
     * @param  bool                 $isFunction
     * @throws \ReflectionException
     */
    public function writeFunctionApplicationElementHeader(IApplyExpression $expression, bool $isFunction): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Apply);
        if ($isFunction) {
            $appliedFunction = $expression->getAppliedFunction();
            assert($appliedFunction instanceof IFunctionReferenceExpression);
            $this->writeRequiredAttribute(
                CsdlConstants::Attribute_Function,
                $appliedFunction->getReferencedFunction(),
                [$this, 'functionAsXml']
            );
        }
    }

    public function writeGuidConstantExpressionElement(IGuidConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Guid);
        $this->xmlWriter->text(EdmValueWriter::guidAsXml($expression->getValue()));
        $this->writeEndElement();
    }

    public function writeIntegerConstantExpressionElement(IIntegerConstantExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Int);
        $this->xmlWriter->text(EdmValueWriter::longAsXml($expression->getValue()));
        $this->writeEndElement();
    }

    public function writePathExpressionElement(IPathExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Path);
        $this->xmlWriter->text(self::pathAsXml($expression->getPath()));
        $this->writeEndElement();
    }

    public function writeIfExpressionElementHeader(IIfExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_If);
    }

    public function writeCollectionExpressionElementHeader(ICollectionExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_Collection);
    }

    /**
     * @param  ILabeledExpression   $labeledElement
     * @throws \ReflectionException
     */
    public function writeLabeledElementHeader(ILabeledExpression $labeledElement): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_LabeledElement);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $labeledElement->getName(),
            [EdmValueWriter::class, 'stringAsXml']
        );
    }

    /**
     * @param  IIsTypeExpression    $expression
     * @param  bool                 $inlineType
     * @throws \ReflectionException
     */
    public function writeIsTypeExpressionElementHeader(IIsTypeExpression $expression, bool $inlineType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_IsType);
        if ($inlineType) {
            $this->writeRequiredAttribute(
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
    public function writeAssertTypeExpressionElementHeader(IAssertTypeExpression $expression, bool $inlineType): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_AssertType);
        if ($inlineType) {
            $this->writeRequiredAttribute(
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
    public function writeEntitySetReferenceExpressionElement(IEntitySetReferenceExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_EntitySetReference);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $expression->getReferencedEntitySet(),
            [self::class, 'entitySetAsXml']
        );
        $this->writeEndElement();
    }

    /**
     * @param  IParameterReferenceExpression $expression
     * @throws \ReflectionException
     */
    public function writeParameterReferenceExpressionElement(IParameterReferenceExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_ParameterReference);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $expression->getReferencedParameter(),
            [self::class, 'parameterAsXml']
        );
        $this->writeEndElement();
    }

    /**
     * @param  IFunctionReferenceExpression $expression
     * @throws \ReflectionException
     */
    public function writeFunctionReferenceExpressionElement(IFunctionReferenceExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_FunctionReference);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $expression->getReferencedFunction(),
            [$this, 'functionAsXml']
        );
        $this->writeEndElement();
    }

    /**
     * @param  IEnumMemberReferenceExpression $expression
     * @throws \ReflectionException
     */
    public function writeEnumMemberReferenceExpressionElement(IEnumMemberReferenceExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_EnumMemberReference);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $expression->getReferencedEnumMember(),
            [self::class, 'enumMemberAsXml']
        );
        $this->writeEndElement();
    }

    /**
     * @param  IPropertyReferenceExpression $expression
     * @throws \ReflectionException
     */
    public function writePropertyReferenceExpressionElementHeader(IPropertyReferenceExpression $expression): void
    {
        $this->xmlWriter->startElement(CsdlConstants::Element_PropertyReference);
        $this->writeRequiredAttribute(
            CsdlConstants::Attribute_Name,
            $expression->getReferencedProperty(),
            [self::class, 'propertyAsXml']
        );
    }

    public function writeEndElement(): void
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
    public function writeOptionalAttribute(string $attribute, $value, $defaultValue, callable $toXml): void
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
    public function writeRequiredAttribute(string $attribute, $value, callable $toXml): void
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
    private static function multiplicityAsXml(Multiplicity $endKind): string
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
    private static function functionParameterModeAsXml(FunctionParameterMode $mode): string
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
    private static function concurrencyModeAsXml(ConcurrencyMode $mode): string
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
    private static function pathAsXml(array $path): string
    {
        return implode('/', $path);
    }

    private static function parameterAsXml(IFunctionParameter $parameter): string
    {
        return $parameter->getName() ?? '';
    }

    private static function propertyAsXml(IProperty $property): string
    {
        return $property->getName() ?? '';
    }

    private static function enumMemberAsXml(IEnumMember $member): string
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
