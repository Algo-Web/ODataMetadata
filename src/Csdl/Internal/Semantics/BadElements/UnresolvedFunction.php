<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Csdl\Internal\Semantics\BadElements;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadElement;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadType;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadTypeReference;

/**
 * Represents information about an EDM function that failed to resolve.
 *
 * @package AlgoWeb\ODataMetadata\Csdl\Internal\Semantics\BadElements
 */
class UnresolvedFunction extends BadElement implements IFunction, IUnresolvedElement
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
     * @var ITypeReference
     */
    private $returnType;

    public function __construct(?string $qualifiedName, string $errorMessage, ILocation $location)
    {
        parent::__construct([new EdmError($location, EdmErrorCode::BadUnresolvedFunction(), $errorMessage)]);
        //$this->qualifiedName = $qualifiedName ?? '';
        EdmUtil::TryGetNamespaceNameFromQualifiedName($qualifiedName, $this->namespaceName, $this->name);
        $this->returnType = new BadTypeReference(new BadType($this->getErrors()), true);
    }

    /**
     * @return string gets the defining expression of this function
     */
    public function getDefiningExpression(): string
    {
        return null;
    }

    /**
     * Gets the return type of this function.
     *
     * @return ITypeReference
     */
    public function getReturnType(): ITypeReference
    {
        return $this->returnType;
    }

    /**
     * Gets the collection of parameters for this function.
     *
     * @return IFunctionParameter[]|null
     */
    public function getParameters(): ?array
    {
        return [];
    }

    /**
     * Searches for a parameter with the given name, and returns null if no such parameter exists.
     *
     * @param  string                  $name the name of the parameter being found
     * @return IFunctionParameter|null the requested parameter or null if no such parameter exists
     */
    public function findParameter(string $name): ?IFunctionParameter
    {
        return null;
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
        return SchemaElementKind::Function();
    }

    /**
     * @return string gets the namespace this schema element belongs to
     */
    public function getNamespace(): string
    {
        return $this->namespaceName;
    }
}
