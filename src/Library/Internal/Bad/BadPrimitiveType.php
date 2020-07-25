<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Helpers\PrimitiveTypeHelpers;
use AlgoWeb\ODataMetadata\Helpers\SchemaElementHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleICheckable;

/**
 * Class BadPrimitiveType.
 *
 * Represents a semantically invalid EDM primitive type definition.
 *
 * @package AlgoWeb\ODataMetadata\Library\Internal\Bad
 */
class BadPrimitiveType extends BadType implements IPrimitiveType
{
    use PrimitiveTypeHelpers;
    use SchemaElementHelpers;
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
     * @param string            $qualifiedName
     * @param PrimitiveTypeKind $primitiveKind
     * @param EdmError[]        $errors
     */
    public function __construct(?string $qualifiedName, PrimitiveTypeKind $primitiveKind, array $errors)
    {
        parent::__construct($errors);
        $this->primitiveKind = $primitiveKind;
        $qualifiedName       = $qualifiedName ?? '';
        $name                = null;
        $namespaceName       = null;
        EdmUtil::tryGetNamespaceNameFromQualifiedName($qualifiedName, $namespaceName, $name);
        $this->namespaceName = $namespaceName;
        $this->name          = $name;
    }

    /**
     * @return string|null gets the name of this element
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return PrimitiveTypeKind gets the primitive kind of this type
     */
    public function getPrimitiveKind(): PrimitiveTypeKind
    {
        return $this->primitiveKind;
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
     * @return TypeKind gets the kind of this type
     */
    public function getTypeKind(): TypeKind
    {
        return TypeKind::Primitive();
    }
}
