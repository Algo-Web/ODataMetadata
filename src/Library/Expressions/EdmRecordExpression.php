<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Expressions;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Helpers\RecordExpressionHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IRecordExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\RecordExpression\IPropertyConstructor;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmElement;

/**
 * Represents an EDM record construction expression.
 *
 * @package AlgoWeb\ODataMetadata\Library\Expressions
 */
class EdmRecordExpression extends EdmElement implements IRecordExpression
{
    use RecordExpressionHelpers;
    /**
     * @var IStructuredTypeReference
     */
    private $declaredType;
    /**
     * @var IPropertyConstructor[]
     */
    private $properties;

    /**
     * Initializes a new instance of the EdmRecordExpression class.
     * @param IStructuredTypeReference $declaredType  optional declared type of the record
     * @param IPropertyConstructor     ...$properties Property constructors.
     */
    public function __construct(IStructuredTypeReference $declaredType = null, IPropertyConstructor ...$properties)
    {
        $this->declaredType = $declaredType;
        $this->properties   = $properties;
    }
    /**
     * {@inheritdoc}
     */
    public function getDeclaredType(): IStructuredTypeReference
    {
        return $this->declaredType;
    }

    /**
     * {@inheritdoc}
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * {@inheritdoc}
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::Record();
    }
}
