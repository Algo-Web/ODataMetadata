<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.13 Using.
 *
 * Using imports the contents of the specified namespace. A schema can refer to contents of another schema or namespace
 * by importing it by using the Using clause. The imported namespace can be associated with an alias that is then used
 * to refer to its types, or the types can be directly used by specifying its fully qualified name.
 *
 * Note Semantically, Using is closer to a merge. Unfortunately, the name does not reflect this. If it was truly
 * "using", structures in the schema being used would be unaffected. However, because a dependent schema can derive
 * an EntityType from an EntityType that is declared in the original schema, this has the potential side-effect of
 * changing what might be found in EntitySet elements declared in the schema being used.
 *
 * The following is an example of the Using element.
 *
 *    <Using Namespace="Microsoft.Samples.Northwind.Types" Alias="Types" />
 *
 * The following rules apply to the Using element:
 * - Using MUST have a Namespace attribute defined that is of type QualifiedName.
 * - Using MUST have an Alias attribute defined that is of type SimpleIdentifier. The alias can be used as shorthand
 * for referring to the Namespace linked to that alias via the Using element.
 * - Using can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute
 * attributes cannot collide.
 * - Using can contain a maximum of one Documentation element.
 * - Using can contain any number of AnnotationElement elements.
 *
 * If a Documentation element is defined, it comes before any AnnotationElement elements.
 * XSD Type: TUsing
 */
class Using extends EdmBase
{
    use HasDocumentation;
    /**
     * @var string $namespace 4.2.1 The edm:Namespace Attribute
     *             A using element MUST provide a [namespace][csdl19] value to the edm:Namespace attribute. The value provided to
     *             the namespace attribute SHOULD match the namespace of an entity model that is in scope.
     * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl4.3
     */
    private $namespace;

    /**
     * @var string $alias 4.2.2 The edm:Alias Attribute
     *             A using element MUST define a [simpleidentifier][csdl19] value for the edm:Alias attribute.
     *             An alias allows a CSDL model to substitute a short string for a long namespace. For instance,
     *             org.example.vocabularies.display may be bound to an alias of display. An alias qualified name is resolved to a
     *             fully qualified name by examining aliases on edm:Using and edm:Schema elements.
     *
     * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl4.4
     */
    private $alias = null;

    public function __construct(string $namespace, string $alias = null, Documentation $documentation = null)
    {
        $this
            ->setNamespace($namespace)
            ->setAlias($alias)
            ->setDocumentation($documentation);
    }

    /**
     * Gets as namespace.
     *
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * Sets a new namespace.
     *
     * @param  string $namespace
     * @return self
     */
    public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;
        return $this;
    }

    /**
     * Gets as alias.
     *
     * @return string|null
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * Sets a new alias.
     *
     * @param  string|null $alias
     * @return self
     */
    public function setAlias(?string $alias): self
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'Using';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('Namespace', $this->getNamespace()),
            new AttributeContainer('Alias', $this->getAlias(), true),
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [$this->getDocumentation()];
    }
}
