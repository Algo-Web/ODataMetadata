<?php


namespace AlgoWeb\ODataMetadata\Library\Annotations;

use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotationBinding;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;

/**
 * Represents the combination of an EDM annotation with an immediate value and the element to which it is attached.
 * @package AlgoWeb\ODataMetadata\Library\Annotations
 */
class EdmDirectValueAnnotationBinding implements  IDirectValueAnnotationBinding
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
        private  $value;

    /**
     * Initializes a new instance of the EdmDirectValueAnnotationBinding class.
     * @param IEdmElement $element Element to which the annotation is attached.
     * @param string $namespaceUri Namespace URI of the annotation.
     * @param string $name Name of the annotation within the namespace.
     * @param mixed $value Value of the annotation
     */
    public function __construct(IEdmElement $element, string $namespaceUri, string $name, $value)
    {
        $this->element = $element;
        $this->namespaceUri = $namespaceUri;
        $this->name = $name;
        $this->value = $value;
    }


    /**
     * @inheritDoc
     */
    public function getElement(): IEdmElement
    {
        return $this->element;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function value()
    {
        return $this->value;
    }
}