<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Annotations;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.32 TypeAnnotation
 *
 * A TypeAnnotation element is used to annotate a model element with a term and provide zero or more values for the properties of the term.
 *
 * The following is an example of the TypeAnnotation element.
 *
 *     <TypeAnnotation Term="ContactInfo">
 *         <PropertyValue Property="ContactName" String="ContactName1" />
 *     </TypeAnnotation>
 *
 * The following rules apply to the TypeAnnotation element:
 * - TypeAnnotation MUST have a Term attribute defined that is a namespace qualified name, alias qualified name, or SimpleIdentifier.
 * - TypeAnnotation can appear only as a child element of the following elements:
 * - - ComplexType
 * - - EntityType
 * - - Annotations
 * - TypeAnnotation can have a Qualifier attribute defined unless the TypeAnnotation is a child element of an Annotations element that has a Qualifier attribute defined. If a Qualifier is defined, it has to be a SimpleIdentifier. Qualifier is used to differentiate bindings based on environmental concerns.
 * - A TypeAnnotation can contain any number of PropertyValue elements.
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl15.2
 * XSD Type: TTypeAnnotation
 */
class TypeAnnotation extends EdmBase
{

    /**
     * @var string $term
     */
    private $term;

    /**
     * @var string $qualifier
     */
    private $qualifier = null;

    /**
     * @var PropertyValue[] $propertyValue
     */
    private $propertyValue = [];

    /**
     * Gets as term
     *
     * @return string
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * Sets a new term
     *
     * @param string $term
     * @return self
     */
    public function setTerm($term)
    {
        $this->term = $term;
        return $this;
    }

    /**
     * Gets as qualifier
     *
     * @return string
     */
    public function getQualifier()
    {
        return $this->qualifier;
    }

    /**
     * Sets a new qualifier
     *
     * @param string $qualifier
     * @return self
     */
    public function setQualifier($qualifier)
    {
        $this->qualifier = $qualifier;
        return $this;
    }

    /**
     * Adds as propertyValue
     *
     * @param PropertyValue $propertyValue
     *@return self
     */
    public function addToPropertyValue(PropertyValue $propertyValue)
    {
        $this->propertyValue[] = $propertyValue;
        return $this;
    }

    /**
     * isset propertyValue
     *
     * @param int|string $index
     * @return bool
     */
    public function issetPropertyValue($index)
    {
        return isset($this->propertyValue[$index]);
    }

    /**
     * unset propertyValue
     *
     * @param int|string $index
     * @return void
     */
    public function unsetPropertyValue($index)
    {
        unset($this->propertyValue[$index]);
    }

    /**
     * Gets as propertyValue
     *
     * @return PropertyValue[]
     */
    public function getPropertyValue()
    {
        return $this->propertyValue;
    }

    /**
     * Sets a new propertyValue
     *
     * @param PropertyValue[] $propertyValue
     * @return self
     */
    public function setPropertyValue(array $propertyValue)
    {
        $this->propertyValue = $propertyValue;
        return $this;
    }


    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'TypeAnnotation';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('Term ', $this->getTerm()),
            new AttributeContainer('Qualifier', $this->getQualifier(), true)
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [$this->getPropertyValue()];
    }
}

