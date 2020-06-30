<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata;

use BadMethodCallException;
use ReflectionClass;
use ReflectionException;

/**
 * @method static UnknownEnumVal_TermKind(string $termKind)
 * @method static UnknownEnumVal_SchemaElementKind(string $schemaElementKind)
 * @method static UnknownEnumVal_ContainerElementKind(string $containerElementKind)
 * @method static UnknownEnumVal_TypeKind(string $typeKind)
 * @method static Annotations_TypeMismatch(string $type, string $attemptedType)
 * @method static EdmModel_CannotUseElementWithTypeNone()
 * @method static EdmPrimitive_UnexpectedKind()
 * @method static EdmModel_Validator_Semantic_DeclaringTypeMustBeCorrect(string $propertyName)
 * @method static EdmModel_Validator_Semantic_IsUnboundedCannotBeTrueWhileMaxLengthIsNotNull()
 * @method static EdmEntityContainer_CannotUseElementWithTypeNone()
 * @method static Constructable_TargetMustBeStock(string $get_class)
 * @method static Constructable_EntityTypeOrCollectionOfEntityTypeExpected(string $string)
 * @method static UnknownEnumVal_Multiplicity(Enums\Multiplicity $multiplicity)
 * @method static Constructable_VocabularyAnnotationMustHaveTarget()
 * @method static UnknownEnumVal_PrimitiveKind($getKey)
 * @method static TypeSemantics_CouldNotConvertTypeReference(string|null $param, string $typeKindName)
 * @method static Bad_CyclicComplex(string|null $qualifiedName)
 * @method static Bad_CyclicEntityContainer(string $name)
 * @method static Bad_CyclicEntity(string|null $qualifiedName)
 * @method static ValueHasAlreadyBeenSet()
 * @method static UnknownEnumVal_PropertyKind($getKey)
 * @method static EdmModel_Validator_Semantic_InvalidElementAnnotationNotIEdmStringValue()
 * @method static EdmModel_Validator_Semantic_InvalidElementAnnotationValueInvalidXml()
 * @method static EdmModel_Validator_Semantic_InvalidElementAnnotationNullNamespaceOrName()
 * @method static EdmModel_Validator_Semantic_InvalidElementAnnotationMismatchedTerm()
 * @method static Serializer_UnknownEdmxVersion()
 * @method static Serializer_UnknownEdmVersion()
 * @method static UnknownEnumVal_EdmxTarget($getKey)
 * @method static ValueWriter_NonSerializableValue($getKey)
 * @method static EdmModel_Validator_Semantic_ComposableFunctionImportCannotBeSideEffecting(string $getName)
 * @method static EdmModel_Validator_Semantic_FunctionImportEntitySetExpressionIsInvalid(string $string)
 * @method static UnknownEnumVal_FunctionParameterMode($getKey)
 * @method static UnknownEnumVal_ConcurrencyMode($getKey)
 * @method static Serializer_NonInlineFunctionImportReturnType(string $string)
 * @method static Annotations_DocumentationPun(string $get_class)
 * @method static EdmModel_Validator_Syntactic_PropertyMustNotBeNull(string $get_class, string $propertyName)
 * @method static EdmModel_Validator_Syntactic_EnumPropertyValueOutOfRange(string $get_class, string $propertyName, string $get_class1, $enumValue)
 * @method static EdmModel_Validator_Syntactic_InterfaceKindValueMismatch($kind, string $get_class, string $propertyName, string $interface)
 * @method static EdmModel_Validator_Syntactic_InterfaceKindValueUnexpected($kind, string $get_class, string $propertyName)
 * @method static EdmModel_Validator_Syntactic_TypeRefInterfaceTypeKindValueMismatch(string $get_class, string $getTypeKind)
 * @method static EdmModel_Validator_Syntactic_EnumerableMustNotHaveNullElements(string $get_class, string $propertyName)
 * @method static EdmModel_Validator_Syntactic_InterfaceCriticalCycleInTypeHierarchy(string $typeName)
 * @method static EdmModel_Validator_Syntactic_NavigationPartnerInvalid(string $getName)
 * @method static EdmModel_Validator_Semantic_AmbiguousType(string $FullName)
 * @method static EdmModel_Validator_Semantic_InaccessibleType(string $FullName)
 * @method static EdmModel_Validator_Syntactic_MissingName()
 * @method static EdmModel_Validator_Syntactic_EdmModel_NameIsTooLong(string $name)
 * @method static EdmModel_Validator_Syntactic_EdmModel_NameIsNotAllowed(string $name)
 * @method static EdmModel_Validator_Semantic_ElementDirectValueAnnotationFullNameMustBeUnique(string $NamespaceUri, string $Name)
 * @method static EdmModel_Validator_Syntactic_MissingNamespaceName()
 * @method static EdmModel_Validator_Syntactic_EdmModel_NamespaceNameIsTooLong(string $Namespace)
 * @method static EdmModel_Validator_Syntactic_EdmModel_NamespaceNameIsNotAllowed(string $Namespace)
 * @method static EdmModel_Validator_Semantic_SystemNamespaceEncountered(string $Namespace)
 * @method static EdmModel_Validator_Semantic_SchemaElementMustNotHaveKindOfNone(string $FullName)
 * @method static EdmModel_Validator_Semantic_EntityContainerElementMustNotHaveKindOfNone(string $FullName)
 * @method static EdmModel_Validator_Semantic_DuplicateEntityContainerMemberName(string $FullName)
 * @method static EdmModel_Validator_Semantic_EntitySetTypeHasNoKeys(string $entitySetName, string $entityTypeName)
 * @method static EdmModel_Validator_Semantic_EntitySetCanOnlyBeContainedByASingleNavigationProperty(string $string)
 * @method static EdmModel_Validator_Semantic_EntitySetNavigationMappingMustBeBidirectional(string $string, string $getName)
 * @method static EdmModel_Validator_Semantic_DuplicateNavigationPropertyMapping(string $string, string $getName)
 * @method static EdmModel_Validator_Semantic_EntitySetRecursiveNavigationPropertyMappingsMustPointBackToSourceEntitySet(Interfaces\INavigationProperty $getNavigationProperty, string $getName)
 * @method static EdmModel_Validator_Semantic_EntitySetNavigationPropertyMappingMustPointToValidTargetForProperty(string $getName, string $getName1)
 * @method static EdmModel_Validator_Semantic_InvalidMemberNameMatchesTypeName(string $getName)
 * @method static EdmModel_Validator_Semantic_PropertyNameAlreadyDefined(string $getName)
 * @method static EdmModel_Validator_Semantic_BaseTypeMustHaveSameTypeKind()
 * @method static EdmModel_Validator_Semantic_OpenTypesSupportedOnlyInV12AndAfterV3()
 * @method static EdmModel_Validator_Semantic_OpenTypesSupportedForEntityTypesOnly()
 * @method static EdmModel_Validator_Semantic_EnumsNotSupportedBeforeV3()
 * @method static EdmModel_Validator_Semantic_EnumMemberNameAlreadyDefined(string $getName)
 * @method static EdmModel_Validator_Semantic_EnumMustHaveIntegralUnderlyingType(string $FullName)
 * @method static EdmModel_Validator_Semantic_EnumMemberTypeMustMatchEnumUnderlyingType(string $getName)
 * @method static EdmModel_Validator_Semantic_ExpressionNotValidForTheAssertedType()
 * @method static EdmModel_Validator_Semantic_PrimitiveConstantExpressionNotValidForNonPrimitiveType()
 * @method static EdmModel_Validator_Semantic_ExpressionPrimitiveKindNotValidForAssertedType()
 * @method static EdmModel_Validator_Semantic_NullCannotBeAssertedToBeANonNullableType()
 * @method static EdmModel_Validator_Semantic_PathIsNotValidForTheGivenContext(string $segment)
 * @method static EdmModel_Validator_Semantic_RecordExpressionNotValidForNonStructuredType()
 * @method static EdmModel_Validator_Semantic_RecordExpressionMissingProperty(string $getName)
 * @method static EdmModel_Validator_Semantic_RecordExpressionHasExtraProperties(string $getName)
 * @method static EdmModel_Validator_Semantic_CollectionExpressionNotValidForNonCollectionType()
 * @method static EdmModel_Validator_Semantic_StringConstantLengthOutOfRange(int $strlen, int|null $getMaxLength)
 * @method static EdmModel_Validator_Semantic_IntegerConstantValueOutOfRange()
 * @method static EdmModel_Validator_Semantic_ExpressionPrimitiveKindCannotPromoteToAssertedType(string $ToTraceString, string $ToTraceString1)
 * @method static EdmModel_Validator_Semantic_CannotAssertNullableTypeAsNonNullableType(string|null $FullName)
 * @method static EdmModel_Validator_Semantic_BinaryConstantLengthOutOfRange(string $strval, int|null $getMaxLength)
 * @method static EdmModel_Validator_Semantic_DuplicatePropertyNameSpecifiedInEntityKey(string $getName, string $getName1)
 * @method static EdmModel_Validator_Semantic_InvalidKeyNullablePart(string $getName, string $getName1)
 * @method static EdmModel_Validator_Semantic_EntityKeyMustBeScalar(string $getName, string $getName1)
 * @method static EdmModel_Validator_Semantic_EntityKeyMustNotBeBinaryBeforeV2(string $getName, string $getName1)
 * @method static EdmModel_Validator_Semantic_InvalidKeyKeyDefinedInBaseClass(string $getName, string $getName1)
 * @method static EdmModel_Validator_Semantic_KeyMissingOnEntityType(string $getName)
 * @method static EdmModel_Validator_Semantic_KeyPropertyMustBelongToEntity(string $getName, string $getName1)
 * @method static EdmModel_Validator_Semantic_TypeMustNotHaveKindOfNone()
 * @method static EdmModel_Validator_Semantic_PrimitiveTypeMustNotHaveKindOfNone(string $FullName)
 * @method static EdmModel_Validator_Semantic_InvalidComplexTypeAbstract(string $FullName)
 * @method static EdmModel_Validator_Semantic_InvalidComplexTypePolymorphic(string $FullName)
 * @method static EdmModel_Validator_Semantic_ComplexTypeMustHaveProperties(string $FullName)
 * @method static EdmModel_Validator_Semantic_RowTypeMustNotHaveBaseType()
 * @method static EdmModel_Validator_Semantic_RowTypeMustHaveProperties()
 * @method static EdmModel_Validator_Semantic_NullableComplexTypeProperty(string $getName)
 * @method static EdmModel_Validator_Semantic_InvalidPropertyType($getKey)
 * @method static EdmModel_Validator_Semantic_InvalidPropertyTypeConcurrencyMode(string $param)
 * @method static EdmModel_Validator_Semantic_InvalidOperationMultipleEndsInAssociation()
 * @method static EdmModel_Validator_Semantic_InvalidNavigationPropertyType(string $getName)
 * @method static EdmModel_Validator_Semantic_DuplicateDependentProperty(string $getName, string $getName1)
 * @method static EdmModel_Validator_Semantic_InvalidMultiplicityOfPrincipalEndDependentPropertiesAllNullable(string $getName, string $getName1)
 * @method static EdmModel_Validator_Semantic_InvalidMultiplicityOfPrincipalEndDependentPropertiesAllNonnullable(string $getName, string $getName1)
 * @method static EdmModel_Validator_Semantic_NavigationPropertyPrincipalEndMultiplicityUpperBoundMustBeOne(string $getName)
 * @method static EdmModel_Validator_Semantic_InvalidMultiplicityOfDependentEndMustBeZeroOneOrOne(string $getName)
 * @method static EdmModel_Validator_Semantic_InvalidMultiplicityOfDependentEndMustBeMany(string $getName)
 * @method static EdmModel_Validator_Semantic_DependentPropertiesMustBelongToDependentEntity(string $getName, string $getName1)
 * @method static EdmModel_Validator_Semantic_InvalidToPropertyInRelationshipConstraint(string $getName, string $FullName)
 * @method static EdmModel_Validator_Semantic_EndWithManyMultiplicityCannotHaveOperationsSpecified(string $getName)
 * @method static EdmModel_Validator_Semantic_NavigationPropertyContainsTargetNotSupportedBeforeV3()
 * @method static EdmModel_Validator_Semantic_NavigationPropertyWithRecursiveContainmentTargetMustBeOptional(string $getName)
 * @method static EdmModel_Validator_Semantic_NavigationPropertyWithRecursiveContainmentSourceMustBeFromZeroOrOne(string $getName)
 * @method static EdmModel_Validator_Semantic_NavigationPropertyWithNonRecursiveContainmentSourceMustBeFromOne(string $getName)
 * @method static EdmModel_Validator_Semantic_NavigationPropertyEntityMustNotIndirectlyContainItself(string $getName)
 * @method static EdmModel_Validator_Semantic_TypeMismatchRelationshipConstraint(string $getName, string $FullName, string $getName1, string $getName2, string $string)
 * @method static EdmModel_Validator_Semantic_PropertyMustNotHaveKindOfNone(string $getName)
 * @method static EdmModel_Validator_Semantic_FunctionsNotSupportedBeforeV2()
 * @method static EdmModel_Validator_Semantic_OnlyInputParametersAllowedInFunctions(string $getName, string $getName1)
 * @method static EdmModel_Validator_Semantic_FunctionImportWithUnsupportedReturnTypeV1(string $getName)
 * @method static EdmModel_Validator_Semantic_FunctionImportWithUnsupportedReturnTypeAfterV1(string $getName)
 * @method static EdmModel_Validator_Semantic_FunctionImportReturnEntitiesButDoesNotSpecifyEntitySet(string $getName)
 * @method static EdmModel_Validator_Semantic_FunctionImportEntitySetExpressionKindIsInvalid(string $getName, $getKey)
 * @method static EdmModel_Validator_Semantic_FunctionImportEntityTypeDoesNotMatchEntitySet(string $getName, string $FullName, string $getName1)
 * @method static EdmModel_Validator_Semantic_FunctionImportEntityTypeDoesNotMatchEntitySet2(string $getName, string|null $FullName)
 * @method static EdmModel_Validator_Semantic_FunctionImportSpecifiesEntitySetButNotEntityType(string $getName)
 * @method static EdmModel_Validator_Semantic_ComposableFunctionImportMustHaveReturnType(string $getName)
 * @method static EdmModel_Validator_Semantic_FunctionImportParameterIncorrectType(string|null $FullName, string $getName)
 * @method static EdmModel_Validator_Semantic_FunctionImportSideEffectingNotSupportedBeforeV3()
 * @method static EdmModel_Validator_Semantic_FunctionImportComposableNotSupportedBeforeV3()
 * @method static EdmModel_Validator_Semantic_FunctionImportBindableNotSupportedBeforeV3()
 * @method static EdmModel_Validator_Semantic_BindableFunctionImportMustHaveParameters(string $getName)
 * @method static EdmModel_Validator_Semantic_InvalidFunctionImportParameterMode(string $getName, string $getName1)
 * @method static EdmModel_Validator_Semantic_ParameterNameAlreadyDefinedDuplicate(string $getName)
 * @method static EdmModel_Validator_Semantic_StreamTypeReferencesNotSupportedBeforeV3()
 * @method static EdmModel_Validator_Semantic_SpatialTypeReferencesNotSupportedBeforeV3()
 * @method static EdmModel_Validator_Semantic_ScaleOutOfRange()
 * @method static EdmModel_Validator_Semantic_PrecisionOutOfRange()
 * @method static EdmModel_Validator_Semantic_StringMaxLengthOutOfRange()
 * @method static EdmModel_Validator_Semantic_MaxLengthOutOfRange()
 * @method static EdmModel_Validator_Semantic_SchemaElementNameAlreadyDefined(string $fullName)
 * @method static EdmModel_Validator_Semantic_DuplicateEntityContainerName(string $getName)
 * @method static EdmModel_Validator_Semantic_VocabularyAnnotationsNotSupportedBeforeV3()
 * @method static EdmModel_Validator_Semantic_InaccessibleTarget(string|null $FullyQualifiedName)
 * @method static EdmModel_Validator_Semantic_InaccessibleTerm(string $FullName)
 * @method static EdmModel_Validator_Semantic_TypeAnnotationMissingRequiredProperty(string $getName)
 * @method static EdmModel_Validator_Semantic_TypeAnnotationHasExtraProperties(string $getName)
 * @method static EdmModel_Validator_Semantic_ValueTermsNotSupportedBeforeV3()
 * @method static EdmModel_Validator_Semantic_TermMustNotHaveKindOfNone(string $FullName)
 * @method static EdmModel_Validator_Semantic_IncorrectNumberOfArguments(int|void $count, string $FullName, int|void $count1)
 * @method static EdmModel_Validator_Semantic_DuplicateAnnotation(string|null $FullyQualifiedName, string $FullName, string $getQualifier)
 * @method static RuleSet_DuplicateRulesExistInRuleSet()
 */
class StringConst
{
    protected const EdmPrimitive_UnexpectedKind                              = 'Unexpected primitive type kind.';
    protected const Annotations_DocumentationPun                             = 'Annotations in the \'Documentation\' namespace must implement \'IEdmDocumentation\', but \'%s\' does not.';
    protected const Annotations_TypeMismatch                                 = 'Annotation of type \'%s\' cannot be interpreted as \'%s\'.';
    protected const Constructable_VocabularyAnnotationMustHaveTarget         = 'The annotation must have non-null target.';
    protected const Constructable_EntityTypeOrCollectionOfEntityTypeExpected = 'An entity type or a collection of an entity type is expected.';
    protected const Constructable_TargetMustBeStock                          = 'Navigation target entity type must be \'%s\'.';
    protected const TypeSemantics_CouldNotConvertTypeReference               = 'The type \'%s\' could not be converted to be a \'%s\' type.';
    protected const EdmModel_CannotUseElementWithTypeNone                    = 'An element with type \'None\' cannot be used in a model.';
    protected const EdmEntityContainer_CannotUseElementWithTypeNone          = 'An element with type \'None\' cannot be used in an entity container.';
    protected const ValueWriter_NonSerializableValue                         = 'The value writer cannot write a value of kind \'%s\'.';
    protected const ValueHasAlreadyBeenSet                                   = 'Value has already been set.';
    protected const PathSegmentMustNotContainSlash                           = 'Path segments must not contain \'/\' character.';

    // Evaluation messages
    protected const Edm_Evaluator_NoTermTypeAnnotationOnType = 'Type \'%s\' must have a single type annotation with term type \'%s\'.';
    protected const Edm_Evaluator_NoValueAnnotationOnType    = 'Type \'%s\' must have a single value annotation with term \'%s\'.';
    protected const Edm_Evaluator_NoValueAnnotationOnElement = 'Element must have a single value annotation with term \'%s\'.';
    protected const Edm_Evaluator_UnrecognizedExpressionKind = 'Expression with kind \'%s\' cannot be evaluated.';
    protected const Edm_Evaluator_UnboundFunction            = 'Function \'%s\' is not present in the execution environment.';
    protected const Edm_Evaluator_UnboundPath                = 'Path segment \'%s\' has no binding in the execution environment.';
    protected const Edm_Evaluator_FailedTypeAssertion        = 'Value fails to match type \'%s\'.';

    // Error message for Semantic validation rules
    protected const EdmModel_Validator_Semantic_SystemNamespaceEncountered                                                 = 'The namespace \'%s\' is a system namespace and cannot be used by non-system types. Please choose a different namespace.';
    protected const EdmModel_Validator_Semantic_EntitySetTypeHasNoKeys                                                     = 'The entity set \'%s\' is based on type \'%s\' that has no keys defined.';
    protected const EdmModel_Validator_Semantic_DuplicateEndName                                                           = 'An end with the name \'%s\' is already defined.';
    protected const EdmModel_Validator_Semantic_DuplicatePropertyNameSpecifiedInEntityKey                                  = 'The key specified in entity type \'%s\' is not valid. Property \'%s\' is referenced more than once in the key element.';
    protected const EdmModel_Validator_Semantic_InvalidComplexTypeAbstract                                                 = 'The complex type \'%s\' is marked as abstract. Abstract complex types are only supported in version 1.1 EDM models.';
    protected const EdmModel_Validator_Semantic_InvalidComplexTypePolymorphic                                              = 'The complex type \'%s\' has a base type specified. Complex type inheritance is only supported in version 1.1 EDM models.';
    protected const EdmModel_Validator_Semantic_InvalidKeyNullablePart                                                     = 'The key part \'%s\' for type \'%s\' is not valid. All parts of the key must be non nullable.';
    protected const EdmModel_Validator_Semantic_EntityKeyMustBeScalar                                                      = 'The property \'%s\' in entity type \'%s\' is not valid. All properties that are part of the entity key must be of primitive type.';
    protected const EdmModel_Validator_Semantic_InvalidKeyKeyDefinedInBaseClass                                            = 'The key usage is not valid. \'%s\' cannot define keys because one of its base classes \'%s\' defines keys.';
    protected const EdmModel_Validator_Semantic_KeyMissingOnEntityType                                                     = 'The entity type \'%s\' has no key defined. Define the key for this entity type.';
    protected const EdmModel_Validator_Semantic_BadNavigationPropertyUndefinedRole                                         = 'The navigation property \'%s\' is not valid. The role \'%s\' is not defined in relationship \'%s\'.';
    protected const EdmModel_Validator_Semantic_BadNavigationPropertyRolesCannotBeTheSame                                  = 'The navigation property \'%s\'is not valid. The from role and to role are the same.';
    protected const EdmModel_Validator_Semantic_BadNavigationPropertyCouldNotDetermineType                                 = 'The navigation property type could not be determined from the role \'%s\'.';
    protected const EdmModel_Validator_Semantic_InvalidOperationMultipleEndsInAssociation                                  = 'An on delete action can only be specified on one end of an association.';
    protected const EdmModel_Validator_Semantic_EndWithManyMultiplicityCannotHaveOperationsSpecified                       = 'The navigation property \'%s\' cannot have \'OnDelete\' specified since its multiplicity is \'*\'.';
    protected const EdmModel_Validator_Semantic_EndNameAlreadyDefinedDuplicate                                             = 'Each name and plural name in a relationship must be unique. \'%s\' is already defined.';
    protected const EdmModel_Validator_Semantic_SameRoleReferredInReferentialConstraint                                    = 'In relationship \'%s\', the principal and dependent role of the referential constraint refers to the same role in the relationship type.';
    protected const EdmModel_Validator_Semantic_NavigationPropertyPrincipalEndMultiplicityUpperBoundMustBeOne              = 'The principal navigation property \'%s\' has an invalid multiplicity. Valid values for the multiplicity of a principal end are \'0..1\' or \'1\'.';
    protected const EdmModel_Validator_Semantic_InvalidMultiplicityOfPrincipalEndDependentPropertiesAllNonnullable         = 'The multiplicity of the principal end \'%s\' is not valid. Because all dependent properties of the end \'%s\' are non-nullable, the multiplicity of the principal end must be \'1\'.';
    protected const EdmModel_Validator_Semantic_InvalidMultiplicityOfPrincipalEndDependentPropertiesAllNullable            = 'The multiplicity of the principal end \'%s\' is not valid. Because all dependent properties of the end \'%s\' are nullable, the multiplicity of the principal end must be \'0..1\'.';
    protected const EdmModel_Validator_Semantic_InvalidMultiplicityOfDependentEndMustBeZeroOneOrOne                        = 'The multiplicity of the dependent end \'%s\' is not valid. Because the dependent properties represent the dependent end key, the multiplicity of the dependent end must be \'0..1\' or \'1\'.';
    protected const EdmModel_Validator_Semantic_InvalidMultiplicityOfDependentEndMustBeMany                                = 'The multiplicity of the dependent end \'%s\' is not valid. Because the dependent properties don\'t represent the dependent end key, the the multiplicity of the dependent end must be \'*\'.';
    protected const EdmModel_Validator_Semantic_InvalidToPropertyInRelationshipConstraint                                  = 'The properties referred by the dependent role \'%s\' must be a subset of the key of the entity type \'%s\'.';
    protected const EdmModel_Validator_Semantic_MismatchNumberOfPropertiesinRelationshipConstraint                         = 'The number of properties in the dependent and principal role in a relationship constraint must be exactly identical.';
    protected const EdmModel_Validator_Semantic_TypeMismatchRelationshipConstraint                                         = 'The types of all properties in the dependent role of a referential constraint must be the same as the corresponding property types in the principal role. The type of property \'%s\' on entity \'%s\' does not match the type of property \'%s\' on entity \'%s\' in the referential constraint \'%s\'.';
    protected const EdmModel_Validator_Semantic_InvalidPropertyInRelationshipConstraintDependentEnd                        = 'There is no property with name \'%s\' defined in the type referred to by role \'%s\'.';
    protected const EdmModel_Validator_Semantic_InvalidPropertyInRelationshipConstraintPrimaryEnd                          = 'The principal end properties in the referential constraint of the association \'%s\' do not match the key of the type referred to by role \'%s\'.';
    protected const EdmModel_Validator_Semantic_NullableComplexTypeProperty                                                = 'The property \'%s\' is of a complex type and is nullable. Nullable complex type properties are not supported in EDM versions 1.0 and 2.0.';
    protected const EdmModel_Validator_Semantic_InvalidPropertyType                                                        = 'A property cannot be of type \'%s\'. The property type must be a complex, a primitive or an enum type, or a collection of complex, primitive, or enum types.';
    protected const EdmModel_Validator_Semantic_ComposableFunctionImportCannotBeSideEffecting                              = 'The function import \'%s\' cannot be composable and side-effecting at the same time.';
    protected const EdmModel_Validator_Semantic_BindableFunctionImportMustHaveParameters                                   = 'The bindable function import \'%s\' must have at least one parameter.';
    protected const EdmModel_Validator_Semantic_FunctionImportWithUnsupportedReturnTypeV1                                  = 'The return type is not valid in function import \'%s\'. In version 1.0 a function import can have no return type or return a collection of scalar values or a collection of entities.';
    protected const EdmModel_Validator_Semantic_FunctionImportWithUnsupportedReturnTypeAfterV1                             = 'The return type is not valid in function import \'%s\'. The function import can have no return type or return a scalar, a complex type, an entity type or a collection of those.';
    protected const EdmModel_Validator_Semantic_FunctionImportReturnEntitiesButDoesNotSpecifyEntitySet                     = 'The function import \'%s\' returns entities but does not specify an entity set.';
    protected const EdmModel_Validator_Semantic_FunctionImportEntityTypeDoesNotMatchEntitySet                              = 'The function import \'%s\' returns entities of type \'%s\' that cannot exist in the entity set \'%s\' specified for the function import.';
    protected const EdmModel_Validator_Semantic_FunctionImportEntityTypeDoesNotMatchEntitySet2                             = 'The function import \'%s\' returns entities of type \'%s\' that cannot be returned by the entity set path specified for the function import.';
    protected const EdmModel_Validator_Semantic_FunctionImportEntitySetExpressionKindIsInvalid                             = 'The function import \'%s\' specifies an entity set expression of kind %s which is not supported in this context. Function import entity set expression can be either an entity set reference or a path starting with a function import parameter and traversing navigation properties.';
    protected const EdmModel_Validator_Semantic_FunctionImportEntitySetExpressionIsInvalid                                 = 'The function import \'%s\' specifies an entity set expression which is not valid. Function import entity set expression can be either an entity set reference or a path starting with a function import parameter and traversing navigation properties.';
    protected const EdmModel_Validator_Semantic_FunctionImportSpecifiesEntitySetButNotEntityType                           = 'The function import \'%s\' specifies an entity set but does not return entities.';
    protected const EdmModel_Validator_Semantic_ComposableFunctionImportMustHaveReturnType                                 = 'The composable function import \'%s\' must specify a return type.';
    protected const EdmModel_Validator_Semantic_ParameterNameAlreadyDefinedDuplicate                                       = 'Each parameter name in a function must be unique. The parameter name \'%s\' is already defined.';
    protected const EdmModel_Validator_Semantic_DuplicateEntityContainerMemberName                                         = 'Each member name in an EntityContainer must be unique. A member with name \'%s\' is already defined.';
    protected const EdmModel_Validator_Semantic_SchemaElementNameAlreadyDefined                                            = 'An element with the name \'%s\' is already defined.';
    protected const EdmModel_Validator_Semantic_InvalidMemberNameMatchesTypeName                                           = 'The member name \'%s\' cannot be used in a type with the same name. Member names cannot be the same as their enclosing type.';
    protected const EdmModel_Validator_Semantic_PropertyNameAlreadyDefined                                                 = 'Each property name in a type must be unique. Property name \'%s\' is already defined.';
    protected const EdmModel_Validator_Semantic_BaseTypeMustHaveSameTypeKind                                               = 'The base type kind of a structured type must be the same as its derived type.';
    protected const EdmModel_Validator_Semantic_RowTypeMustNotHaveBaseType                                                 = 'Row types cannot have a base type.';
    protected const EdmModel_Validator_Semantic_FunctionsNotSupportedBeforeV2                                              = 'Functions are not supported prior to version 2.0.';
    protected const EdmModel_Validator_Semantic_FunctionImportSideEffectingNotSupportedBeforeV3                            = 'The \'SideEffecting\' setting of function imports is not supported before version 3.0.';
    protected const EdmModel_Validator_Semantic_FunctionImportComposableNotSupportedBeforeV3                               = 'The \'Composable\' setting of function imports is not supported before version 3.0.';
    protected const EdmModel_Validator_Semantic_FunctionImportBindableNotSupportedBeforeV3                                 = 'The \'Bindable\' setting of function imports is not supported before version 3.0.';
    protected const EdmModel_Validator_Semantic_KeyPropertyMustBelongToEntity                                              = 'The key property \'%s\' must belong to the entity \'%s\'.';
    protected const EdmModel_Validator_Semantic_DependentPropertiesMustBelongToDependentEntity                             = 'The dependent property \'%s\' must belong to the dependent entity \'%s\'.';
    protected const EdmModel_Validator_Semantic_DeclaringTypeMustBeCorrect                                                 = 'The property \'%s\' cannot belong to a type other than its declaring type. ';
    protected const EdmModel_Validator_Semantic_InaccessibleType                                                           = 'The named type \'%s\' could not be found from the model being validated.';
    protected const EdmModel_Validator_Semantic_AmbiguousType                                                              = 'The named type \'%s\' is ambiguous from the model being validated.';
    protected const EdmModel_Validator_Semantic_InvalidNavigationPropertyType                                              = 'The type of the navigation property \'%s\' is invalid. The navigation target type must be an entity type or a collection of entity type. The navigation target entity type must match the declaring type of the partner property.';
    protected const EdmModel_Validator_Semantic_NavigationPropertyWithRecursiveContainmentTargetMustBeOptional             = 'The target multiplicity of the navigation property \'%s\' is invalid. If a navigation property has \'ContainsTarget\' set to true and declaring entity type of the property is the same or inherits from the target entity type, then the property represents a recursive containment and it must have an optional target represented by a collection or a nullable entity type.';
    protected const EdmModel_Validator_Semantic_NavigationPropertyWithRecursiveContainmentSourceMustBeFromZeroOrOne        = 'The source multiplicity of the navigation property \'%s\' is invalid. If a navigation property has \'ContainsTarget\' set to true and declaring entity type of the property is the same or inherits from the target entity type, then the property represents a recursive containment and the multiplicity of the navigation source must be zero or one.';
    protected const EdmModel_Validator_Semantic_NavigationPropertyWithNonRecursiveContainmentSourceMustBeFromOne           = 'The source multiplicity of the navigation property \'%s\' is invalid. If a navigation property has \'ContainsTarget\' set to true and declaring entity type of the property is not the same as the target entity type, then the property represents a non-recursive containment and the multiplicity of the navigation source must be exactly one.';
    protected const EdmModel_Validator_Semantic_NavigationPropertyContainsTargetNotSupportedBeforeV3                       = 'The \'ContainsTarget\' setting of navigation properties is not supported before version 3.0.';
    protected const EdmModel_Validator_Semantic_OnlyInputParametersAllowedInFunctions                                      = 'The mode of the parameter \'%s\' in the function \'%s\' is invalid. Only input parameters are allowed in functions.';
    protected const EdmModel_Validator_Semantic_InvalidFunctionImportParameterMode                                         = 'The mode of the parameter \'%s\' in the function import \'%s\' is invalid.';
    protected const EdmModel_Validator_Semantic_FunctionImportParameterIncorrectType                                       = 'The type \'%s\' of parameter \'%s\' is invalid. A function import parameter must be one of the following types: A simple type or complex type.';
    protected const EdmModel_Validator_Semantic_RowTypeMustHaveProperties                                                  = 'The row type is invalid. A row must contain at least one property.';
    protected const EdmModel_Validator_Semantic_ComplexTypeMustHaveProperties                                              = 'The complex type \'%s\' is invalid. A complex type must contain at least one property.';
    protected const EdmModel_Validator_Semantic_DuplicateDependentProperty                                                 = 'The dependent property \'%s\' of navigation property \'%s\' is a duplicate.';
    protected const EdmModel_Validator_Semantic_ScaleOutOfRange                                                            = 'The scale value can range from 0 through the specified precision value.';
    protected const EdmModel_Validator_Semantic_PrecisionOutOfRange                                                        = 'Precision cannot be negative.';
    protected const EdmModel_Validator_Semantic_StringMaxLengthOutOfRange                                                  = 'The max length facet specifies the maximum length of an instance of the string type. For unicode equal to \'true\', the max length can range from 1 to 2^30, or if \'false\', 1 to 2^31.';
    protected const EdmModel_Validator_Semantic_MaxLengthOutOfRange                                                        = 'Max length can range from 1 to 2^31.';
    protected const EdmModel_Validator_Semantic_InvalidPropertyTypeConcurrencyMode                                         = 'A property with a fixed concurrency mode cannot be of type \'%s\'. The property type must be a primitive type.';
    protected const EdmModel_Validator_Semantic_EntityKeyMustNotBeBinaryBeforeV2                                           = 'The property \'%s\' in entity type \'%s\' is not valid. Binary types are not allowed in entity keys before version 2.0.';
    protected const EdmModel_Validator_Semantic_EnumsNotSupportedBeforeV3                                                  = 'Enums are not supported prior to version 3.0.';
    protected const EdmModel_Validator_Semantic_EnumMemberTypeMustMatchEnumUnderlyingType                                  = 'The type of the value of enum member \'%s\' must match the underlying type of the parent enum.';
    protected const EdmModel_Validator_Semantic_EnumMemberNameAlreadyDefined                                               = 'Each member name of an enum type must be unique. Enum member name \'%s\' is already defined.';
    protected const EdmModel_Validator_Semantic_ValueTermsNotSupportedBeforeV3                                             = 'Value terms are not supported prior to version 3.0.';
    protected const EdmModel_Validator_Semantic_VocabularyAnnotationsNotSupportedBeforeV3                                  = 'Vocabulary annotations are not supported prior to version 3.0.';
    protected const EdmModel_Validator_Semantic_OpenTypesSupportedOnlyInV12AndAfterV3                                      = 'Open types are supported only in version 1.2 and after version 2.0.';
    protected const EdmModel_Validator_Semantic_OpenTypesSupportedForEntityTypesOnly                                       = 'Only entity types can be open types.';
    protected const EdmModel_Validator_Semantic_IsUnboundedCannotBeTrueWhileMaxLengthIsNotNull                             = 'The string reference is invalid because if \'IsUnbounded\' is true \'MaxLength\' must be null.';
    protected const EdmModel_Validator_Semantic_InvalidElementAnnotationMismatchedTerm                                     = 'The declared name and namespace of the annotation must match the name and namespace of its xml value.';
    protected const EdmModel_Validator_Semantic_InvalidElementAnnotationValueInvalidXml                                    = 'The value of an annotation marked to be serialized as an xml element must have a well-formed xml value.';
    protected const EdmModel_Validator_Semantic_InvalidElementAnnotationNotIEdmStringValue                                 = 'The value of an annotation marked to be serialized as an xml element must be IEdmStringValue.';
    protected const EdmModel_Validator_Semantic_InvalidElementAnnotationNullNamespaceOrName                                = 'The value of an annotation marked to be serialized as an xml element must be a string representing an xml element with non-empty name and namespace.';
    protected const EdmModel_Validator_Semantic_CannotAssertNullableTypeAsNonNullableType                                  = 'Cannot assert the nullable type \'%s\' as a non-nullable type.';
    protected const EdmModel_Validator_Semantic_ExpressionPrimitiveKindCannotPromoteToAssertedType                         = 'Cannot promote the primitive type \'%s\' to the specified primitive type \'%s\'.';
    protected const EdmModel_Validator_Semantic_NullCannotBeAssertedToBeANonNullableType                                   = 'Null value cannot have a non-nullable type.';
    protected const EdmModel_Validator_Semantic_ExpressionNotValidForTheAssertedType                                       = 'The type of the expression is incompatible with the asserted type.';
    protected const EdmModel_Validator_Semantic_CollectionExpressionNotValidForNonCollectionType                           = 'A collection expression is incompatible with a non-collection type.';
    protected const EdmModel_Validator_Semantic_PrimitiveConstantExpressionNotValidForNonPrimitiveType                     = 'A primitive expression is incompatible with a non-primitive type.';
    protected const EdmModel_Validator_Semantic_RecordExpressionNotValidForNonStructuredType                               = 'A record expression is incompatible with a non-structured type.';
    protected const EdmModel_Validator_Semantic_RecordExpressionMissingProperty                                            = 'The record expression does not have a constructor for a property named \'%s\'.';
    protected const EdmModel_Validator_Semantic_RecordExpressionHasExtraProperties                                         = 'The type of the record expression is not open and does not contain a property named \'%s\'.';
    protected const EdmModel_Validator_Semantic_DuplicateAnnotation                                                        = 'The annotated element \'%s\' has multiple annotations with the term \'%s\' and the qualifier \'%s\'.';
    protected const EdmModel_Validator_Semantic_IncorrectNumberOfArguments                                                 = 'The function application provides \'%s\' arguments, but the function \'%s\' expects \'%s\' arguments.';
    protected const EdmModel_Validator_Semantic_StreamTypeReferencesNotSupportedBeforeV3                                   = 'References to EDM stream type are not supported before version 3.0.';
    protected const EdmModel_Validator_Semantic_SpatialTypeReferencesNotSupportedBeforeV3                                  = 'References to EDM spatial types are not supported before version 3.0.';
    protected const EdmModel_Validator_Semantic_DuplicateEntityContainerName                                               = 'Each entity container name in a function must be unique. The name \'%s\' is already defined.';
    protected const EdmModel_Validator_Semantic_ExpressionPrimitiveKindNotValidForAssertedType                             = 'The primitive expression is not compatible with the asserted type.';
    protected const EdmModel_Validator_Semantic_IntegerConstantValueOutOfRange                                             = 'The value of the integer constant is out of range for the asserted type.';
    protected const EdmModel_Validator_Semantic_StringConstantLengthOutOfRange                                             = 'The value of the string constant is \'%s\' characters long, but the max length of its type is \'%s\'.';
    protected const EdmModel_Validator_Semantic_BinaryConstantLengthOutOfRange                                             = 'The value of the binary constant is \'%s\' characters long, but the max length of its type is \'%s\'.';
    protected const EdmModel_Validator_Semantic_TypeMustNotHaveKindOfNone                                                  = 'A type without other errors must not have kind of none.';
    protected const EdmModel_Validator_Semantic_TermMustNotHaveKindOfNone                                                  = 'A term without other errors must not have kind of none. The kind of term \'%s\' is none.';
    protected const EdmModel_Validator_Semantic_SchemaElementMustNotHaveKindOfNone                                         = 'A schema element without other errors must not have kind of none. The kind of schema element \'%s\' is none.';
    protected const EdmModel_Validator_Semantic_PropertyMustNotHaveKindOfNone                                              = 'A property without other errors must not have kind of none. The kind of property \'%s\' is none.';
    protected const EdmModel_Validator_Semantic_PrimitiveTypeMustNotHaveKindOfNone                                         = 'A primitive type without other errors must not have kind of none. The kind of primitive type \'%s\' is none.';
    protected const EdmModel_Validator_Semantic_EntityContainerElementMustNotHaveKindOfNone                                = 'An entity container element without other errors must not have kind of none. The kind of entity container element \'%s\' is none.';
    protected const EdmModel_Validator_Semantic_DuplicateNavigationPropertyMapping                                         = 'The entity set \'%s\' should have only a single mapping for the property \'%s\'.';
    protected const EdmModel_Validator_Semantic_EntitySetNavigationMappingMustBeBidirectional                              = 'The mapping of the entity set \'%s\' and navigation property \'%s\' is invalid because the navigation property mapping must have a mapping with the navigation property\'s partner that points back to the originating entity set. ';
    protected const EdmModel_Validator_Semantic_EntitySetCanOnlyBeContainedByASingleNavigationProperty                     = 'The entity set \'%s\' is invalid because it is contained by more than one navigation property.';
    protected const EdmModel_Validator_Semantic_TypeAnnotationMissingRequiredProperty                                      = 'The type annotation is missing a binding for the property \'%s\'.';
    protected const EdmModel_Validator_Semantic_TypeAnnotationHasExtraProperties                                           = 'They type of the type annotation is not open, and does not contain a property named \'%s\'.';
    protected const EdmModel_Validator_Semantic_EnumMustHaveIntegralUnderlyingType                                         = 'The underlying type of \'%s\' is not valid. The underlying type of an enum type must be an integral type. ';
    protected const EdmModel_Validator_Semantic_InaccessibleTerm                                                           = 'The term \'%s\' could not be found from the model being validated.';
    protected const EdmModel_Validator_Semantic_InaccessibleTarget                                                         = 'The target \'%s\' could not be found from the model being validated.';
    protected const EdmModel_Validator_Semantic_ElementDirectValueAnnotationFullNameMustBeUnique                           = 'An element already has a direct value annotation with the namespace \'%s\' and name \'%s\'.';
    protected const EdmModel_Validator_Semantic_NoEntitySetsFoundForType                                                   = 'The association set \'%s\' cannot assume an entity set for the role \'%s\' because there are no entity sets for the role type \'%s\'.';
    protected const EdmModel_Validator_Semantic_CannotInferEntitySetWithMultipleSetsPerType                                = 'The association set \'%s\' must specify an entity set for the role \'%s\' because there are multiple entity sets for the role type \'%s\'.';
    protected const EdmModel_Validator_Semantic_EntitySetRecursiveNavigationPropertyMappingsMustPointBackToSourceEntitySet = 'Because the navigation property \'%s\' is recursive, the mapping from the entity set \'%s\' must point back to itself.';
    protected const EdmModel_Validator_Semantic_NavigationPropertyEntityMustNotIndirectlyContainItself                     = 'The navigation property \'%s\' is invalid because it indirectly contains itself.';
    protected const EdmModel_Validator_Semantic_PathIsNotValidForTheGivenContext                                           = 'The path cannot be resolved in the given context. The segment \'%s\' failed to resolve.';
    protected const EdmModel_Validator_Semantic_EntitySetNavigationPropertyMappingMustPointToValidTargetForProperty        = 'The entity set \'%s\' is not a valid destination for the navigation property \'%s\' because it cannot hold an element of the target entity type.';

    // Error message for Syntactic validation rules
    protected const EdmModel_Validator_Syntactic_MissingName                           = 'The name is missing or not valid.';
    protected const EdmModel_Validator_Syntactic_EdmModel_NameIsTooLong                = 'The specified name must not be longer than 480 characters: \'%s\'.';
    protected const EdmModel_Validator_Syntactic_EdmModel_NameIsNotAllowed             = 'The specified name is not allowed: \'%s\'.';
    protected const EdmModel_Validator_Syntactic_MissingNamespaceName                  = 'The namespace name is missing or not valid.';
    protected const EdmModel_Validator_Syntactic_EdmModel_NamespaceNameIsTooLong       = 'The specified name must not be longer than 480 characters: \'%s\'.';
    protected const EdmModel_Validator_Syntactic_EdmModel_NamespaceNameIsNotAllowed    = 'The specified namespace name is not allowed: \'%s\'.';
    protected const EdmModel_Validator_Syntactic_PropertyMustNotBeNull                 = 'The value of the property \'%s.%s\' must not be null.';
    protected const EdmModel_Validator_Syntactic_EnumPropertyValueOutOfRange           = 'The property \'%s.%s\' of type \'%s\' has value \'%s\' that is not a valid enum member.';
    protected const EdmModel_Validator_Syntactic_InterfaceKindValueMismatch            = 'An object with the value \'%s\' of the \'%s.%s\' property must implement \'%s\' interface.';
    protected const EdmModel_Validator_Syntactic_TypeRefInterfaceTypeKindValueMismatch = 'An object implementing \'%s\' interface has type definition of kind \'%s\'. The type reference interface must match to the kind of the  definition.';
    protected const EdmModel_Validator_Syntactic_InterfaceKindValueUnexpected          = 'The value \'%s\' of the property \'%s.%s\' is not semantically valid. A semantically valid model must not contain elements of kind \'%1$s\'.';
    protected const EdmModel_Validator_Syntactic_EnumerableMustNotHaveNullElements     = 'The value of the enumeration the property \'%s.%s\' contains a null element. Enumeration properties must not contain null elements.';
    protected const EdmModel_Validator_Syntactic_NavigationPartnerInvalid              = 'The partner of the navigation property \'%s\' must not be the same property, and must point back to the navigation property.';
    protected const EdmModel_Validator_Syntactic_InterfaceCriticalCycleInTypeHierarchy = 'The chain of base types of type \'%s\' is cyclic.';

    // Error message for Serializer
    protected const Serializer_SingleFileExpected                         = 'Single file provided but model cannot be serialized into single file.';
    protected const Serializer_UnknownEdmVersion                          = 'Unknown Edm version.';
    protected const Serializer_UnknownEdmxVersion                         = 'Unknown Edmx version.';
    protected const Serializer_NonInlineFunctionImportReturnType          = 'The function import \'%s\' could not be serialized because its return type cannot be represented inline.';
    protected const Serializer_ReferencedTypeMustHaveValidName            = 'A referenced type can not be serialized with an invalid name. The name \'%s\' is invalid.';
    protected const Serializer_OutOfLineAnnotationTargetMustHaveValidName = 'The annotation can not be serialized with an invalid target name. The name \'%s\' is invalid.';
    protected const Serializer_NoSchemasProduced                          = 'No CSDL is written because no schema elements could be produced. This is likely because the model is empty.';

    protected const XmlParser_EmptyFile                           = '%s does not contain a schema definition, or the XmlReader provided started at the end of the file.';
    protected const XmlParser_EmptySchemaTextReader               = 'The source XmlReader does not contain a schema definition or started at the end of the file.';
    protected const XmlParser_MissingAttribute                    = 'Required schema attribute \'%s\' is not present on element \'%s\'.';
    protected const XmlParser_TextNotAllowed                      = 'The current schema element does not support text \'%s\'.';
    protected const XmlParser_UnexpectedAttribute                 = 'The attribute \'%s\' was not expected in the given context.';
    protected const XmlParser_UnexpectedElement                   = 'The schema element \'%s\' was not expected in the given context.';
    protected const XmlParser_UnusedElement                       = 'Unused schema element: \'%s\'.';
    protected const XmlParser_UnexpectedNodeType                  = 'Unexpected XML node type: %s.';
    protected const XmlParser_UnexpectedRootElement               = 'The element \'%s\' was unexpected for the root element. The root element should be %s.';
    protected const XmlParser_UnexpectedRootElementWrongNamespace = 'The namespace \'%s\' is invalid. The root element is expected to belong to one of the following namespaces: \'%s\'.';
    protected const XmlParser_UnexpectedRootElementNoNamespace    = 'The root element has no namespace. The root element is expected to belong to one of the following namespaces: \'%s\'.';

    // CSDL Parser
    protected const CsdlParser_InvalidAlias                                             = 'The alias \'%s\' is not a valid simple name.';
    protected const CsdlParser_AssociationHasAtMostOneConstraint                        = 'Associations may have at most one constraint. Multiple constraints were specified for this association.';
    protected const CsdlParser_InvalidDeleteAction                                      = 'The delete action \'%s\' is not valid. Action must be: \'None\', \'Cascade\', or \'Restrict\'.';
    protected const CsdlParser_MissingTypeAttributeOrElement                            = 'An XML attribute or sub-element representing an EDM type is missing.';
    protected const CsdlParser_InvalidAssociationIncorrectNumberOfEnds                  = 'The association \'%s\' is not valid. Associations must contain exactly two end elements.';
    protected const CsdlParser_InvalidAssociationSetIncorrectNumberOfEnds               = 'The association set \'%s\' is not valid. Association sets must contain at most two end elements.';
    protected const CsdlParser_InvalidConcurrencyMode                                   = 'The concurrency mode \'%s\' is not valid. Concurrency mode must be: \'None\', or \'Fixed\'.';
    protected const CsdlParser_InvalidParameterMode                                     = 'Parameter mode \'%s\' is not valid. Parameter mode must be: \'In\', \'Out\', or \'InOut\'.';
    protected const CsdlParser_InvalidEndRoleInRelationshipConstraint                   = 'There is no Role with name \'%s\' defined in relationship \'%s\'.';
    protected const CsdlParser_InvalidMultiplicity                                      = 'The multiplicity \'%s\' is not valid. Multiplicity must be: \'*\', \'0..1\', or \'1\'.';
    protected const CsdlParser_ReferentialConstraintRequiresOneDependent                = 'Referential constraints requires one dependent role. Multiple dependent roles were specified for this referential constraint.';
    protected const CsdlParser_ReferentialConstraintRequiresOnePrincipal                = 'Referential constraints requires one principal role. Multiple principal roles were specified for this referential constraint.';
    protected const CsdlParser_InvalidIfExpressionIncorrectNumberOfOperands             = 'If expression must contain 3 operands, the first being a boolean test, the second being being evaluated if the first is true, and the third being evaluated if the first is false.';
    protected const CsdlParser_InvalidIsTypeExpressionIncorrectNumberOfOperands         = 'The IsType expression must contain 1 operand.';
    protected const CsdlParser_InvalidAssertTypeExpressionIncorrectNumberOfOperands     = 'The AssertType expression must contain 1 operand.';
    protected const CsdlParser_InvalidLabeledElementExpressionIncorrectNumberOfOperands = 'The LabeledElement expression must contain 1 operand.';
    protected const CsdlParser_InvalidTypeName                                          = 'The type name \'%s\' is invalid. The type name must be that of a primitive type, a fully qualified name or an inline \'Collection\' or \'Ref\' type.';
    protected const CsdlParser_InvalidQualifiedName                                     = 'The qualified name \'%s\' is invalid. A qualified name must have a valid namespace or alias, and a valid name.';
    protected const CsdlParser_NoReadersProvided                                        = 'A model could not be produced because no XML readers were provided.';
    protected const CsdlParser_NullXmlReader                                            = 'A model could not be produced because one of the XML readers was null.';
    protected const CsdlParser_InvalidEntitySetPath                                     = '\'%s\' is not a valid entity set path.';
    protected const CsdlParser_InvalidEnumMemberPath                                    = '\'%s\' is not a valid enum member path.';
    protected const CsdlSemantics_ReferentialConstraintMismatch                         = ' There was a mismatch in the principal and dependent ends of the referential constraint.';
    protected const CsdlSemantics_EnumMemberValueOutOfRange                             = 'The enumeration member value exceeds the range of its data type \'http://www.w3.org/2001/XMLSchema:long\'.';
    protected const CsdlSemantics_ImpossibleAnnotationsTarget                           = 'The annotation target \'%s\' could not be resolved because it cannot refer to an annotatable element.';
    protected const CsdlSemantics_DuplicateAlias                                        = 'The schema \'%s\' contains the alias \'%s\' more than once.';

    // EdmxParser
    protected const EdmxParser_EdmxVersionMismatch              = 'The EDMX version specified in the \'Version\' attribute does not match the version corresponding to the namespace of the \'Edmx\' element.';
    protected const EdmxParser_EdmxDataServiceVersionInvalid    = 'The specified value of data service version is invalid.';
    protected const EdmxParser_EdmxMaxDataServiceVersionInvalid = 'The specified value of max data service version is invalid.';
    protected const EdmxParser_BodyElement                      = 'Unexpected %s element while parsing Edmx. Edmx is expected to have at most one of \'Runtime\' or \'DataServices\' elements.';

    // EdxmParseException
    protected const EdmParseException_ErrorsEncounteredInEdmx = 'Encountered the following errors when parsing the EDMX document: \r\n%s';

    // Error message for the value parser
    protected const ValueParser_InvalidBoolean        = 'The value \'%s\' is not a valid boolean. The value must be \'true\' or \'false\'.';
    protected const ValueParser_InvalidInteger        = 'The value \'%s\' is not a valid integer. The value must be a valid 32 bit integer.';
    protected const ValueParser_InvalidLong           = 'The value \'%s\' is not a valid integer. The value must be a valid 64 bit integer.';
    protected const ValueParser_InvalidFloatingPoint  = 'The value \'%s\' is not a valid floating point value. ';
    protected const ValueParser_InvalidMaxLength      = 'The value \'%s\' is not a valid integer. The value must be a valid 32 bit integer or \'Max\'.';
    protected const ValueParser_InvalidSrid           = 'The value \'%s\' is not a valid SRID. The value must either be a 32 bit integer or \'Variable\'.';
    protected const ValueParser_InvalidGuid           = 'The value \'%s\' is not a valid Guid. ';
    protected const ValueParser_InvalidDecimal        = 'The value \'%s\' is not a valid decimal.';
    protected const ValueParser_InvalidDateTimeOffset = 'The value \'%s\' is not a valid date time offset value.';
    protected const ValueParser_InvalidDateTime       = 'The value \'%s\' is not a valid date time value.';
    protected const ValueParser_InvalidTime           = 'The value \'%s\' is not a valid time value.';
    protected const ValueParser_InvalidBinary         = 'The value \'%s\' is not a valid binary value. The value must be a hexadecimal string and must not be prefixed by \'0x\'.';

    // Unknown enumerated type value errors
    protected const UnknownEnumVal_Multiplicity          = 'Invalid multiplicity: \'%s\'';
    protected const UnknownEnumVal_SchemaElementKind     = 'Invalid schema element kind: \'%s\'';
    protected const UnknownEnumVal_TypeKind              = 'Invalid type kind: \'%s\'';
    protected const UnknownEnumVal_PrimitiveKind         = 'Invalid primitive kind: \'%s\'';
    protected const UnknownEnumVal_ContainerElementKind  = 'Invalid container element kind: \'%s\'';
    protected const UnknownEnumVal_EdmxTarget            = 'Invalid edmx target: \'%s\'';
    protected const UnknownEnumVal_FunctionParameterMode = 'Invalid function parameter mode: \'%s\'';
    protected const UnknownEnumVal_ConcurrencyMode       = 'Invalid concurrency mode: \'%s\'';
    protected const UnknownEnumVal_PropertyKind          = 'Invalid property kind: \'%s\'';
    protected const UnknownEnumVal_TermKind              = 'Invalid term kind: \'%s\'';
    protected const UnknownEnumVal_ExpressionKind        = 'Invalid expression kind: \'%s\'';
    // Error message for 'Bad' types
    protected const Bad_AmbiguousElementBinding     = 'The name \'%s\' is ambiguous.';
    protected const Bad_UnresolvedType              = 'The type \'%s\' could not be found.';
    protected const Bad_UnresolvedComplexType       = 'The complex type \'%s\' could not be found.';
    protected const Bad_UnresolvedEntityType        = 'The entity type \'%s\' could not be found.';
    protected const Bad_UnresolvedPrimitiveType     = 'The primitive type \'%s\' could not be found.';
    protected const Bad_UnresolvedFunction          = 'The function \'%s\' could not be found.';
    protected const Bad_AmbiguousFunction           = 'The function \'%s\' could not be resolved because more than one function could be used for this application.';
    protected const Bad_FunctionParametersDontMatch = 'The function \'%s\' could not be resolved because none of the functions with that name take the correct set of parameters.';
    protected const Bad_UnresolvedEntitySet         = 'The entity set \'%s\' could not be found.';
    protected const Bad_UnresolvedEntityContainer   = 'The entity container \'%s\' could not be found.';
    protected const Bad_UnresolvedEnumType          = 'The enum type \'%s\' could not be found.';
    protected const Bad_UnresolvedEnumMember        = 'The enum member \'%s\' could not be found.';
    protected const Bad_UnresolvedProperty          = 'The property \'%s\' could not be found.';
    protected const Bad_UnresolvedParameter         = 'The parameter \'%s\' could not be found.';
    protected const Bad_UnresolvedLabeledElement    = 'The labeled element \'%s\' could not be found.';
    protected const Bad_CyclicEntity                = 'The entity \'%s\' is invalid because its base type is cyclic.';
    protected const Bad_CyclicComplex               = 'The complex type \'%s\' is invalid because its base type is cyclic.';
    protected const Bad_CyclicEntityContainer       = 'The entity container \'%s\' is invalid because its extends hierarchy is cyclic.';
    protected const Bad_UncomputableAssociationEnd  = 'The association end \'%s\' could not be computed.';

    // Error messages for validation rulesets
    protected const RuleSet_DuplicateRulesExistInRuleSet = 'The same rule cannot be in the same rule set twice.';

    // Error messages for EDM to PHP conversion
    protected const EdmToClr_UnsupportedTypeCode                        = 'Conversion of EDM values to a PHP type with type code %s is not supported.';
    protected const EdmToClr_StructuredValueMappedToNonClass            = 'Conversion of an EDM structured value is supported only to a PHP class.';
    protected const EdmToClr_IEnumerableOfTPropertyAlreadyHasValue      = 'Cannot initialize a property \'%s\' on an object of type \'%s\'. The property already has a value.';
    protected const EdmToClr_StructuredPropertyDuplicateValue           = 'An EDM structured value contains multiple values for the property \'%s\'. Conversion of an EDM structured value with duplicate property values is not supported.';
    protected const EdmToClr_CannotConvertEdmValueToClrType             = 'Conversion of an EDM value of the type \'%s\' to the PHP type \'%s\' is not supported.';
    protected const EdmToClr_CannotConvertEdmCollectionValueToClrType   = 'Conversion of an edm collection value to the PHP type \'%s\' is not supported.';
    protected const EdmToClr_TryCreateObjectInstanceReturnedWrongObject = 'The type \'%s\' of the object returned by the TryCreateObjectInstance delegate is not assignable to the expected type \'%s\'.';


    public static function __callStatic($name, $arguments): string
    {
        $array = static::toArray();
        if (isset($array[$name])) {
            return sprintf($array[$name], ...$arguments);
        }
        throw new BadMethodCallException("No static method or string constant '$name' in class " . static::class);
    }

    /**
     * Store existing constants in a static cache per object.
     */
    protected static $cache = [];
    /**
     * Returns all possible values as an array.
     * @return array<string, string> Constant name in key, constant value in value
     */
    protected static function toArray(): array
    {
        $class = static::class;

        if (!isset(static::$cache[$class])) {
            try {
                $reflection = new ReflectionClass($class);
            } catch (ReflectionException $e) {
                return [];
            }
            static::$cache[$class] = $reflection->getConstants();
        }

        return static::$cache[$class];
    }
}
