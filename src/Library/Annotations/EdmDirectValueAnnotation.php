<?php


namespace AlgoWeb\ODataMetadata\Library\Annotations;

use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;
use AlgoWeb\ODataMetadata\Library\EdmNamedElement;

/**
 * Represents an EDM annotation with an immediate native value.
 *
 * @package AlgoWeb\ODataMetadata\Library\Annotations
 */
class EdmDirectValueAnnotation extends EdmNamedElement implements IDirectValueAnnotation
{
private $value;
private $namespaceUri;

    /**
     * Initializes a new instance of the EdmDirectValueAnnotation class.
     * @param string $namespaceUri
     * @param string $name
     * @param $value
     */
public function __construct(string $namespaceUri, string $name, $value)
{
    parent::__construct($name);
    $this->namespaceUri = $namespaceUri;
    EdmUtil::checkArgumentNull($value, 'value');
    $this->value = $value;
}

    /**
     * @inheritDoc
     */
    public function getNamespaceUri(): string
    {
        return $this->namespaceUri;
    }

    /**
     * @inheritDoc
     */
    public function getValue()
    {
        return $this->value;
    }
}