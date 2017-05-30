<?php

namespace AlgoWeb\ODataMetadata\Tests;

use AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType;

class TValueAnnotationsTypeTest extends TestCase
{
    public function testTQualifiedNameFromKnownDocument()
    {
        $foo = new TValueAnnotationType();
        $name = "Org.OData.Publication.V1.DocumentationUrl";
        $this->assertTrue($foo->isTQualifiedNameValid($name));
    }

    public function testTQualifiedNameFromKnownDocumentWithTrailingSpace()
    {
        $foo = new TValueAnnotationType();
        $name = "Org.OData.Publication.V1.DocumentationUrl ";
        $this->assertFalse($foo->isTQualifiedNameValid($name));
    }
}
