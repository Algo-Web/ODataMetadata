<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Csdl\Internal\Serialization;

use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;

class EdmSchema
{
    /**
     * @var string
     */
    private $schemaNamespace;
    /**
     * @var ISchemaElement[]
     */
    private $schemaElements;
    /**
     * @var INavigationProperty[]
     */
    private $associationNavigationProperties;
    /**
     * @var IEntityContainer[]
     */
    private $entityContainers;
    /**
     * @var array<string, IVocabularyAnnotation[]>
     */
    private $annotations;
    /**
     * @var string[]
     */
    private $usedNamespaces;

    public function __construct(string $namespaceString)
    {
        $this->schemaNamespace                 = $namespaceString;
        $this->schemaElements                  = [];
        $this->entityContainers                = [];
        $this->associationNavigationProperties = [];
        $this->annotations                     = [];
        $this->usedNamespaces                  = [];
    }
    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->schemaNamespace;
    }

    /**
     * @return ISchemaElement[]
     */
    public function getSchemaElements(): array
    {
        return $this->schemaElements;
    }

    /**
     * @return INavigationProperty[]
     */
    public function getAssociationNavigationProperties(): array
    {
        return $this->associationNavigationProperties;
    }

    /**
     * @return IEntityContainer[]
     */
    public function getEntityContainers(): array
    {
        return $this->entityContainers;
    }

    /**
     * @return array[]
     */
    public function getAnnotations(): array
    {
        return $this->annotations;
    }

    /**
     * @return string[]
     */
    public function getUsedNamespaces(): array
    {
        return $this->usedNamespaces;
    }

    public function addSchemaElement(ISchemaElement $element): self
    {
        $this->schemaElements[] = $element;
        return $this;
    }

    public function addEntityContainer(IEntityContainer $container): self
    {
        $this->entityContainers[] = $container;
        return $this;
    }

    public function addNamespaceUsing(string $usedNamespace): self
    {
        if ($usedNamespace != EdmConstants::EdmNamespace) {
            if (!in_array($usedNamespace, $this->usedNamespaces)) {
                $this->usedNamespaces[] = $usedNamespace;
            }
        }
        return $this;
    }

    public function addVocabularyAnnotation(IVocabularyAnnotation $annotation)
    {
        if (!array_key_exists($annotation->targetString(), $this->annotations)) {
            $this->annotations[$annotation->targetString()] = [];
        }
        $this->annotations[$annotation->targetString()][] = $annotation;
        return $this;
    }

    public function addAssociatedNavigationProperty(INavigationProperty $property): self
    {
        $this->associationNavigationProperties[] = $property;
        return $this;
    }
}
