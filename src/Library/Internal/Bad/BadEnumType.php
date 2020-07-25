<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Helpers\SchemaElementHelpers;
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
    use SchemaElementHelpers;

    /**
     * @var string
     */
    private $namespaceName;
    /**
     * @var string
     */
    private $name;

    public function __construct(?string $qualifiedName, array $errors)
    {
        parent::__construct($errors);
        $qualifiedName = $qualifiedName ?? '';
        EdmUtil::TryGetNamespaceNameFromQualifiedName($qualifiedName, $this->namespaceName, $this->name);
    }

    /**
     * @return IPrimitiveType gets the underlying type of this enumeration type
     */
    public function getUnderlyingType(): IPrimitiveType
    {
        $type = EdmCoreModel::getInstance()->GetPrimitiveType(PrimitiveTypeKind::Int32());
        EdmUtil::checkArgumentNull($type, 'BadEnumType->getUnderlyingType');
        return $type;
    }

    /**
     * @return IEnumMember[] gets the members of this enumeration type
     */
    public function getMembers(): array
    {
        return [];
    }

    /**
     * @return bool gets a value indicating whether the enumeration type can be treated as a bit field
     */
    public function isFlags(): bool
    {
        return false;
    }

    /**
     * @return string|null gets the name of this element
     */
    public function getName(): ?string
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
}
