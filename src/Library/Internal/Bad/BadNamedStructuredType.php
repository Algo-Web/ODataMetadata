<?php


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;

class BadNamedStructuredType extends BadStructuredType implements ISchemaElement
{
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
     * @param EdmError[] $errors
     */
    public function __construct(?string $qualifiedName, array $errors)
    {
        parent::__construct($errors);
        $qualifiedName = $qualifiedName ?? '';
        EdmUtil::TryGetNamespaceNameFromQualifiedName($qualifiedName, $this->namespaceName, $this->name);
    }

    public function getName(): string{
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