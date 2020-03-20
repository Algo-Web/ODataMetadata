<?php


namespace AlgoWeb\ODataMetadata\MetadataV3\Edmx;


use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\edm\EdmBase;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Schema;
use AlgoWeb\ODataMetadata\OdataVersions;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use AlgoWeb\ODataMetadata\Writer\WritterContext;

/**
 * Class TEdmxType
 *
 * 3.1 The edmx:Edmx Element
 *
 * An OData service exposes a single entity model. A CSDL description of the entity model can be requested from
 * $metadata.
 *
 * The document returned by $metadata MUST contain a single root edmx:Edmx element. This element MUST contain a single
 * direct child edmx:DataServices element. The data services element contains a description of the entity model(s)
 * exposed by the OData service.
 *
 * In addition to the data services element, Edmx may have zero or more edmx:Reference elements and zero or more
 * edmx:AnnotationsReference elements. Reference elements specify the location of schemas referenced by the OData
 * service. Annotations reference elements specify the location of annotations to be applied to the OData service.
 *
 * The following example demonstrates the basic structure of the Edmx element and the edmx:DataServices element:
 *
 *     <edmx:Edmx xmlns:edmx="http://schemas.microsoft.com/ado/2007/06/edmx" Version="1.0">
 *         <edmx:DataServices xmlns:m="http://schemas.microsoft.com/ado/2007/08/dataservices/metadata" m:DataServiceVersion="2.0">
 *             <Schema ... />
 *         </edmx:DataServices>
 *     </edmx:Edmx>
 *
 * The edmx:Edmx element defines the XML namespace for the EDMX document and contains the edmx:DataServices subelement.
 * The following rules apply to the edmx:Edmx element:
 * An EDMX document MUST have exactly one edmx:Edmx element as its root element.
 * The Version attribute MUST be defined on the edmx:Edmx element. Version is of type xs:string, as specified in the
 * XML schema [XMLSCHEMA1].
 * The edmx:Edmx element can contain a choice of zero or more of each of the following subelements:
 * edmx:Reference
 * edmx:AnnotationsReference
 *
 * Subelements in a given choice set can appear in any given order.
 * The edmx:Edmx element specifies exactly one edmx:DataServices subelement. This subelement MUST appear after the
 * edmx:Reference and edmx:AnnotationReference subelements, if present.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3
 */
class Edmx extends DomBase
{
    /**
     * @var string $version 3.1.1 The Version Attribute
     * The Version attribute MUST be present on the edmx:Edmx element.
     *
     * The Version attribute is a string value that specifies the version of the EDMX wrapper, and must be of the
     * form .. This version of the specification defines version 1.0 of the EDMX Wrapper.
     */
    private $version = "1.0";

    /**
     * @var DataServices|Schema[] $dataServices  3.2 The edmx:DataServices Element
     * The edmx:DataServices element contains zero or more Edm:Schema elements which define the schema(s) exposed by
     * the OData service.
     */
    private $dataServices;

    public function __construct()
    {
        $this->dataServices = new DataServices();
    }

    /**
     * Adds as schema
     *
     * @return self
     * @param Schema $schema
     */
    public function addToDataServices(Schema $schema)
    {
        $this->dataServices[] = $schema;
        return $this;
    }

    /**
     * isset dataServices
     *
     * @param int|string $index
     * @return bool
     */
    public function issetDataServices($index)
    {
        return isset($this->dataServices[$index]);
    }

    /**
     * unset dataServices
     *
     * @param int|string $index
     * @return void
     */
    public function unsetDataServices($index)
    {
        unset($this->dataServices[$index]);
    }

    /**
     * Gets as dataServices
     *
     * @return Schema[]
     */
    public function getDataServices()
    {
        return $this->dataServices;
    }

    /**
     * Sets a new dataServices
     *
     * @param Schema[] $dataServices
     * @return self
     */
    public function setDataServices(array $dataServices)
    {
        $this->dataServices = $dataServices;
        return $this;
    }


    public function XmlSerialize(OdataVersions $version){
        $context = new WritterContext($version);
        $domDocument = $context->getBaseDocument();
        $edmxElement = $context->createEdmxElement('edmx:Edmx');
        $domDocument->appendChild($edmxElement);
        $this->setUpNamespaces($edmxElement,$context);
        $edmxElement->setAttribute('Version', $this->version);
        EdmBase::setSerilizationContext($context);
        $this->dataServices->XmlSerialize($edmxElement);
        return $domDocument->saveXML();
    }

    private function setUpNamespaces(\DOMElement $edmxElement, WritterContext $context){
        $edmxElement->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns', $context->getEdmNamespace());
        $edmxElement->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:annotations', $context->getAnnotationsNamespace());
        $edmxElement->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:metadata', $context->getMetadataNamespace());
        $context->registerNamespace(null, $context->getEdmNamespace());
        $context->registerNamespace("annotations", $context->getAnnotationsNamespace());
        $context->registerNamespace('metadata', $context->getMetadataNamespace());
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('Version', $this->version)
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [$this->getDataServices()];
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'edmx:Edmx';
    }
}