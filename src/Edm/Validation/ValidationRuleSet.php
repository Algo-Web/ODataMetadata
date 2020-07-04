<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IApplyExpression\FunctionApplicationExpressionParametersMatchAppliedFunction;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IBinaryTypeReference\BinaryTypeReferenceBinaryMaxLengthNegative;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IBinaryTypeReference\BinaryTypeReferenceBinaryUnboundedNotValidForMaxLength;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ICollectionExpression\CollectionExpressionAllElementsCorrectType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IComplexType\ComplexTypeInvalidAbstractComplexType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IComplexType\ComplexTypeInvalidPolymorphicComplexType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IComplexType\ComplexTypeMustContainProperties;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IDecimalTypeReference\DecimalTypeReferencePrecisionOutOfRange;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IDecimalTypeReference\DecimalTypeReferenceScaleOutOfRange;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IDirectValueAnnotation\DirectValueAnnotationHasXmlSerializableName;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IDirectValueAnnotation\ImmediateValueAnnotationElementAnnotationHasNameAndNamespace;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IDirectValueAnnotation\ImmediateValueAnnotationElementAnnotationIsValid;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEdmElement\ElementDirectValueAnnotationFullNameMustBeUnique;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityContainer\EntityContainerDuplicateEntityContainerMemberName;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityContainerElement\EntityContainerElementMustNotHaveKindOfNone;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityReferenceType\EntityReferenceTypeInaccessibleEntityType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet\EntitySetAssociationSetNameMustBeValid;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet\EntitySetCanOnlyBeContainedByASingleNavigationProperty;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet\EntitySetInaccessibleEntityType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet\EntitySetNavigationMappingMustBeBidirectional;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet\EntitySetNavigationPropertyMappingMustPointToValidTargetForProperty;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet\EntitySetNavigationPropertyMappingsMustBeUnique;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet\EntitySetRecursiveNavigationPropertyMappingsMustPointBackToSourceEntitySet;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet\EntitySetTypeHasNoKeys;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType\EntityTypeDuplicatePropertyNameSpecifiedInEntityKey;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType\EntityTypeEntityKeyMustBeScalar;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType\EntityTypeEntityKeyMustNotBeBinaryBeforeV2;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType\EntityTypeInvalidKeyKeyDefinedInBaseClass;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType\EntityTypeInvalidKeyNullablePart;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType\EntityTypeKeyMissingOnEntityType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType\EntityTypeKeyPropertyMustBelongToEntity;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEnumMember\EnumMemberValueMustHaveSameTypeAsUnderlyingType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEnumType\EnumMustHaveIntegerUnderlyingType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEnumType\EnumTypeEnumMemberNameAlreadyDefined;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEnumType\EnumTypeEnumsNotSupportedBeforeV3;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunction\FunctionOnlyInputParametersAllowedInFunctions;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunction\FunctionsNotSupportedBeforeV2;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionBase\FunctionBaseParameterNameAlreadyDefinedDuplicate;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\ComposableFunctionImportMustHaveReturnType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportBindableFunctionImportMustHaveParameters;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportComposableFunctionImportCannotBeSideEffecting;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportEntitySetExpressionIsInvalid;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportEntityTypeDoesNotMatchEntitySet;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportIsBindableNotSupportedBeforeV3;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportIsComposableNotSupportedBeforeV3;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportIsSideEffectingNotSupportedBeforeV3;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportParametersCannotHaveModeOfNone;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportParametersIncorrectTypeBeforeV3;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportReturnEntitiesButDoesNotSpecifyEntitySet;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportUnsupportedReturnTypeAfterV1;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportUnsupportedReturnTypeV1;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IIfExpression\IfExpressionAssertCorrectTestType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IModel\ModelDuplicateEntityContainerName;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IModel\ModelDuplicateSchemaElementName;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IModel\ModelDuplicateSchemaElementNameBeforeV3;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INamedElement\NamedElementNameIsNotAllowed;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INamedElement\NamedElementNameIsTooLong;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INamedElement\NamedElementNameMustNotBeEmptyOrWhiteSpace;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyAssociationEndNameIsValid;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyAssociationNameIsValid;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyContainsTargetNotSupportedBeforeV3;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyCorrectType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyDependentEndMultiplicity;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyDependentPropertiesMustBelongToDependentEntity;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyDuplicateDependentProperty;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyEndWithManyMultiplicityCannotHaveOperationsSpecified;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyEntityMustNotIndirectlyContainItself;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyInvalidOperationMultipleEndsInAssociation;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyInvalidToPropertyInRelationshipConstraintBeforeV2;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyPrincipalEndMultiplicity;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyTypeMismatchRelationshipConstraint;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyWithNonRecursiveContainmentSourceMustBeFromOne;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyWithRecursiveContainmentSourceMustBeFromZeroOrOne;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyWithRecursiveContainmentTargetMustBeOptional;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IPrimitiveType\PrimitiveTypeMustNotHaveKindOfNone;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IPrimitiveTypeReference\SpatialTypeReferencesNotSupportedBeforeV3;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IPrimitiveTypeReference\StreamTypeReferencesNotSupportedBeforeV3;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IPrimitiveValue\PrimitiveValueValidForType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IProperty\PropertyMustNotHaveKindOfNone;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IPropertyValueBinding\PropertyValueBindingValueIsCorrectType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IRecordExpression\RecordExpressionPropertiesMatchType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IRowType\RowTypeBaseTypeMustBeNull;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IRowType\RowTypeMustContainProperties;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ISchemaElement\SchemaElementMustNotHaveKindOfNone;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ISchemaElement\SchemaElementNamespaceIsNotAllowed;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ISchemaElement\SchemaElementNamespaceIsTooLong;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ISchemaElement\SchemaElementNamespaceMustNotBeEmptyOrWhiteSpace;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ISchemaElement\SchemaElementSystemNamespaceEncountered;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStringTypeReference\StringTypeReferenceStringMaxLengthNegative;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStringTypeReference\StringTypeReferenceStringUnboundedNotValidForMaxLength;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuralProperty\StructuralPropertyInvalidPropertyType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuralProperty\StructuralPropertyInvalidPropertyTypeConcurrencyMode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuralProperty\StructuralPropertyNullableComplexType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType\OnlyEntityTypesCanBeOpen;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType\OpenTypesNotSupported;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType\StructuredTypeBaseTypeMustBeSameKindAsDerivedKind;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType\StructuredTypeInaccessibleBaseType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType\StructuredTypeInvalidMemberNameMatchesTypeName;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType\StructuredTypePropertiesDeclaringTypeMustBeCorrect;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType\StructuredTypePropertyNameAlreadyDefined;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITemporalTypeReference\TemporalTypeReferencePrecisionOutOfRange;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITerm\TermMustNotHaveKindOfNone;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IType\TypeMustNotHaveKindOfNone;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITypeAnnotation\TypeAnnotationAssertMatchesTermType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITypeAnnotation\TypeAnnotationInaccessibleTerm;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITypeReference\TypeReferenceInaccessibleSchemaType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IValueAnnotation\ValueAnnotationAssertCorrectExpressionType;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IValueAnnotation\ValueAnnotationInaccessibleTerm;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IValueTerm\ValueTermsNotSupportedBeforeV3;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IVocabularyAnnotatable\VocabularyAnnotatableNoDuplicateAnnotations;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IVocabularyAnnotation\VocabularyAnnotationInaccessibleTarget;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IVocabularyAnnotation\VocabularyAnnotationsNotSupportedBeforeV3;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Version;
use Traversable;

/**
 * A set of rules to run during validation.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation
 */
class ValidationRuleSet implements \IteratorAggregate
{
    /**
     * @var array<string, ValidationRule[]>
     */
    private $rules = [];

    /**
     * Initializes a new instance of the ValidationRuleSet class.
     *
     * @param iterable|ValidationRule[][] ...$ruleSets Rules to be contained in this ruleset.
     */
    public function __construct(iterable ...$ruleSets)
    {
        $this->rules = [];
        foreach ($ruleSets as $ruleSet) {
            assert(is_iterable($ruleSet));
            foreach ($ruleSet as $rule) {
                assert($rule instanceof ValidationRule);
                $this->AddRule($rule);
            }
        }
    }

    /**
     * Gets the default validation ruleset for the given version.
     *
     * @param  Version           $version $versionOrRuleset the EDM version being validated
     * @return ValidationRuleSet the set of rules to validate that the model conforms to the given version
     */
    public static function getEdmModelRuleSet(Version $version): self
    {
        switch ($version) {
            case Version::v1():
                return self::getV1RuleSet();
            case Version::v1_1():
                return self::getV1_1RuleSet();
            case Version::v1_2():
                return self::getV1_2RuleSet();
            case Version::v2():
                return self::getV2RuleSet();
            case Version::v3():
                return self::getV3RuleSet();
        }
        throw new InvalidOperationException(StringConst::Serializer_UnknownEdmVersion());
    }

    /**
     * @param  string           $type the interfaces or class name for which we are seeking rules
     * @return ValidationRule[]
     */
    public function GetRules(string $type): array
    {
        return $this->rules[$type] ?? [];
    }

    private function AddRule(ValidationRule $rule): void
    {
        $typeName = $rule->getValidatedType();
        if (!isset($this->rules[$typeName])) {
            $this->rules[$typeName] = [];
        }
        if (in_array($rule, $this->rules[$typeName])) {
            throw new InvalidOperationException(StringConst::RuleSet_DuplicateRulesExistInRuleSet());
        }
        $this->rules[$typeName][] = $rule;
    }

    private static function getBaseRuleSet(): self
    {
        return new self([
            new EntityTypeKeyPropertyMustBelongToEntity(),
            new StructuredTypePropertiesDeclaringTypeMustBeCorrect(),
            new NamedElementNameMustNotBeEmptyOrWhiteSpace(),
            new NamedElementNameIsTooLong(),
            new NamedElementNameIsNotAllowed(),
            new SchemaElementNamespaceIsNotAllowed(),
            new SchemaElementNamespaceIsTooLong(),
            new SchemaElementNamespaceMustNotBeEmptyOrWhiteSpace(),
            new SchemaElementSystemNamespaceEncountered(),
            new EntityContainerDuplicateEntityContainerMemberName(),
            new EntityTypeDuplicatePropertyNameSpecifiedInEntityKey(),
            new EntityTypeInvalidKeyNullablePart(),
            new EntityTypeEntityKeyMustBeScalar(),
            new EntityTypeInvalidKeyKeyDefinedInBaseClass(),
            new EntityTypeKeyMissingOnEntityType(),
            new StructuredTypeInvalidMemberNameMatchesTypeName(),
            new StructuredTypePropertyNameAlreadyDefined(),
            new StructuralPropertyInvalidPropertyType(),
            new ComplexTypeInvalidAbstractComplexType(),
            new ComplexTypeInvalidPolymorphicComplexType(),
            new FunctionBaseParameterNameAlreadyDefinedDuplicate(),
            new FunctionImportReturnEntitiesButDoesNotSpecifyEntitySet(),
            new FunctionImportEntityTypeDoesNotMatchEntitySet(),
            new ComposableFunctionImportMustHaveReturnType(),
            new StructuredTypeBaseTypeMustBeSameKindAsDerivedKind(),
            new RowTypeBaseTypeMustBeNull(),
            new NavigationPropertyWithRecursiveContainmentTargetMustBeOptional(),
            new NavigationPropertyWithRecursiveContainmentSourceMustBeFromZeroOrOne(),
            new NavigationPropertyWithNonRecursiveContainmentSourceMustBeFromOne(),
            new EntitySetInaccessibleEntityType(),
            new StructuredTypeInaccessibleBaseType(),
            new EntityReferenceTypeInaccessibleEntityType(),
            new TypeReferenceInaccessibleSchemaType(),
            new EntitySetTypeHasNoKeys(),
            new FunctionOnlyInputParametersAllowedInFunctions(),
            new RowTypeMustContainProperties(),
            new DecimalTypeReferenceScaleOutOfRange(),
            new BinaryTypeReferenceBinaryMaxLengthNegative(),
            new StringTypeReferenceStringMaxLengthNegative(),
            new StructuralPropertyInvalidPropertyTypeConcurrencyMode(),
            new EnumMemberValueMustHaveSameTypeAsUnderlyingType(),
            new EnumTypeEnumMemberNameAlreadyDefined(),
            new FunctionImportBindableFunctionImportMustHaveParameters(),
            new FunctionImportComposableFunctionImportCannotBeSideEffecting(),
            new FunctionImportEntitySetExpressionIsInvalid(),
            new BinaryTypeReferenceBinaryUnboundedNotValidForMaxLength(),
            new StringTypeReferenceStringUnboundedNotValidForMaxLength(),
            new ImmediateValueAnnotationElementAnnotationIsValid(),
            new ValueAnnotationAssertCorrectExpressionType(),
            new IfExpressionAssertCorrectTestType(),
            new CollectionExpressionAllElementsCorrectType(),
            new RecordExpressionPropertiesMatchType(),
            new NavigationPropertyDependentPropertiesMustBelongToDependentEntity(),
            new NavigationPropertyInvalidOperationMultipleEndsInAssociation(),
            new NavigationPropertyEndWithManyMultiplicityCannotHaveOperationsSpecified(),
            new NavigationPropertyTypeMismatchRelationshipConstraint(),
            new NavigationPropertyDuplicateDependentProperty(),
            new NavigationPropertyPrincipalEndMultiplicity(),
            new NavigationPropertyDependentEndMultiplicity(),
            new NavigationPropertyCorrectType(),
            new ImmediateValueAnnotationElementAnnotationHasNameAndNamespace(),
            new FunctionApplicationExpressionParametersMatchAppliedFunction(),
            new VocabularyAnnotatableNoDuplicateAnnotations(),
            new TemporalTypeReferencePrecisionOutOfRange(),
            new DecimalTypeReferencePrecisionOutOfRange(),
            new ModelDuplicateEntityContainerName(),
            new FunctionImportParametersCannotHaveModeOfNone(),
            new TypeMustNotHaveKindOfNone(),
            new PrimitiveTypeMustNotHaveKindOfNone(),
            new PropertyMustNotHaveKindOfNone(),
            new TermMustNotHaveKindOfNone(),
            new SchemaElementMustNotHaveKindOfNone(),
            new EntityContainerElementMustNotHaveKindOfNone(),
            new PrimitiveValueValidForType(),
            new EntitySetCanOnlyBeContainedByASingleNavigationProperty(),
            new EntitySetNavigationMappingMustBeBidirectional(),
            new EntitySetNavigationPropertyMappingsMustBeUnique(),
            new TypeAnnotationAssertMatchesTermType(),
            new TypeAnnotationInaccessibleTerm(),
            new PropertyValueBindingValueIsCorrectType(),
            new EnumMustHaveIntegerUnderlyingType(),
            new ValueAnnotationInaccessibleTerm(),
            new ElementDirectValueAnnotationFullNameMustBeUnique(),
            new VocabularyAnnotationInaccessibleTarget(),
            new ComplexTypeMustContainProperties(),
            new EntitySetAssociationSetNameMustBeValid(),
            new NavigationPropertyAssociationEndNameIsValid(),
            new NavigationPropertyAssociationNameIsValid(),
            new OnlyEntityTypesCanBeOpen(),
            new NavigationPropertyEntityMustNotIndirectlyContainItself(),
            new EntitySetRecursiveNavigationPropertyMappingsMustPointBackToSourceEntitySet(),
            new EntitySetNavigationPropertyMappingMustPointToValidTargetForProperty(),
            new DirectValueAnnotationHasXmlSerializableName()
        ]);
    }

    private static function getV1RuleSet(): self
    {
        return new self(
            self::getBaseRuleSet(),
            [
                new NavigationPropertyInvalidToPropertyInRelationshipConstraintBeforeV2(),
                new FunctionsNotSupportedBeforeV2(),
                new FunctionImportUnsupportedReturnTypeV1(),
                new FunctionImportParametersIncorrectTypeBeforeV3(),
                new FunctionImportIsSideEffectingNotSupportedBeforeV3(),
                new FunctionImportIsComposableNotSupportedBeforeV3(),
                new FunctionImportIsBindableNotSupportedBeforeV3(),
                new EntityTypeEntityKeyMustNotBeBinaryBeforeV2(),
                new EnumTypeEnumsNotSupportedBeforeV3(),
                new NavigationPropertyContainsTargetNotSupportedBeforeV3(),
                new StructuralPropertyNullableComplexType(),
                new ValueTermsNotSupportedBeforeV3(),
                new VocabularyAnnotationsNotSupportedBeforeV3(),
                new OpenTypesNotSupported(),
                new StreamTypeReferencesNotSupportedBeforeV3(),
                new SpatialTypeReferencesNotSupportedBeforeV3(),
                new ModelDuplicateSchemaElementNameBeforeV3(),
            ]
        );
    }

    private static function getV1_1RuleSet(): self
    {
        $filteredBase = [];
        foreach (self::getBaseRuleSet() as $baseRule) {
            if ($baseRule instanceof ComplexTypeInvalidAbstractComplexType ||
                $baseRule instanceof ComplexTypeInvalidPolymorphicComplexType
            ) {
                continue;
            }
            $filteredBase[] = $baseRule;
        }
        return new self(
            $filteredBase,
            [
                new NavigationPropertyInvalidToPropertyInRelationshipConstraintBeforeV2(),
                new FunctionsNotSupportedBeforeV2(),
                new FunctionImportUnsupportedReturnTypeAfterV1(),
                new FunctionImportIsSideEffectingNotSupportedBeforeV3(),
                new FunctionImportIsComposableNotSupportedBeforeV3(),
                new FunctionImportIsBindableNotSupportedBeforeV3(),
                new EntityTypeEntityKeyMustNotBeBinaryBeforeV2(),
                new FunctionImportParametersIncorrectTypeBeforeV3(),
                new EnumTypeEnumsNotSupportedBeforeV3(),
                new NavigationPropertyContainsTargetNotSupportedBeforeV3(),
                new ValueTermsNotSupportedBeforeV3(),
                new VocabularyAnnotationsNotSupportedBeforeV3(),
                new OpenTypesNotSupported(),
                new StreamTypeReferencesNotSupportedBeforeV3(),
                new SpatialTypeReferencesNotSupportedBeforeV3(),
                new ModelDuplicateSchemaElementNameBeforeV3(),
            ]
        );
    }

    private static function getV1_2RuleSet(): self
    {
        $filteredBase = [];
        foreach (self::getBaseRuleSet() as $baseRule) {
            if ($baseRule instanceof ComplexTypeInvalidAbstractComplexType ||
                $baseRule instanceof ComplexTypeInvalidPolymorphicComplexType
            ) {
                continue;
            }
            $filteredBase[] = $baseRule;
        }
        return new self(
            $filteredBase,
            [
                new NavigationPropertyInvalidToPropertyInRelationshipConstraintBeforeV2(),
                new FunctionsNotSupportedBeforeV2(),
                new FunctionImportUnsupportedReturnTypeAfterV1(),
                new FunctionImportParametersIncorrectTypeBeforeV3(),
                new FunctionImportIsSideEffectingNotSupportedBeforeV3(),
                new FunctionImportIsComposableNotSupportedBeforeV3(),
                new FunctionImportIsBindableNotSupportedBeforeV3(),
                new EntityTypeEntityKeyMustNotBeBinaryBeforeV2(),
                new EnumTypeEnumsNotSupportedBeforeV3(),
                new NavigationPropertyContainsTargetNotSupportedBeforeV3(),
                new ValueTermsNotSupportedBeforeV3(),
                new VocabularyAnnotationsNotSupportedBeforeV3(),
                new StreamTypeReferencesNotSupportedBeforeV3(),
                new SpatialTypeReferencesNotSupportedBeforeV3(),
                new ModelDuplicateSchemaElementNameBeforeV3(),
            ]
        );
    }

    private static function getV2RuleSet(): self
    {
        return new self(
            self::getBaseRuleSet(),
            [new FunctionImportParametersIncorrectTypeBeforeV3(),
                new FunctionImportUnsupportedReturnTypeAfterV1(),
                new FunctionImportIsSideEffectingNotSupportedBeforeV3(),
                new FunctionImportIsComposableNotSupportedBeforeV3(),
                new FunctionImportIsBindableNotSupportedBeforeV3(),
                new EnumTypeEnumsNotSupportedBeforeV3(),
                new NavigationPropertyContainsTargetNotSupportedBeforeV3(),
                new StructuralPropertyNullableComplexType(),
                new ValueTermsNotSupportedBeforeV3(),
                new VocabularyAnnotationsNotSupportedBeforeV3(),
                new OpenTypesNotSupported(),
                new StreamTypeReferencesNotSupportedBeforeV3(),
                new SpatialTypeReferencesNotSupportedBeforeV3(),
                new ModelDuplicateSchemaElementNameBeforeV3(),
            ]
        );
    }

    private static function getV3RuleSet(): self
    {
        return new self(
            self::getBaseRuleSet(),
            [
                new FunctionImportUnsupportedReturnTypeAfterV1(),
                new ModelDuplicateSchemaElementName(),
            ]
        );
    }
    /**
     * Retrieve an external iterator.
     * @return Traversable|ValidationRule An instance of an object implementing <b>Iterator</b> or
     */
    public function getIterator(): Traversable
    {
        foreach ($this->rules as $ruleList) {
            foreach ($ruleList as $rule) {
                assert($rule instanceof ValidationRule);
                yield $rule;
            }
        }
    }
}
