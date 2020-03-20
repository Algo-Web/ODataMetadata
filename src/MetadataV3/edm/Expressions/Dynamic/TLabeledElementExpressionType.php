<?php


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Documentation;

/**
 * Class representing TLabeledElementExpressionType.
 *
 * 16.2.9 The Edm:LabeledElement Expression
 *
 * The Edm:LabeledElement expression assigns a name to a child expression. The value of the child expression can then
 * be reused elsewhere with an Edm:LabeledElementReference expression. The labeled element expression MUST assign a
 * value of the type [simpleidentifier][csdl19] to the Edm:Name attribute.
 *
 * A labeled element expression MUST contain exactly one child expression written either in attribute notation or
 * element notation. The value of the child expression is passed through the labeled element expression. The value of
 * the child expression can also be accessed elsewhere by a labeled element reference expression.
 *
 * A labeled element expression MUST be written with element notation, as shown in the following example:
 *     <ValueAnnotation Term="org.example.display.DisplayName">
 *         <LabeledElement Name="CustomerFirstName">
 *             <Path>FirstName</Path>
 *         </LabeledElement>
 *     </ValueAnnotation>
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.9
 * @see https://docs.microsoft.com/en-us/openspecs/windows_protocols/mc-csdl/32d84017-fbce-49f7-8de0-873e58edd259
 * XSD Type: TLabeledElement
 */
class TLabeledElementExpressionType extends DynamicBase
{
    use HasExpression;
    /**
     * @var Documentation $documentation
     */
    private $documentation = null;

    /**
     * @var string $name
     */
    private $name = null;


    /**
     * Gets as name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name.
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

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
}
