<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces\Expressions\RecordExpression;

use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;

/**
 * Interface IPropertyConstructor.
 *
 * Represents an EDM property constructor specified as part of a EDM construction record expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions\RecordExpression
 */
interface IPropertyConstructor extends IEdmElement
{
    /**
     * @return string|null gets the name of the property
     */
    public function getName(): ?string;

    /**
     * @return IExpression|null gets the expression for the value of the property
     */
    public function getValue(): ?IExpression;
}
