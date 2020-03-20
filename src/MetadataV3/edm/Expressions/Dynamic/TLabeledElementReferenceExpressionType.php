<?php


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic;

/**
 * Class TLabeledElementReferenceExpressionType.
 *
 * 16.2.10 The Edm:LabeledElementReference Expression
 *
 * The Edm:LabeledElementReference expression returns the value of a labeled element expression.
 *
 * The labeled element reference expression MUST contain a value of the type [simpleidentifier][csdl19]. The value of
 * the [simpleidentifier][csdl19] MUST resolve to a labeled element expression.
 *
 * The Edm:LabeledElementReference expression MUST be written with element notation, as shown in the following example:
 *
 *     <ValueAnnotation Term="org.example.display.DisplayName">
 *         <LabeledElementReference>DisplayName</LabeledElement>
 *     </ValueAnnotation>
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.10
 * XSD Type: TLabeledElementReferenceExpression
 */
class TLabeledElementReferenceExpressionType extends DynamicBase
{
    /**
     * @var string $__value
     */
    protected $__value = null;

    /**
     * Gets a string value.
     *
     * @return string
     */
    public function __toString(): string
    {
        return strval($this->__value);
    }

    /**
     * Construct.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value.
     *
     * @param  string $value
     * @return string
     */
    public function value(string $value = null): string
    {
        if (null !== $value) {
            $this->__value = $value;
        }
        return $this->__value;
    }
}
