<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edmx;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\edm\EdmBase;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Schema;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use AlgoWeb\ODataMetadata\Writer\WriterContext;
use ArrayAccess;
use DOMElement;

/**
 * Class DataServices
 *
 * 3.2 The edmx:DataServices Element
 * The edmx:DataServices element contains zero or more Edm:Schema elements which define the schema(s) exposed by the
 * OData service.
 *
 * The edmx:DataServices element contains the service metadata of a data service. This service metadata contains zero
 * or more Entity Data Model (EDM) conceptual schemas (as specified in [MC-CSDL]), which are annotated as specified in
 * [MS-ODATA].
 *
 * The following represents the edmx:DataServices element.
 *
 * <edmx:DataServices>
 *
 * The following rule applies to the edmx:DataServices element:
 * The edmx:DataServices element can contain any number of Schema sublements.<1>
 * @package AlgoWeb\ODataMetadata\MetadataV3
 */
class DataServices extends DomBase implements ArrayAccess
{
    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'edmx:DataServices';
    }

    /**
     * @param WriterContext|null $wc
     * @return array|AttributeContainer[]
     */
    public function getAttributes(WriterContext $wc = null): array
    {
        return [
            new AttributeContainer('metadata:DataServiceVersion', $wc->getOdataVersion())
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return empty($this->schema) ? [new Schema()] : $this->schema;
    }

    /**
     * @var Schema[] $dataServices 3.2 The edmx:DataServices Element
     * The edmx:DataServices element contains zero or more Edm:Schema elements which define the schema(s) exposed by
     * the OData service.
     */
    private $schema = [];

    /**
     * @return string 3.2.1 The metadata:DataServiceVersion Attribute
    The metadata:DataServiceVersion attribute describes the version of OData protocol required to consume the service.
     * This version of the specification defines the following valid data service version values:
     * "1.0", "2.0", and "3.0", corresponding to OData protocol versions 1.0, 2.0 and 3.0 respectively.
     */
    private function getDataServiceVersion(): string
    {
        return EdmBase::getSerilizationContext()->getOdataVersion();
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->schema);
    }

    public function offsetGet($offset)
    {
        return $this->schema[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if (null === $offset) {
            $this->schema[] = $value;
        } else {
            $this->schema[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->schema[$offset]);
    }
}
