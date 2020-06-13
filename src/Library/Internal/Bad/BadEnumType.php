<?php


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;


use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Library\Core\EdmCoreModel;

/**
 * Represents a semantically invalid EDM enumeration type.
 *
 * @package AlgoWeb\ODataMetadata\Library\Internal\Bad
 */
class BadEnumType extends BadType implements IEnumType
{
    /**
     * @var string
     */
    private $namespaceName;
    /**
     * @var string
     */
    private $name;

    public function __construct(?string $qualifiedName,array $errors)
    {
        parent::__construct($errors);
        $qualifiedName = $qualifiedName ?? '';
        EdmUtil::TryGetNamespaceNameFromQualifiedName($qualifiedName, $this->namespaceName, $this->name);

    }

    /**
     * @return IPrimitiveType Gets the underlying type of this enumeration type.
     */
    public function getUnderlyingType(): IPrimitiveType
    {
        return EdmCoreModel::getInstance()->GetPrimitiveType(PrimitiveTypeKind::Int32());
    }

    /**
     * @return IEnumMember[] Gets the members of this enumeration type.
     */
    public function getMembers(): array
    {
        return [];
    }

    /**
     * @return bool Gets a value indicating whether the enumeration type can be treated as a bit field.
     */
    public function isFlags(): bool
    {
        return false;
    }

    /**
     * @return string Gets the name of this element.
     */
    public function getName(): string
    {
        return $this->name;
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
}