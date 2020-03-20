<?php

namespace AlgoWeb\ODataMetadata\Tests\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Schema;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Using;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class SchemaTest extends TestCase
{
    /**
     * @param $expected
     * @param $namespace
     * @param $alias
     * @param mixed $using
     * @dataProvider SchemaWithUsingSerializerProvider
     */
    public function testSchemaXmlSerialize($expected, $namespace, $alias, $using)
    {
        $schema = new Schema($namespace, $alias, [], [], [], [], $using);

        $domNode = $this->writterContext->write($schema, false);
        $this->TESTNODE->appendChild($domNode);
        $xml = $this->writterContext->getBaseDocument()->saveXML($domNode);
        $this->assertEquals($expected, $xml);
    }

    public static function SchemaSerializerProvider()
    {
        return [
            [
                '<Schema/>', null, null, []
            ],
            [
                '<Schema Namespace="DummyNameSpace"/>', 'DummyNameSpace', null,[]
            ],
            [
                '<Schema Alias="DummyAlias"/>', null, 'DummyAlias',[]
            ],
            [
                '<Schema Namespace="DummyNameSpace" Alias="DummyAlias"/>', 'DummyNameSpace', 'DummyAlias',[]
            ]
        ];
    }
    public static function SchemaWithUsingSerializerProvider()
    {
        $base = [
            [
                '<Schema>%s</Schema>', null,null

            ],
            [
                '<Schema Namespace="DummyNameSpace">%s</Schema>', 'DummyNameSpace', null
            ],
            [
                '<Schema Alias="DummyAlias">%s</Schema>',null, 'DummyAlias'
            ],
            [
                '<Schema Namespace="DummyNameSpace" Alias="DummyAlias">%s</Schema>','DummyNameSpace', 'DummyAlias'
            ]
        ];
        $usingArray = UsingTest::usingTestDataProvider();
        $data = [];
        foreach ($usingArray as $usingItem) {
            $expected = $usingItem[0];
            $using = new Using($usingItem[1], $usingItem[2], $usingItem[3]);
            foreach ($base as $baseItem) {
                $data[] = [sprintf($baseItem[0], $expected), $baseItem[1], $baseItem[2], [$using]];
            }
        }
        return array_merge($data, self::SchemaSerializerProvider());
    }
}
