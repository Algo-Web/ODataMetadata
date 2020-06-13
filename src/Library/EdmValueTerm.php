<?php


namespace AlgoWeb\ODataMetadata\Library;


use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Enums\TermKind;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Library\Core\EdmCoreModel;

class EdmValueTerm extends EdmNamedElement implements IValueTerm
{
    /**
     * @var string
     */
    private $namespaceName;
    /**
     * @var ITypeReference
     */
    private $type;

    /**
     * Initializes a new instance of EdmValueTerm class.
     * The new value term will be of the nullable primitive if a PrimitiveTypeKind is passed.
     * @param string $namespaceName Namespace of the term.
     * @param string $name Name of the term.
     * @param ITypeReference|PrimitiveTypeKind $type Type of the term.
     */
    public function __construct(string $namespaceName, string $name,  $type)
    {
        $type = ($type instanceof PrimitiveTypeKind) ? EdmCoreModel::getInstance()->GetPrimitive($type, true): $type;
        assert($type instanceof ITypeReference);
        parent::__construct($name);
        $this->type = $type;
        $this->namespaceName = $namespaceName;
    }

    /**
     * @return SchemaElementKind Gets the kind of this schema element.
     */
    public function getSchemaElementKind(): SchemaElementKind
    {
        return SchemaElementKind::ValueTerm();
    }

    /**
     * @return string Gets the namespace this schema element belongs to.
     */
    public function getNamespace(): string
    {
        return $this->namespaceName;
    }

    /**
     * Gets the kind of a term.
     *
     * @return TermKind
     */
    public function getTermKind(): TermKind
    {
        return TermKind::Value();
    }

    /**
     * @return ITypeReference Gets the type of this term.
     */
    public function getType(): ITypeReference
    {
        return $this->type;
    }
}