<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Annotations;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.34 ValueAnnotation.
 *
 * ValueAnnotation is used to attach a named value to a model element.
 *
 * The following is an example of the ValueAnnotation element.
 *
 * <ValueAnnotation Term="Title" String="MyTitle" />
 * <ValueAnnotation Term="ReadOnly" />
 *
 * The following rules apply to the ValueAnnotation element:
 * - The ValueAnnotation element MUST have a Term attribute defined that is a namespace qualified name, alias qualified name, or SimpleIdentifier.
 * - The ValueAnnotation can appear only as a child element of the following elements:
 * - - Annotations
 * - - Association
 * - - AssociationSet
 * - - ComplexType
 * - - EntityContainer
 * - - EntitySet
 * - - EntityType
 * - - FunctionImport
 * - - FunctionImport Parameter
 * - - Model Function
 * - - Model Function Parameter
 * - - NavigationProperty
 * - - Property
 * - ValueAnnotation can have a Qualifier attribute defined unless the ValueAnnotation is a child element of an Annotations element that has a Qualifier attribute defined. If a Qualifier is defined, it has to be a SimpleIdentifier. Qualifier is used to differentiate bindings based on external context.
 * - ValueAnnotation can specify an expression as a child element or as an expression attribute that gives the value of the term.
 * - A ValueAnnotation can have one of the following attributes defined in place of a child element expression. Each of these is equivalent to the same-named expression with the equivalent spelling:
 * - - Path
 * - - String
 * - - Int
 * - - Float
 * - - Decimal
 * - - Bool
 * - - DateTime
 *
 * - If a ValueAnnotation has neither a child expression nor an attribute specifying a value, the value of the
 * annotation is the DefaultValue specified for the annotation, or Null if no DefaultValue is specified. Note that a
 * Null value for a term is distinct from the absence of a ValueAnnotation element for that term, in which case the
 * term has no value.
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl15.4
 * XSD Type: TValueAnnotation
 */
class ValueAnnotation extends EdmBase
{
    /**
     * @var string $term the ValueAnnotation element MUST have a Term attribute defined that is a
     *             namespace qualified name, alias qualified name, or SimpleIdentifier
     */
    private $term = null;

    /**
     * @var string|null $qualifier ValueAnnotation can have a Qualifier attribute defined unless the ValueAnnotation is a
     *                  child element of an Annotations element that has a Qualifier attribute defined. If a Qualifier is defined,
     *                  it has to be a SimpleIdentifier. Qualifier is used to differentiate bindings based on external context.
     *
     * The value of the edm:Qualifier attribute is an arbitrary string.
     * Type or value annotations MUST provide at most one value for the qualifier attribute. Type or value annotations
     * that are children of an annotations element MUST NOT provide a value for the qualifier attribute.
     */
    private $qualifier = null;

    /**
     * @var Expressions\ExpressionBase $expression a ValueAnnotation can specify an expression as a
     *                                 child element or as an expression attribute that gives the value of the term
     */
    private $expression;

    public function __construct(string $term, Expressions\ExpressionBase $expression, string $qualifier = null)
    {
        $this
            ->setTerm($term)
            ->setExpression($expression)
            ->setQualifier($qualifier);
    }

    /**
     * Gets as term.
     *
     * @return string
     */
    public function getTerm(): string
    {
        return $this->term;
    }

    /**
     * Sets a new term.
     *
     * @param  string $term
     * @return self
     */
    public function setTerm(string $term): self
    {
        $this->term = $term;
        return $this;
    }

    /**
     * Gets as qualifier.
     *
     * @return string|null
     */
    public function getQualifier(): ?string
    {
        return $this->qualifier;
    }

    /**
     * Sets a new qualifier.
     *
     * @param  string|null $qualifier
     * @return self
     */
    public function setQualifier(?string $qualifier): self
    {
        $this->qualifier = $qualifier;
        return $this;
    }
    /**
     * Gets as Expression.
     *
     * @return Expressions\ExpressionBase
     */
    public function getExpression(): Expressions\ExpressionBase
    {
        return $this->expression;
    }

    /**
     * Sets a new Expression.
     *
     * @param  Expressions\ExpressionBase $expression
     * @return self
     */
    public function setExpression(Expressions\ExpressionBase $expression): self
    {
        $this->expression = $expression;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'ValueAnnotation';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        $base   = [];
        $base[] = new AttributeContainer('Term', $this->getTerm());
        $base[] = new AttributeContainer('Qualifier', $this->getQualifier());
        if (//        $this->expression instanceof Expressions\Dynamic\TPathExpression ||
            $this->expression instanceof Expressions\Constant\StringConstant ||
            $this->expression instanceof Expressions\Constant\IntConstant ||
            $this->expression instanceof Expressions\Constant\FloatConstant ||
            $this->expression instanceof Expressions\Constant\DecimalConstant ||
            $this->expression instanceof Expressions\Constant\BoolConstant ||
            $this->expression instanceof Expressions\Constant\DateTimeConstant
        ) {
            $base[] = $this->expression;
        }
        return $base;
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        if (!(
      //      $this->expression instanceof Expressions\Dynamic\TPathExpression ||
            $this->expression instanceof Expressions\Constant\StringConstant ||
            $this->expression instanceof Expressions\Constant\IntConstant ||
            $this->expression instanceof Expressions\Constant\FloatConstant ||
            $this->expression instanceof Expressions\Constant\DecimalConstant ||
            $this->expression instanceof Expressions\Constant\BoolConstant ||
            $this->expression instanceof Expressions\Constant\DateTimeConstant
        )) {
            return [$this->expression];
        }
        return [];
    }
}
