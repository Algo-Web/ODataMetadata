<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Csdl;

use AlgoWeb\ODataMetadata\Csdl\Internal\Serialization\EdmModelCsdlSerializationVisitor;
use AlgoWeb\ODataMetadata\Csdl\Internal\Serialization\EdmModelSchemaSeparationSerializationVisitor;
use AlgoWeb\ODataMetadata\Csdl\Internal\Serialization\EdmSchema;
use AlgoWeb\ODataMetadata\Csdl\Internal\Serialization\SerializationValidator;
use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Version;
use XMLWriter;

/**
 * Provides EDMX serialization services for EDM models.
 *
 * @package AlgoWeb\ODataMetadata\Csdl
 */
class EdmxWriter
{
    /**
     * @var IModel
     */
    private $model;
    /**
     * @var EdmSchema[]
     */
    private $schemas;
    /**
     * @var XmlWriter
     */
    private $writer;
    /**
     * @var Version
     */
    private $edmxVersion;
    /**
     * @var string
     */
    private $edmxNamespace;
    /**
     * @var EdmxTarget
     */
    private $target;

    private $namespacesWritten = [];
    private function getEdmxNamespace(): ?string
    {
        return isset($this->namespacesWritten[$this->edmxNamespace]) ? null : $this->namespacesWritten[$this->edmxNamespace] = $this->edmxNamespace;
    }

    private function __construct(IModel $model, array $schemas, XmlWriter $writer, Version $edmxVersion, EdmxTarget $target)
    {
        $this->model       = $model;
        $this->schemas     = $schemas;
        $this->writer      = $writer;
        $this->edmxVersion = $edmxVersion;
        $this->target      = $target;

        assert(in_array($edmxVersion, CsdlConstants::getSupportedVersions()), 'Unsupported Edmx Version');
        $this->edmxNamespace = CsdlConstants::versionToEdmxNamespace(/*Version::v1());/*/ $edmxVersion);
    }

    /**
     * Outputs an EDMX artifact to the provided XmlWriter.
     *
     * @param  IModel                                                 $model  model to be written
     * @param  XMLWriter                                              $writer xmlWriter the generated EDMX will be written to
     * @param  EdmxTarget                                             $target target implementation of the EDMX being generated
     * @param  array                                                  $errors errors that prevented successful serialization, or no errors if serialization was successful
     * @throws \ReflectionException
     * @throws \AlgoWeb\ODataMetadata\Exception\NotSupportedException
     * @return bool                                                   a value indicating whether serialization was successful
     */
    public static function TryWriteEdmx(IModel $model, XmlWriter $writer, EdmxTarget $target = null, array &$errors = []): bool
    {
        $target = $target ?? EdmxTarget::OData();
        $errors = SerializationValidator::GetSerializationErrors($model);
        if (count($errors) > 0) {
            return false;
        }

        $edmxVersion = $model->getEdmxVersion();
        if ($edmxVersion != null) {
            if (!in_array($edmxVersion, CsdlConstants::getSupportedVersions())) {
                $errors = [new EdmError(new CsdlLocation(0, 0), EdmErrorCode::UnknownEdmxVersion(), StringConst::Serializer_UnknownEdmxVersion())];
                return false;
            }
        } elseif (! $edmxVersion = CsdlConstants::EdmToEdmxVersions($model->getEdmVersion() ?? Version::v3())) {
            $errors = [new EdmError(new CsdlLocation(0, 0), EdmErrorCode::UnknownEdmVersion(), StringConst::Serializer_UnknownEdmVersion()) ];
            return false;
        }

        $schemas = (new EdmModelSchemaSeparationSerializationVisitor($model))->GetSchemas();
        $writer->openMemory();
        $writer->startDocument();
        $writer->setIndent(true);
        $writer->setIndentString('   ');
        $edmxWriter = new EdmxWriter($model, $schemas, $writer, $edmxVersion, $target);
        $edmxWriter->WriteEdmx();
        $writer->endDocument();

        $errors = [];
        return true;
    }

    /**
     * @throws \AlgoWeb\ODataMetadata\Exception\NotSupportedException
     * @throws \ReflectionException
     */
    private function WriteEdmx(): void
    {
        switch ($this->target) {
            case EdmxTarget::OData():
                $this->WriteODataEdmx();
                break;
            default:
                throw new InvalidOperationException(StringConst::UnknownEnumVal_EdmxTarget($this->target->getKey()));
        }
    }

    /**
     * @throws \AlgoWeb\ODataMetadata\Exception\NotSupportedException
     * @throws \ReflectionException
     */
    private function WriteODataEdmx(): void
    {
        $this->WriteEdmxElement();
        $this->WriteDataServicesElement();
        $this->WriteSchemas();
        $this->EndElement(); // </DataServices>
        $this->EndElement(); // </Edmx>
    }

    private function WriteEdmxElement(): void
    {
        $this->writer->startElementNs(CsdlConstants::Prefix_Edmx, CsdlConstants::Element_Edmx, $this->getEdmxNamespace());
        $this->writer->writeAttribute(CsdlConstants::Prefix_Xml_Namespace, CsdlConstants::versionToEdmNamespace($this->edmxVersion));
        $this->writer->writeAttributeNs(CsdlConstants::Prefix_Xml_Namespace, CsdlConstants::Prefix_ODataMetadata, null, CsdlConstants::ODataMetadataNamespace);
        $this->writer->writeAttributeNs(CsdlConstants::Prefix_Xml_Namespace, CsdlConstants::Prefix_Annotations, null, CsdlConstants::AnnotationNamespace);

        $this->writer->writeAttribute(CsdlConstants::Attribute_Version, /*Version::v1()->toString());*/ $this->edmxVersion->toString());
    }

    private function WriteDataServicesElement(): void
    {
        $this->writer->startElementNs(CsdlConstants::Prefix_Edmx, CsdlConstants::Element_DataServices, $this->getEdmxNamespace());
        $dataServiceVersion = $this->model->getDataServiceVersion();
        if ($dataServiceVersion != null) {
            $this->writer->writeAttributeNs(CsdlConstants::Prefix_ODataMetadata, CsdlConstants::Attribute_DataServiceVersion, CsdlConstants::ODataMetadataNamespace, $dataServiceVersion->ToString());
        } else {
            $this->writer->writeAttributeNs(CsdlConstants::Prefix_ODataMetadata, CsdlConstants::Attribute_DataServiceVersion, CsdlConstants::ODataMetadataNamespace, $this->edmxVersion->ToString());
        }

        $dataServiceMaxVersion = $this->model->getMaxDataServiceVersion();
        if ($dataServiceMaxVersion != null) {
            $this->writer->writeAttributeNs(CsdlConstants::Prefix_ODataMetadata, CsdlConstants::Attribute_MaxDataServiceVersion, CsdlConstants::ODataMetadataNamespace, $dataServiceMaxVersion->ToString());
        }
    }

    /**
     * @throws \AlgoWeb\ODataMetadata\Exception\NotSupportedException
     * @throws \ReflectionException
     */
    private function WriteSchemas(): void
    {
        $edmVersion = $this->model->getEdmVersion() ?? Version::v3();
        foreach ($this->schemas as $schema) {
            $visitor = new EdmModelCsdlSerializationVisitor($this->model, $this->writer, $edmVersion);
            $visitor->VisitEdmSchema($schema, $this->model->getNamespacePrefixMappings());
        }
    }

    private function EndElement(): void
    {
        $this->writer->endElement();
    }
}
