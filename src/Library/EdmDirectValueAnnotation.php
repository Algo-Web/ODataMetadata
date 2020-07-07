<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 7/07/20
 * Time: 11:33 PM
 */

namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;

class EdmDirectValueAnnotation extends EdmNamedElement implements IDirectValueAnnotation
{
    private $namespaceUri;
    private $value;

    public function __construct(string $namespaceUri, string $name, $value = null)
    {
        parent::__construct($name);
        $this->namespaceUri = $namespaceUri;
        $this->value = $value;
    }

    /**
     * @return string gets the namespace Uri of the annotation
     */
    public function getNamespaceUri(): string
    {
        return $this->namespaceUri;
    }

    /**
     * @return mixed gets the value of this annotation
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Gets the location of this element.
     *
     * @return ILocation|null the location of the element
     */
    public function Location(): ?ILocation
    {
        // TODO: Implement Location() method.
    }

    public function getErrors(): iterable
    {
        // TODO: Implement getErrors() method.
    }
}
