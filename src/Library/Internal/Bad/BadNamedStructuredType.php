<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Helpers\SchemaElementHelpers;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;

class BadNamedStructuredType extends BadStructuredType implements ISchemaElement
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

    /**
     * BadNamedStructuredType constructor.
     * @param string|null $qualifiedName
     * @param EdmError[]  $errors
     */
    public function __construct(?string $qualifiedName, array $errors)
    {
        parent::__construct($errors);
        $qualifiedName = $qualifiedName ?? '';
        EdmUtil::tryGetNamespaceNameFromQualifiedName($qualifiedName, $this->namespaceName, $this->name);
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
     * @return string|null gets the namespace this schema element belongs to
     */
    public function getNamespace(): ?string
    {
        return $this->namespaceName;
    }
}
