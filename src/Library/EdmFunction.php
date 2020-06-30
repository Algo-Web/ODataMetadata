<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Helpers\SchemaElementHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

class EdmFunction extends EdmFunctionBase implements IFunction
{
    use SchemaElementHelpers;

    /**
     * @var string
     */
    private $namespaceName;
    /**
     * @var string
     */
    private $definingExpression;

    /**
     * Initializes a new instance of the EdmFunction class.
     *
     * @param string         $namespaceName      namespace of the function
     * @param string         $name               name of the function
     * @param ITypeReference $returnType         return type of the function
     * @param string|null    $definingExpression defining expression of the function (for example an eSQL expression)
     */
    public function __construct(string $namespaceName, string $name, ITypeReference $returnType, string $definingExpression = null)
    {
        parent::__construct($name, $returnType);
        $this->namespaceName      = $namespaceName;
        $this->definingExpression = $definingExpression;
    }

    /**
     * @return string gets the defining expression of this function
     */
    public function getDefiningExpression(): string
    {
        return $this->definingExpression;
    }

    /**
     * @return SchemaElementKind gets the kind of this schema element
     */
    public function getSchemaElementKind(): SchemaElementKind
    {
        return SchemaElementKind::Function();
    }

    /**
     * @return string gets the namespace this schema element belongs to
     */
    public function getNamespace(): string
    {
        return $this->namespaceName;
    }
}
