<?php

namespace AlgoWeb\ODataMetadata\Tests\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Documentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edmx\DataServices;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class DocumentationTest extends TestCase
{
    /**
     * @param $expected
     * @param $summery
     * @param $description
     * @dataProvider documentationTestProvider
     */
    public function testDocumentationTestXmlSerialize($expected, $summery, $description)
    {
        $domNode =  $this->TESTNODE;

        $dataService = new Documentation($summery, $description);
        $domNode = $this->writerContext->write($dataService, false);
        $this->TESTNODE->appendChild($domNode);
        $xml = $this->writerContext->getBaseDocument()->saveXML($domNode);
        $this->assertEquals($expected, $xml);
    }

    public static function documentationTestProvider(){
        return [
            [
                '<Documentation><Summary>Short Summery</Summary></Documentation>', 'Short Summery', null
            ],
            [
                '<Documentation><Summary>Short Summery</Summary><LongDescription>LongDescription</LongDescription></Documentation>', 'Short Summery', 'LongDescription'
            ],
            [
            '<Documentation><LongDescription>LongDescription</LongDescription></Documentation>', null, 'LongDescription'
            ]
        ];
    }
}
