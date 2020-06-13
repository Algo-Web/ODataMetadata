<?php


namespace AlgoWeb\ODataMetadata\Library\Internal\Ambiguous;


use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;

class AmbiguousTypeBinding extends AmbiguousBinding implements ISchemaType
{
    /**
     * @var string
     */
    private $namespaceName;
    public function __construct(ISchemaType $first, ISchemaType $second)
    {
        parent::__construct($first, $second);
        assert($first->getNamespace() === $second->getNamespace(), "Schema elements should only be ambiguous with other elements in the same namespace");
        $this->namespaceName = $first->getNamespace() ?? '';
    }

    /**
     * Gets the kind of this schema element.
     *
     * @return SchemaElementKind
     */
    public function getSchemaElementKind(): SchemaElementKind
    {
        return SchemaElementKind::TypeDefinition();
    }

    /**
     * Gets the namespace this schema element belongs to.
     *
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespaceName;
    }

    /**
     * @return TypeKind Gets the kind of this type.
     */
    public function getTypeKind(): TypeKind
    {
        return TypeKind::None();
    }
}