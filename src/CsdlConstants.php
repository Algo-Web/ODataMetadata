<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata;

use AlgoWeb\ODataMetadata\Enums\ConcurrencyMode;
use AlgoWeb\ODataMetadata\Enums\FunctionParameterMode;

class CsdlConstants
{
    /**
     * @return Version Version 1.0 of EDMX. Corresponds to EDMX namespace "http://schemas.microsoft.com/ado/2007/06/edmx".
     */
    public static function getEdmVersion1(): Version
    {
        return Version::v1();
    }

    /**
     * @return Version Version 2.0 of EDMX. Corresponds to EDMX namespace "http://schemas.microsoft.com/ado/2008/10/edmx".
     */
    public static function getEdmxVersion2(): Version
    {
        return Version::v2();
    }

    /**
     * @return Version Version 3.0 of EDMX. Corresponds to EDMX namespace "http://schemas.microsoft.com/ado/2009/11/edmx".
     */
    public static function getEdmxVersion3(): Version
    {
        return Version::v3();
    }

    /**
     * @return Version the current latest version of EDMX
     */
    public static function getEdmxVersionLatest(): Version
    {
        return self::getEdmxVersion3();
    }

    public const  CsdlFileExtension = '.csdl';

    public const  Version1Namespace = 'http://schemas.microsoft.com/ado/2006/04/edm';
    public const  Version1Xsd       = 'Edm.Csdl.CSDLSchema_1.xsd';

    public const  Version1_1Namespace = 'http://schemas.microsoft.com/ado/2007/05/edm';
    public const  Version1_1Xsd       = 'Edm.Csdl.CSDLSchema_1_1.xsd';

    public const  Version1_2Namespace = 'http://schemas.microsoft.com/ado/2008/01/edm';

    public const  Version2Namespace          = 'http://schemas.microsoft.com/ado/2008/09/edm';
    public const  Version2NamespaceAlternate = 'http://schemas.microsoft.com/ado/2009/08/edm';
    public const  Version2Xsd                = 'Edm.Csdl.CSDLSchema_2.xsd';

    public const  Version3Namespace = 'http://schemas.microsoft.com/ado/2009/11/edm';

    public const  AnnotationNamespace = 'http://schemas.microsoft.com/ado/2009/02/edm/annotation';
    public const  AnnotationXsd       = 'Edm.Csdl.AnnotationSchema.xsd';

    public const  CodeGenerationSchemaNamespace = 'http://schemas.microsoft.com/ado/2006/04/codegeneration';
    public const  CodeGenerationSchemaXsd       = 'Edm.Csdl.CodeGenerationSchema.xsd';

    public const  AssociationAnnotationsAnnotation          = 'AssociationAnnotations';
    public const  AssociationNameAnnotation                 = 'AssociationName';
    public const  AssociationNamespaceAnnotation            = 'AssociationNamespace';
    public const  AssociationEndNameAnnotation              = 'AssociationEndName';
    public const  AssociationSetAnnotationsAnnotation       = 'AssociationSetAnnotations';
    public const  AssociationSetNameAnnotation              = 'AssociationSetName';
    public const  SchemaNamespaceAnnotation                 = 'SchemaNamespace';
    public const  AnnotationSerializationLocationAnnotation = 'AnnotationSerializationLocation';
    public const  NamespacePrefixAnnotation                 = 'NamespacePrefix';
    public const  IsEnumMemberValueExplicitAnnotation       = 'IsEnumMemberValueExplicit';
    public const  IsSerializedAsElementAnnotation           = 'IsSerializedAsElement';
    public const  NamespaceAliasAnnotation                  = 'NamespaceAlias';

    public const  Attribute_Abstract        = 'Abstract';
    public const  Attribute_Action          = 'Action';
    public const  Attribute_Alias           = 'Alias';
    public const  Attribute_Association     = 'Association';
    public const  Attribute_BaseType        = 'BaseType';
    public const  Attribute_Binary          = 'Binary';
    public const  Attribute_Bool            = 'Bool';
    public const  Attribute_Collation       = 'Collation';
    public const  Attribute_ConcurrencyMode = 'ConcurrencyMode';
    public const  Attribute_ContainsTarget  = 'ContainsTarget';
    public const  Attribute_DateTime        = 'DateTime';
    public const  Attribute_DateTimeOffset  = 'DateTimeOffset';
    public const  Attribute_Decimal         = 'Decimal';
    public const  Attribute_DefaultValue    = 'DefaultValue';
    public const  Attribute_FromRole        = 'FromRole';
    public const  Attribute_ElementType     = 'ElementType';
    public const  Attribute_Extends         = 'Extends';
    public const  Attribute_EntityType      = 'EntityType';
    public const  Attribute_EntitySet       = 'EntitySet';
    public const  Attribute_EntitySetPath   = 'EntitySetPath';
    public const  Attribute_FixedLength     = 'FixedLength';
    public const  Attribute_Float           = 'Float';
    public const  Attribute_Function        = 'Function';
    public const  Attribute_Guid            = 'Guid';
    public const  Attribute_Int             = 'Int';
    public const  Attribute_IsBindable      = 'IsBindable';
    public const  Attribute_IsComposable    = 'IsComposable';
    public const  Attribute_IsFlags         = 'IsFlags';
    public const  Attribute_IsSideEffecting = 'IsSideEffecting';
    public const  Attribute_MaxLength       = 'MaxLength';
    public const  Attribute_MethodAccess    = 'MethodAccess';
    public const  Attribute_Mode            = 'Mode';
    public const  Attribute_Multiplicity    = 'Multiplicity';
    public const  Attribute_Name            = 'Name';
    public const  Attribute_Namespace       = 'Namespace';
    public const  Attribute_Nullable        = 'Nullable';
    public const  Attribute_OpenType        = 'OpenType';
    public const  Attribute_Path            = 'Path';
    public const  Attribute_Precision       = 'Precision';
    public const  Attribute_Property        = 'Property';
    public const  Attribute_Qualifier       = 'Qualifier';
    public const  Attribute_Relationship    = 'Relationship';
    public const  Attribute_ResultEnd       = 'ResultEnd';
    public const  Attribute_ReturnType      = 'ReturnType';
    public const  Attribute_Role            = 'Role';
    public const  Attribute_Scale           = 'Scale';
    public const  Attribute_Srid            = 'SRID';
    public const  Attribute_String          = 'String';
    public const  Attribute_Target          = 'Target';
    public const  Attribute_Term            = 'Term';
    public const  Attribute_Time            = 'Time';
    public const  Attribute_ToRole          = 'ToRole';
    public const  Attribute_Type            = 'Type';
    public const  Attribute_UnderlyingType  = 'UnderlyingType';
    public const  Attribute_Unicode         = 'Unicode';
    public const  Attribute_Value           = 'Value';

    public const  Element_Annotations             = 'Annotations';
    public const  Element_Apply                   = 'Apply';
    public const  Element_AssertType              = 'AssertType';
    public const  Element_Association             = 'Association';
    public const  Element_AssociationSet          = 'AssociationSet';
    public const  Element_Binary                  = 'Binary';
    public const  Element_Bool                    = 'Bool';
    public const  Element_Collection              = 'Collection';
    public const  Element_CollectionType          = 'CollectionType';
    public const  Element_ComplexType             = 'ComplexType';
    public const  Element_DateTime                = 'DateTime';
    public const  Element_DateTimeOffset          = 'DateTimeOffset';
    public const  Element_Decimal                 = 'Decimal';
    public const  Element_DefiningExpression      = 'DefiningExpression';
    public const  Element_Dependent               = 'Dependent';
    public const  Element_Documentation           = 'Documentation';
    public const  Element_End                     = 'End';
    public const  Element_EntityContainer         = 'EntityContainer';
    public const  Element_EntitySet               = 'EntitySet';
    public const  Element_EntitySetReference      = 'EntitySetReference';
    public const  Element_EntityType              = 'EntityType';
    public const  Element_EnumMemberReference     = 'EnumMemberReference';
    public const  Element_EnumType                = 'EnumType';
    public const  Element_Float                   = 'Float';
    public const  Element_Guid                    = 'Guid';
    public const  Element_Function                = 'Function';
    public const  Element_FunctionImport          = 'FunctionImport';
    public const  Element_FunctionReference       = 'FunctionReference';
    public const  Element_If                      = 'If';
    public const  Element_IsType                  = 'IsType';
    public const  Element_Int                     = 'Int';
    public const  Element_Key                     = 'Key';
    public const  Element_LabeledElement          = 'LabeledElement';
    public const  Element_LabeledElementReference = 'LabeledElementReference';
    public const  Element_LongDescription         = 'LongDescription';
    public const  Element_Member                  = 'Member';
    public const  Element_NavigationProperty      = 'NavigationProperty';
    public const  Element_Null                    = 'Null';
    public const  Element_OnDelete                = 'OnDelete';
    public const  Element_Parameter               = 'Parameter';
    public const  Element_ParameterReference      = 'ParameterReference';
    public const  Element_Path                    = 'Path';
    public const  Element_Principal               = 'Principal';
    public const  Element_Property                = 'Property';
    public const  Element_PropertyRef             = 'PropertyRef';
    public const  Element_PropertyReference       = 'PropertyReference';
    public const  Element_PropertyValue           = 'PropertyValue';
    public const  Element_Record                  = 'Record';
    public const  Element_ReferenceType           = 'ReferenceType';
    public const  Element_ReferentialConstraint   = 'ReferentialConstraint';
    public const  Element_ReturnType              = 'ReturnType';
    public const  Element_RowType                 = 'RowType';
    public const  Element_Schema                  = 'Schema';
    public const  Element_String                  = 'String';
    public const  Element_Summary                 = 'Summary';
    public const  Element_Time                    = 'Time';
    public const  Element_TypeAnnotation          = 'TypeAnnotation';
    public const  Element_TypeRef                 = 'TypeRef';
    public const  Element_Using                   = 'Using';
    public const  Element_ValueAnnotation         = 'ValueAnnotation';
    public const  Element_ValueTerm               = 'ValueTerm';

    public const  Property_ElementType = 'ElementType';
    public const  Property_TargetSet   = 'TargetSet';
    public const  Property_SourceSet   = 'SourceSet';

    public const  Value_Bag              = 'Bag';
    public const  Value_Cascade          = 'Cascade';
    public const  Value_Collection       = 'Collection';
    public const  Value_Computed         = 'Computed';
    public const  Value_EndMany          = '*';
    public const  Value_EndOptional      = '0..1';
    public const  Value_EndRequired      = '1';
    public const  Value_False            = 'false';
    public const  Value_Fixed            = 'Fixed';
    public const  Value_Identity         = 'Identity';
    public const  Value_ModeIn           = 'In';
    public const  Value_ModeOut          = 'Out';
    public const  Value_ModeInOut        = 'InOut';
    public const  Value_List             = 'List';
    public const  Value_Max              = 'Max';
    public const  Value_None             = 'None';
    public const  Value_Ref              = 'Ref';
    public const  Value_Self             = 'Self';
    public const  Value_True             = 'true';
    public const  Value_UnknownNamespace = '[UnknownNamespace]';
    public const  Value_SridVariable     = 'Variable';

    public const  Default_Abstract               = false;
    public const  Default_CollectionNullable     = false;
    public static $Default_ConcurrencyMode       = null;
    public const  Default_ContainsTarget         = false;
    public static $Default_FunctionParameterMode = null;
    public const  Default_IsAtomic               = false;
    public const  Default_IsBindable             = false;
    public const  Default_IsComposable           = false;
    public const  Default_IsFlags                = false;
    public const  Default_IsSideEffecting        = true;
    public const  Default_OpenType               = false;
    public const  Default_Nullable               = true;
    public const  Default_SpatialGeographySrid   = 4326;
    public const  Default_SpatialGeometrySrid    = 0;

    public const  Max_NameLength      = 480;
    public const  Max_NamespaceLength = 512;

    public const  Version3Xsd = 'Edm.Csdl.CSDLSchema_3.xsd';

    #endregion

    #region EDMX

    public const  EdmxFileExtension = '.edmx';

    public const  EdmxVersion1Namespace = 'http://schemas.microsoft.com/ado/2007/06/edmx';

    public const  EdmxVersion2Namespace = 'http://schemas.microsoft.com/ado/2008/10/edmx';

    public const  EdmxVersion3Namespace = 'http://schemas.microsoft.com/ado/2009/11/edmx';

    public const  ODataMetadataNamespace = 'http://schemas.microsoft.com/ado/2007/08/dataservices/metadata';

    /**
     * The local name of the annotation that stores EDMX version of a model.
     */
    public const  EdmxVersionAnnotation = 'EdmxVersion';

    public const  Prefix_Edmx          = 'edmx';
    public const  Prefix_ODataMetadata = 'metadata';
    public const  Prefix_Xml_Namespace = 'xmlns';
    public const  Prefix_Annotations   = 'annotations';

    public const  Attribute_Version               = 'Version';
    public const  Attribute_DataServiceVersion    = 'DataServiceVersion';
    public const  Attribute_MaxDataServiceVersion = 'MaxDataServiceVersion';

    public const Attribute_IsDefaultEntityContainer = 'IsDefaultEntityContainer';
    public const Attribute_LazyLoadingEnabled       = 'LazyLoadingEnabled';

    public const  Element_ConceptualModels = 'ConceptualModels';
    public const  Element_Edmx             = 'Edmx';
    public const  Element_Runtime          = 'Runtime';
    public const  Element_DataServices     = 'DataServices';


    public static function getSupportedVersions(): array
    {
        return [Version::v1(), Version::v1_1(), Version::v2(), Version::v3()];
    }
    public static function versionToEdmxNamespace(Version $version): ?string
    {
        switch ($version->getMajor()) {
            case 1:
                return self::EdmxVersion1Namespace;
            case 2:
                return self::EdmxVersion2Namespace;
            case 3:
                return self::EdmxVersion3Namespace;
        }
        return null;
    }
    public static function versionToEdmNamespace(Version $version): ?string
    {
        switch ($version) {
            case Version::v1():
                return self::Version1Namespace;
            case Version::v1_1():
                return self::Version1_1Namespace;
            case Version::v1_2():
                return self::Version1_2Namespace;
            case Version::v2():
                return self::Version2Namespace;
            case Version::v3():
                return self::Version3Namespace;
        }
        return null;
    }
    public static function EdmToEdmxVersions(Version $edm)
    {
        switch ($edm) {
            case Version::v1():
            case Version::v1_1():
            case Version::v1_2():
                return Version::v1();
        }
        return $edm;
    }
}
// Basically using it as a static constructor.
(function () {
    CsdlConstants::$Default_ConcurrencyMode = ConcurrencyMode::None();
    CsdlConstants::$Default_FunctionParameterMode = FunctionParameterMode::IN();
});
