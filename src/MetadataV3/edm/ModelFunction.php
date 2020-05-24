<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\HasValueAnnotation;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.23 Model Function
 *
 * A Function element is used to define or declare a user function. These functions are defined as child elements of
 * the Schema element.
 * he following is an example of the Function element.
 *     <Function Name="GetAge" ReturnType="Edm.Int32">
 *         <Parameter Name="Person" Type="Model.Person" />
 *         <DefiningExpression>
 *             Edm.DiffYears(Edm.CurrentDateTime(), Person.Birthday)
 *         </DefiningExpression>
 *     </Function>
 *
 * The following rules apply to the Function element:
 * - The Function MUST have a Name attribute defined that is of type SimpleIdentifier. The Name attribute represents
 *   the name of this Function.
 * - The Function MUST define a return type as an attribute or as a child element.
 * - The Function cannot contain both an attribute and a child element that defines the return type.
 * - If defined, the type of FunctionReturnType MUST be:
 * - - A scalar type, EntityType, or ComplexType that is in scope.
 * - - A collection of one of these scalar, EntityType, or ComplexType in-scope types.
 * - - A RowType element or a collection of RowType elements that is defined as a child element of ReturnType.
 * - - A ReferenceType element or a collection of ReferenceType elements that is defined as a child element of
 *     ReturnType.
 * - A single DefiningExpression element can be defined for a given Function. A DefiningExpression is any expression
 *   that is intended to be the body of the function. The conceptual schema definition language (CSDL) file format does
 *   not specify rules and restrictions regarding what language is to be used for specifying function bodies.
 * - All Function parameters have to be inbound.
 * - Function can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute
 *   attributes cannot collide.
 * - Functions are declared as global items inside the Schema element.
 * - Function can contain a maximum of one Documentation element.
 * - The function parameters and return type MUST be of the following types:
 * - - A scalar type or a collection of scalar types.
 * - - An entity type or a collection of entity types.
 * - - A complex type or a collection of complex types.
 * - - A row type or a collection of row types.
 * - - A reference type or a collection of reference types.
 * - Function can contain any number of Parameter elements.
 * - Function can contain any number of AnnotationElement elements.
 * - In CSDL 3.0, Function can contain any number of ValueAnnotation elements.
 * - Parameter, DefiningExpression, and ReturnType can appear in any order.
 * - AnnotationElement has to be the last in the sequence of elements of a Function.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl11
 *
 * XSD Type: TFunction
 */
class ModelFunction extends EdmBase
{
    use HasDocumentation,
        HasValueAnnotation;
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var FunctionReturn $returnType
     */
    private $returnType = null;

    /**
     * @var ModelFunctionParameter[] $parameter
     */
    private $parameter = [

    ];

    /**
     * @var TextType $definingExpression
     */
    private $definingExpression = null;

    /**
     * Gets as name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }


    /**
     * Gets as returnType
     *
     * @return FunctionReturn|null
     */
    public function getReturnType(): ?FunctionReturn
    {
        return $this->returnType;
    }

    /**
     * Sets a new returnType
     *
     * @param FunctionReturn|null $returnType
     * @return self
     */
    public function setReturnType(?FunctionReturn $returnType):self
    {
        $this->returnType = $returnType;
        return $this;
    }

    /**
     * Adds as parameter
     *
     * @param ModelFunctionParameter $parameter
     * @return self
     */
    public function addToParameter(ModelFunctionParameter $parameter): self
    {
        $this->parameter[$parameter->getName()] = $parameter;
        return $this;
    }

    /**
     * isset parameter
     *
     * @param string $name
     * @return bool
     */
    public function issetParameter(string $name): bool
    {
        return isset($this->parameter[$name]);
    }

    /**
     * unset parameter
     *
     * @param string $name
     * @return void
     */
    public function unsetParameter(string $name):void
    {
        unset($this->parameter[$name]);
    }

    /**
     * Gets as parameter
     *
     * @return ModelFunctionParameter[]
     */
    public function getParameter():array
    {
        return $this->parameter;
    }

    /**
     * Sets a new parameter
     *
     * @param ModelFunctionParameter[] $parameter
     * @return self
     */
    public function setParameter(array $parameter):self
    {
        $this->parameter = $this->elementToNamedArray($parameter);
        return $this;
    }

    /**
     * Gets as definingExpression
     *
     * @return TextType|null
     */
    public function getDefiningExpression(): ?TextType
    {
        return $this->definingExpression;
    }

    /**
     * Sets a new definingExpression
     *
     * @param string|null $definingExpression
     * @return self
     */
    public function setDefiningExpression(?string $definingExpression): self
    {
        $this->definingExpression = null === $definingExpression ?
            null :
            new TextType('DefiningExpression', $definingExpression);
        return $this;
    }


    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'Function';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('Name', $this->getName()),
            new AttributeContainer('ReturnType', $this->getReturnType(), true),
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return array_merge(
            [$this->getDocumentation()],
            $this->getParameter(),
            [$this->getDefiningExpression()],
            $this->getValueAnnotation()
        );
    }
}
