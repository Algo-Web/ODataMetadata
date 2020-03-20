<?php


namespace AlgoWeb\ODataMetadata\Tests;

use AlgoWeb\ODataMetadata\MetadataV3\edm\EdmBase;
use AlgoWeb\ODataMetadata\OdataVersions;
use AlgoWeb\ODataMetadata\Writer\WritterContext;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var WritterContext
     */
    protected $writterContext = null;
    /**
     * @var null|\DOMElement
     */
    protected $TESTNODE = null;

    protected function setUp(): void
    {
        parent::setUp();
        $this->writterContext =  new WritterContext(OdataVersions::THREE());
        $this->setContext($this->writterContext);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    protected function setContext(WritterContext $context)
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
