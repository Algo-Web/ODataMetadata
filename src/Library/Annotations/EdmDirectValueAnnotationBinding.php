<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Annotations;

use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotationBinding;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;

/**
 * Represents the combination of an EDM annotation with an immediate value and the element to which it is attached.
 * @package AlgoWeb\ODataMetadata\Library\Annotations
 */
class EdmDirectValueAnnotationBinding implements IDirectValueAnnotationBinding
{
    /**
     * @var IEdmElement
     */
    private $element;
    /**
     * @var string
     */
    private $namespaceUri;
    /**
     * @var string
     */
    private $name;
    /**
     * @var mixed
     */
    private $value;

    /**
     * Initializes a new instance of the EdmDirectValueAnnotationBinding class.
     * @param IEdmElement $element      element to which the annotation is attached
     * @param string      $namespaceUri namespace URI of the annotation
     * @param string      $name         name of the annotation within the namespace
     * @param mixed       $value        Value of the annotation
     */
    public function __construct(IEdmElement $element, string $namespaceUri, string $name, $value)
    {
        $this->element      = $element;
        $this->namespaceUri = $namespaceUri;
        $this->name         = $name;
        $this->value        = $value;
    }


    /**
     * {@inheritdoc}
     */
    public function getElement(): IEdmElement
    {
        return $this->element;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }
}
