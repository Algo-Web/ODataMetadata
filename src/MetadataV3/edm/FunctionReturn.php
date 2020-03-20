<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\HasType;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.30 Function ReturnType.
 *
 * ReturnType describes the shape of data that is returned from a Function. The return type of a function can be declared as a ReturnType attribute on a Function or as a child element.
 *
 * The following is an example of the return type of a function declared as a ReturnType attribute on a Function.
 *
 * <Function Name="GetAge" ReturnType="Edm.Int32">
 *
 * The following is an example of the return type of a function declared as a child element.
 *
 * <Function Name="GetAge">
 * <ReturnType Type="Edm.Int32" />
 * </Function>
 *
 * The following rules apply to the ReturnType element of a function:
 * - ReturnType MUST define type declaration either as an attribute or as a child element.
 * - ReturnType cannot contain both an attribute and a child element defining the type.
 * - ReturnType can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute attributes MUST NOT collide.
 * - The return type of Function MUST be one of the following:
 * - - A scalar type or collection of scalar types.
 * - - An entity type or collection of entity types.
 * - - A complex type or collection of complex types.
 * - - A row type or collection of row types.
 * - - A reference type or collection of reference types.
 * - ReturnType can contain a maximum of one CollectionType element.
 * - ReturnType can contain a maximum of one ReferenceType element.
 * - ReturnType can contain a maximum of one RowType element.
 * - ReturnType can contain any number of AnnotationElement elements.
 * - AnnotationElement elements are to be last in the sequence of child elements of ReturnType.
 * XSD Type: TFunctionReturnType
 */
class FunctionReturn extends EdmBase
{
    use HasType;


    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'ReturnType';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return $this->getAttributesHasType();
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [$this->getChildElementsHasType()];
    }
}
