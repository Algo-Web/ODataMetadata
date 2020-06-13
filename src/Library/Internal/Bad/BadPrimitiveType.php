<?php


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Helpers\PrimitiveTypeHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleICheckable;

/**
 * Class BadPrimitiveType
 *
 * Represents a semantically invalid EDM primitive type definition.
 *
 * @package AlgoWeb\ODataMetadata\Library\Internal\Bad
 */
class BadPrimitiveType extends BadType implements IPrimitiveType
{
    use PrimitiveTypeHelpers;
    use SimpleICheckable;
    /**
     * @var PrimitiveTypeKind
     */
    private $primitiveKind;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $namespaceName;

    /**
     * BadPrimitiveType constructor.
     * @param string $qualifiedName
     * @param PrimitiveTypeKind $primitiveKind
     * @param EdmError[] $errors
     */
    public function __construct(?string $qualifiedName, PrimitiveTypeKind $primitiveKind, array $errors)
    {
        parent::__construct($errors);
        $this->primitiveKind = $primitiveKind;
        $qualifiedName = $qualifiedName ?? '';
        $name = null;
        $namespaceName = null;
        EdmUtil::TryGetNamespaceNameFromQualifiedName($qualifiedName, $namespaceName, $name);
        $this->namespaceName = $namespaceName;
        $this->name = $name;


    }

    /**
     * @return string Gets the name of this element.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return PrimitiveTypeKind Gets the primitive kind of this type.
     */
    public function getPrimitiveKind(): PrimitiveTypeKind
    {
        return $this->primitiveKind;
    }

    /**
     * @return SchemaElementKind Gets the kind of this schema element.
     */
    public function getSchemaElementKind(): SchemaElementKind
    {
        return SchemaElementKind::TypeDefinition();
    }

    /**
     * @return string Gets the namespace this schema element belongs to.
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
        return TypeKind::Primitive();
    }
}