<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use DOMElement;

/**
 *   2.1.36 Expressions.
 *
 * Values for a value term or properties of a type term are obtained by calculating expressions.
 * There are a variety of expressions that allow service authors to supply constant or dynamic values.
 *
 * All vocabulary expressions may be specified as an element, for example:
 *
 *     <ValueAnnotation Term="org.example.display.DisplayName">
 *         <String>Customers</String>
 *     </ValueAnnotation>
 *
 * The constant expressions and the Edm:Path expression also support attribute notation:
 *
 *     <ValueAnnotation Term="org.example.display.DisplayName" String="Customers" />
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions
 */
abstract class ExpressionBase extends EdmBase
{
}
