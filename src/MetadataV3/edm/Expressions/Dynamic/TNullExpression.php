<?php


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Documentation;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.36.1.1 Null.
 *
 * Null is an expression that produces an untyped value.
 *
 * The Edm:Null expression returns an untyped null value. The Edm:Null expression MUST NOT contain any other elements
 * or expressions.
 *
 * The Edm:Null expression MUST be written with element notation, as shown in the following example:
 *     <ValueAnnotation Term="org.example.display.DisplayName">
 *         <Null />
 *     </ValueAnnotation>
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.11
 * @see https://docs.microsoft.com/en-us/openspecs/windows_protocols/mc-csdl/9e0ac041-e204-4a9b-a52e-07a72ee5114a
 * XSD Type: TNullExpression
 */
class TNullExpression extends DynamicBase
{
    /**
     * @var Documentation $documentation
     */
    private $documentation = null;


    /**
     * Gets as documentation.
     *
     * @return Documentation
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation.
     *
     * @param  Documentation $documentation
     * @return self
     */
    public function setDocumentation(Documentation $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'Null';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [$this->getDocumentation()];
    }
}
