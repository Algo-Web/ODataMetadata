<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Csdl\Internal\Serialization;

use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\OnDeleteAction;
use AlgoWeb\ODataMetadata\Enums\TermKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Exception\NotSupportedException;
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
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
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
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ISpatialTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStringTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;
use AlgoWeb\ODataMetadata\Interfaces\Values\IValue;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Structure\Tuple;
use AlgoWeb\ODataMetadata\Version;
use ArrayObject;
use XMLWriter;

class EdmModelCsdlSerializationVisitor extends EdmModelVisitor
{
    /**
     * @var Version
     */
    private $edmVersion;
    /**
     * @var IEdmModelCsdlSchemaWriter
     */
    private $schemaWriter;
    /**
     * @var INavigationProperty
     */
    private $navigationProperties = [];
    /**
     * @var array<string, INavigationProperty[]>|array
     */
    private $associations = [];
    /**
     * @var array<string, array<IEntitySet|INavigationProperty>[]>
     */
    private $associationSets = [];
    /**
     * @var array<string, string>
     */
    private $namespaceAliasMappings = [];

    public function __construct(
        IModel $model,
        XMLWriter $xmlWriter,
        Version $edmVersion,
        IEdmModelCsdlSchemaWriter $schemaWriter = null
    ) {
        parent::__construct($model);
        $this->edmVersion             = $edmVersion;
        $this->namespaceAliasMappings = $model->GetNamespaceAliases();
        $this->schemaWriter           = $schemaWriter ??
                                        new EdmModelCsdlSchemaWriter(
                                            $model,
                                            $this->namespaceAliasMappings,
                                            $this->edmVersion,
                                            $xmlWriter
                                        );
    }

    /**
     * @param  EdmSchema             $element
     * @param  array                 $mappings
     * @throws \ReflectionException
     * @throws NotSupportedException
     */
    public function VisitEdmSchema(EdmSchema $element, array $mappings): void
    {
        $alias = null;
        if ($this->namespaceAliasMappings != null) {
            $alias = array_key_exists($element->getNamespace(), $this->namespaceAliasMappings) ?
                $this->namespaceAliasMappings[$element->getNamespace()] :
                null;
        }

        $this->schemaWriter->WriteSchemaElementHeader($element, $alias, $mappings);
        foreach ($element->getUsedNamespaces() as $usingNamespace) {
            if ($usingNamespace != $element->getUsedNamespaces()) {
                if ($this->namespaceAliasMappings != null &&
                    array_key_exists($usingNamespace, $this->namespaceAliasMappings)) {
                    $this->schemaWriter->WriteNamespaceUsingElement(
                        $usingNamespace,
                        $this->namespaceAliasMappings[$usingNamespace]
                    );
                }
            }
        }

        $this->visitSchemaElements($element->getSchemaElements());
        foreach ($element->getAssociationNavigationProperties() as $navigationProperty) {
            $associationName = $this->model->GetAssociationFullName($navigationProperty);
            if (!array_key_exists($associationName, $this->associations)) {
                $handledNavigationProperties          = [];
                $this->associations[$associationName] = $handledNavigationProperties;
            }
            $self   = $this;
            $shared = array_filter(
                $this->associations[$associationName],
                function (INavigationProperty $np) use ($self, $navigationProperty) {
                    return $self->SharesAssociation($np, $navigationProperty);
                }
            );
            // This prevents us from losing associations if they share the same name.
            if (!count($shared) > 0) {
                $this->associations[$associationName][] = $navigationProperty;
                $this->associations[$associationName][] = $navigationProperty->getPartner();
                $this->ProcessAssociation($navigationProperty);
            }
        }

        // EntityContainers are excluded from the EdmSchema.SchemaElements property so they can be forced to the end.
        $this->visitCollection($element->getEntityContainers(), [$this, 'ProcessEntityContainer']);
        foreach ($element->getAnnotations() as $annotationsForTargetKey => $annotationsForTarget) {
            $this->schemaWriter->WriteAnnotationsElementHeader($annotationsForTargetKey);
            $this->visitVocabularyAnnotations($annotationsForTarget);
            $this->schemaWriter->WriteEndElement();
        }

        $this->schemaWriter->WriteEndElement();
    }

    /**
     * @param  IEntityContainer      $element
     * @throws \ReflectionException
     * @throws NotSupportedException
     */
    protected function ProcessEntityContainer(IEntityContainer $element): void
    {
        $this->BeginElement($element, [$this->schemaWriter, 'WriteEntityContainerElementHeader']);
        parent::ProcessEntityContainer($element);

        /** @var IEntitySet $entitySet */
        foreach ($element->EntitySets() as $entitySet) {
            foreach ($entitySet->getNavigationTargets() as $mapping) {
                $associationSetName = $this->model->GetAssociationFullName($mapping->getNavigationProperty());
                if (!isset($this->associationSets[$associationSetName])) {
                    $handledAssociationSets                     = [];
                    $this->associationSets[$associationSetName] = $handledAssociationSets;
                }
                $self = $this;
                $any  = array_filter(
                    $this->associationSets[$associationSetName],
                    function (Tuple $set) use ($self, $entitySet, $mapping) {
                        return $self->SharesAssociationSet(
                            $set->getItem1(),
                            $set->getItem2(),
                            $entitySet,
                            $mapping->getNavigationProperty()
                        );
                    }
                );
                // This prevents us from losing association sets if they share the same name.
                if (!count($any) > 0) {
                    $this->associationSets[$associationSetName] =
                        new Tuple($entitySet, $mapping->getNavigationProperty());
                    $this->associationSets[$associationSetName] =
                        new Tuple($mapping->getTargetEntitySet(), $mapping->getNavigationProperty()->getPartner());

                    $this->ProcessAssociationSet($entitySet, $mapping->getNavigationProperty());
                }
            }
        }

        $this->associationSets = [];

        $this->FinishElement($element);
    }

    /**
     * @param  IEntitySet            $element
     * @throws NotSupportedException
     */
    protected function ProcessEntitySet(IEntitySet $element): void
    {
        $this->BeginElement($element, [$this->schemaWriter, 'WriteEntitySetElementHeader']);
        parent::ProcessEntitySet($element);
        $this->FinishElement($element);
    }

    /**
     * @param  IEntityType           $element
     * @throws NotSupportedException
     * @throws \ReflectionException
     */
    protected function ProcessEntityType(IEntityType $element): void
    {
        $this->BeginElement($element, [$this->schemaWriter, 'WriteEntityTypeElementHeader']);
        if (null !== $element->getDeclaredKey() &&
            count($element->getDeclaredKey()) > 0 &&
            null === $element->getBaseType()) {
            $this->VisitEntityTypeDeclaredKey($element->getDeclaredKey());
        }

        $this->VisitProperties($element->DeclaredStructuralProperties());
        $this->VisitProperties($element->DeclaredNavigationProperties());
        $this->FinishElement($element);
    }

    /**
     * @param  IStructuralProperty   $element
     * @throws NotSupportedException
     */
    protected function ProcessStructuralProperty(IStructuralProperty $element): void
    {
        EdmUtil::checkArgumentNull($element->getType(), 'element->getType');
        $inlineType = self::IsInlineType($element->getType());
        $this->BeginElement($element, function (IStructuralProperty $t) use ($inlineType) {
            $this->schemaWriter->WriteStructuralPropertyElementHeader($t, $inlineType);
        }, function (IStructuralProperty $e) use ($inlineType) {
            EdmUtil::checkArgumentNull($e->getType(), 'e->getType');
            $this->ProcessFacets($e->getType(), $inlineType);
        });
        if (!$inlineType) {
            $this->visitTypeReference($element->getType());
        }

        $this->FinishElement($element);
    }

    /**
     * @param  IBinaryTypeReference $element
     * @throws \ReflectionException
     */
    protected function ProcessBinaryTypeReference(IBinaryTypeReference $element): void
    {
        $this->schemaWriter->WriteBinaryTypeAttributes($element);
    }

    /**
     * @param  IDecimalTypeReference $element
     * @throws \ReflectionException
     */
    protected function ProcessDecimalTypeReference(IDecimalTypeReference $element): void
    {
        $this->schemaWriter->WriteDecimalTypeAttributes($element);
    }

    /**
     * @param  ISpatialTypeReference $element
     * @throws \ReflectionException
     */
    protected function ProcessSpatialTypeReference(ISpatialTypeReference $element): void
    {
        $this->schemaWriter->WriteSpatialTypeAttributes($element);
    }

    /**
     * @param  IStringTypeReference $element
     * @throws \ReflectionException
     */
    protected function ProcessStringTypeReference(IStringTypeReference $element): void
    {
        $this->schemaWriter->WriteStringTypeAttributes($element);
    }

    /**
     * @param  ITemporalTypeReference $element
     * @throws \ReflectionException
     */
    protected function ProcessTemporalTypeReference(ITemporalTypeReference $element): void
    {
        $this->schemaWriter->WriteTemporalTypeAttributes($element);
    }

    /**
     * @param  INavigationProperty   $element
     * @throws NotSupportedException
     */
    protected function ProcessNavigationProperty(INavigationProperty $element): void
    {
        $this->BeginElement($element, [$this->schemaWriter, 'WriteNavigationPropertyElementHeader']);
        $this->FinishElement($element);
        $this->navigationProperties[] = $element;
    }

    /**
     * @param  IComplexType          $element
     * @throws NotSupportedException
     */
    protected function ProcessComplexType(IComplexType $element): void
    {
        $this->BeginElement($element, [$this->schemaWriter, 'WriteComplexTypeElementHeader']);
        parent::ProcessComplexType($element);
        $this->FinishElement($element);
    }

    /**
     * @param  IEnumType             $element
     * @throws NotSupportedException
     */
    protected function ProcessEnumType(IEnumType $element): void
    {
        $this->BeginElement($element, [$this->schemaWriter, 'WriteEnumTypeElementHeader']);
        parent::ProcessEnumType($element);
        $this->FinishElement($element);
    }

    /**
     * @param  IEnumMember           $element
     * @throws NotSupportedException
     */
    protected function ProcessEnumMember(IEnumMember $element): void
    {
        $this->BeginElement($element, [$this->schemaWriter, 'WriteEnumMemberElementHeader']);
        $this->FinishElement($element);
    }

    /**
     * @param  IValueTerm            $term
     * @throws NotSupportedException
     */
    protected function ProcessValueTerm(IValueTerm $term): void
    {
        $inlineType = null !== $term->getType() && self::IsInlineType($term->getType());
        $this->BeginElement($term, function (IValueTerm $t) use ($inlineType) {
            $this->schemaWriter->WriteValueTermElementHeader($t, $inlineType);
        }, function (IValueTerm $e) use ($inlineType) {
            EdmUtil::checkArgumentNull($e->getType(), 'e->getType');
            $this->ProcessFacets($e->getType(), $inlineType);
        });
        if (!$inlineType) {
            if (null !== $term->getType()) {
                $this->VisitTypeReference($term->getType());
            }
        }

        $this->FinishElement($term);
    }

    /**
     * @param  IFunction             $element
     * @throws NotSupportedException
     */
    protected function ProcessFunction(IFunction $element): void
    {
        if (null !== $element->getReturnType()) {
            $inlineReturnType = self::IsInlineType($element->getReturnType());
            $this->BeginElement($element, function (IFunction $f) use ($inlineReturnType) {
                $this->schemaWriter->WriteFunctionElementHeader($f, $inlineReturnType);
            }, function (IFunction $f) use ($inlineReturnType) {
                EdmUtil::checkArgumentNull($f->getReturnType(), 'f->getReturnType');
                $this->ProcessFacets($f->getReturnType(), $inlineReturnType);
            });
            if (!$inlineReturnType) {
                $this->schemaWriter->WriteReturnTypeElementHeader();
                $this->VisitTypeReference($element->getReturnType());
                $this->schemaWriter->WriteEndElement();
            }
        } else {
            $this->BeginElement($element, function (IFunction $t) {
                $this->schemaWriter->WriteFunctionElementHeader($t, false /*Inline ReturnType*/);
            });
        }

        if (null !== $element->getDefiningExpression()) {
            $this->schemaWriter->WriteDefiningExpressionElement($element->getDefiningExpression());
        }

        $this->VisitFunctionParameters($element->getParameters());
        $this->FinishElement($element);
    }

    /**
     * @param  IFunctionParameter    $element
     * @throws NotSupportedException
     */
    protected function ProcessFunctionParameter(IFunctionParameter $element): void
    {
        $inlineType = self::IsInlineType($element->getType());
        $this->BeginElement(
            $element,
            function (IFunctionParameter $t) use ($inlineType) {
                $this->schemaWriter->WriteFunctionParameterElementHeader($t, $inlineType);
            },
            function (IFunctionParameter $e) use ($inlineType) {
                $this->ProcessFacets($e->getType(), $inlineType);
            }
        );
        if (!$inlineType) {
            $this->VisitTypeReference($element->getType());
        }

        $this->FinishElement($element);
    }

    /**
     * @param  ICollectionType       $element
     * @throws NotSupportedException
     */
    protected function ProcessCollectionType(ICollectionType $element): void
    {
        EdmUtil::checkArgumentNull($element->getElementType(), 'element->getElementType');
        $inlineType = self::IsInlineType($element->getElementType());
        $this->BeginElement(
            $element,
            function (ICollectionType $t) use ($inlineType) {
                $this->schemaWriter->WriteCollectionTypeElementHeader($t, $inlineType);
            },
            function (ICollectionType $e) use ($inlineType) {
                EdmUtil::checkArgumentNull($e->getElementType(), 'e->getElementType');
                $this->ProcessFacets($e->getElementType(), $inlineType);
            }
        );
        if (!$inlineType) {
            $this->VisitTypeReference($element->getElementType());
        }

        $this->FinishElement($element);
    }

    protected function ProcessRowType(IRowType $element): void
    {
        $this->schemaWriter->WriteRowTypeElementHeader();
        parent::ProcessRowType($element);
        $this->schemaWriter->WriteEndElement();
    }

    /**
     * @param  IFunctionImport       $functionImport
     * @throws NotSupportedException
     */
    protected function ProcessFunctionImport(IFunctionImport $functionImport): void
    {
        if (null !== $functionImport->getReturnType() && !self::IsInlineType($functionImport->getReturnType())) {
            throw new InvalidOperationException(
                StringConst::Serializer_NonInlineFunctionImportReturnType(
                    $functionImport->getContainer()->FullName() . '/' . $functionImport->getName()
                )
            );
        }

        $this->BeginElement($functionImport, [$this->schemaWriter, 'WriteFunctionImportElementHeader']);
        $this->VisitFunctionParameters($functionImport->getParameters());
        $this->FinishElement($functionImport);
    }

    #region Vocabulary Annotations

    /**
     * @param  IValueAnnotation      $annotation
     * @throws NotSupportedException
     */
    protected function ProcessValueAnnotation(IValueAnnotation $annotation): void
    {
        $isInline = self::IsInlineExpression($annotation->getValue());
        $this->BeginElement($annotation, function ($t) use ($isInline) {
            $this->schemaWriter->WriteValueAnnotationElementHeader($t, $isInline);
        });
        if (!$isInline) {
            parent::ProcessValueAnnotation($annotation);
        }

        $this->FinishElement($annotation);
    }

    /**
     * @param  ITypeAnnotation       $annotation
     * @throws NotSupportedException
     */
    protected function ProcessTypeAnnotation(ITypeAnnotation $annotation): void
    {
        $this->BeginElement($annotation, [$this->schemaWriter, 'WriteTypeAnnotationElementHeader']);
        parent::ProcessTypeAnnotation($annotation);
        $this->FinishElement($annotation);
    }

    /**
     * @param  IPropertyValueBinding $binding
     * @throws NotSupportedException
     */
    protected function ProcessPropertyValueBinding(IPropertyValueBinding $binding): void
    {
        $isInline = self::IsInlineExpression($binding->getValue());
        $this->BeginElement($binding, function ($t) use ($isInline) {
            $this->schemaWriter->WritePropertyValueElementHeader($t, $isInline);
        });
        if (!$isInline) {
            parent::ProcessPropertyValueBinding($binding);
        }

        $this->FinishElement($binding);
    }

    #endregion

    #region Expressions

    protected function ProcessStringConstantExpression(IStringConstantExpression $expression): void
    {
        $this->schemaWriter->WriteStringConstantExpressionElement($expression);
    }

    protected function ProcessBinaryConstantExpression(IBinaryConstantExpression $expression): void
    {
        $this->schemaWriter->WriteBinaryConstantExpressionElement($expression);
    }

    /**
     * @param  IRecordExpression     $expression
     * @throws NotSupportedException
     */
    protected function ProcessRecordExpression(IRecordExpression $expression): void
    {
        $this->BeginElement($expression, [$this->schemaWriter, 'WriteRecordExpressionElementHeader']);
        $this->VisitPropertyConstructors($expression->getProperties());
        $this->FinishElement($expression);
    }

    /**
     * @param  ILabeledExpression    $element
     * @throws NotSupportedException
     */
    protected function ProcessLabeledExpression(ILabeledExpression $element): void
    {
        if (null === $element->getName()) {
            parent::processLabeledExpression($element);
        } else {
            $this->BeginElement($element, [$this->schemaWriter, 'WriteLabeledElementHeader']);
            parent::processLabeledExpression($element);
            $this->FinishElement($element);
        }
    }

    /**
     * @param  IPropertyConstructor  $constructor
     * @throws NotSupportedException
     */
    protected function ProcessPropertyConstructor(IPropertyConstructor $constructor): void
    {
        EdmUtil::checkArgumentNull($constructor->getValue(), 'constructor->getValue');
        $isInline = self::IsInlineExpression($constructor->getValue());
        $this->BeginElement($constructor, function ($t) use ($isInline) {
            $this->schemaWriter->WritePropertyConstructorElementHeader($t, $isInline);
        });
        if (!$isInline) {
            parent::processPropertyConstructor($constructor);
        }

        $this->FinishElement($constructor);
    }

    /**
     * @param  IPropertyReferenceExpression $expression
     * @throws NotSupportedException
     */
    protected function ProcessPropertyReferenceExpression(IPropertyReferenceExpression $expression): void
    {
        $this->BeginElement($expression, [$this->schemaWriter, 'WritePropertyReferenceExpressionElementHeader']);
        if ($expression->getBase()!= null) {
            $this->VisitExpression($expression->getBase());
        }

        $this->FinishElement($expression);
    }

    /**
     * @param IPathExpression $expression
     */
    protected function ProcessPathExpression(IPathExpression $expression): void
    {
        $this->schemaWriter->WritePathExpressionElement($expression);
    }

    /**
     * @param  IParameterReferenceExpression $expression
     * @throws \ReflectionException
     */
    protected function ProcessParameterReferenceExpression(IParameterReferenceExpression $expression): void
    {
        $this->schemaWriter->WriteParameterReferenceExpressionElement($expression);
    }

    /**
     * @param  ICollectionExpression $expression
     * @throws NotSupportedException
     */
    protected function ProcessCollectionExpression(ICollectionExpression $expression): void
    {
        $this->BeginElement($expression, [$this->schemaWriter, 'WriteCollectionExpressionElementHeader']);
        $this->VisitExpressions($expression->getElements());
        $this->FinishElement($expression);
    }

    /**
     * @param  IIsTypeExpression     $expression
     * @throws NotSupportedException
     */
    protected function ProcessIsTypeExpression(IIsTypeExpression $expression): void
    {
        $inlineType = self::IsInlineType($expression->getType());
        $this->BeginElement($expression, function (IIsTypeExpression $t) use ($inlineType) {
            $this->schemaWriter->WriteIsTypeExpressionElementHeader($t, $inlineType);
        }, function (IIsTypeExpression $e) use ($inlineType) {
            $this->ProcessFacets($e->getType(), $inlineType);
        });
        if (!$inlineType) {
            $this->VisitTypeReference($expression->getType());
        }

        $this->VisitExpression($expression->getOperand());
        $this->FinishElement($expression);
    }

    protected function ProcessIntegerConstantExpression(IIntegerConstantExpression $expression): void
    {
        $this->schemaWriter->WriteIntegerConstantExpressionElement($expression);
    }

    /**
     * @param  IIfExpression         $expression
     * @throws NotSupportedException
     */
    protected function ProcessIfExpression(IIfExpression $expression): void
    {
        $this->BeginElement($expression, [$this->schemaWriter, 'WriteIfExpressionElementHeader']);
        parent::processIfExpression($expression);
        $this->FinishElement($expression);
    }

    /**
     * @param  IFunctionReferenceExpression $expression
     * @throws \ReflectionException
     */
    protected function ProcessFunctionReferenceExpression(IFunctionReferenceExpression $expression): void
    {
        $this->schemaWriter->WriteFunctionReferenceExpressionElement($expression);
    }

    /**
     * @param  IApplyExpression      $expression
     * @throws NotSupportedException
     */
    protected function ProcessFunctionApplicationExpression(IApplyExpression $expression): void
    {
        $isFunction = $expression->getAppliedFunction()->getExpressionKind() == ExpressionKind::FunctionReference();
        $this->BeginElement($expression, function ($e) use ($isFunction) {
            $this->schemaWriter->WriteFunctionApplicationElementHeader($e, $isFunction);
        });
        if (!$isFunction) {
            EdmUtil::checkArgumentNull($expression->getAppliedFunction(), 'expression->getAppliedFunction');
            $this->VisitExpression($expression->getAppliedFunction());
        }

        $this->VisitExpressions($expression->getArguments());
        $this->FinishElement($expression);
    }

    protected function ProcessFloatingConstantExpression(IFloatingConstantExpression $expression): void
    {
        $this->schemaWriter->WriteFloatingConstantExpressionElement($expression);
    }

    protected function ProcessGuidConstantExpression(IGuidConstantExpression $expression): void
    {
        $this->schemaWriter->WriteGuidConstantExpressionElement($expression);
    }

    /**
     * @param  IEnumMemberReferenceExpression $expression
     * @throws \ReflectionException
     */
    protected function ProcessEnumMemberReferenceExpression(IEnumMemberReferenceExpression $expression): void
    {
        $this->schemaWriter->WriteEnumMemberReferenceExpressionElement($expression);
    }

    /**
     * @param  IEntitySetReferenceExpression $expression
     * @throws \ReflectionException
     */
    protected function ProcessEntitySetReferenceExpression(IEntitySetReferenceExpression $expression): void
    {
        $this->schemaWriter->WriteEntitySetReferenceExpressionElement($expression);
    }

    protected function ProcessDecimalConstantExpression(IDecimalConstantExpression $expression): void
    {
        $this->schemaWriter->WriteDecimalConstantExpressionElement($expression);
    }

    protected function ProcessDateTimeConstantExpression(IDateTimeConstantExpression $expression): void
    {
        $this->schemaWriter->WriteDateTimeConstantExpressionElement($expression);
    }

    protected function ProcessDateTimeOffsetConstantExpression(IDateTimeOffsetConstantExpression $expression): void
    {
        $this->schemaWriter->WriteDateTimeOffsetConstantExpressionElement($expression);
    }

    protected function ProcessBooleanConstantExpression(IBooleanConstantExpression $expression): void
    {
        $this->schemaWriter->WriteBooleanConstantExpressionElement($expression);
    }

    protected function ProcessNullConstantExpression(INullExpression $expression): void
    {
        $this->schemaWriter->WriteNullConstantExpressionElement($expression);
    }

    /**
     * @param  IAssertTypeExpression $expression
     * @throws NotSupportedException
     */
    protected function ProcessAssertTypeExpression(IAssertTypeExpression $expression): void
    {
        $inlineType = self::IsInlineType($expression->getType());
        $this->BeginElement($expression, function (IAssertTypeExpression $t) use ($inlineType) {
            $this->schemaWriter->WriteAssertTypeExpressionElementHeader($t, $inlineType);
        }, function (IAssertTypeExpression $e) use ($inlineType) {
            $this->ProcessFacets($e->getType(), $inlineType);
        });
        if (!$inlineType) {
            $this->VisitTypeReference($expression->getType());
        }

        $this->VisitExpression($expression->getOperand());
        $this->FinishElement($expression);
    }

    #endregion

    private static function IsInlineType(ITypeReference $reference): bool
    {
        if ($reference->getDefinition() instanceof ISchemaElement || $reference->IsEntityReference()) {
            return true;
        } elseif ($reference->IsCollection()) {
            $def = $reference->AsCollection()->CollectionDefinition()->getElementType()->getDefinition();
            return $def instanceof ISchemaElement;
        }

        return false;
    }

    private static function IsInlineExpression(IExpression $expression): bool
    {
        return $expression->getExpressionKind()->isAnyOf(
            ExpressionKind::BinaryConstant(),
            ExpressionKind::BooleanConstant(),
            ExpressionKind::DateTimeConstant(),
            ExpressionKind::DateTimeOffsetConstant(),
            ExpressionKind::DecimalConstant(),
            ExpressionKind::FloatingConstant(),
            ExpressionKind::GuidConstant(),
            ExpressionKind::IntegerConstant(),
            ExpressionKind::Path(),
            ExpressionKind::StringConstant(),
            ExpressionKind::TimeConstant()
        );
    }

    /**
     * @param  iterable|IDirectValueAnnotation[] $annotations
     * @throws NotSupportedException
     */
    private function ProcessAnnotations(iterable $annotations): void
    {
        $this->VisitAttributeAnnotations($annotations);
        foreach ($annotations as $annotation) {
            if ($annotation->getNamespaceUri() == EdmConstants::DocumentationUri &&
                $annotation->getName() == EdmConstants::DocumentationAnnotation) {
                $value = $annotation->getValue();
                assert($value instanceof IDocumentation);
                $this->ProcessEdmDocumentation($value);
            }
        }
    }

    /**
     * @param  INavigationProperty   $element
     * @throws \ReflectionException
     * @throws NotSupportedException
     */
    private function ProcessAssociation(INavigationProperty $element): void
    {
        $end1 = $element->GetPrimary();
        $end2 = $end1->getPartner();
        /** @var IDirectValueAnnotation[] $associationAnnotations */
        $associationAnnotations = [];
        /** @var IDirectValueAnnotation[] $end1Annotations */
        $end1Annotations = [];
        /** @var IDirectValueAnnotation[] $end2Annotations */
        $end2Annotations = [];
        /** @var IDirectValueAnnotation[] $constraintAnnotations */
        $constraintAnnotations = [];
        $this->model->GetAssociationAnnotations(
            $element,
            $associationAnnotations,
            $end1Annotations,
            $end2Annotations,
            $constraintAnnotations
        );

        $this->schemaWriter->WriteAssociationElementHeader($end1);
        $this->ProcessAnnotations($associationAnnotations);

        $this->ProcessAssociationEnd($end1, $end1 === $element ? $end1Annotations : $end2Annotations);
        $this->ProcessAssociationEnd($end2, $end1 === $element ? $end2Annotations : $end1Annotations);
        $this->ProcessReferentialConstraint($end1, $constraintAnnotations);

        $this->VisitPrimitiveElementAnnotations($associationAnnotations);
        $this->schemaWriter->WriteEndElement();
    }

    /**
     * @param  INavigationProperty               $element
     * @param  iterable|IDirectValueAnnotation[] $annotations
     * @throws \ReflectionException
     * @throws NotSupportedException
     */
    private function ProcessAssociationEnd(INavigationProperty $element, iterable $annotations): void
    {
        $this->schemaWriter->WriteAssociationEndElementHeader($element);
        $this->ProcessAnnotations($annotations);

        if ($element->getOnDelete() != OnDeleteAction::None()) {
            $this->schemaWriter->WriteOperationActionElement(CsdlConstants::Element_OnDelete, $element->getOnDelete());
        }

        $this->VisitPrimitiveElementAnnotations($annotations);
        $this->schemaWriter->WriteEndElement();
    }

    /**
     * @param  INavigationProperty               $element
     * @param  iterable|IDirectValueAnnotation[] $annotations
     * @throws \ReflectionException
     * @throws NotSupportedException
     */
    private function ProcessReferentialConstraint(INavigationProperty $element, iterable $annotations): void
    {
        if ($element->getDependentProperties() !== null) {
            $principalElement = $element->getPartner();
        } elseif ($element->getPartner()->getDependentProperties() !== null) {
            $principalElement = $element;
        } else {
            return;
        }

        $this->schemaWriter->WriteReferentialConstraintElementHeader($principalElement);
        $this->ProcessAnnotations($annotations);
        $this->schemaWriter->WriteReferentialConstraintPrincipalEndElementHeader($principalElement);
        $dType = $principalElement->getDeclaringType();
        assert($dType instanceof IEntityType);
        $this->VisitPropertyRefs($dType->Key());
        $this->schemaWriter->WriteEndElement();
        $this->schemaWriter->WriteReferentialConstraintDependentEndElementHeader($principalElement->getPartner());
        EdmUtil::checkArgumentNull(
            $principalElement->getPartner()->getDependentProperties(),
            'principalElement->getPartner->getDependentProperties'
        );
        $this->VisitPropertyRefs($principalElement->getPartner()->getDependentProperties());
        $this->schemaWriter->WriteEndElement();
        $this->VisitPrimitiveElementAnnotations($annotations);
        $this->schemaWriter->WriteEndElement();
    }

    /**
     * @param  IEntitySet            $entitySet
     * @param  INavigationProperty   $property
     * @throws \ReflectionException
     * @throws NotSupportedException
     */
    private function ProcessAssociationSet(IEntitySet $entitySet, INavigationProperty $property): void
    {
        /** @var IDirectValueAnnotation[] $associationSetAnnotations */
        $associationSetAnnotations = [];
        /** @var IDirectValueAnnotation[] $end1Annotations */
        $end1Annotations = [];
        /** @var IDirectValueAnnotation[] $end2Annotations */
        $end2Annotations = [];
        $this->model->GetAssociationSetAnnotations(
            $entitySet,
            $property,
            $associationSetAnnotations,
            $end1Annotations,
            $end2Annotations
        );

        $this->schemaWriter->WriteAssociationSetElementHeader($entitySet, $property);
        $this->ProcessAnnotations($associationSetAnnotations);

        $this->ProcessAssociationSetEnd($entitySet, $property, $end1Annotations);

        $otherEntitySet = $entitySet->findNavigationTarget($property);
        if ($otherEntitySet != null) {
            $this->ProcessAssociationSetEnd($otherEntitySet, $property->getPartner(), $end2Annotations);
        }

        $this->VisitPrimitiveElementAnnotations($associationSetAnnotations);
        $this->schemaWriter->WriteEndElement();
    }

    /**
     * @param  IEntitySet                        $entitySet
     * @param  INavigationProperty               $property
     * @param  iterable|IDirectValueAnnotation[] $annotations
     * @throws \ReflectionException
     * @throws NotSupportedException
     */
    private function ProcessAssociationSetEnd(
        IEntitySet $entitySet,
        INavigationProperty $property,
        iterable $annotations
    ): void {
        $this->schemaWriter->WriteAssociationSetEndElementHeader($entitySet, $property);
        $this->ProcessAnnotations($annotations);
        $this->VisitPrimitiveElementAnnotations($annotations);
        $this->schemaWriter->WriteEndElement();
    }

    /**
     * @param  ITypeReference       $element
     * @param  bool                 $inlineType
     * @throws \ReflectionException
     */
    private function ProcessFacets(ITypeReference $element, bool $inlineType): void
    {
        if ($element != null) {
            if ($element->IsEntityReference()) {
                // No facets get serialized for an entity reference.
                return;
            }

            if ($inlineType) {
                if ($element->TypeKind()->isCollection()) {
                    $collectionElement = $element->AsCollection();
                    $type              = $collectionElement->CollectionDefinition()->getElementType();
                    EdmUtil::checkArgumentNull($type, 'ProcessFacets - $type');
                    $this->schemaWriter->WriteNullableAttribute($type);
                    $this->VisitTypeReference($type);
                } else {
                    $this->schemaWriter->WriteNullableAttribute($element);
                    $this->VisitTypeReference($element);
                }
            }
        }
    }

    /**
     * @param  iterable|IStructuralProperty[] $keyProperties
     * @throws \ReflectionException
     */
    private function VisitEntityTypeDeclaredKey(iterable $keyProperties): void
    {
        $this->schemaWriter->WriteDeclaredKeyPropertiesElementHeader();
        $this->VisitPropertyRefs($keyProperties);
        $this->schemaWriter->WriteEndElement();
    }

    /**
     * @param  iterable|IStructuralProperty[] $properties
     * @throws \ReflectionException
     */
    private function VisitPropertyRefs(iterable $properties): void
    {
        foreach ($properties as $property) {
            $this->schemaWriter->WritePropertyRefElement($property);
        }
    }

    /**
     * @param  iterable|IDirectValueAnnotation[] $annotations
     * @throws NotSupportedException
     */
    private function VisitAttributeAnnotations(iterable $annotations): void
    {
        foreach ($annotations as $annotation) {
            if ($annotation->getNamespaceUri() != EdmConstants::InternalUri) {
                $edmValue = $annotation->getValue();
                if ($edmValue instanceof IValue) {
                    if (!$edmValue->IsSerializedAsElement($this->model)) {
                        if ($edmValue->getType()->TypeKind()->isPrimitive()) {
                            $this->ProcessAttributeAnnotation($annotation);
                        }
                    }
                }
            }
        }
    }
    /**
     * @param iterable|IDirectValueAnnotation[] $annotations
     */
    private function VisitPrimitiveElementAnnotations(iterable $annotations): void
    {
        foreach ($annotations as $annotation) {
            if ($annotation->getNamespaceUri() != EdmConstants::InternalUri) {
                $edmValue = $annotation->getValue();
                if ($edmValue instanceof IValue) {
                    if (!$edmValue->IsSerializedAsElement($this->model)) {
                        if ($edmValue->getType()->TypeKind()->isPrimitive()) {
                            $this->ProcessElementAnnotation($annotation);
                        }
                    }
                }
            }
        }
    }

    /**
     * @param  IDirectValueAnnotation $annotation
     * @throws NotSupportedException
     */
    private function ProcessAttributeAnnotation(IDirectValueAnnotation $annotation): void
    {
        $this->schemaWriter->WriteAnnotationStringAttribute($annotation);
    }

    /**
     * @param IDirectValueAnnotation $annotation
     */
    private function ProcessElementAnnotation(IDirectValueAnnotation $annotation): void
    {
        $this->schemaWriter->WriteAnnotationStringElement($annotation);
    }

    /**
     * @param  iterable|IVocabularyAnnotation[] $annotations
     * @throws NotSupportedException
     */
    private function VisitElementVocabularyAnnotations(iterable $annotations): void
    {
        foreach ($annotations as $annotation) {
            switch ($annotation->getTerm()->getTermKind()) {
                case TermKind::Type():
                    assert($annotation instanceof  ITypeAnnotation);
                    $this->ProcessTypeAnnotation($annotation);
                    break;
                case TermKind::Value():
                    assert($annotation instanceof  IValueAnnotation);

                    $this->ProcessValueAnnotation($annotation);
                    break;
                case TermKind::None():
                    $this->ProcessVocabularyAnnotation($annotation);
                    break;
                default:
                    throw new InvalidOperationException(
                        StringConst::UnknownEnumVal_TermKind($annotation->getTerm()->getTermKind()->getKey())
                    );
            }
        }
    }

    /**
     * @param  IEdmElement           $element
     * @param  callable              $elementHeaderWriter
     * @param  callable              ...$additionalAttributeWriters
     * @throws NotSupportedException
     */
    private function BeginElement(
        IEdmElement $element,
        callable $elementHeaderWriter,
        callable ...$additionalAttributeWriters
    ) {
        $elementHeaderWriter($element);
        if ($additionalAttributeWriters != null) {
            foreach ($additionalAttributeWriters as $action) {
                $action($element);
            }
        }

        $this->VisitAttributeAnnotations(
            $this->model->getDirectValueAnnotationsManager()->GetDirectValueAnnotations($element)
        );
        $documentation = $this->model->GetAnnotationValue(
            IDocumentation::class,
            $element,
            EdmConstants::DocumentationUri,
            EdmConstants::DocumentationAnnotation
        );
        if ($documentation != null) {
            assert($documentation instanceof IDocumentation);
            $this->ProcessEdmDocumentation($documentation);
        }
    }

    /**
     * @param  IEdmElement           $element
     * @throws NotSupportedException
     */
    private function FinishElement(IEdmElement $element): void
    {
        $this->VisitPrimitiveElementAnnotations(
            $this->model->getDirectValueAnnotationsManager()->GetDirectValueAnnotations($element)
        );
        $vocabularyAnnotatableElement = $element;
        if ($vocabularyAnnotatableElement instanceof IVocabularyAnnotatable) {
            $self = $this;
            $this->VisitElementVocabularyAnnotations(
                array_filter(
                    $this->model->findDeclaredVocabularyAnnotations($vocabularyAnnotatableElement),
                    function (IVocabularyAnnotation $a) use ($self) {
                        return $a->IsInline($self->model);
                    }
                )
            );
        }

        $this->schemaWriter->WriteEndElement();
    }

    private function ProcessEdmDocumentation(IDocumentation $element): void
    {
        $this->schemaWriter->WriteDocumentationElement($element);
    }

    private function SharesAssociation(INavigationProperty $thisNavprop, INavigationProperty $thatNavprop): bool
    {
        if ($thisNavprop === $thatNavprop) {
            return true;
        }

        if ($this->model->GetAssociationName($thisNavprop) != $this->model->GetAssociationName($thatNavprop)) {
            return false;
        }

        $thisPrimary = $thisNavprop->GetPrimary();
        $thatPrimary = $thatNavprop->GetPrimary();
        if (!$this->SharesEnd($thisPrimary, $thatPrimary)) {
            return false;
        }

        $thisDependent = $thisPrimary->getPartner();
        $thatDependent = $thatPrimary->getPartner();
        if (!$this->SharesEnd($thisDependent, $thatDependent)) {
            return false;
        }
        $thisDeclaringType = $thisPrimary->getDeclaringType();
        $thatDeclaringType = $thisPrimary->getDeclaringType();
        assert($thisDeclaringType instanceof IEntityType);
        assert($thatDeclaringType instanceof IEntityType);
        $thisPrincipalProperties = $thisDeclaringType->Key();
        $thatPrincipalProperties = $thatDeclaringType->Key();
        if (!$this->SharesReferentialConstraintEnd($thisPrincipalProperties, $thatPrincipalProperties)) {
            return false;
        }

        $thisDependentProperties = $thisDependent->getDependentProperties();
        $thatDependentProperties = $thisDependent->getDependentProperties();
        if ($thisDependentProperties != null &&
            $thatDependentProperties != null &&
            !$this->SharesReferentialConstraintEnd($thisDependentProperties, $thatDependentProperties)) {
            return false;
        }

        $thisAssociationAnnotations =[];
        $thisEnd1Annotations        = [];
        $thisEnd2Annotations        =[];
        $thisConstraintAnnotations  =[];
        $this->model->GetAssociationAnnotations(
            $thisPrimary,
            $thisAssociationAnnotations,
            $thisEnd1Annotations,
            $thisEnd2Annotations,
            $thisConstraintAnnotations
        );

        $thatAssociationAnnotations = [];
        $thatEnd1Annotations        = [];
        $thatEnd2Annotations        = [];
        $thatConstraintAnnotations  =[];
        $this->model->GetAssociationAnnotations(
            $thatPrimary,
            $thatAssociationAnnotations,
            $thatEnd1Annotations,
            $thatEnd2Annotations,
            $thatConstraintAnnotations
        );

        if (!($thisAssociationAnnotations == $thatAssociationAnnotations &&
            $thisEnd1Annotations == $thatEnd1Annotations &&
            $thisEnd2Annotations == $thatEnd2Annotations &&
            $thisConstraintAnnotations == $thatConstraintAnnotations)) {
            return false;
        }

        return true;
    }

    private function SharesEnd(INavigationProperty $end1, INavigationProperty $end2): bool
    {
        $end1DeclaringType = $end1->getDeclaringType();
        $end2DeclaringType = $end2->getDeclaringType();
        assert($end1DeclaringType instanceof IEntityType);
        assert($end2DeclaringType instanceof IEntityType);
        if (!($end1DeclaringType->FullName() == $end2DeclaringType->FullName() &&
            $this->model->GetAssociationEndName($end1) == $this->model->GetAssociationEndName($end2) &&
            $end1->Multiplicity()->equals($end2->Multiplicity()) &&
            $end1->getOnDelete()->equals($end2->getOnDelete()))) {
            return false;
        }

        return true;
    }

    /**
     * @param  array|IStructuralProperty[] $theseProperties
     * @param  array|IStructuralProperty[] $thoseProperties
     * @return bool
     */
    private function SharesReferentialConstraintEnd(array $theseProperties, array $thoseProperties): bool
    {
        $numProp   = count($theseProperties);
        if ($numProp != count($thoseProperties)) {
            return false;
        }
        $theseKeys = array_keys($theseProperties);
        $thoseKeys = array_keys($thoseProperties);

        for ($i = 0; $i < $numProp; $i++) {
            $these = $theseProperties[$theseKeys[$i]];
            $those = $thoseProperties[$thoseKeys[$i]];
            if ($these->getName() != $those->getName()) {
                return false;
            }
        }

        return true;
    }

    private function SharesAssociationSet(
        IEntitySet $thisEntitySet,
        INavigationProperty $thisNavprop,
        IEntitySet $thatEntitySet,
        INavigationProperty $thatNavprop
    ): bool {
        if ($thisEntitySet === $thatEntitySet && $thisNavprop === $thatNavprop) {
            return true;
        }

        // Association Set
        if (!($this->model->GetAssociationSetName($thisEntitySet, $thisNavprop) ==
              $this->model->GetAssociationSetName($thatEntitySet, $thatNavprop) &&
            $this->model->GetAssociationFullName($thisNavprop) == $this->model->GetAssociationFullName($thatNavprop))) {
            return false;
        }

        // End 1
        if (!($this->model->GetAssociationEndName($thisNavprop) == $this->model->GetAssociationEndName($thatNavprop) &&
            $thisEntitySet->getName() == $thatEntitySet->getName())) {
            return false;
        }

        // End 2
        $thisOtherEntitySet = $thisEntitySet->findNavigationTarget($thisNavprop);
        $thatOtherEntitySet = $thatEntitySet->findNavigationTarget($thatNavprop);

        $nullityMismatch    = (null === $thisOtherEntitySet) !== (null === $thatOtherEntitySet);
        if ($nullityMismatch) {
            return false;
        }

        if (null !== $thisOtherEntitySet) {
            if (!($this->model->GetAssociationEndName($thisNavprop->getPartner()) ==
                  $this->model->GetAssociationEndName($thatNavprop->getPartner()) &&
                  $thisOtherEntitySet->getName() == $thatOtherEntitySet->getName())) {
                return false;
            }
        }

        // Annotations
        $thisAssociationSetAnnotations = [];
        $thisEnd1Annotations           = [];
        $thisEnd2Annotations           = [];
        $this->model->GetAssociationSetAnnotations(
            $thisEntitySet,
            $thisNavprop,
            $thisAssociationSetAnnotations,
            $thisEnd1Annotations,
            $thisEnd2Annotations
        );

        $thatAssociationSetAnnotations = [];
        $thatEnd1Annotations           =[];
        $thatEnd2Annotations           =[];
        $this->model->GetAssociationSetAnnotations(
            $thatEntitySet,
            $thatNavprop,
            $thatAssociationSetAnnotations,
            $thatEnd1Annotations,
            $thatEnd2Annotations
        );

        if (!($thisAssociationSetAnnotations == $thatAssociationSetAnnotations &&
            $thisEnd1Annotations == $thatEnd1Annotations &&
            $thisEnd2Annotations == $thatEnd2Annotations)) {
            return false;
        }

        return true;
    }
}
