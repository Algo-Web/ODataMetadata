<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation;

use MyCLabs\Enum\Enum;

/**
 * Class EdmErrorCode
 *
 * EdmLib validation error codes
 *
 * @package AlgoWeb\ODataMetadata\Validation
 * @method static self BadAmbiguousElementBinding()
 * @method static self TypeSemanticsCouldNotConvertTypeReference()
 * @method static self BadCyclicComplex()
 * @method static self BadCyclicEntityContainer()
 * @method static self BadCyclicEntity()
 * @method static self InvalidName()
 * @method static self NameTooLong()
 * @method static self InvalidNamespaceName()
 * @method static self SystemNamespaceEncountered()
 * @method static self RowTypeMustNotHaveBaseType()
 * @method static self ReferencedTypeMustHaveValidName()
 * @method static self FunctionImportEntitySetExpressionIsInvalid()
 * @method static self FunctionImportParameterIncorrectType()
 * @method static self OnlyInputParametersAllowedInFunctions()
 * @method static self InvalidFunctionImportParameterMode()
 * @method static self TypeMustNotHaveKindOfNone()
 * @method static self PrimitiveTypeMustNotHaveKindOfNone()
 * @method static self PropertyMustNotHaveKindOfNone()
 * @method static self TermMustNotHaveKindOfNone()
 * @method static self SchemaElementMustNotHaveKindOfNone()
 * @method static self EntityContainerElementMustNotHaveKindOfNone()
 * @method static self BinaryValueCannotHaveEmptyValue()
 * @method static self EnumMustHaveIntegerUnderlyingType()
 * @method static self EnumMemberTypeMustMatchEnumUnderlyingType()
 * @method static self InvalidElementAnnotation()
 * @method static self InterfaceCriticalPropertyValueMustNotBeNull()
 * @method static self InterfaceCriticalCycleInTypeHierarchy()
 * @method static UnknownEdmxVersion()
 * @method static UnknownEdmVersion()
 * @method static BadUnresolvedFunction()
 */
class EdmErrorCode extends Enum
{
    /**
     * Invalid error code
     */
    protected const InvalidErrorCodeValue = 0;

    /**
     * References to EDM stream type are not supported before version 3.0.
     */
    protected const StreamTypeReferencesNotSupportedBeforeV3 = 1;

    // SecurityError = 2;

    /**
     * References to EDM spatial types are not supported before version 3.0.
     */
    protected const SpatialTypeReferencesNotSupportedBeforeV3 = 3;

    // IOException = 4;

    /**
     * An exception was thrown by the underlying xml reader.
     */
    protected const XmlError = 5;

    // TooManyErrors = 6;
    // MalformedXml = 7;

    /**
     * Encountered an XML node that was never used
     */
    protected const UnexpectedXmlNodeType = 8;

    /**
     * Encountered an XML attribute that was never used
     */
    protected const UnexpectedXmlAttribute = 9;

    /**
     * Encountered an XML element that was never used
     */
    protected const UnexpectedXmlElement = 10;

    /**
     * Text was found in a location it was not allowed in
     */
    protected const TextNotAllowed = 11;

    /**
     * An empty file was provided to the parser
     */
    protected const EmptyFile = 12;

    // protected const XsdError = 13;
    // protected const InvalidAlias = 14;

    /**
     * An XML element was missing a required attribute
     */
    protected const MissingAttribute = 15;

    //protected const IntegerExpected = 16;

    /**
     * Invalid Name
     */
    protected const InvalidName = 17;

    /**
     * An XML attribute or element representing EDM type is missing.
     */
    protected const MissingType = 18;

    /**
     * Element name is already defined in this context.
     */
    protected const AlreadyDefined = 19;

    // protected const ElementNotInSchema = 20;
    // unused 21;
    // protected const InvalidBaseType = 22;
    // protected const NoConcreteDescendants = 23;
    // 24;

    /**
     * The specified version number is not valid.
     */
    protected const InvalidVersionNumber = 25;

    protected const InvalidSize = 26;

    /**
     * Malformed boolean value.
     */
    protected const InvalidBoolean = 27;

    // unused 28;
    //protected const  BadType = 29;
    // unused 30;
    // unused 31;
    // protected const InvalidVersioningClass = 32;
    // protected const InvalidVersionIntroduced = 33;
    // protected const BadNamespace = 34;
    // unused 35;
    // unused 36;
    // unused 37;
    // protected const UnresolvedReferenceSchema = 38;
    // unused 39;
    //protected const  NotInNamespace = 40;
    //protected const  NotUnnestedType = 41;

    /**
     * The property contains an error.
     */
    protected const BadProperty = 42;

    // UndefinedProperty = 43;

    /**
     * The type of this property is invalid for the given context.
     */
    protected const InvalidPropertyType = 44;

    // protected const InvalidAsNestedType = 45;
    // protected const InvalidChangeUnit = 46;
    // protected const UnauthorizedAccessException = 47;
    // unused 48;
    // unused 49;
    // unused 50;

    /**
     * Precision out of range
     */
    protected const PrecisionOutOfRange = 51;

    /**
     * Scale out of range
     */
    protected const ScaleOutOfRange = 52;

    // protected const DefaultNotAllowed = 53;
    // protected const InvalidDefault = 54;
    /**
     * One of the required facets is missing
     */
    // protected const RequiredFacetMissing = 55;
    // protected const BadImageFormatException = 56;
    // protected const MissingSchemaXml = 57;
    // protected const BadPrecisionAndScale = 58;
    // protected const InvalidChangeUnitUsage = 59;

    /**
     * Name is too long.
     */
    protected const NameTooLong = 60;

    // CircularlyDefinedType = 61;

    /**
     * The provided association is invalid
     */
    protected const InvalidAssociation = 62;

    /**
     * The facet isn't allow by the property type.
     */
    // protected const FacetNotAllowedByType = 63;
    /**
     * This facet value is constant and is specified in the schema
     */
    // protected const ConstantFacetSpecifiedInSchema = 64;
    // unused 65;
    // unused 66;
    // unused 67;
    // unused 68;
    // unused 69;
    // unused 70;
    // unused 71;
    // unused 72;
    // unused 73;

    /**
     * Navigation property contains errors.
     */
    protected const BadNavigationProperty = 74;

    /**
     * Entity key is invalid.
     */
    protected const InvalidKey = 75;

    /**
     * The value of the property must not be null.
     */
    protected const InterfaceCriticalPropertyValueMustNotBeNull = 76;

    /**
     * An object with an interface kind property does not implement the interface corresponding to the value of that
     * property. For example this error will be reported for an object that implements @see IType interface with kind
     * property reporting @see=TypeKind::Entity;
     * but does not implement @see="IEntityType" interface.
     */
    protected const InterfaceCriticalKindValueMismatch = 77;

    /**
     * The value of an interface kind property is not semantically valid. A semantically valid model must not contain
     * elements of kind 'None'.
     */
    protected const InterfaceCriticalKindValueUnexpected = 78;

    /**
     * An enumeration property must not contain null elements.
     */
    protected const InterfaceCriticalEnumerableMustNotHaveNullElements = 79;

    /**
     * The value of the enum type property is out of range.
     */
    protected const InterfaceCriticalEnumPropertyValueOutOfRange = 80;

    /**
     * If property P1 is a navigation property and P2 is its parnter; then partner property of P2 must be P1.
     */
    protected const InterfaceCriticalNavigationPartnerInvalid = 81;

    /**
     * A chain of base types is cyclic.
     */
    protected const InterfaceCriticalCycleInTypeHierarchy = 82;

    // reserved for critical structural errors 83;
    // reserved for critical structural errors 84;
    // reserved for critical structural errors 85;
    // reserved for critical structural errors 86;
    // reserved for critical structural errors 87;
    // reserved for critical structural errors 88;
    // reserved for critical structural errors 89;
    // reserved for critical structural errors 90;
    // reserved for critical structural errors 91;

    /**
     * Multiplicity value was malformed
     */
    protected const InvalidMultiplicity = 92;

    // unused = 93
    // unused = 94
    // unused = 95

    /**
     * The value for the Action attribute is invalid or not allowed in the current context
     */
    protected const InvalidAction = 96;

    /**
     * An error occured processing the OnDelete element
     */
    protected const InvalidOnDelete = 97;

    /**
     * No complex type with that name exists.
     */
    protected const BadUnresolvedComplexType = 98;

    //**Ends were given for the Property element of a EntityContainer that is not a RelationshipSet</summary>
    // InvalidContainerTypeForEnd = 99;

    /**
     * The extent name used in the EntittyContainerType End does not match the name of any of the EntityContainerProperties in the containing EntityContainer
     */
    protected const InvalidEndEntitySet = 100;

    /**
     * An end element was not given; and cannot be inferred because too many EntityContainerEntitySet elements that
     * are good possibilities.
     */
    // protected const AmbiguousEntityContainerEnd = 101;
    /**
     * An end element was not given; and cannot be infered because there is no EntityContainerEntitySets that are
     * the correct type to be used as an EntitySet.
     */
    // protected const MissingExtentEntityContainerEnd = 102;

    /**
     * Function import specifies an entity set expression which is not supported in this context. Function import
     * entity set expression can be either an entity set reference or a path starting with a function import
     * parameter and traversing navigation properties.
     */
    protected const FunctionImportEntitySetExpressionIsInvalid = 103;

    // unused 104;
    // unused 105;
    /**
     * Not a valid parameter direction for the parameter in a function
     */
    // protected const BadParameterDirection = 106;
    /**
     * Unable to infer an optional schema part; to resolve this; be more explicit
     */
    // protected const FailedInference = 107;
    // unused = 108;

    /**
     * The target entity set must be able to hold an entity that is valid for the navigation property of a mapping.
     */
    protected const EntitySetNavigationPropertyMappingMustPointToValidTargetForProperty = 109;

    /**
     * Invalid role value in the relationship constraint
     */
    protected const InvalidRoleInRelationshipConstraint = 110;

    /**
     * Invalid Property in relationship constraint
     */
    protected const InvalidPropertyInRelationshipConstraint = 111;

    /**
     * Type mismatch between ToProperty and FromProperty in the relationship constraint
     */
    protected const TypeMismatchRelationshipConstraint = 112;

    /**
     * Invalid multiplicty of the principal end of a navigation.
     */
    protected const InvalidMultiplicityOfPrincipalEnd = 113;

    /**
     * The number of properties in the FromProperty and ToProperty in the relationship constraint must be identical
     */
    protected const MismatchNumberOfPropertiesInRelationshipConstraint = 114;

    //** No Properties defined in either FromProperty or ToProperty in the relationship constraint</summary>
    // MissingPropertyInRelationshipConstraint = 115;

    /**
     * Invalid multiplicty of the dependent end of a navigation.
     */
    protected const InvalidMultiplicityOfDependentEnd = 116;

    /**
     * Open types are supported only in version 1.2 and after version 2.0. Only entity types can be open.
     */
    protected const OpenTypeNotSupported = 117;

    /**
     * Vocabulary annotations are not supported before EDM 3.0
     */
    protected const VocabularyAnnotationsNotSupportedBeforeV3 = 118;

    /**
     * Same role referred in the ToRole and FromRole of a referential constraint
     */
    protected const SameRoleReferredInReferentialConstraint = 119;

    /**
     * Invalid value for attribute ParameterTypeSemantics
     */
    // protected const InvalidValueForParameterTypeSemantics = 120;
    /**
     * Invalid type used for a Relationship End Type
     */
    // protected const InvalidRelationshipEndType = 121;
    /**
     * Invalid PrimitiveTypeKind
     */
    // protected const InvalidPrimitiveTypeKind = 122;
    // unused 123;
    /**
     * Invalid TypeConversion DestinationType
     */
    // protected const InvalidTypeConversionDestinationType = 124;
    /**
     * Expected a integer value between 0 - 255
     */
    // protected const ByteValueExpected = 125;
    /**
     * Invalid Type specified in function
     */
    // protected const FunctionWithNonScalarTypeNotSupported = 126;
    /**
     * Precision must not be greater than 28
     */
    // protected const PrecisionMoreThanAllowedMax = 127;

    /**
     * Properties that are part of entity key must be of scalar type
     */
    protected const EntityKeyMustBeScalar = 128;

    /**
     * Binary type properties which are part of entity key are currently supported before V2.0
     */
    protected const EntityKeyMustNotBeBinary = 129;

    /**
     * The primitive type kind does not have a prefered mapping
     */
    // protected const NoPreferredMappingForPrimitiveTypeKind = 130;
    /**
     * More than one PreferredMapping for a PrimitiveTypeKind
     */
    // protected const TooManyPreferredMappingsForPrimitiveTypeKind = 131;

    /**
     * End with * multiplicity cannot have operations specified
     */
    protected const EndWithManyMultiplicityCannotHaveOperationsSpecified = 132;

    /**
     * EntitySet type has no keys
     */
    protected const EntitySetTypeHasNoKeys = 133;

    /**
     * Invalid Number Of Parameters For Aggregate Function
     */
    // protected const InvalidNumberOfParametersForAggregateFunction = 134;
    /**
     * Invalid Parameter Type For Aggregate Function
     */
    // protected const InvalidParameterTypeForAggregateFunction = 135;
    /**
     * Composable functions must declare a return type.
     */
    // protected const ComposableFunctionWithoutReturnType = 136;
    /**
     * Non-composable functions must not declare a return type.
     */
    // protected const NonComposableFunctionWithReturnType = 137;
    /**
     * Non-composable functions do not permit the aggregate; niladic; or built-in attributes.
     */
    // protected const NonComposableFunctionAttributesNotValid = 138;
    /**
     * Composable functions can not include command text attribute.
     */
    // protected const ComposableFunctionWithCommandText = 139;
    /**
     * Functions should not declare both a store name and command text (only one or the other can be used).
     */
    // protected const FunctionDeclaresCommandTextAndStoreFunctionName = 140;
    /**
     * System Namespace
     */
    // protected const SystemNamespace = 141;
    /**
     * Empty DefiningQuery text
     */
    // protected const EmptyDefiningQuery = 142;
    /**
     * Schema, Table and DefiningQuery are all specified, and are mutualy exlusive
     */
    // protected const  TableAndSchemaAreMutuallyExclusiveWithDefiningQuery = 143;

    /**
     * ConcurrencyMode value was malformed
     */
    protected const InvalidConcurrencyMode = 144;

    /**
     * Conurency can't change for any sub types of an EntitySet type.
     */
    protected const ConcurrencyRedefinedOnSubtypeOfEntitySetType = 145;

    /**
     * In version 1.0 function import can have no return type or return a collection of scalars or a collection of entities.
     * In all other versions function import can have no return type or return a scalar; a complex type; an entity type or a collection of those.
     */
    protected const FunctionImportUnsupportedReturnType = 146;

    /**
     * Composable function import cannot be side-effecting.
     */
    protected const ComposableFunctionImportCannotBeSideEffecting = 147;

    /**
     * Function import specifies entity type return but no entity set.
     */
    protected const FunctionImportReturnsEntitiesButDoesNotSpecifyEntitySet = 148;

    /**
     * Function import specifies entity type that does not derive from element type of entity set.
     */
    protected const FunctionImportEntityTypeDoesNotMatchEntitySet = 149;

    /**
     * Function import specifies a binding to an entity set but does not return entities.
     */
    protected const FunctionImportSpecifiesEntitySetButDoesNotReturnEntityType = 150;

    /**
     * A composable function import must have return type.
     */
    protected const ComposableFunctionImportMustHaveReturnType = 152;

    /**
     * Same Entity Set Taking part in the same role of the relationship set in two different relationship sets
     */
    protected const SimilarRelationshipEnd = 153;

    /**
     * Entity key refers to the same property twice
     */
    protected const DuplicatePropertySpecifiedInEntityKey = 154;

    //** Function declares a ReturnType attribute and element</summary>
    // AmbiguousFunctionReturnType = 156;

    /**
     * Nullable complex Type not supported in version 1.0 and 2.0.
     */
    protected const NullableComplexTypeProperty = 157;

    //** Only Complex Collections supported in Edm V1.1</summary>
    // NonComplexCollections = 158;

    /**
     * No Key defined on Entity Type
     */
    protected const KeyMissingOnEntityType = 159;

    //** Invalid namespace specified in using element</summary>
    // InvalidNamespaceInUsing = 160;

    /**
     * Need not specify system namespace in using
     */
    protected const SystemNamespaceEncountered = 161;

    //** Cannot use a reserved/system namespace as alias </summary>
    // CannotUseSystemNamespaceAsAlias = 162;

    /**
     * Invalid qualification specified for type
     */
    protected const InvalidNamespaceName = 163;

    /**
     * Invalid Entity Container Name in extends attribute
     */
    // protected const InvalidEntityContainerNameInExtends = 164;
    /**
     * Invalid CollectionKind value in property CollectionKind attribute
     */
    // protected const InvalidCollectionKind = 165;
    /**
     * Must specify namespace or alias of the schema in which this type is defined
     */
    // protected const InvalidNamespaceOrAliasSpecified = 166;
    /**
     * Entity Container cannot extend itself
     */
    // protected const EntityContainerCannotExtendItself = 167;
    /**
     * Failed to retrieve provider manifest
     */
    // protected const FailedToRetrieveProviderManifest = 168;
    /**
     * Mismatched Provider Manifest token values in SSDL artifacts
     */
    // protected const ProviderManifestTokenMismatch = 169;
    /**
     * Missing Provider Manifest token value in SSDL artifact(s)
     */
    // protected const ProviderManifestTokenNotFound = 170;
    /**
     * Empty CommandText element
     */
    //protected const  EmptyCommandText = 171;
    /**
     * Inconsistent Provider values in SSDL artifacts
     */
    // protected const InconsistentProvider = 172;
    /**
     * Inconsistent Provider Manifest token values in SSDL artifacts
     */
    // protected const InconsistentProviderManifestToken = 173;
    /**
    // Duplicated Function overloads
     */
    // protected const DuplicatedFunctionoverloads = 174;
    /**
     * Invalid Provider
     */
    // protected const InvalidProvider = 175;
    /**
     * Function With Non Edm Type Not Supported
     */
    // protected const FunctionWithNonEdmTypeNotSupported = 176;
    /**
     * Complex Type As Return Type And Defined Entity Set
     */
    // protected const ComplexTypeAsReturnTypeAndDefinedEntitySet = 177;
    /**
     * Complex Type As Return Type And Defined Entity Set
     */
    // protected const ComplexTypeAsReturnTypeAndNestedComplexProperty = 178;
// unused 179;
// unused 180;
// unused 181;
    /**
     * In model functions facet attribute is allowed only on ScalarTypes
     */
    // protected const FacetOnNonScalarType = 182;
    /**
     * Captures several conditions where facets are placed on element where it should not exist.
     */
    // protected const IncorrectlyPlacedFacet = 183;
    /**
     * Return type has not been declared
     */
    // protected const ReturnTypeNotDeclared = 184;
    // protected const TypeNotDeclared = 185;
    // protected const RowTypeWithoutProperty = 186;
    // protected const ReturnTypeDeclaredAsAttributeAndElement = 187;
    // protected const TypeDeclaredAsAttributeAndElement = 188;
    // protected const ReferenceToNonEntityType = 189;
    /**
     * Invalid value in the EnumTypeOption
     */
    // protected const InvalidValueInEnumOption = 190;
    // protected const IncompatibleSchemaVersion = 191;
    /**
     * The structural annotation cannot use codegen namespaces
     */
    // protected const NoCodeGenNamespaceInStructuralAnnotation = 192;
    /**
     * Function and type cannot have the same fully qualified name
     */
    // protected const AmbiguousFunctionAndType = 193;
    /**
     * Cannot load different version of schema in the same ItemCollection
     */
    // protected const  CannotLoadDifferentVersionOfSchemaInTheSameItemCollection = 194;
    /**
     * Expected bool value
     */
    // protected const BoolValueExpected = 195;
    /**
     * End without Multiplicity specified
     */
    // protected const EndWithoutMultiplicity = 196;
    /**
     * In SSDL, if composable function returns a collection of rows (TVF), all row properties must be of scalar types.
     */
    // protected const TVFReturnTypeRowHasNonScalarProperty = 197;
    /**
     * The name of NamedEdmItem must not be empty or white space only
     */
    // protected const EdmModel_NameMustNotBeEmptyOrWhiteSpace = 198;
    /**
     * EdmTypeReference is empty
     */
// Unused 199;
    // protected const EdmAssociationType_AssociationEndMustNotBeNull = 200;
    // protected const EdmAssociationConstraint_DependentEndMustNotBeNull = 201;
    // protected const EdmAssociationConstraint_DependentPropertiesMustNotBeEmpty = 202;
    // protected const EdmNavigationProperty_AssociationMustNotBeNull = 203;
    // protected const EdmNavigationProperty_ResultEndMustNotBeNull = 204;
    // protected const EdmAssociationEnd_EntityTypeMustNotBeNull = 205;

    /**
     * The value for an enumeration type member is ouf of range.
     */
    protected const EnumMemberValueOutOfRange = 206;

    // protected const EdmAssociationSet_ElementTypeMustNotBeNull = 207;
    // protected const EdmAssociationSet_SourceSetMustNotBeNull = 208;
    // protected const EdmAssociationSet_TargetSetMustNotBeNull = 209;
    // protected const EdmFunctionImport_ReturnTypeMustBeCollectionType = 210;
    // protected const EdmModel_NameIsNotAllowed = 211;
    // protected const EdmTypeReferenceNotValid = 212;
    // protected const EdmFunctionNotExistsInV1 = 213;
    // protected const EdmFunctionNotExistsInV1_1 = 214;
    // protected const Serializer_OneNamespaceAndOneContainer = 215;
    // protected const EdmModel_Validator_Semantic_InvalidEdmTypeReference = 216;
    // protected const EdmModel_Validator_TypeNameAlreadyDefinedDuplicate = 217;

    /**
     * The entity container name has already been assigned to a different entity container.
     */
    protected const DuplicateEntityContainerMemberName = 218;

    // EdmFunction_UnsupportedParameterType = 219;

    /**
     * Complex types were not allowed to be abstract here.
     */
    protected const InvalidAbstractComplexType = 220;

    /**
     * Complex types cannot have base types in this version.
     */
    protected const InvalidPolymorphicComplexType = 221;

    /**
     * A navigation property without direct containment cannot contain its declaring entity indirectly.
     */
    protected const NavigationPropertyEntityMustNotIndirectlyContainItself = 222;

    /**
     * If a navigation property mapping is of a recursive navigation property; the mapping must point back to the same entity set.
     */
    protected const EntitySetRecursiveNavigationPropertyMappingsMustPointBackToSourceEntitySet = 223;

    /**
     * Name collision makes this name ambiguous.
     */
    protected const BadAmbiguousElementBinding = 224;

    /**
     * Could not find a type with this name.
     */
    protected const BadUnresolvedType = 225;

    /**
     * Could not find a primitive type with this name.
     */
    protected const BadUnresolvedPrimitiveType = 226;
    /**
     * This complex type is part of a cycle.
     */
    protected const BadCyclicComplex = 227;

    /**
     * This Entity Container is bad because some part of its extends hierarchy is part of a cycle.
     */
    protected const BadCyclicEntityContainer = 228;

    /**
     * This entity type is part of a cycle.
     */
    protected const BadCyclicEntity = 229;

    /**
     * Could not convert type reference to the requested type.
     */
    protected const TypeSemanticsCouldNotConvertTypeReference = 230;

    /**
     * This entity set became invalid because the entity that it was of the type of was removed from the model.
     */
    protected const ConstructibleEntitySetTypeInvalidFromEntityTypeRemoval = 231;

    /**
     * Could not find an EntityContainer with that name.
     */
    protected const BadUnresolvedEntityContainer = 232;

    /**
     * Could not find an EntitySet with that name.
     */
    protected const BadUnresolvedEntitySet = 233;

    /**
     * Could not find a property with that name
     */
    protected const BadUnresolvedProperty = 234;

    /**
     * Could not find an association end with that name
     */
    protected const BadNonComputableAssociationEnd = 235;

    /**
     * Type of the navigation property was invalid because the association of the navigation property was invalid.
     */
    protected const NavigationPropertyTypeInvalidBecauseOfBadAssociation = 236;

    /**
     * The base type of an entity must also be an entity.
     */
    protected const EntityMustHaveEntityBaseType = 237;

    /**
     * The base type of a complex type must also be complex.
     */
    protected const ComplexTypeMustHaveComplexBaseType = 238;

    /**
     * Could not find a function with this name.
     */
    protected const BadUnresolvedFunction = 239;

    /**
     * Rows cannot have base types.
     */
    protected const RowTypeMustNotHaveBaseType = 240;

    /**
     * The role of an association set end must be an association end belonging to the association type that defines the associaiton set.
     */
    protected const AssociationSetEndRoleMustBelongToSetElementType = 241;

    /**
     * Every property in an entity key must be a property of the entity.
     */
    protected const KeyPropertyMustBelongToEntity = 242;

    /**
     * The principal end of a referential constraint must be one of the ends of the association that defined the referential constraint.
     */
    protected const ReferentialConstraintPrincipalEndMustBelongToAssociation = 243;

    /**
     * Dependent properties of a referential constraint must belong to the dependent entity set.
     */
    protected const DependentPropertiesMustBelongToDependentEntity = 244;

    /**
     * If a structured type declares a property; that properties declaring type must be the declaring structured type.
     */
    protected const DeclaringTypeMustBeCorrect = 245;

    /**
     * Functions are not supported before version 2.0.
     */
    protected const FunctionsNotSupportedBeforeV2 = 256;

    /**
     * Value terms are not supported before EDM 3.0
     */
    protected const ValueTermsNotSupportedBeforeV3 = 257;

    /**
     * Navigation property has a type that is not an entity or collection of entities.
     */
    protected const InvalidNavigationPropertyType = 258;

    // unused 259

    // unused 260

    /**
     * Underlying type of the enumeration type is bad because the enumeration type is bad.
     */
    protected const UnderlyingTypeIsBadBecauseEnumTypeIsBad = 261;

    /**
     * The type of the entity set on this association end is inconsistent with the association end.
     */
    protected const InvalidAssociationSetEndSetWrongType = 262;

    /**
     * Only function parameters with mode of In are allowed in function imports.
     */
    protected const OnlyInputParametersAllowedInFunctions = 263;

    /**
     * Complex types must contain at least one property.
     */
    protected const ComplexTypeMustHaveProperties = 264;

    /**
     * Unsupported function import parameter type.
     */
    protected const FunctionImportParameterIncorrectType = 265;

    /**
     * A row type must contain at least one property.
     */
    protected const RowTypeMustHaveProperties = 266;

    /**
     * A referential constraint cannot have multiple dependent properties with the same name.
     */
    protected const DuplicateDependentProperty = 267;

    /**
     * Bindable function import must have at least one parameter.
     */
    protected const BindableFunctionImportMustHaveParameters = 268;

    /**
     * Function imports with side-effecting setting are not supported before version 3.0.
     */
    protected const FunctionImportSideEffectingNotSupportedBeforeV3 = 269;

    /**
     * Function imports with composable setting are not supported before version 3.0.
     */
    protected const FunctionImportComposableNotSupportedBeforeV3 = 270;

    /**
     * Function imports with bindable setting are not supported before version 3.0.
     */
    protected const FunctionImportBindableNotSupportedBeforeV3 = 271;

    /**
     * Max length is out of range.
     */
    protected const MaxLengthOutOfRange = 272;

    /**
     * Binding context for Path expression does not supply an entity type
     */
    protected const PathExpressionHasNoEntityContext = 274;

    /**
     * Invalid value for SRID
     */
    protected const InvalidSrid = 275;

    /**
     * Invalid value for max length
     */
    protected const InvalidMaxLength = 276;

    /**
     * Invalid value for long
     */
    protected const InvalidLong = 277;

    /**
     * Invalid value for integer
     */
    protected const InvalidInteger = 278;

    /**
     * Invalid association set
     */
    protected const InvalidAssociationSet = 279;

    /**
     * Invalid parameter mode
     */
    protected const InvalidParameterMode = 280;

    /**
     * No entity type with that name exists.
     */
    protected const BadUnresolvedEntityType = 281;

    /**
     * Value is invalid
     */
    protected const InvalidValue = 282;

    /**
     * Binary value is invalid.
     */
    protected const InvalidBinary = 283;

    /**
     * Floating point value is invalid.
     */
    protected const InvalidFloatingPoint = 284;

    /**
     * DateTime value is invalid.
     */
    protected const InvalidDateTime = 285;

    /**
     * DateTimeOffset value is invalid.
     */
    protected const InvalidDateTimeOffset = 286;

    /**
     * Decimal value is invalid.
     */
    protected const InvalidDecimal = 287;

    /**
     * Guid value is invalid.
     */
    protected const InvalidGuid = 288;

    /**
     * The type kind None is not semantically valid. A semantically valid model must not contain elements of type kind None.
     */
    protected const InvalidTypeKindNone = 289;

    /**
     * The if expression is invalid because it does not have 3 elements.
     */
    protected const InvalidIfExpressionIncorrectNumberOfOperands = 290;

    /**
     * Enums were present in a model with a version below 3.0
     */
    protected const EnumsNotSupportedBeforeV3 = 291;

    /**
     * The type of an enum member value must match the underlying of the parent enum.
     */
    protected const EnumMemberTypeMustMatchEnumUnderlyingType = 292;

    /**
     * The IsType expression is invalid because it does not have 1 element.
     */
    protected const InvalidIsTypeExpressionIncorrectNumberOfOperands = 293;

    /**
     * The type name is not fully qualified and not a primitive.
     */
    protected const InvalidTypeName = 294;

    /**
     * The term name is not fully qualified.
     */
    protected const InvalidQualifiedName = 295;

    /**
     * No model was parsed because no XmlReaders were provided.
     */
    protected const NoReadersProvided = 296;

    /**
     * Model could not be parsed because one of the XmlReaders was null.
     */
    protected const NullXmlReader = 297;

    /**
     * IsUnbounded cannot be true if MaxLength is non-null.
     */
    protected const IsUnboundedCannotBeTrueWhileMaxLengthIsNotNull = 298;

    /**
     * ImmediateValueAnnotation is invalid as an element annotation.
     */
    protected const InvalidElementAnnotation = 299;

    /**
     * The LabeledElement expression is invalid because it does not have 1 element.
     */
    protected const InvalidLabeledElementExpressionIncorrectNumberOfOperands = 300;

    /**
     * Could not find a LabeledElement with that name
     */
    protected const BadUnresolvedLabeledElement = 301;

    /**
     * Could not find a enum member with that name
     */
    protected const BadUnresolvedEnumMember = 302;

    /**
     * The AssertType expression is invalid because it does not have 1 element.
     */
    protected const InvalidAssertTypeExpressionIncorrectNumberOfOperands = 303;

    /**
     * Could not find a Parameter with that name
     */
    protected const BadUnresolvedParameter = 304;

    /**
     * A navigation property with <see cref="IEdmNavigationProperty.ContainsTarget"/> = true must point to an optional target.
     */
    protected const NavigationPropertyWithRecursiveContainmentTargetMustBeOptional = 305;

    /**
     * If a navigation property has <see cref="IEdmNavigationProperty.ContainsTarget"/> = true and the target entity type is the same as
     * the declaring type of the property; then the multiplicity of the source of navigation is Zero-Or-One.
     */
    protected const NavigationPropertyWithRecursiveContainmentSourceMustBeFromZeroOrOne = 306;

    /**
     * If a navigation property has <see cref="IEdmNavigationProperty.ContainsTarget"/> = true and the target entity type is defferent than
     * the declaring type of the property; then the multiplicity of the source of navigation is One.
     */
    protected const NavigationPropertyWithNonRecursiveContainmentSourceMustBeFromOne = 307;

    /**
     * Navigation properties with <see cref="IEdmNavigationProperty.ContainsTarget"/> setting are not supported before version 3.0.
     */
    protected const NavigationPropertyContainsTargetNotSupportedBeforeV3 = 308;

    /**
     * The annotation target path cannot possibly refer to an annotable element.
     */
    protected const ImpossibleAnnotationsTarget = 309;

    /**
     * A nullable type is not valid if a non-nullable type is required.
     */
    protected const CannotAssertNullableTypeAsNonNullableType = 310;

    /**
     * The expression is a primitive constant; and cannot be valid for an non-primitive type.
     */
    protected const CannotAssertPrimitiveExpressionAsNonPrimitiveType = 311;

    /**
     * The primitive type is not valid for the requested type.
     */
    protected const ExpressionPrimitiveKindNotValidForAssertedType = 312;

    /**
     * Null is not valid in a non nullable expression.
     */
    protected const NullCannotBeAssertedToBeANonNullableType = 313;

    /**
     * The expression is not valid for the asserted type.
     */
    protected const ExpressionNotValidForTheAssertedType = 314;

    /**
     * A collection expression is not valid for a non-collection type.
     */
    protected const CollectionExpressionNotValidForNonCollectionType = 315;

    /**
     * A record expression is not valid for a non-structured type.
     */
    protected const RecordExpressionNotValidForNonStructuredType = 316;

    /**
     * The record expression does not have all of the properties required for the specified type.
     */
    protected const RecordExpressionMissingRequiredProperty = 317;

    /**
     * The record expression's type is not open; but the record expression has extra properties.
     */
    protected const RecordExpressionHasExtraProperties = 318;

    /**
     * Target has multiple annotations with the same term and same qualifier.
     */
    protected const DuplicateAnnotation = 319;

    /**
     * Function application has wrong number of arguments for the function being applied.
     */
    protected const IncorrectNumberOfArguments = 320;

    /**
     * Is it invalid to have multiple using statements with the same alias in a single schema element.
     */
    protected const DuplicateAlias = 321;

    /**
     * A model cannot be serialized to CSDL if it has references to types without fully qualified names.
     */
    protected const ReferencedTypeMustHaveValidName = 322;

    /**
     * The model could not be serialized because multiple schemas were produced and only a single output stream was found.
     */
    protected const SingleFileExpected = 323;

    /**
     * The Edmx version is not valid.
     */
    protected const UnknownEdmxVersion = 324;

    /**
     * The EdmVersion is not valid.
     */
    protected const UnknownEdmVersion = 325;

    /**
     * Nothing was written because no schemas were produced.
     */
    protected const NoSchemasProduced = 326;

    /**
     * Model has multiple entity containers with the same name.
     */
    protected const DuplicateEntityContainerName = 327;

    /**
     * The container name of a container element must be the full name of the container entity container.
     */
    protected const ContainerElementContainerNameIncorrect = 328;

    /**
     * A primitive constant expression is not valid for a non-primitive type.
     */
    protected const PrimitiveConstantExpressionNotValidForNonPrimitiveType = 329;

    /**
     * The value of the integer constant is out of range for the asserted type.
     */
    protected const IntegerConstantValueOutOfRange = 330;

    /**
     * The length of the string constant is too large for the asserted type.
     */
    protected const StringConstantLengthOutOfRange = 331;

    /**
     * The length of the binary constant is too large for the asserted type.
     */
    protected const BinaryConstantLengthOutOfRange = 332;

    /**
     * None is not a valid mode for a function import parameter.
     */
    protected const InvalidFunctionImportParameterMode = 333;

    /**
     * A type without other errors must not have kind of none.
     */
    protected const TypeMustNotHaveKindOfNone = 334;

    /**
     * A primitive type without other errors must not have kind of none.
     */
    protected const PrimitiveTypeMustNotHaveKindOfNone = 335;

    /**
     * A property without other errors must not have kind of none.
     */
    protected const PropertyMustNotHaveKindOfNone = 336;

    /**
     * A term without other errors must not have kind of none.
     */
    protected const TermMustNotHaveKindOfNone = 337;

    /**
     * A schema element without other errors must not have kind of none.
     */
    protected const SchemaElementMustNotHaveKindOfNone = 338;

    /**
     * An entity container element without other errors must not have kind of none.
     */
    protected const EntityContainerElementMustNotHaveKindOfNone = 339;

    /**
     * A binary value must have content.
     */
    protected const BinaryValueCannotHaveEmptyValue = 340;

    /**
     * There can only be a single navigation property mapping with containment that targets a particular entity set.
     */
    protected const EntitySetCanOnlyBeContainedByASingleNavigationProperty = 341;

    /**
     * The navigation properties partner does not point back to the correct type.
     */
    protected const InconsistentNavigationPropertyPartner = 342;

    /**
     * An entity set can only have one navigation property with containment.
     */
    protected const EntitySetCanOnlyHaveSingleNavigationPropertyWithContainment = 343;

    /**
     * If a navigation property is traversed from an entity set; and then it's partner is traversed from the target of the first mapping; the destination should be the originating entity set.
     */
    protected const EntitySetNavigationMappingMustBeBidirectional = 344;

    /**
     * There can only be a single mapping from a given EntitySet with a particular navigation property.
     */
    protected const DuplicateNavigationPropertyMapping = 345;

    /**
     * An entity set must have a mapping for all of the navigation properties in its element type.
     */
    protected const AllNavigationPropertiesMustBeMapped = 346;

    /**
     * Type annotation does not have a property binding for all required properties.
     */
    protected const TypeAnnotationMissingRequiredProperty = 347;

    /**
     * Type annotation has a property binding for a non-existant property and its type is not open.
     */
    protected const TypeAnnotationHasExtraProperties = 348;

    /**
     * Time value is invalid.
     */
    protected const InvalidTime = 349;

    /**
     * The primitive type is invalid.
     */
    protected const InvalidPrimitiveValue = 350;

    /**
     * An Enum type must have an underlying type of integer.
     */
    protected const EnumMustHaveIntegerUnderlyingType = 351;

    /**
     * Could not find a term with this name.
     */
    protected const BadUnresolvedTerm = 352;

    /**
     * The principal properties of a referential constraint must match the key of the referential constraint.
     */
    protected const BadPrincipalPropertiesInReferentialConstraint = 353;

    /**
     * A direct value annotation with the same name and namespace already exists.
     */
    protected const DuplicateDirectValueAnnotationFullName = 354;

    /**
     * AssociationSetEnd cannot infer an entity set because no set exists of the given type.
     */
    protected const NoEntitySetsFoundForType = 355;

    /**
     * AssociationSetEnd cannot infer an entity set because more than one set exists of the given type.
     */
    protected const CannotInferEntitySetWithMultipleSetsPerType = 356;

    /**
     * Invalid entity set path.
     */
    protected const InvalidEntitySetPath = 357;

    /**
     * Invalid enum member path.
     */
    protected const InvalidEnumMemberPath = 358;

    /**
     * An annotation qualifier must be a simple name.
     */
    protected const QualifierMustBeSimpleName = 359;

    /**
     * Enum type could not be resolved.
     */
    protected const BadUnresolvedEnumType = 360;

    /**
     * Could not find a target with this name.
     */
    protected const BadUnresolvedTarget = 361;

    /**
     * Path cannot be resolved in the given context.
     */
    protected const PathIsNotValidForTheGivenContext = 362;
}