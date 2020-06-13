<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Annotations;


use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;

/**
 * Interface IEdmPropertyValueBinding
 *
 * Represents a property binding specified as part of an EDM type annotation.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Annotations
 */
interface IPropertyValueBinding extends IEdmElement
{
    /**

     * @return IProperty Gets the property that is given a value by the annotation.
     */
    public function getBoundProperty(): IProperty ;

    /**

     * @return IExpression Gets the expression producing the value of the annotation.
     */
    public function getValue(): IExpression ;
}