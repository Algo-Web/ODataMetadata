<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityContainer;

use AlgoWeb\ODataMetadata\MetadataV3\AccessorType;
use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\HasValueAnnotation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityContainer\FunctionImport\ParameterType;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityContainer\FunctionImport\ReturnType;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic\TEntitySetReferenceExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\TOperandType;
use AlgoWeb\ODataMetadata\OdataVersions;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.15 FunctionImport
 *
 * FunctionImport element is used to import stored procedures or functions that are defined in the Store Schema Model
 * into Entity Data Model (EDM).
 *
 * The following is an example of the FunctionImport element.
 *
 *     <FunctionImport Name="annualCustomerSales" EntitySet="result_annualCustomerSalesSet" ReturnType="Collection(Self.result_annualCustomerSales)">
 *         <Parameter Name="fiscalyear" Mode="In" Type="String" />
 *     </FunctionImport>
 *
 * The following rules apply to the FunctionImport element:
 * - FunctionImport MUST have a Name attribute defined. Name attribute is of type SimpleIdentifier.
 * - FunctionImport can define a ReturnType as an attribute.
 * - In CSDL 3.0, the ReturnType can be defined as either an attribute or a child element, but not both.
 * - If defined in CSDL 1.1, CSDL 2.0, and CSDL 3.0, the type of ReturnType MUST be a scalar type, EntityType, or
 *   ComplexType that is in scope or a collection of one of these in-scope types. In CSDL 1.0, the ReturnType is
 *   collection of either scalar type or EntityType.
 * - Types that are in scope for a FunctionImport include all scalar types, EntityTypes, and ComplexTypes that are
 *   defined in the declaring SchemaNamespace or in schemas that are in scope of the declaring Schema.
 * - If the return type of FunctionImport is a collection of entities, the EntitySet attribute is defined.
 * - If the return type of FunctionImport is of ComplexType or scalar type, the EntitySet attribute cannot be defined.
 * - FunctionImport can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute
 *   attributes cannot collide.
 * - The FunctionImport element can contain a maximum of one Documentation element.
 * - FunctionImport can have zero or more Parameter elements.
 * - Parameter element names inside a FunctionImport cannot collide.
 * - FunctionImport can have an IsSideEffecting attribute defined. Possible values are "true" and "false". If the
 *   IsSideEffecting attribute is omitted, the value of the IsSideEffecting attribute defaults to "true".
 * - FunctionImport can have an IsBindable attribute defined. Possible values are "true" and "false". If the IsBindable
 *   attribute is omitted, the value of the IsBindable attribute is assumed to be "false".
 * - When IsBindable is set to "true", FunctionImport MUST have at least one Parameter element defined.
 * - FunctionImport can have an IsComposable attribute defined. Possible values are "true" and "false". If the
 *   IsComposable attribute is omitted, the value of the IsComposable attribute is assumed to be "false".
 * - FunctionImport cannot have IsComposable set to "true" if IsSideEffecting is set to "true".
 * - In CSDL 2.0 and CSDL 3.0, FunctionImport can contain any number of AnnotationElement elements.
 * - In CSDL 3.0, FunctionImport can have an EntitySetPath attribute defined. EntitySetPath defines the EntitySet
 *   that contains the entities that are returned by the FunctionImport when that EntitySet is dependent on one of the
 *   FunctionImport parameters. For example, the entities returned from a FunctionImport can be dependent on the entity
 *   set that is passed to the FunctionImport as a parameter. In this case, a static EntitySet is not sufficient, and an
 *   EntitySetPath is used. EntitySetPath is composed of segments that are separated by a forward slash. The first
 *   segment refers to a FunctionImport parameter. Each remaining segment represents either navigation, in which case
 *   the segment is a SimpleIdentifier, or a type cast, in which case the segment is a QualifiedName.
 * - In CSDL 3.0, FunctionImport can contain any number of ValueAnnotation elements.
 * - Child elements of FunctionImport are to appear in this sequence:
 *   Documentation (if present), ReturnType, Parameter, AnnotationElement.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl12.4
 */
class FunctionImport extends EdmBase
{
    /**
     * In CSDL 3.0, FunctionImport can contain any number of ValueAnnotation elements.
     */
    use HasValueAnnotation,
        /**
         * The FunctionImport element can contain a maximum of one Documentation element.
         */
        HasDocumentation;
    /**
     * @var string $name FunctionImport MUST have a Name attribute defined. Name attribute is of type SimpleIdentifier.
     */
    private $name;

    /**
     * @var ReturnType|null $returnType FunctionImport can define a ReturnType as an attribute.
     * In CSDL 3.0, the ReturnType can be defined as either an attribute or a child element, but not both.
     *
     * If defined in CSDL 1.1, CSDL 2.0, and CSDL 3.0, the type of ReturnType MUST be a scalar type, EntityType,
     * or ComplexType that is in scope or a collection of one of these in-scope types. In CSDL 1.0, the ReturnType
     * is collection of either scalar type or EntityType.
     */
    private $returnType = null;

    /**
     * @var TEntitySetReferenceExpressionType|null $entitySet If the return type of FunctionImport is a collection of entities, the EntitySet
     * attribute is defined.
     *
     * If the return type of FunctionImport is of ComplexType or scalar type, the EntitySet attribute cannot be defined.
     */
    private $entitySet = null;
    /**
     * @var string In CSDL 3.0, FunctionImport can have an EntitySetPath attribute defined. EntitySetPath defines the
     * EntitySet that contains the entities that are returned by the FunctionImport when that EntitySet is dependent
     * on one of the FunctionImport parameters. For example, the entities returned from a FunctionImport can be
     * dependent on the entity set that is passed to the FunctionImport as a parameter. In this case, a static EntitySet
     * is not sufficient, and an EntitySetPath is used. EntitySetPath is composed of segments that are separated by a
     * forward slash. The first segment refers to a FunctionImport parameter. Each remaining segment represents either
     * navigation, in which case the segment is a SimpleIdentifier, or a type cast, in which case the segment is a
     * QualifiedName.
     */
    private $entitySetPath = null;

    /**
     * @var bool $isComposable FunctionImport can have an IsComposable attribute defined. Possible values are "true"
     * and "false". If the IsComposable attribute is omitted, the value of the IsComposable attribute is assumed to
     * be "false".
     *
     * FunctionImport cannot have IsComposable set to "true" if IsSideEffecting is set to "true".
     */
    private $isComposable = false;

    /**
     * @var bool $isSideEffecting FunctionImport can have an IsSideEffecting attribute defined. Possible values are
     * "true" and "false". If the IsSideEffecting attribute is omitted, the value of the IsSideEffecting attribute
     * defaults to "true".
     */
    private $isSideEffecting = true;

    /**
     * @var bool $isBindable FunctionImport can have an IsBindable attribute defined. Possible values are "true" and
     * "false". If the IsBindable attribute is omitted, the value of the IsBindable attribute is assumed to be "false".
     *
     * When IsBindable is set to "true", FunctionImport MUST have at least one Parameter element defined.
     */
    private $isBindable = false;

    /**
     * @var AccessorType? $methodAccess
     */
    private $methodAccess = null;


    /**
     * @var ParameterType[] $parameter FunctionImport can have zero or more Parameter elements.
     * Parameter element names inside a FunctionImport cannot collide.
     */
    private $parameter = [];

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
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as returnType
     *
     * @return ReturnType|null
     */
    public function getReturnType(): ?ReturnType
    {
        return $this->returnType;
    }

    /**
     * Sets a new returnType
     *
     * @param ReturnType|null $returnType
     * @return self
     */
    public function setReturnType(?ReturnType $returnType): self
    {
        $this->returnType = $returnType;
        return $this;
    }

    /**
     * Gets as entitySet
     *
     * @return TEntitySetReferenceExpressionType|null
     */
    public function getEntitySet(): ?TEntitySetReferenceExpressionType
    {
        return $this->entitySet;
    }

    /**
     * Sets a new entitySet
     *
     * @param TEntitySetReferenceExpressionType|null $entitySet
     * @return self
     */
    public function setEntitySet(?TEntitySetReferenceExpressionType $entitySet):self
    {
        $this->entitySet = $entitySet;
        return $this;
    }
    /**
     * Gets as entitySet
     *
     * @return string|null
     */
    public function getEntitySetPath(): ?string
    {
        return $this->entitySetPath;
    }

    /**
     * Sets a new entitySet
     *
     * @param string|null $entitySet
     * @return self
     */
    public function setEntitySetPath(?string $entitySet):self
    {
        $this->entitySetPath = $entitySet;
        return $this;
    }
    /**
     * Gets as isComposable
     *
     * @return bool
     */
    public function getIsComposable(): bool
    {
        return $this->isComposable;
    }

    /**
     * Sets a new isComposable
     *
     * @param bool $isComposable
     * @return self
     */
    public function setIsComposable(bool $isComposable): self
    {
        $this->isComposable = $isComposable;
        return $this;
    }

    /**
     * Gets as isSideEffecting
     *
     * @return bool
     */
    public function getIsSideEffecting(): bool
    {
        return $this->isSideEffecting;
    }

    /**
     * Sets a new isSideEffecting
     *
     * @param bool $isSideEffecting
     * @return self
     */
    public function setIsSideEffecting(bool $isSideEffecting): self
    {
        $this->isSideEffecting = $isSideEffecting;
        return $this;
    }

    /**
     * Gets as isBindable
     *
     * @return bool
     */
    public function getIsBindable(): bool
    {
        return $this->isBindable;
    }

    /**
     * Sets a new isBindable
     *
     * @param bool $isBindable
     * @return self
     */
    public function setIsBindable(bool $isBindable): self
    {
        $this->isBindable = $isBindable;
        return $this;
    }

    /**
     * Gets as methodAccess
     *
     * @return AccessorType|null
     */
    public function getMethodAccess(): ?AccessorType
    {
        return $this->methodAccess;
    }

    /**
     * Sets a new methodAccess
     *
     * @param AccessorType|null $methodAccess
     * @return self
     */
    public function setMethodAccess(?AccessorType $methodAccess): self
    {
        $this->methodAccess = $methodAccess;
        return $this;
    }

    /**
     * Adds as parameter
     *
     * @param ParameterType $parameter
     * @return self
     */
    public function addToParameter(ParameterType $parameter): self
    {
        $this->parameter[] = $parameter;
        return $this;
    }

    /**
     * isset parameter
     *
     * @param int $index
     * @return bool
     */
    public function issetParameter(int $index): bool
    {
        return isset($this->parameter[$index]);
    }

    /**
     * unset parameter
     *
     * @param int $index
     * @return void
     */
    public function unsetParameter(int $index):void
    {
        unset($this->parameter[$index]);
    }

    /**
     * Gets as parameter
     *
     * @return ParameterType[]
     */
    public function getParameter():array
    {
        return $this->parameter;
    }

    /**
     * Sets a new parameter
     *
     * @param ParameterType[] $parameter
     * @return self
     */
    public function setParameter(array $parameter): self
    {
        $this->parameter = $parameter;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'FunctionImport';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('Name', $this->getName()),
            new AttributeContainer('EntitySet', $this->getEntitySet(), true),
            new AttributeContainer('EntitySetPath', $this->getEntitySetPath(), true),
            new AttributeContainer('ReturnType', $this->getReturnType()->getType(), true, OdataVersions::TWO(), [OdataVersions::THREE()]),
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return array_merge(
            [
                $this->getDocumentation(),
                $this->getReturnType()
            ],
            $this->getParameter(),
            $this->getValueAnnotation()
        );
    }
}
