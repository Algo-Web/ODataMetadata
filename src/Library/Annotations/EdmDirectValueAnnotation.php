<?php

declare(strict_types=1);

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
    /**
     * @var mixed
     */
    private $value;
    /**
     * @var string
     */
    private $namespaceUri;

    /**
     * Initializes a new instance of the EdmDirectValueAnnotation class.
     * @param string $namespaceUri namespace URI of the annotation
     * @param string $name         name of the annotation within the namespace
     * @param mixed  $value        Value of the annotation
     */
    public function __construct(string $namespaceUri, string $name, $value = null)
    {
        parent::__construct($name);
        $this->namespaceUri = $namespaceUri;
        $this->value        = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getNamespaceUri(): string
    {
        return $this->namespaceUri;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }
}
