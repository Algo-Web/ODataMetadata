<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

/**
 * Root Level element for CS mapping
 * Mapping specification language (MSL) is an XML-based language that describes the mapping between the conceptual model and storage model of an Entity Framework application.
 * In an Entity Framework application, mapping metadata is loaded from an .msl file (written in MSL) at build time. The Entity Framework uses mapping metadata at runtime to translate queries against the conceptual model to store-specific commands.
 * The Entity Framework Designer (EF Designer) stores mapping information in an .edmx file at design time. At build time, the Entity Designer uses information in an .edmx file to create the .msl file that is needed by the Entity Framework at runtime
 */
class Mapping extends TMappingType
{
}
