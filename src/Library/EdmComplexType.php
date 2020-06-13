<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Enums\TermKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Helpers\ComplexTypeHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IComplexType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;

/**
 * Represents a definition of an EDM complex type.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
class EdmComplexType extends EdmStructuredType implements IComplexType
{
    use ComplexTypeHelpers;
    /**
     * @var string
     */
    private $namespaceName;
    /**
     * @var string
     */
    private $name;

    /**
     * Initializes a new instance of the EdmComplexType class.
     * Note: Complex type inheritance is not supported in EDM version 3.0 and above.
     *
     * @param string               $namespaceName      the namespace this type belongs to
     * @param string               $name               the name of this type within its namespace
     * @param bool                 $isAbstract         denotes whether this complex type is abstract
     * @param IStructuredType|null $baseStructuredType the base type of this complex type
     */
    public function __construct(string $namespaceName, string $name, ?IStructuredType $baseStructuredType = null, bool $isAbstract = false)
    {
        parent::__construct($isAbstract, false, $baseStructuredType);
        $this->namespaceName = $namespaceName;
        $this->name          = $name;
    }

    /**
     * @return TypeKind gets the kind of this type
     */
    public function getTypeKind(): TypeKind
    {
        return TypeKind::Complex();
    }

    /**
     * @return string gets the name of this element
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return SchemaElementKind gets the kind of this schema element
     */
    public function getSchemaElementKind(): SchemaElementKind
    {
        return SchemaElementKind::TypeDefinition();
    }

    /**
     * @return string gets the namespace this schema element belongs to
     */
    public function getNamespace(): string
    {
        return $this->namespaceName;
    }

    /**
     * @return TermKind gets the kind of a term
     */
    public function getTermKind(): TermKind
    {
        return TermKind::Type();
    }
}
