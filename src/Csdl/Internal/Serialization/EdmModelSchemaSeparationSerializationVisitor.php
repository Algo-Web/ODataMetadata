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
            $this->visit();
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
        $this->processElement($model);
        $this->visitSchemaElements($model->getSchemaElements());
        $this->visitVocabularyAnnotations(
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
        $this->visitAnnotations($this->model->getDirectValueAnnotationsManager()->getDirectValueAnnotations($element));
        $this->visitVocabularyAnnotations(
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
            $schema                             = new EdmSchema(/** @scrutinizer ignore-type */$namespaceName);
            $this->modelSchemas[$namespaceName] = $schema;
        }

        $this->modelSchemas[$namespaceName]->addSchemaElement($element);
        $this->activeSchema = $this->modelSchemas[$namespaceName];
        parent::processSchemaElement($element);
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

        if (null !== $annotation->getTerm()) {
            $this->CheckSchemaElementReference($annotation->getTerm());
        }

        parent::processVocabularyAnnotation($annotation);
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
        EdmUtil::checkArgumentNull($element->getNamespace(), 'element->getNamespace');
        $containerSchemaNamespace = $element->getNamespace();

        if (!array_key_exists($containerSchemaNamespace, $this->modelSchemas)) {
            $containerSchema                               = new EdmSchema($containerSchemaNamespace);
            $containerSchemaNamespace                      = $containerSchema->getNamespace();
            $this->modelSchemas[$containerSchemaNamespace] = $containerSchema;
        }

        $this->modelSchemas[$containerSchemaNamespace]->addEntityContainer($element);
        $this->activeSchema = $this->modelSchemas[$containerSchemaNamespace];

        parent::processEntityContainer($element);
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
        if (null !== $element->BaseEntityType()) {
            $this->CheckSchemaElementReference($element->BaseEntityType());
        }
    }

    protected function ProcessComplexType(IComplexType $element): void
    {
        parent::ProcessComplexType($element);
        if (null !== $element->BaseComplexType()) {
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
        EdmUtil::checkArgumentNull($associationNamespace, 'associationNamespace');

        if (!array_key_exists($associationNamespace, $this->modelSchemas)) {
            $associationSchema                         = new EdmSchema($associationNamespace);
            $associationNamespace                      = $associationSchema->getNamespace();
            $this->modelSchemas[$associationNamespace] = $associationSchema;
        }

        $entityTypeNamespace = $property->DeclaringEntityType()->getNamespace();
        EdmUtil::checkArgumentNull($entityTypeNamespace, 'property->DeclaringEntityType->getNamespace');
        $partnerEntityTypeNamespace = $property->getPartner()->DeclaringEntityType()->getNamespace();
        EdmUtil::checkArgumentNull(
            $partnerEntityTypeNamespace,
            'property->getPartner->DeclaringEntityType->getNamespace'
        );
        $this->modelSchemas[$associationNamespace]->AddAssociatedNavigationProperty($property);
        $this->modelSchemas[$associationNamespace]->AddNamespaceUsing($entityTypeNamespace);
        $this->modelSchemas[$associationNamespace]->AddNamespaceUsing($partnerEntityTypeNamespace);
        $this->activeSchema->addNamespaceUsing($associationNamespace);

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
