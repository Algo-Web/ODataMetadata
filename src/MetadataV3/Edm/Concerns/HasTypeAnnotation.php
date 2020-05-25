<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Annotations\TypeAnnotation;
use DOMElement;

trait HasTypeAnnotation
{
    /**
     * @var TypeAnnotation[] $typeAnnotation
     */
    private $typeAnnotation = [];


    /**
     * Adds as typeAnnotation.
     *
     * @param TypeAnnotation $typeAnnotation
     *@return self
     */
    public function addToTypeAnnotation(TypeAnnotation $typeAnnotation): self
    {
        $this->typeAnnotation[] = $typeAnnotation;
        return $this;
    }

    /**
     * isset typeAnnotation.
     *
     * @param  int  $index
     * @return bool
     */
    public function issetTypeAnnotation(int $index): bool
    {
        return isset($this->typeAnnotation[$index]);
    }

    /**
     * unset typeAnnotation.
     *
     * @param  int  $index
     * @return void
     */
    public function unsetTypeAnnotation(int $index): void
    {
        unset($this->typeAnnotation[$index]);
    }

    /**
     * Gets as typeAnnotation.
     *
     * @return TypeAnnotation[]
     */
    public function getTypeAnnotation(): array
    {
        return $this->typeAnnotation;
    }

    /**
     * Sets a new typeAnnotation.
     *
     * @param  TypeAnnotation[] $typeAnnotation
     * @return self
     */
    public function setHasTypeAnnotation(array $typeAnnotation): self
    {
        $this->typeAnnotation = $typeAnnotation;
        return $this;
    }
}
