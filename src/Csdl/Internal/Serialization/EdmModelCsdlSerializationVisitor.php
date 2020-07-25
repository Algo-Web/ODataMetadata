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
     * @var INavigationProperty[]
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
        $this->namespaceAliasMappings = $model->getNamespaceAliases();
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
    public function visitEdmSchema(EdmSchema $element, array $mappings): void
    {
        $alias = null;
        if ($this->namespaceAliasMappings != null) {
            $alias = array_key_exists($element->getNamespace(), $this->namespaceAliasMappings) ?
                $this->namespaceAliasMappings[$element->getNamespace()] :
                null;
        }

        $this->schemaWriter->writeSchemaElementHeader($element, $alias, $mappings);
        foreach ($element->getUsedNamespaces() as $usingNamespace) {
            if ($usingNamespace != $element->getUsedNamespaces()) {
                if ($this->namespaceAliasMappings != null &&
                    array_key_exists($usingNamespace, $this->namespaceAliasMappings)) {
                    $this->schemaWriter->writeNamespaceUsingElement(
                        $usingNamespace,
                        $this->namespaceAliasMappings[$usingNamespace]
                    );
                }
            }
        }

        $this->visitSchemaElements($element->getSchemaElements());
        foreach ($element->getAssociationNavigationProperties() as $navigationProperty) {
            $associationName = $this->model->getAssociationFullName($navigationProperty);
            if (!array_key_exists($associationName, $this->associations)) {
                $handledNavigationProperties          = [];
                $this->associations[$associationName] = $handledNavigationProperties;
            }
            $self   = $this;
            $shared = array_filter(
                $this->associations[$associationName],
                function (INavigationProperty $np) use ($self, $navigationProperty) {
                    return $self->sharesAssociation($np, $navigationProperty);
                }
            );
            // This prevents us from losing associations if they share the same name.
            if (!count($shared) > 0) {
                $this->associations[$associationName][] = $navigationProperty;
                $this->associations[$associationName][] = $navigationProperty->getPartner();
                $this->processAssociation($navigationProperty);
            }
        }

        // EntityContainers are excluded from the EdmSchema.SchemaElements property so they can be forced to the end.
        $this->visitCollection($element->getEntityContainers(), [$this, 'processEntityContainer']);
        foreach ($element->getAnnotations() as $annotationsForTargetKey => $annotationsForTarget) {
            $this->schemaWriter->writeAnnotationsElementHeader($annotationsForTargetKey);
            $this->visitVocabularyAnnotations($annotationsForTarget);
            $this->schemaWriter->writeEndElement();
        }

        $this->schemaWriter->writeEndElement();
    }

    /**
     * @param  IEntityContainer      $element
     * @throws \ReflectionException
     * @throws NotSupportedException
     */
    protected function processEntityContainer(IEntityContainer $element): void
    {
        $this->beginElement($element, [$this->schemaWriter, 'writeEntityContainerElementHeader']);
        parent::processEntityContainer($element);

        /** @var IEntitySet $entitySet */
        foreach ($element->entitySets() as $entitySet) {
            foreach ($entitySet->getNavigationTargets() as $mapping) {
                $associationSetName = $this->model->getAssociationFullName($mapping->getNavigationProperty());
                if (!isset($this->associationSets[$associationSetName])) {
                    $handledAssociationSets                     = [];
                    $this->associationSets[$associationSetName] = $handledAssociationSets;
                }
                $self = $this;
                $any  = array_filter(
                    $this->associationSets[$associationSetName],
                    function (Tuple $set) use ($self, $entitySet, $mapping) {
                        return $self->sharesAssociationSet(
                            $set->getItem1(),
                            $set->getItem2(),
                            $entitySet,
                            $mapping->getNavigationProperty()
                        );
                    }
                );
                // This prevents us from losing association sets if they share the same name.
                if (!count($any) > 0) {
                    $this->associationSets[$associationSetName][] =
                        new Tuple($entitySet, $mapping->getNavigationProperty());
                    $this->associationSets[$associationSetName][] =
                        new Tuple($mapping->getTargetEntitySet(), $mapping->getNavigationProperty()->getPartner());

                    $this->processAssociationSet($entitySet, $mapping->getNavigationProperty());
                }
            }
        }

        $this->associationSets = [];

        $this->finishElement($element);
    }

    /**
     * @param  IEntitySet            $element
     * @throws NotSupportedException
     */
    protected function processEntitySet(IEntitySet $element): void
    {
        $this->beginElement($element, [$this->schemaWriter, 'writeEntitySetElementHeader']);
        parent::processEntitySet($element);
        $this->finishElement($element);
    }

    /**
     * @param  IEntityType           $element
     * @throws NotSupportedException
     * @throws \ReflectionException
     */
    protected function processEntityType(IEntityType $element): void
    {
        $this->beginElement($element, [$this->schemaWriter, 'writeEntityTypeElementHeader']);
        if (null !== $element->getDeclaredKey() &&
            count($element->getDeclaredKey()) > 0 &&
            null === $element->getBaseType()) {
            $this->visitEntityTypeDeclaredKey($element->getDeclaredKey());
        }

        $this->visitProperties($element->declaredStructuralProperties());
        $this->visitProperties($element->declaredNavigationProperties());
        $this->finishElement($element);
    }

    /**
     * @param  IStructuralProperty   $element
     * @throws NotSupportedException
     */
    protected function processStructuralProperty(IStructuralProperty $element): void
    {
        EdmUtil::checkArgumentNull($element->getType(), 'element->getType');
        $inlineType = self::isInlineType($element->getType());
        $this->beginElement($element, function (IStructuralProperty $t) use ($inlineType) {
            $this->schemaWriter->writeStructuralPropertyElementHeader($t, $inlineType);
        }, function (IStructuralProperty $e) use ($inlineType) {
            EdmUtil::checkArgumentNull($e->getType(), 'e->getType');
            $this->processFacets($e->getType(), $inlineType);
        });
        if (!$inlineType) {
            $this->visitTypeReference($element->getType());
        }

        $this->finishElement($element);
    }

    /**
     * @param  IBinaryTypeReference $element
     * @throws \ReflectionException
     */
    protected function processBinaryTypeReference(IBinaryTypeReference $element): void
    {
        $this->schemaWriter->writeBinaryTypeAttributes($element);
    }

    /**
     * @param  IDecimalTypeReference $element
     * @throws \ReflectionException
     */
    protected function processDecimalTypeReference(IDecimalTypeReference $element): void
    {
        $this->schemaWriter->writeDecimalTypeAttributes($element);
    }

    /**
     * @param  ISpatialTypeReference $element
     * @throws \ReflectionException
     */
    protected function processSpatialTypeReference(ISpatialTypeReference $element): void
    {
        $this->schemaWriter->writeSpatialTypeAttributes($element);
    }

    /**
     * @param  IStringTypeReference $element
     * @throws \ReflectionException
     */
    protected function processStringTypeReference(IStringTypeReference $element): void
    {
        $this->schemaWriter->writeStringTypeAttributes($element);
    }

    /**
     * @param  ITemporalTypeReference $element
     * @throws \ReflectionException
     */
    protected function processTemporalTypeReference(ITemporalTypeReference $element): void
    {
        $this->schemaWriter->writeTemporalTypeAttributes($element);
    }

    /**
     * @param  INavigationProperty   $element
     * @throws NotSupportedException
     */
    protected function processNavigationProperty(INavigationProperty $element): void
    {
        $this->beginElement($element, [$this->schemaWriter, 'writeNavigationPropertyElementHeader']);
        $this->finishElement($element);
        $this->navigationProperties[] = $element;
    }

    /**
     * @param  IComplexType          $element
     * @throws NotSupportedException
     */
    protected function processComplexType(IComplexType $element): void
    {
        $this->beginElement($element, [$this->schemaWriter, 'writeComplexTypeElementHeader']);
        parent::processComplexType($element);
        $this->finishElement($element);
    }

    /**
     * @param  IEnumType             $element
     * @throws NotSupportedException
     */
    protected function processEnumType(IEnumType $element): void
    {
        $this->beginElement($element, [$this->schemaWriter, 'writeEnumTypeElementHeader']);
        parent::processEnumType($element);
        $this->finishElement($element);
    }

    /**
     * @param  IEnumMember           $element
     * @throws NotSupportedException
     */
    protected function processEnumMember(IEnumMember $element): void
    {
        $this->beginElement($element, [$this->schemaWriter, 'writeEnumMemberElementHeader']);
        $this->finishElement($element);
    }

    /**
     * @param  IValueTerm            $term
     * @throws NotSupportedException
     */
    protected function processValueTerm(IValueTerm $term): void
    {
        $inlineType = null !== $term->getType() && self::isInlineType($term->getType());
        $this->beginElement($term, function (IValueTerm $t) use ($inlineType) {
            $this->schemaWriter->writeValueTermElementHeader($t, $inlineType);
        }, function (IValueTerm $e) use ($inlineType) {
            EdmUtil::checkArgumentNull($e->getType(), 'e->getType');
            $this->processFacets($e->getType(), $inlineType);
        });
        if (!$inlineType) {
            if (null !== $term->getType()) {
                $this->visitTypeReference($term->getType());
            }
        }

        $this->finishElement($term);
    }

    /**
     * @param  IFunction             $element
     * @throws NotSupportedException
     */
    protected function processFunction(IFunction $element): void
    {
        if (null !== $element->getReturnType()) {
            $inlineReturnType = self::isInlineType($element->getReturnType());
            $this->beginElement($element, function (IFunction $f) use ($inlineReturnType) {
                $this->schemaWriter->writeFunctionElementHeader($f, $inlineReturnType);
            }, function (IFunction $f) use ($inlineReturnType) {
                EdmUtil::checkArgumentNull($f->getReturnType(), 'f->getReturnType');
                $this->processFacets($f->getReturnType(), $inlineReturnType);
            });
            if (!$inlineReturnType) {
                $this->schemaWriter->writeReturnTypeElementHeader();
                $this->visitTypeReference($element->getReturnType());
                $this->schemaWriter->writeEndElement();
            }
        } else {
            $this->beginElement($element, function (IFunction $t) {
                $this->schemaWriter->writeFunctionElementHeader($t, false /*Inline ReturnType*/);
            });
        }

        if (null !== $element->getDefiningExpression()) {
            $this->schemaWriter->writeDefiningExpressionElement($element->getDefiningExpression());
        }

        $this->visitFunctionParameters($element->getParameters());
        $this->finishElement($element);
    }

    /**
     * @param  IFunctionParameter    $element
     * @throws NotSupportedException
     */
    protected function processFunctionParameter(IFunctionParameter $element): void
    {
        $inlineType = self::isInlineType($element->getType());
        $this->beginElement(
            $element,
            function (IFunctionParameter $t) use ($inlineType) {
                $this->schemaWriter->writeFunctionParameterElementHeader($t, $inlineType);
            },
            function (IFunctionParameter $e) use ($inlineType) {
                $this->processFacets($e->getType(), $inlineType);
            }
        );
        if (!$inlineType) {
            $this->visitTypeReference($element->getType());
        }

        $this->finishElement($element);
    }

    /**
     * @param  ICollectionType       $element
     * @throws NotSupportedException
     */
    protected function processCollectionType(ICollectionType $element): void
    {
        EdmUtil::checkArgumentNull($element->getElementType(), 'element->getElementType');
        $inlineType = self::isInlineType($element->getElementType());
        $this->beginElement(
            $element,
            function (ICollectionType $t) use ($inlineType) {
                $this->schemaWriter->writeCollectionTypeElementHeader($t, $inlineType);
            },
            function (ICollectionType $e) use ($inlineType) {
                EdmUtil::checkArgumentNull($e->getElementType(), 'e->getElementType');
                $this->processFacets($e->getElementType(), $inlineType);
            }
        );
        if (!$inlineType) {
            $this->visitTypeReference($element->getElementType());
        }

        $this->finishElement($element);
    }

    protected function processRowType(IRowType $element): void
    {
        $this->schemaWriter->writeRowTypeElementHeader();
        parent::processRowType($element);
        $this->schemaWriter->writeEndElement();
    }

    /**
     * @param  IFunctionImport       $functionImport
     * @throws NotSupportedException
     */
    protected function processFunctionImport(IFunctionImport $functionImport): void
    {
        if (null !== $functionImport->getReturnType() && !self::isInlineType($functionImport->getReturnType())) {
            throw new InvalidOperationException(
                StringConst::Serializer_NonInlineFunctionImportReturnType(
                    $functionImport->getContainer()->fullName() . '/' . $functionImport->getName()
                )
            );
        }

        $this->beginElement($functionImport, [$this->schemaWriter, 'writeFunctionImportElementHeader']);
        $this->visitFunctionParameters($functionImport->getParameters());
        $this->finishElement($functionImport);
    }

    #region Vocabulary Annotations

    /**
     * @param  IValueAnnotation      $annotation
     * @throws NotSupportedException
     */
    protected function processValueAnnotation(IValueAnnotation $annotation): void
    {
        $isInline = self::isInlineExpression($annotation->getValue());
        $this->beginElement($annotation, function ($t) use ($isInline) {
            $this->schemaWriter->writeValueAnnotationElementHeader($t, $isInline);
        });
        if (!$isInline) {
            parent::processValueAnnotation($annotation);
        }

        $this->finishElement($annotation);
    }

    /**
     * @param  ITypeAnnotation       $annotation
     * @throws NotSupportedException
     */
    protected function processTypeAnnotation(ITypeAnnotation $annotation): void
    {
        $this->beginElement($annotation, [$this->schemaWriter, 'writeTypeAnnotationElementHeader']);
        parent::processTypeAnnotation($annotation);
        $this->finishElement($annotation);
    }

    /**
     * @param  IPropertyValueBinding $binding
     * @throws NotSupportedException
     */
    protected function processPropertyValueBinding(IPropertyValueBinding $binding): void
    {
        $isInline = self::isInlineExpression($binding->getValue());
        $this->beginElement($binding, function ($t) use ($isInline) {
            $this->schemaWriter->writePropertyValueElementHeader($t, $isInline);
        });
        if (!$isInline) {
            parent::processPropertyValueBinding($binding);
        }

        $this->finishElement($binding);
    }

    #endregion

    #region Expressions

    protected function processStringConstantExpression(IStringConstantExpression $expression): void
    {
        $this->schemaWriter->writeStringConstantExpressionElement($expression);
    }

    protected function processBinaryConstantExpression(IBinaryConstantExpression $expression): void
    {
        $this->schemaWriter->writeBinaryConstantExpressionElement($expression);
    }

    /**
     * @param  IRecordExpression     $expression
     * @throws NotSupportedException
     */
    protected function processRecordExpression(IRecordExpression $expression): void
    {
        $this->beginElement($expression, [$this->schemaWriter, 'writeRecordExpressionElementHeader']);
        $this->visitPropertyConstructors($expression->getProperties());
        $this->finishElement($expression);
    }

    /**
     * @param  ILabeledExpression    $element
     * @throws NotSupportedException
     */
    protected function processLabeledExpression(ILabeledExpression $element): void
    {
        if (null === $element->getName()) {
            parent::processLabeledExpression($element);
        } else {
            $this->beginElement($element, [$this->schemaWriter, 'writeLabeledElementHeader']);
            parent::processLabeledExpression($element);
            $this->finishElement($element);
        }
    }

    /**
     * @param  IPropertyConstructor  $constructor
     * @throws NotSupportedException
     */
    protected function processPropertyConstructor(IPropertyConstructor $constructor): void
    {
        EdmUtil::checkArgumentNull($constructor->getValue(), 'constructor->getValue');
        $isInline = self::isInlineExpression($constructor->getValue());
        $this->beginElement($constructor, function ($t) use ($isInline) {
            $this->schemaWriter->writePropertyConstructorElementHeader($t, $isInline);
        });
        if (!$isInline) {
            parent::processPropertyConstructor($constructor);
        }

        $this->finishElement($constructor);
    }

    /**
     * @param  IPropertyReferenceExpression $expression
     * @throws NotSupportedException
     */
    protected function processPropertyReferenceExpression(IPropertyReferenceExpression $expression): void
    {
        $this->beginElement($expression, [$this->schemaWriter, 'writePropertyReferenceExpressionElementHeader']);
        if ($expression->getBase()!= null) {
            $this->visitExpression($expression->getBase());
        }

        $this->finishElement($expression);
    }

    /**
     * @param IPathExpression $expression
     */
    protected function processPathExpression(IPathExpression $expression): void
    {
        $this->schemaWriter->writePathExpressionElement($expression);
    }

    /**
     * @param  IParameterReferenceExpression $expression
     * @throws \ReflectionException
     */
    protected function processParameterReferenceExpression(IParameterReferenceExpression $expression): void
    {
        $this->schemaWriter->writeParameterReferenceExpressionElement($expression);
    }

    /**
     * @param  ICollectionExpression $expression
     * @throws NotSupportedException
     */
    protected function processCollectionExpression(ICollectionExpression $expression): void
    {
        $this->beginElement($expression, [$this->schemaWriter, 'writeCollectionExpressionElementHeader']);
        $this->visitExpressions($expression->getElements());
        $this->finishElement($expression);
    }

    /**
     * @param  IIsTypeExpression     $expression
     * @throws NotSupportedException
     */
    protected function processIsTypeExpression(IIsTypeExpression $expression): void
    {
        $inlineType = self::isInlineType($expression->getType());
        $this->beginElement($expression, function (IIsTypeExpression $t) use ($inlineType) {
            $this->schemaWriter->writeIsTypeExpressionElementHeader($t, $inlineType);
        }, function (IIsTypeExpression $e) use ($inlineType) {
            $this->processFacets($e->getType(), $inlineType);
        });
        if (!$inlineType) {
            $this->visitTypeReference($expression->getType());
        }

        $this->visitExpression($expression->getOperand());
        $this->finishElement($expression);
    }

    protected function processIntegerConstantExpression(IIntegerConstantExpression $expression): void
    {
        $this->schemaWriter->writeIntegerConstantExpressionElement($expression);
    }

    /**
     * @param  IIfExpression         $expression
     * @throws NotSupportedException
     */
    protected function processIfExpression(IIfExpression $expression): void
    {
        $this->beginElement($expression, [$this->schemaWriter, 'writeIfExpressionElementHeader']);
        parent::processIfExpression($expression);
        $this->finishElement($expression);
    }

    /**
     * @param  IFunctionReferenceExpression $expression
     * @throws \ReflectionException
     */
    protected function processFunctionReferenceExpression(IFunctionReferenceExpression $expression): void
    {
        $this->schemaWriter->writeFunctionReferenceExpressionElement($expression);
    }

    /**
     * @param  IApplyExpression      $expression
     * @throws NotSupportedException
     */
    protected function processFunctionApplicationExpression(IApplyExpression $expression): void
    {
        $isFunction = $expression->getAppliedFunction()->getExpressionKind() == ExpressionKind::FunctionReference();
        $this->beginElement($expression, function ($e) use ($isFunction) {
            $this->schemaWriter->writeFunctionApplicationElementHeader($e, $isFunction);
        });
        if (!$isFunction) {
            EdmUtil::checkArgumentNull($expression->getAppliedFunction(), 'expression->getAppliedFunction');
            $this->visitExpression($expression->getAppliedFunction());
        }

        $this->visitExpressions($expression->getArguments());
        $this->finishElement($expression);
    }

    protected function processFloatingConstantExpression(IFloatingConstantExpression $expression): void
    {
        $this->schemaWriter->writeFloatingConstantExpressionElement($expression);
    }

    protected function processGuidConstantExpression(IGuidConstantExpression $expression): void
    {
        $this->schemaWriter->writeGuidConstantExpressionElement($expression);
    }

    /**
     * @param  IEnumMemberReferenceExpression $expression
     * @throws \ReflectionException
     */
    protected function processEnumMemberReferenceExpression(IEnumMemberReferenceExpression $expression): void
    {
        $this->schemaWriter->writeEnumMemberReferenceExpressionElement($expression);
    }

    /**
     * @param  IEntitySetReferenceExpression $expression
     * @throws \ReflectionException
     */
    protected function processEntitySetReferenceExpression(IEntitySetReferenceExpression $expression): void
    {
        $this->schemaWriter->writeEntitySetReferenceExpressionElement($expression);
    }

    protected function processDecimalConstantExpression(IDecimalConstantExpression $expression): void
    {
        $this->schemaWriter->writeDecimalConstantExpressionElement($expression);
    }

    protected function processDateTimeConstantExpression(IDateTimeConstantExpression $expression): void
    {
        $this->schemaWriter->writeDateTimeConstantExpressionElement($expression);
    }

    protected function processDateTimeOffsetConstantExpression(IDateTimeOffsetConstantExpression $expression): void
    {
        $this->schemaWriter->writeDateTimeOffsetConstantExpressionElement($expression);
    }

    protected function processBooleanConstantExpression(IBooleanConstantExpression $expression): void
    {
        $this->schemaWriter->writeBooleanConstantExpressionElement($expression);
    }

    protected function processNullConstantExpression(INullExpression $expression): void
    {
        $this->schemaWriter->writeNullConstantExpressionElement($expression);
    }

    /**
     * @param  IAssertTypeExpression $expression
     * @throws NotSupportedException
     */
    protected function processAssertTypeExpression(IAssertTypeExpression $expression): void
    {
        $inlineType = self::isInlineType($expression->getType());
        $this->beginElement($expression, function (IAssertTypeExpression $t) use ($inlineType) {
            $this->schemaWriter->writeAssertTypeExpressionElementHeader($t, $inlineType);
        }, function (IAssertTypeExpression $e) use ($inlineType) {
            $this->processFacets($e->getType(), $inlineType);
        });
        if (!$inlineType) {
            $this->visitTypeReference($expression->getType());
        }

        $this->visitExpression($expression->getOperand());
        $this->finishElement($expression);
    }

    #endregion

    private static function isInlineType(ITypeReference $reference): bool
    {
        if ($reference->getDefinition() instanceof ISchemaElement || $reference->isEntityReference()) {
            return true;
        } elseif ($reference->isCollection()) {
            $def = $reference->asCollection()->collectionDefinition()->getElementType()->getDefinition();
            return $def instanceof ISchemaElement;
        }

        return false;
    }

    private static function isInlineExpression(IExpression $expression): bool
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
    private function processAnnotations(iterable $annotations): void
    {
        $this->visitAttributeAnnotations($annotations);
        foreach ($annotations as $annotation) {
            if ($annotation->getNamespaceUri() == EdmConstants::DocumentationUri &&
                $annotation->getName() == EdmConstants::DocumentationAnnotation) {
                $value = $annotation->getValue();
                assert($value instanceof IDocumentation);
                $this->processEdmDocumentation($value);
            }
        }
    }

    /**
     * @param  INavigationProperty   $element
     * @throws \ReflectionException
     * @throws NotSupportedException
     */
    private function processAssociation(INavigationProperty $element): void
    {
        $end1 = $element->getPrimary();
        $end2 = $end1->getPartner();
        /** @var IDirectValueAnnotation[] $associationAnnotations */
        $associationAnnotations = [];
        /** @var IDirectValueAnnotation[] $end1Annotations */
        $end1Annotations = [];
        /** @var IDirectValueAnnotation[] $end2Annotations */
        $end2Annotations = [];
        /** @var IDirectValueAnnotation[] $constraintAnnotations */
        $constraintAnnotations = [];
        $this->model->getAssociationAnnotations(
            $element,
            $associationAnnotations,
            $end1Annotations,
            $end2Annotations,
            $constraintAnnotations
        );

        $this->schemaWriter->writeAssociationElementHeader($end1);
        $this->processAnnotations($associationAnnotations);

        $this->processAssociationEnd($end1, $end1 === $element ? $end1Annotations : $end2Annotations);
        $this->processAssociationEnd($end2, $end1 === $element ? $end2Annotations : $end1Annotations);
        $this->processReferentialConstraint($end1, $constraintAnnotations);

        $this->visitPrimitiveElementAnnotations($associationAnnotations);
        $this->schemaWriter->writeEndElement();
    }

    /**
     * @param  INavigationProperty               $element
     * @param  iterable|IDirectValueAnnotation[] $annotations
     * @throws \ReflectionException
     * @throws NotSupportedException
     */
    private function processAssociationEnd(INavigationProperty $element, iterable $annotations): void
    {
        $this->schemaWriter->writeAssociationEndElementHeader($element);
        $this->processAnnotations($annotations);

        if ($element->getOnDelete() != OnDeleteAction::None()) {
            $this->schemaWriter->writeOperationActionElement(CsdlConstants::Element_OnDelete, $element->getOnDelete());
        }

        $this->visitPrimitiveElementAnnotations($annotations);
        $this->schemaWriter->writeEndElement();
    }

    /**
     * @param  INavigationProperty               $element
     * @param  iterable|IDirectValueAnnotation[] $annotations
     * @throws \ReflectionException
     * @throws NotSupportedException
     */
    private function processReferentialConstraint(INavigationProperty $element, iterable $annotations): void
    {
        if ($element->getDependentProperties() !== null) {
            $principalElement = $element->getPartner();
        } elseif ($element->getPartner()->getDependentProperties() !== null) {
            $principalElement = $element;
        } else {
            return;
        }

        $this->schemaWriter->writeReferentialConstraintElementHeader($principalElement);
        $this->processAnnotations($annotations);
        $this->schemaWriter->writeReferentialConstraintPrincipalEndElementHeader($principalElement);
        $dType = $principalElement->getDeclaringType();
        assert($dType instanceof IEntityType);
        EdmUtil::checkArgumentNull($dType->key(), 'principalElement->getDeclaringType->Key');
        $this->visitPropertyRefs($dType->key());
        $this->schemaWriter->writeEndElement();
        $this->schemaWriter->writeReferentialConstraintDependentEndElementHeader($principalElement->getPartner());
        EdmUtil::checkArgumentNull(
            $principalElement->getPartner()->getDependentProperties(),
            'principalElement->getPartner->getDependentProperties'
        );
        $this->visitPropertyRefs($principalElement->getPartner()->getDependentProperties());
        $this->schemaWriter->writeEndElement();
        $this->visitPrimitiveElementAnnotations($annotations);
        $this->schemaWriter->writeEndElement();
    }

    /**
     * @param  IEntitySet            $entitySet
     * @param  INavigationProperty   $property
     * @throws \ReflectionException
     * @throws NotSupportedException
     */
    private function processAssociationSet(IEntitySet $entitySet, INavigationProperty $property): void
    {
        /** @var IDirectValueAnnotation[] $associationSetAnnotations */
        $associationSetAnnotations = [];
        /** @var IDirectValueAnnotation[] $end1Annotations */
        $end1Annotations = [];
        /** @var IDirectValueAnnotation[] $end2Annotations */
        $end2Annotations = [];
        $this->model->getAssociationSetAnnotations(
            $entitySet,
            $property,
            $associationSetAnnotations,
            $end1Annotations,
            $end2Annotations
        );

        $this->schemaWriter->writeAssociationSetElementHeader($entitySet, $property);
        $this->processAnnotations($associationSetAnnotations);

        $this->processAssociationSetEnd($entitySet, $property, $end1Annotations);

        $otherEntitySet = $entitySet->findNavigationTarget($property);
        if ($otherEntitySet != null) {
            $this->processAssociationSetEnd($otherEntitySet, $property->getPartner(), $end2Annotations);
        }

        $this->visitPrimitiveElementAnnotations($associationSetAnnotations);
        $this->schemaWriter->writeEndElement();
    }

    /**
     * @param  IEntitySet                        $entitySet
     * @param  INavigationProperty               $property
     * @param  iterable|IDirectValueAnnotation[] $annotations
     * @throws \ReflectionException
     * @throws NotSupportedException
     */
    private function processAssociationSetEnd(
        IEntitySet $entitySet,
        INavigationProperty $property,
        iterable $annotations
    ): void {
        $this->schemaWriter->writeAssociationSetEndElementHeader($entitySet, $property);
        $this->processAnnotations($annotations);
        $this->visitPrimitiveElementAnnotations($annotations);
        $this->schemaWriter->writeEndElement();
    }

    /**
     * @param  ITypeReference       $element
     * @param  bool                 $inlineType
     * @throws \ReflectionException
     */
    private function processFacets(ITypeReference $element, bool $inlineType): void
    {
        if ($element != null) {
            if ($element->isEntityReference()) {
                // No facets get serialized for an entity reference.
                return;
            }

            if ($inlineType) {
                if ($element->typeKind()->isCollection()) {
                    $collectionElement = $element->asCollection();
                    $type              = $collectionElement->collectionDefinition()->getElementType();
                    EdmUtil::checkArgumentNull($type, 'ProcessFacets - $type');
                    $this->schemaWriter->writeNullableAttribute($type);
                    $this->visitTypeReference($type);
                } else {
                    $this->schemaWriter->writeNullableAttribute($element);
                    $this->visitTypeReference($element);
                }
            }
        }
    }

    /**
     * @param  iterable|IStructuralProperty[] $keyProperties
     * @throws \ReflectionException
     */
    private function visitEntityTypeDeclaredKey(iterable $keyProperties): void
    {
        $this->schemaWriter->writeDeclaredKeyPropertiesElementHeader();
        $this->visitPropertyRefs($keyProperties);
        $this->schemaWriter->writeEndElement();
    }

    /**
     * @param  iterable|IStructuralProperty[] $properties
     * @throws \ReflectionException
     */
    private function visitPropertyRefs(iterable $properties): void
    {
        foreach ($properties as $property) {
            $this->schemaWriter->writePropertyRefElement($property);
        }
    }

    /**
     * @param  iterable|IDirectValueAnnotation[] $annotations
     * @throws NotSupportedException
     */
    private function visitAttributeAnnotations(iterable $annotations): void
    {
        foreach ($annotations as $annotation) {
            if ($annotation->getNamespaceUri() != EdmConstants::InternalUri) {
                $edmValue = $annotation->getValue();
                if ($edmValue instanceof IValue) {
                    if (!$edmValue->isSerializedAsElement($this->model)) {
                        if ($edmValue->getType()->typeKind()->isPrimitive()) {
                            $this->processAttributeAnnotation($annotation);
                        }
                    }
                }
            }
        }
    }
    /**
     * @param iterable|IDirectValueAnnotation[] $annotations
     */
    private function visitPrimitiveElementAnnotations(iterable $annotations): void
    {
        foreach ($annotations as $annotation) {
            if ($annotation->getNamespaceUri() != EdmConstants::InternalUri) {
                $edmValue = $annotation->getValue();
                if ($edmValue instanceof IValue) {
                    if (!$edmValue->isSerializedAsElement($this->model)) {
                        if ($edmValue->getType()->typeKind()->isPrimitive()) {
                            $this->processElementAnnotation($annotation);
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
    private function processAttributeAnnotation(IDirectValueAnnotation $annotation): void
    {
        $this->schemaWriter->writeAnnotationStringAttribute($annotation);
    }

    /**
     * @param IDirectValueAnnotation $annotation
     */
    private function processElementAnnotation(IDirectValueAnnotation $annotation): void
    {
        $this->schemaWriter->writeAnnotationStringElement($annotation);
    }

    /**
     * @param  iterable|IVocabularyAnnotation[] $annotations
     * @throws NotSupportedException
     */
    private function visitElementVocabularyAnnotations(iterable $annotations): void
    {
        foreach ($annotations as $annotation) {
            switch ($annotation->getTerm()->getTermKind()) {
                case TermKind::Type():
                    assert($annotation instanceof  ITypeAnnotation);
                    $this->processTypeAnnotation($annotation);
                    break;
                case TermKind::Value():
                    assert($annotation instanceof  IValueAnnotation);

                    $this->processValueAnnotation($annotation);
                    break;
                case TermKind::None():
                    $this->processVocabularyAnnotation($annotation);
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
    private function beginElement(
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

        $this->visitAttributeAnnotations(
            $this->model->getDirectValueAnnotationsManager()->getDirectValueAnnotations($element)
        );
        $documentation = $this->model->getAnnotationValue(
            IDocumentation::class,
            $element,
            EdmConstants::DocumentationUri,
            EdmConstants::DocumentationAnnotation
        );
        if ($documentation != null) {
            assert($documentation instanceof IDocumentation);
            $this->processEdmDocumentation($documentation);
        }
    }

    /**
     * @param  IEdmElement           $element
     * @throws NotSupportedException
     */
    private function finishElement(IEdmElement $element): void
    {
        $this->visitPrimitiveElementAnnotations(
            $this->model->getDirectValueAnnotationsManager()->getDirectValueAnnotations($element)
        );
        $vocabularyAnnotatableElement = $element;
        if ($vocabularyAnnotatableElement instanceof IVocabularyAnnotatable) {
            $self = $this;
            $this->visitElementVocabularyAnnotations(
                array_filter(
                    $this->model->findDeclaredVocabularyAnnotations($vocabularyAnnotatableElement),
                    function (IVocabularyAnnotation $a) use ($self) {
                        return $a->isInline($self->model);
                    }
                )
            );
        }

        $this->schemaWriter->writeEndElement();
    }

    private function processEdmDocumentation(IDocumentation $element): void
    {
        $this->schemaWriter->writeDocumentationElement($element);
    }

    private function sharesAssociation(INavigationProperty $thisNavprop, INavigationProperty $thatNavprop): bool
    {
        if ($thisNavprop === $thatNavprop) {
            return true;
        }

        if ($this->model->getAssociationName($thisNavprop) != $this->model->getAssociationName($thatNavprop)) {
            return false;
        }

        $thisPrimary = $thisNavprop->getPrimary();
        $thatPrimary = $thatNavprop->getPrimary();
        if (!$this->sharesEnd($thisPrimary, $thatPrimary)) {
            return false;
        }

        $thisDependent = $thisPrimary->getPartner();
        $thatDependent = $thatPrimary->getPartner();
        if (!$this->sharesEnd($thisDependent, $thatDependent)) {
            return false;
        }
        $thisDeclaringType = $thisPrimary->getDeclaringType();
        $thatDeclaringType = $thisPrimary->getDeclaringType();
        assert($thisDeclaringType instanceof IEntityType);
        assert($thatDeclaringType instanceof IEntityType);
        $thisPrincipalProperties = $thisDeclaringType->key();
        $thatPrincipalProperties = $thatDeclaringType->key();
        if (!$this->sharesReferentialConstraintEnd($thisPrincipalProperties, $thatPrincipalProperties)) {
            return false;
        }

        $thisDependentProperties = $thisDependent->getDependentProperties();
        $thatDependentProperties = $thisDependent->getDependentProperties();
        if ($thisDependentProperties != null &&
            $thatDependentProperties != null &&
            !$this->sharesReferentialConstraintEnd($thisDependentProperties, $thatDependentProperties)) {
            return false;
        }

        $thisAssociationAnnotations =[];
        $thisEnd1Annotations        = [];
        $thisEnd2Annotations        =[];
        $thisConstraintAnnotations  =[];
        $this->model->getAssociationAnnotations(
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
        $this->model->getAssociationAnnotations(
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

    private function sharesEnd(INavigationProperty $end1, INavigationProperty $end2): bool
    {
        $end1DeclaringType = $end1->getDeclaringType();
        $end2DeclaringType = $end2->getDeclaringType();
        assert($end1DeclaringType instanceof IEntityType);
        assert($end2DeclaringType instanceof IEntityType);
        if (!($end1DeclaringType->fullName() == $end2DeclaringType->fullName() &&
              $this->model->getAssociationEndName($end1) == $this->model->getAssociationEndName($end2) &&
              $end1->multiplicity()->equals($end2->multiplicity()) &&
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
    private function sharesReferentialConstraintEnd(?array $theseProperties, ?array $thoseProperties): bool
    {
        if (null === $theseProperties || null === $thoseProperties) {
            return false;
        }
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

    private function sharesAssociationSet(
        IEntitySet $thisEntitySet,
        INavigationProperty $thisNavprop,
        IEntitySet $thatEntitySet,
        INavigationProperty $thatNavprop
    ): bool {
        if ($thisEntitySet === $thatEntitySet && $thisNavprop === $thatNavprop) {
            return true;
        }

        // Association Set
        if (!($this->model->getAssociationSetName($thisEntitySet, $thisNavprop) ==
              $this->model->getAssociationSetName($thatEntitySet, $thatNavprop) &&
              $this->model->getAssociationFullName($thisNavprop) == $this->model->getAssociationFullName($thatNavprop))) {
            return false;
        }

        // End 1
        if (!($this->model->getAssociationEndName($thisNavprop) == $this->model->getAssociationEndName($thatNavprop) &&
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
            if (!($this->model->getAssociationEndName($thisNavprop->getPartner()) ==
                  $this->model->getAssociationEndName($thatNavprop->getPartner()) &&
                  $thisOtherEntitySet->getName() == $thatOtherEntitySet->getName())) {
                return false;
            }
        }

        // Annotations
        $thisAssociationSetAnnotations = [];
        $thisEnd1Annotations           = [];
        $thisEnd2Annotations           = [];
        $this->model->getAssociationSetAnnotations(
            $thisEntitySet,
            $thisNavprop,
            $thisAssociationSetAnnotations,
            $thisEnd1Annotations,
            $thisEnd2Annotations
        );

        $thatAssociationSetAnnotations = [];
        $thatEnd1Annotations           =[];
        $thatEnd2Annotations           =[];
        $this->model->getAssociationSetAnnotations(
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
