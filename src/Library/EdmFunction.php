<?php


namespace AlgoWeb\ODataMetadata\Library;


use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

class EdmFunction extends EdmFunctionBase implements IFunction
{
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
     * @param string $namespaceName Namespace of the function.
     * @param string $name Name of the function.
     * @param ITypeReference $returnType Return type of the function.
     * @param string|null $definingExpression Defining expression of the function (for example an eSQL expression).
     */
    public function __construct(string $namespaceName, string $name, ITypeReference $returnType, string $definingExpression = null)
    {
        parent::__construct($name, $returnType);
        $this->namespaceName = $namespaceName;
        $this->definingExpression = $definingExpression;
    }

    /**
     * @return string Gets the defining expression of this function.
     */
    public function getDefiningExpression(): string
    {
        return $this->definingExpression;
    }

    /**
     * @return SchemaElementKind Gets the kind of this schema element.
     */
    public function getSchemaElementKind(): SchemaElementKind
    {
        return SchemaElementKind::Function();
    }

    /**
     * @return string Gets the namespace this schema element belongs to.
     */
    public function getNamespace(): string
    {
        return $this->namespaceName;
    }
}