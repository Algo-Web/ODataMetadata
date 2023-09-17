<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Core;

use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Helpers\PrimitiveTypeHelpers;
use AlgoWeb\ODataMetadata\Helpers\SchemaElementHelpers;
use AlgoWeb\ODataMetadata\Helpers\VocabularyAnnotatableHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IEdmValidCoreModelElement;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Library\EdmType;

class EdmValidCoreModelPrimitiveType extends EdmType implements IPrimitiveType, IEdmValidCoreModelElement
{
    use PrimitiveTypeHelpers;
    use SchemaElementHelpers;
    use VocabularyAnnotatableHelpers;
    /**
     * @var string
     */
    private $namespaceName;
    /**
     * @var string
     */
    private $name;
    /**
     * @var PrimitiveTypeKind
     */
    private $primitiveKind;

    public function __construct(?string $namespaceName, ?string $name, PrimitiveTypeKind $primitiveKind)
    {
        $this->namespaceName = $namespaceName ?? '';
        $this->name          = $name ?? '';
        $this->primitiveKind = $primitiveKind;
    }

    /**
     * Gets the name of this element.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Gets the primitive kind of this type.
     *
     * @return PrimitiveTypeKind
     */
    public function getPrimitiveKind(): PrimitiveTypeKind
    {
        return $this->primitiveKind;
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
     * @return TypeKind gets the kind of this type
     */
    public function getTypeKind(): TypeKind
    {
        return TypeKind::Primitive();
    }
}
