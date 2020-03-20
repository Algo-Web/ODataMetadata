<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic;

/**
 * Class representing TParameterReferenceExpressionType.
 *
 * 16.2.12 The Edm:ParameterReference Expression
 *
 * The value of a Edm:ParameterReference expression is a reference to a function parameter.
 *
 * The Edm:ParameterReference expression MUST contain a value of the type [qualifiedname][csdl19]. The value of the
 * parameter reference expression MUST resolve to a parameter.
 *
 * The Edm:ParameterReference expression MUST be written with element notation,
 * as shown in the following example:
 *
 *     <ValueAnnotation Term="org.example.base.IsUrl">
 *         <ParameterReference>Image</ParameterReference>
 *     </ValueAnnotation>
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.12
 * XSD Type: TParameterReferenceExpression
 */
class TParameterReferenceExpressionType extends DynamicBase
{

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
}
