<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;

/**
 * Trait VisitFunctionRelated.
 * @package AlgoWeb\ODataMetadata\ModelVisitorConcerns
 */
trait VisitFunctionRelated
{
    /**
     * @param IFunctionParameter[] $parameters
     */
    public function visitFunctionParameters(?array $parameters): void
    {
        /** @var EdmModelVisitor $this */
        self::visitCollection($parameters, [$this, 'ProcessFunctionParameter']);
    }
}
