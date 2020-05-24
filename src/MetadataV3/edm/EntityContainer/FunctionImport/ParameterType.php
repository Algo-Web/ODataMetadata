<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityContainer\FunctionImport;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets\HasMaxLength;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets\HasNullable;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets\HasPrecision;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets\HasScale;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\Facets\HasSRID;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\HasValueAnnotation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.17 FunctionImport Parameter
 *
 * Functions that are defined in conceptual schema definition language (CSDL) optionally accept both in and out Parameter elements. Each Parameter element MUST have an associated Name and Type defined.
 *
 * The following is an example of FunctionImport Parameter element.
 *
 *     <FunctionImport Name="GetScalar" ReturnType="Collection(String)">
 *         <Parameter Name="count" Type="Int32" Mode="Out" />
 *         <ValueFunctionImport Anything="bogus1" xmlns="FunctionImportAnnotation"/>
 *     </FunctionImport>
 *
 * The following rules apply to the FunctionImport Parameter element:
 * - Parameter MUST have a Name defined.
 * - The Type of the Parameter MUST be defined. Type is a scalar type, ComplexType, or EntityType or a collection of scalar, ComplexType, or EntityType types.
 * - Parameter can define the Mode of the parameter. Possible values are "In", "Out", and "InOut".
 * - For a given Parameter, a MaxLength value can be specified.
 * - Precision can be specified for a given Parameter.
 * - Scale can be specified for a given Parameter.
 * - Parameter can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute attributes cannot collide.
 * - Parameter can contain a maximum of one Documentation element.
 * - Parameter can contain any number of AnnotationElement elements.
 * - In CSDL 3.0, Parameter can contain any number of ValueAnnotation elements.
 * - Child elements of Parameter are to appear in this sequence: Documentation, AnnotationElement.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl12.6
 * XSD Type: TFunctionImportParameter
 */
class ParameterType extends EdmBase
{
    /**
     * 12.6.3 Parameter Facets
     * A parameter may specify values for the edm:Nullable, edm:MaxLength, edm:Precision, edm:Scale, or edm:SRID
     * attributes. The descriptions of these facets and their implications are covered elsewhere in this specification.
     * https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl12.6.3
     */
    use HasNullable,
        HasMaxLength,
        HasPrecision,
        HasScale,
        HasSRID,
        /**
         * Parameter can contain a maximum of one Documentation element.
         */
        HasDocumentation,
        HasValueAnnotation;
    /**
     * @var string $name Parameter MUST have a Name defined.
     */
    private $name;

    /**
     * @var string $type The parameter MUST indicate which set of types can be passed to the parameter by providing
     * a [anytypereference][csdl19] value for the edm:Type attribute.
     * The Type of the Parameter MUST be defined. Type is a scalar type, ComplexType, or EntityType or a collection
     * of scalar, ComplexType, or EntityType types.
     * https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl12.6.1
     */
    private $type;

    /**
     * @var ParameterMode|null $mode 12.6.2 The edm:Mode Attribute
     * A value of In, Out, or InOut MAY be provided to the edm:Mode attribute. These values correspond to the modality of
     * parameters passed to stored procedures in relational databases.
     * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl12.6.2
     */
    private $mode = null;

    /**
     * ParameterType constructor.
     * @param string $name
     * @param string $type
     * @param ParameterMode|null $mode
     * @param bool $nullable
     * @param int|null $maxLength
     * @param int|null $precision
     * @param int|null $scale
     * @param string|null $sRID
     */
    public function __construct(
        string $name,
        string $type,
        ?ParameterMode $mode = null,
        bool $nullable = true,
        int $maxLength = null,
        int $precision = null,
        int $scale = null,
        string  $sRID = null)
    {
        $this
            ->setName($name)
            ->setType($type)
            ->setMode($mode)
            ->setNullable($nullable)
            ->setMaxLength($maxLength)
            ->setPrecision($precision)
            ->setScale($scale)
            ->setSRID($sRID);
    }

    /**
     * Gets as name
     *
     * @return string
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * Sets a new name
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name):self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as type
     *
     * @return string
     */
    public function getType():string
    {
        return $this->type;
    }

    /**
     * Sets a new type
     *
     * @param string $type
     * @return self
     */
    public function setType(string $type):self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Gets as mode
     *
     * @return ParameterMode|null
     */
    public function getMode(): ?ParameterMode
    {
        return $this->mode;
    }

    /**
     * Sets a new mode
     *
     * @param ParameterMode|null  $mode
     * @return self
     */
    public function setMode(?ParameterMode$mode):self
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'Parameter';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return array_merge(
            [
                new AttributeContainer('Name', $this->getName()),
                new AttributeContainer('Type', $this->getType()),
                new AttributeContainer('Mode', $this->GetMode(), true),
            ],
            $this->getAttributesHasMaxLength(),
            $this->getAttributesHasNullable(),
            $this->getAttributesHasPrecision(),
            $this->getAttributesHasScale(),
            $this->getAttributesHasSRID()
        );
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return
            [
                $this->getDocumentation(),
                $this->getValueAnnotation()
            ];
    }
}

