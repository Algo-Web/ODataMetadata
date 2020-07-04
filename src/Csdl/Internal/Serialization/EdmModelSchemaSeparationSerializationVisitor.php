<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Csdl\Internal\Serialization;

use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Helpers\Helpers;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IComplexType;
use AlgoWeb\ODataMetadata\Interfaces\IComplexTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\Interfaces\IEnumTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;

class EdmModelSchemaSeparationSerializationVisitor extends EdmModelVisitor
{
    /**
     * @var bool
     */
    private $visitCompleted = false;
    /**
     * @var array<string, EdmSchema>
     */
    private $modelSchemas = [];
    /**
     * @var EdmSchema
     */
    private $activeSchema;


    public function GetSchemas(): array
    {
        if (!$this->visitCompleted) {
            $this->Visit();
        }

        return array_values($this->modelSchemas);
    }

    public function visit(): void
    {
        $this->visitEdmModel();
        $this->visitCompleted = true;
    }

    protected function processModel(IModel $model): void
    {
        $this->ProcessElement($model);
        $this->visitSchemaElements($model->getSchemaElements());
        $this->VisitVocabularyAnnotations(
            array_filter(
                $model->getVocabularyAnnotations(),
                function (IVocabularyAnnotation $value) {
                    $value->IsInline($this->model);
                }
            )
        );
    }

    protected function ProcessVocabularyAnnotatable(IVocabularyAnnotatable $element): void
    {
        $this->VisitAnnotations($this->model->getDirectValueAnnotationsManager()->getDirectValueAnnotations($element));
        $this->VisitVocabularyAnnotations(
            array_filter(
                $this->model->findDeclaredVocabularyAnnotations($element),
                function (IVocabularyAnnotation $value) {
                    $value->IsInline($this->model);
                }
            )
        );
    }

    protected function ProcessSchemaElement(ISchemaElement $element): void
    {
        $namespaceName = $element->getNamespace();

        // Put all of the namespaceless stuff into one schema.
        if (EdmUtil::IsNullOrWhiteSpaceInternal($namespaceName)) {
            $namespaceName = '';
        }
        /** @var EdmSchema|null $schema */
        $schema = null;
        if (!array_key_exists($namespaceName, $this->modelSchemas)) {
            $schema                             = new EdmSchema($namespaceName);
            $this->modelSchemas[$namespaceName] =  $schema;
        }

        $this->modelSchemas[$namespaceName]->addSchemaElement($element);
        $this->activeSchema = $this->modelSchemas[$namespaceName];
        parent::ProcessSchemaElement($element);
    }

    protected function ProcessVocabularyAnnotation(IVocabularyAnnotation $annotation): void
    {
        if (!$annotation->IsInline($this->model)) {
            $annotationSchemaNamespace = $annotation->GetSchemaNamespace($this->model) ??
                count($this->modelSchemas) === 0 ? '' : array_keys($this->modelSchemas)[0];
            if (!array_key_exists($annotationSchemaNamespace, $this->modelSchemas)) {
                $annotationSchema                               = new EdmSchema($annotationSchemaNamespace);
                $annotationSchemaNamespace                      = $annotationSchema->getNamespace();
                $this->modelSchemas[$annotationSchemaNamespace] = $annotationSchema;
            }

            $this->modelSchemas[$annotationSchemaNamespace]->addVocabularyAnnotation($annotation);
            $this->activeSchema = $this->modelSchemas[$annotationSchemaNamespace];
        }

        if ($annotation->getTerm() != null) {
            $this->CheckSchemaElementReference($annotation->getTerm());
        }

        parent::ProcessVocabularyAnnotation($annotation);
    }

    /**
     * When we see an entity container, we see if it has <see cref="CsdlConstants.SchemaNamespaceAnnotation"/>.
     * If it does, then we attach it to that schema, otherwise we attached to the first existing schema.
     * If there are no schemas, we create the one named "Default" and attach container to it.
     *
     * @param IEntityContainer $element the entity container being processed
     */
    protected function ProcessEntityContainer(IEntityContainer $element): void
    {
        $containerSchemaNamespace = $element->getNamespace();

        if (!array_key_exists($containerSchemaNamespace, $this->modelSchemas)) {
            $containerSchema                               = new EdmSchema($containerSchemaNamespace);
            $containerSchemaNamespace                      = $containerSchema->getNamespace();
            $this->modelSchemas[$containerSchemaNamespace] = $containerSchema;
        }

        $this->modelSchemas[$containerSchemaNamespace]->addEntityContainer($element);
        $this->activeSchema = $this->modelSchemas[$containerSchemaNamespace];

        parent::ProcessEntityContainer($element);
    }

    protected function ProcessComplexTypeReference(IComplexTypeReference $element): void
    {
        $this->CheckSchemaElementReference($element->ComplexDefinition());
    }

    protected function ProcessEntityTypeReference(IEntityTypeReference $element): void
    {
        $this->CheckSchemaElementReference($element->EntityDefinition());
    }

    protected function ProcessEntityReferenceTypeReference(IEntityReferenceTypeReference $element): void
    {
        $this->CheckSchemaElementReference($element->EntityType());
    }

    protected function ProcessEnumTypeReference(IEnumTypeReference $element): void
    {
        $this->CheckSchemaElementReference($element->EnumDefinition());
    }

    protected function ProcessEntityType(IEntityType $element): void
    {
        parent::ProcessEntityType($element);
        if ($element->BaseEntityType() != null) {
            $this->CheckSchemaElementReference($element->BaseEntityType());
        }
    }

    protected function ProcessComplexType(IComplexType $element): void
    {
        parent::ProcessComplexType($element);
        if ($element->BaseComplexType() != null) {
            $this->CheckSchemaElementReference($element->BaseComplexType());
        }
    }

    protected function ProcessEnumType(IEnumType $element): void
    {
        parent::ProcessEnumType($element);
        $this->CheckSchemaElementReference($element->getUnderlyingType());
    }

    protected function ProcessNavigationProperty(INavigationProperty $property): void
    {
        $associationNamespace = Helpers::GetAssociationNamespace($this->model, $property);

        if (!array_key_exists($associationNamespace, $this->modelSchemas)) {
            $associationSchema                         = new EdmSchema($associationNamespace);
            $associationNamespace                      = $associationSchema->getNamespace();
            $this->modelSchemas[$associationNamespace] = $associationSchema;
        }

        $this->modelSchemas[$associationNamespace]->AddAssociatedNavigationProperty($property);
        $this->modelSchemas[$associationNamespace]->AddNamespaceUsing($property->DeclaringEntityType()->getNamespace());
        $this->modelSchemas[$associationNamespace]->AddNamespaceUsing(
            $property->getPartner()->DeclaringEntityType()->getNamespace()
        );
        $this->activeSchema->AddNamespaceUsing($associationNamespace);

        parent::ProcessNavigationProperty($property);
    }
    /**
     * @param string|ISchemaElement $elementOrNamespaceName
     */
    private function CheckSchemaElementReference($elementOrNamespaceName): void
    {
        $namespaceName = $elementOrNamespaceName instanceof ISchemaElement ?
            $elementOrNamespaceName->getNamespace() : $elementOrNamespaceName;
        assert(is_string($namespaceName));
        if ($this->activeSchema != null) {
            $this->activeSchema->addNamespaceUsing($namespaceName);
        }
    }
}
