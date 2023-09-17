<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Expressions;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IEnumMemberReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;
use AlgoWeb\ODataMetadata\Library\EdmElement;

/**
 * Represents an EDM enumeration member reference expression.
 * @package AlgoWeb\ODataMetadata\Library\Expressions
 */
class EdmEnumMemberReferenceExpression extends EdmElement implements IEnumMemberReferenceExpression
{
    /**
     * @var IEnumMember
     */
    private $referencedEnumMember;

    /**
     * Initializes a new instance of the EdmEnumMemberReferenceExpression class.
     * @param IEnumMember $referencedEnumMember referenced enum member
     */
    public function __construct(IEnumMember $referencedEnumMember)
    {
        $this->referencedEnumMember = $referencedEnumMember;
    }

    /**
     * {@inheritdoc}
     */
    public function getReferencedEnumMember(): IEnumMember
    {
        return $this->referencedEnumMember;
    }

    /**
     * {@inheritdoc}
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::EnumMemberReference();
    }
}
