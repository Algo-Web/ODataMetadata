<?php


namespace AlgoWeb\ODataMetadata;

/**
 * Class EdmConstants
 *
 * Contains constant values that apply to the EDM model, regardless of source.
 *
 * @package AlgoWeb\ODataMetadata
 * @see CsdlConstants for CSDL/EDMX specific constants
 */
class EdmConstants
{
    public const  EdmNamespace = "Edm";
    public const  TransientNamespace = "Transient";

    public const  XmlPrefix = "xml";
    public const  XmlNamespacePrefix = "xmlns";

    /**
     * The URI of annotations that will be serialized as documentation elements.
     */
    public const  DocumentationUri = "http://schemas.microsoft.com/ado/2011/04/edm/documentation";

    /**
     * The local name of annotations that will be serialized as documentation elements.
     */
    public const  DocumentationAnnotation = "Documentation";

    /**
     * The URI of annotations that are internal and will not be serialized.
     */
    public const  InternalUri = "http://schemas.microsoft.com/ado/2011/04/edm/internal";

    /**
     * The local name of the annotation that stores the data services version attribute for EDMX serialization.
     */
    public const  DataServiceVersion = "DataServiceVersion";

    /**
     * The local name of the annotation that stores the max data services version attribute for EDMX serialization.
     */
    public const  MaxDataServiceVersion = "MaxDataServiceVersion";

    /**
     * The local name of the annotation that stores EDM version of a model.
     */
    public const  EdmVersionAnnotation = "EdmVersion";

    public const  FacetName_Nullable = "Nullable";
    public const  FacetName_Precision = "Precision";
    public const  FacetName_Scale = "Scale";
    public const  FacetName_MaxLength = "MaxLength";
    public const  FacetName_FixedLength = "FixedLength";
    public const  FacetName_Unicode = "Unicode";
    public const  FacetName_Collation = "Collation";
    public const  FacetName_Srid = "SRID";

    public const  Value_UnknownType = "UnknownType";
    public const  Value_UnnamedType = "UnnamedType";
    public const  Value_Max = "Max";
    public const  Value_SridVariable = "Variable";

    public const  Type_Association = "Association";
    public const  Type_Collection = "Collection";
    public const  Type_Complex = "Complex";
    public const  Type_Entity = "Entity";
    public const  Type_EntityReference = "EntityReference";
    public const  Type_Enum = "Enum";
    public const  Type_Row = "Row";

    public const  Type_Primitive = "Primitive";
    public const  Type_Binary = "Binary";
    public const  Type_Decimal = "Decimal";
    public const  Type_String = "String";
    public const  Type_Stream = "Stream";
    public const  Type_Spatial = "Spatial";
    public const  Type_Temporal = "Temporal";

    public const  Type_Structured = "Structured";

    public const  Max_Precision = PHP_INT_MAX;
    public const  Min_Precision = 0;
}