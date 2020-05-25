<?php

namespace AlgoWeb\ODataMetadata\Tests\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Documentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edmx\DataServices;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class DocumentationTest extends TestCase
{
    /**
     * @param $expected
     * @param $summary
     * @param $description
     * @dataProvider documentationTestProvider
     */
    public function testDocumentationTestXmlSerialize($expected, $summary, $description)
    {
        $dataService = new Documentation($summary, $description);
        $domNode = $this->writerContext->write($dataService, false);
        $this->TESTNODE->appendChild($domNode);
        $xml = $this->writerContext->getBaseDocument()->saveXML($domNode);
        $this->assertEquals($expected, $xml);
    }

    public static function documentationTestProvider()
    {
        return [
            [
                '<Documentation><Summary>Short Summary</Summary></Documentation>', 'Short Summary', null
            ],
            [
                '<Documentation><Summary>Short Summary</Summary><LongDescription>LongDescription</LongDescription></Documentation>', 'Short Summary', 'LongDescription'
            ],
            [
            '<Documentation><LongDescription>LongDescription</LongDescription></Documentation>', null, 'LongDescription'
            ]
        ];
    }
}
