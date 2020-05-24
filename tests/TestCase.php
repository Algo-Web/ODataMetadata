<?php


namespace AlgoWeb\ODataMetadata\Tests;

use AlgoWeb\ODataMetadata\MetadataV3\edm\EdmBase;
use AlgoWeb\ODataMetadata\OdataVersions;
use AlgoWeb\ODataMetadata\Writer\WriterContext;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var WriterContext
     */
    protected $writerContext = null;
    /**
     * @var null|\DOMElement
     */
    protected $TESTNODE = null;

    protected function setUp(): void
    {
        parent::setUp();
        $this->writerContext =  new WriterContext(OdataVersions::THREE());
        $this->setContext($this->writerContext);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    protected function setContext(WriterContext $context)
    {
        $domDocument = $context->getBaseDocument();
        $baseElement = $domDocument->createElement('BASE');
        $baseElement->setAttributeNS(
            'http://www.w3.org/2000/xmlns/', // xmlns namespace URI
            'xmlns:edmx',
            $context->getEdmxNamespace()
        );
        $baseElement->setAttributeNS(
            'http://www.w3.org/2000/xmlns/', // xmlns namespace URI
            'xmlns:metadata',
            $context->getMetadataNamespace()
        );
        $baseElement->setAttributeNS(
            'http://www.w3.org/2000/xmlns/', // xmlns namespace URI
            'xmlns',
            $context->getEdmNamespace()
        );
        $domDocument->appendChild($baseElement);
        $this->TESTNODE = $baseElement;
    }
}
