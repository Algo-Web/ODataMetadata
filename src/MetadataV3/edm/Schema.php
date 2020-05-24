<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Annotations\Annotations;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.1 Schema
 *
 * The Schema element is the top-level conceptual schema definition language (CSDL) construct that allows creation of
 * a namespace.
 *
 * The contents of a namespace can be defined by one or more Schema instances. The identifiers that are used to name
 * types are unique within a Namespace. For instance, an EntityType cannot have the same name as a ComplexType within
 * the same namespace. The Namespace forms a part of the type's fully qualified name.
 *
 * The following is an example of the Schema element:
 *
 *     <Schema Alias="Model" Namespace="Test.Simple.Model" xmlns:edm="http://schemas.microsoft.com/ado/2009/11/edm" xmlns="http://schemas.microsoft.com/ado/2009/11/edm">

 * The following rules apply to the Schema element.
 * - The CSDL document MUST have the Schema element as its root element.
 * - The Namespace attribute is defined for each Schema element. Namespace is of type QualifiedName. A namespace is a
 *   logical grouping of EntityType elements, ComplexType elements, and Association elements.
 * - A schema Namespace attribute cannot use the values "System", "Transient", or "Edm".
 * - A schema definition can span across more than one CSDL document.
 * - The Alias attribute can be defined on a Schema element. Alias is of the type SimpleIdentifier.
 * - Schema can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute
 *   attributes cannot collide.
 * - Schema can contain zero or more of the following child elements. The elements can appear in any given order.
 * - - Using
 * - - Association
 * - - ComplexType
 * - - EntityType
 * - EntityContainer
 * In CSDL 2.0 and CSDL 3.0, Schema can contain zero or more of the following child elements.
 * - Function
 * Schema can contain any number of AnnotationElement elements.
 * In CSDL 3.0, Schema can contain any number of Annotations elements.
 * In CSDL 3.0, Schema can contain any number of ValueTerm elements.
 * AnnotationElement elements MUST appear only after all other child elements of Schema.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl4.1
 * XSD Type: TSchema
 */
class Schema extends DomBase
{

    /**
     * @var string $namespace  A schema is identified by the value of the edm:Namespace attribute. The schema's
     * namespace is combined with the name of elements in the entity model to create unique names.
     *
     * Identifiers that are used to name types MUST be unique within a namespace to prevent ambiguity.
     *
     * A schema that contains nominal types MUST specify a [namespace][csdl19] value for the namespace attribute.
     * A schema that contains only vocabulary annotations MAY specify a [namespace][csdl19] value for the namespace
     * attribute. The edm:Namespace attribute MUST NOT use the reserved values System, Transient or Edm.
     */
    private $namespace = null;

    /**
     * @var string $alias A schema MAY provide a [simpleidentifier][csdl19] value for the edm:Alias attribute.
     * An alias allows a CSDL document to qualify nominal types with a short string rather than a long namespace.
     * For instance, org.example.vocabularies.display may simply have an alias of Self.
     * An alias qualified name is resolved to a fully qualified name by examining aliases on edm:Using and
     * edm:Schema elements.
     *
     * An alias is scoped to the container in which it is declared. For example, a model referencing an annotations
     * document cannot use any aliases defined in that annotations document.
     * A referencing model defines its own aliases with the edm:Using element.
     */
    private $alias = null;

    /**
     * @var Using[] $using The edm:Using element imports the contents of a specified namespace. A using element
     * binds an alias to the namespace of any entity model.
     *
     * Importing the contents of another model with a using element may alter the importing model. For instance,
     * a model may import an entity model containing an entity type derived from an entity type in the importing model.
     * In that case an edm:EntitySet in the importing model may return either entity type.
     */
    private $using = [

    ];

    /**
     * @var Association[] $association  The edm:Association element represents an association in an entity model.
     */
    private $association = [

    ];

    /**
     * @var ComplexType[] $complexType The edm:ComplexType element represents a complex type in an entity model.
     */
    private $complexType = [

    ];

    /**
     * @var Entity[] $entityType The edm:EntityType element represents an entity type in the entity model.
     */
    private $entityType = [

    ];

    /**
     * @var Enum[] $enumType
     */
    private $enumType = [

    ];

    /**
     * @var ValueTerm[] $valueTerm
     */
    private $valueTerm = [

    ];

    /**
     * @var ModelFunction[] $function
     */
    private $function = [

    ];

    /**
     * @var Annotations[] $annotations
     */
    private $annotations = [

    ];

    /**
     * @var EntityContainer[] $entityContainer
     */
    private $entityContainer = [

    ];

    public function __construct(string $namespace = null,
                                string $alias = null,
                                array $association = [],
                                array $complexType = [],
                                array $entityType = [],
                                array $entityContainer = [],
                                array $using = [],
                                array $enumType = [],
                                array $valueTerm = [],
                                array $function = [],
                                array $annotations = []
    )
    {
        $this
            ->setNamespace($namespace)
            ->setAlias($alias)
            ->setAssociation($association)
            ->setComplexType($complexType)
            ->setEntityType($entityType)
            ->setEntityContainer($entityContainer)
            ->setUsing($using)
            ->setEnumType($enumType)
            ->setValueTerm($valueTerm)
            ->setFunction($function)
            ->setAnnotations($annotations);
    }

    /**
     * Gets as namespace
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Sets a new namespace
     *
     * @param string $namespace
     * @return self
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }

    /**
     * Gets as alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Sets a new alias
     *
     * @param string $alias
     * @return self
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * Adds as using
     *
     * @param Using $using
     * @return self
     */
    public function addToUsing(Using $using)
    {
        $this->using[] = $using;
        return $this;
    }

    /**
     * isset using
     *
     * @param int|string $index
     * @return bool
     */
    public function issetUsing($index)
    {
        return isset($this->using[$index]);
    }

    /**
     * unset using
     *
     * @param int|string $index
     * @return void
     */
    public function unsetUsing($index)
    {
        unset($this->using[$index]);
    }

    /**
     * Gets as using
     *
     * @return Using[]
     */
    public function getUsing()
    {
        return $this->using;
    }

    /**
     * Sets a new using
     *
     * @param Using[] $using
     * @return self
     */
    public function setUsing(array $using)
    {
        $this->using = $using;
        return $this;
    }

    /**
     * Adds as association
     *
     * @param Association $association
     *@return self
     */
    public function addToAssociation(Association $association)
    {
        $this->association[] = $association;
        return $this;
    }

    /**
     * isset association
     *
     * @param int|string $index
     * @return bool
     */
    public function issetAssociation($index)
    {
        return isset($this->association[$index]);
    }

    /**
     * unset association
     *
     * @param int|string $index
     * @return void
     */
    public function unsetAssociation($index)
    {
        unset($this->association[$index]);
    }

    /**
     * Gets as association
     *
     * @return Association[]
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Sets a new association
     *
     * @param Association[] $association
     * @return self
     */
    public function setAssociation(array $association)
    {
        $this->association = $association;
        return $this;
    }

    /**
     * Adds as complexType
     *
     * @param ComplexType $complexType
     *@return self
     */
    public function addToComplexType(ComplexType $complexType)
    {
        $this->complexType[] = $complexType;
        return $this;
    }

    /**
     * isset complexType
     *
     * @param int|string $index
     * @return bool
     */
    public function issetComplexType($index)
    {
        return isset($this->complexType[$index]);
    }

    /**
     * unset complexType
     *
     * @param int|string $index
     * @return void
     */
    public function unsetComplexType($index)
    {
        unset($this->complexType[$index]);
    }

    /**
     * Gets as complexType
     *
     * @return ComplexType[]
     */
    public function getComplexType()
    {
        return $this->complexType;
    }

    /**
     * Sets a new complexType
     *
     * @param ComplexType[] $complexType
     * @return self
     */
    public function setComplexType(array $complexType)
    {
        $this->complexType = $complexType;
        return $this;
    }

    /**
     * Adds as entityType
     *
     * @param Entity $entityType
     * @return self
     */
    public function addToEntityType(Entity $entityType)
    {
        $this->entityType[] = $entityType;
        return $this;
    }

    /**
     * isset entityType
     *
     * @param int|string $index
     * @return bool
     */
    public function issetEntityType($index)
    {
        return isset($this->entityType[$index]);
    }

    /**
     * unset entityType
     *
     * @param int|string $index
     * @return void
     */
    public function unsetEntityType($index)
    {
        unset($this->entityType[$index]);
    }

    /**
     * Gets as entityType
     *
     * @return Entity[]
     */
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * Sets a new entityType
     *
     * @param Entity[] $entityType
     * @return self
     */
    public function setEntityType(array $entityType)
    {
        $this->entityType = $entityType;
        return $this;
    }

    /**
     * Adds as enumType
     *
     * @param Enum $enumType
     * @return self
     */
    public function addToEnumType(Enum $enumType)
    {
        $this->enumType[] = $enumType;
        return $this;
    }

    /**
     * isset enumType
     *
     * @param int|string $index
     * @return bool
     */
    public function issetEnumType($index)
    {
        return isset($this->enumType[$index]);
    }

    /**
     * unset enumType
     *
     * @param int|string $index
     * @return void
     */
    public function unsetEnumType($index)
    {
        unset($this->enumType[$index]);
    }

    /**
     * Gets as enumType
     *
     * @return Enum[]
     */
    public function getEnumType()
    {
        return $this->enumType;
    }

    /**
     * Sets a new enumType
     *
     * @param Enum[] $enumType
     * @return self
     */
    public function setEnumType(array $enumType)
    {
        $this->enumType = $enumType;
        return $this;
    }

    /**
     * Adds as valueTerm
     *
     * @param ValueTerm $valueTerm
     * @return self
     */
    public function addToValueTerm(ValueTerm $valueTerm)
    {
        $this->valueTerm[] = $valueTerm;
        return $this;
    }

    /**
     * isset valueTerm
     *
     * @param int|string $index
     * @return bool
     */
    public function issetValueTerm($index)
    {
        return isset($this->valueTerm[$index]);
    }

    /**
     * unset valueTerm
     *
     * @param int|string $index
     * @return void
     */
    public function unsetValueTerm($index)
    {
        unset($this->valueTerm[$index]);
    }

    /**
     * Gets as valueTerm
     *
     * @return ValueTerm[]
     */
    public function getValueTerm()
    {
        return $this->valueTerm;
    }

    /**
     * Sets a new valueTerm
     *
     * @param ValueTerm[] $valueTerm
     * @return self
     */
    public function setValueTerm(array $valueTerm)
    {
        $this->valueTerm = $valueTerm;
        return $this;
    }

    /**
     * Adds as function
     *
     * @param ModelFunction $function
     * @return self
     */
    public function addToFunction(ModelFunction $function)
    {
        $this->function[] = $function;
        return $this;
    }

    /**
     * isset function
     *
     * @param int|string $index
     * @return bool
     */
    public function issetFunction($index)
    {
        return isset($this->function[$index]);
    }

    /**
     * unset function
     *
     * @param int|string $index
     * @return void
     */
    public function unsetFunction($index)
    {
        unset($this->function[$index]);
    }

    /**
     * Gets as function
     *
     * @return ModelFunction[]
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Sets a new function
     *
     * @param ModelFunction[] $function
     * @return self
     */
    public function setFunction(array $function)
    {
        $this->function = $function;
        return $this;
    }

    /**
     * Adds as annotations
     *
     * @param Annotations $annotations
     *@return self
     */
    public function addToAnnotations(Annotations $annotations)
    {
        $this->annotations[] = $annotations;
        return $this;
    }

    /**
     * isset annotations
     *
     * @param int|string $index
     * @return bool
     */
    public function issetAnnotations($index)
    {
        return isset($this->annotations[$index]);
    }

    /**
     * unset annotations
     *
     * @param int|string $index
     * @return void
     */
    public function unsetAnnotations($index)
    {
        unset($this->annotations[$index]);
    }

    /**
     * Gets as annotations
     *
     * @return Annotations[]
     */
    public function getAnnotations()
    {
        return $this->annotations;
    }

    /**
     * Sets a new annotations
     *
     * @param Annotations[] $annotations
     * @return self
     */
    public function setAnnotations(array $annotations)
    {
        $this->annotations = $annotations;
        return $this;
    }

    /**
     * Adds as entityContainer
     *
     * @param EntityContainer $entityContainer
     *@return self
     */
    public function addToEntityContainer(EntityContainer $entityContainer)
    {
        $this->entityContainer[] = $entityContainer;
        return $this;
    }

    /**
     * isset entityContainer
     *
     * @param int|string $index
     * @return bool
     */
    public function issetEntityContainer($index)
    {
        return isset($this->entityContainer[$index]);
    }

    /**
     * unset entityContainer
     *
     * @param int|string $index
     * @return void
     */
    public function unsetEntityContainer($index)
    {
        unset($this->entityContainer[$index]);
    }

    /**
     * Gets as entityContainer
     *
     * @return EntityContainer[]
     */
    public function getEntityContainer()
    {
        return $this->entityContainer;
    }

    /**
     * Sets a new entityContainer
     *
     * @param EntityContainer[] $entityContainer
     * @return self
     */
    public function setEntityContainer(array $entityContainer)
    {
        $this->entityContainer = $entityContainer;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'Schema';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('Namespace', $this->getNamespace(), true),
            new AttributeContainer('Alias', $this->getAlias(), true),
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return array_merge(
            $this->getUsing(), //Edm:Using
            $this->getAssociation(),//Edm:Association
            $this->getComplexType(),//Edm:ComplexType
            $this->getEntityType(),//Edm:EntityType
            $this->getEntityContainer(),//Edm:EntityContainer
            $this->getFunction(), //Edm.Functions
            $this->getAnnotations(), // Edm:Annotations
            $this->getEnumType(), //Edm:EnumType
            $this->getValueTerm() //Edm:ValueTerm
        );
    }
}

