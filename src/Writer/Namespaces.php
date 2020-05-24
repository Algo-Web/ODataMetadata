<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Writer;

use AlgoWeb\ODataMetadata\OdataVersions;

/**
 * Class Namespaces
 *
 * 1 Common Schema Definition Language (CSDL) Namespaces
 *
 * In addition to the default XML namespace, the elements and attributes used to describe the entity model of an
 * OData service are defined in one of the following namespaces.
 *
 * @package AlgoWeb\ODataMetadata\Writer
 */
class Namespaces
{
    /**
     * 1.1 Entity Data Model for Data Services Packaging (EDMX) Namespace
     *
     * Elements and attributes associated with the top-level wrapper that contains the CSDL used to define the entity
     * model for an OData Service are qualified with the Entity Data Model for Data Services Packaging
     * namespace: http://schemas.microsoft.com/ado/2007/06/edmx.
     *
     * In this specification the namespace prefix edmx is used to represent the Entity Data Model for Data Services
     * Packaging namespace, however the prefix name is not prescriptive.
     */
    private const EDMXNamespace = 'http://schemas.microsoft.com/ado/2007/06/edmx';
    /**
     * 1.2 Entity Data Model (EDM) Namespace
     *
     * Elements and attributes that define the entity model exposed by the OData Service are qualified with the Entity
     * Data Model namespace: http://schemas.microsoft.com/ado/2009/11/edm.
     *
     * Prior versions of CSDL used the following namespaces for EDM:
     * CSDL version 1.0: http://schemas.microsoft.com/ado/2006/04/edm
     * CSDL version 1.1: http://schemas.microsoft.com/ado/2007/05/edm
     * CSDL version 1.2: http://schemas.microsoft.com/ado/2008/01/edm
     * CSDL version 2.0: http://schemas.microsoft.com/ado/2008/09/edm
     * CSDL version 3.0: http://schemas.microsoft.com/ado/2009/11/edm
     *
     * In this specification the namespace prefix Edm is used to represent the Entity Data Model namespace, however
     * the prefix name is not prescriptive.
     */
    private const V1EdmNamespace= 'http://schemas.microsoft.com/ado/2006/04/edm';
    private const V2EdmNamespace = 'http://schemas.microsoft.com/ado/2008/09/edm';
    private const V3EdmNamespace = 'http://schemas.microsoft.com/ado/2009/11/edm';
    /**
     * 1.3 Data Service Metadata Namespace
     * Elements and attributes specific to how the entity model is exposed as an OData Service are qualified with the
     * Data Service Metadata namespace: http://schemas.microsoft.com/ado/2007/08/DataServices/Metadata.
     *
     * In this specification the namespace prefix metadata is used to represent the Data Service Metadata namespace,
     * however the prefix name is not prescriptive.
     */
    private const MetadataNamespace = 'http://schemas.microsoft.com/ado/2007/08/DataServices/Metadata';

    private const DataServicesNamespace = 'http://schemas.microsoft.com/ado/2007/08/dataservices';

    private const AnnotationsNamespace = 'http://schemas.microsoft.com/ado/2009/02/edm/annotation';

    private $edmNamespace;
    private $edmxNamespace;
    private $metadataNamespace;
    private $dataServiceNamespace;
    private $annotationsNamespace;

    public function __construct(OdataVersions $version)
    {
        switch ($version) {
            case OdataVersions::ONE():
                $this->edmNamespace = self::V1EdmNamespace;
                break;
            case OdataVersions::TWO():
                $this->edmNamespace = self::V2EdmNamespace;
                break;
            case OdataVersions::THREE():
                $this->edmNamespace = self::V3EdmNamespace;
                break;
        }
        $this->edmxNamespace = self::EDMXNamespace;
        $this->metadataNamespace = self::MetadataNamespace;
        $this->dataServiceNamespace = self::DataServicesNamespace;
        $this->annotationsNamespace = self::AnnotationsNamespace;
    }


    public function getEdmNamespace()
    {
        return $this->edmNamespace;
    }
    public function getEdmxNamespace()
    {
        return $this->edmxNamespace;
    }
    public function getMetadataNamespace()
    {
        return $this->metadataNamespace;
    }
    public function getDataServiceNamespace()
    {
        return $this->dataServiceNamespace;
    }
    public function getAnnotationsNamespace()
    {
        return $this->annotationsNamespace;
    }
}
