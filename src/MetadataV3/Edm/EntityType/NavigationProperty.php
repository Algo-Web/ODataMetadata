<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityType;

use AlgoWeb\ODataMetadata\MetadataV3\AccessorType;
use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasAccessors;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasValueAnnotation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Documentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.4 NavigationProperty
 *
 * NavigationProperty elements define non-structural properties on entities that allow for navigation from one Entity
 * to another via a relationship. Standard properties describe a value that is associated with an entity, while
 * navigation properties describe a navigation path over a relationship. For example, given a relationship between
 * Customer and Order entities, an Order EntityType (section 2.1.2) can describe a NavigationProperty"OrderedBy" that
 * represents the Customer instance associated with that particular Order instance.
 *
 * The following is an example of a NavigationProperty element.
 *
 * <NavigationProperty Name="Orders" Relationship="Model1.CustomerOrder" FromRole="Customer" ToRole="Order" />
 *
 * The following rules apply to the NavigationProperty element:
 * - NavigationProperty MUST have a Name defined.
 * - NavigationProperty MUST have a Relationship attribute defined.
 * - The Relationship attribute can be either a namespace qualified name or an alias qualified name of an Association
 * (section 2.1.8) element that is in scope.
 * - NavigationProperty MUST have a ToRole attribute defined. ToRole specifies the other end of the relationship and
 * refers to one of the role names that is defined on the Association.
 * - NavigationProperty MUST have a FromRole defined. FromRole is used to establish the starting point for the
 * navigation and refers to one of the role names that is defined on the Association.
 * - NavigationProperty can contain any number of AnnotationAttribute attributes. The full names of the
 * AnnotationAttribute attributes cannot collide.
 * - NavigationProperty can contain a maximum of one Documentation element.
 * - NavigationProperty can contain any number of AnnotationElement elements.
 * - In CSDL 3.0, NavigationProperty can have a ContainsTarget defined. When ContainsTarget is absent, it defaults
 * to "false". When it is set to "true", ContainsTarget indicates containment NavigationProperty (section 2.1.39).
 * - In CSDL 3.0, NavigationProperty can contain any number of ValueAnnotation elements.
 * - Child elements of NavigationProperty are to appear in this sequence: Documentation, AnnotationElement.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl6.4
 *
 * XSD Type: TNavigationProperty
 */
class NavigationProperty extends EdmBase
{
    use HasDocumentation,
        HasValueAnnotation,
        HasAccessors;
    /**
     * @var string $name The navigation property MUST provide a [simpleidentifier][csdl19] value to the edm:Name
     * attribute. The name attribute is a meaningful string that characterizes the relationship when navigating from
     * the entity that declared the navigation property to the related entity.
     *
     * The name of the navigation property MUST be unique within the set of structural and navigation properties of
     * the containing entity type and any base types of the entity type.
     */
    private $name = null;

    /**
     * @var string $relationship The edm:Relationship attribute MUST be given a [simpleidentifier][csdl19] or
     * [qualifiedidentifier][csdl19] value. The value of the attribute MUST resolve to an association in the
     * entity model.
     */
    private $relationship = null;

    /**
     * @var string $toRole The navigation property MUST provide a [simpleidentifier][csdl19] value to the edm:ToRole
     * attribute. The edm:ToRole attribute is a name used to refer to the destination of the navigation property.
     *
     * The value provided to the edm:ToRole attribute MUST be the same as one of the edm:Role names on the
     * corresponding edm:Association.
     */
    private $toRole = null;

    /**
     * @var string $fromRole The navigation property MUST provide a [][csdl19] value to the edm:FromRole attribute.
     * The edm:FromRole attribute is a name used to refer to the destination of the navigation property.
     *
     * The value provided to the edm:FromRole attribute MUST be the same as one of the edm:Role names on the
     * corresponding edm:Association.
     */
    private $fromRole = null;

    public function __construct(string $name, string $relationship, string $toRole, string $fromRole, Documentation $documentation = null, AccessorType $getter = null, AccessorType $setter = null)
    {
        $this
            ->setName($name)
            ->setRelationship($relationship)
            ->setToRole($toRole)
            ->setFromRole($fromRole)
            ->setDocumentation($documentation)
            ->setGetterAccess($getter)
            ->setSetterAccess($setter);
    }
    /**
     * Gets as name
     *
     * @return string
     */
    public function getName(): string
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
     * Gets as relationship
     *
     * @return string
     */
    public function getRelationship()
    {
        return $this->relationship;
    }

    /**
     * Sets a new relationship
     *
     * @param string $relationship
     * @return self
     */
    public function setRelationship($relationship)
    {
        $this->relationship = $relationship;
        return $this;
    }

    /**
     * Gets as toRole
     *
     * @return string
     */
    public function getToRole()
    {
        return $this->toRole;
    }

    /**
     * Sets a new toRole
     *
     * @param string $toRole
     * @return self
     */
    public function setToRole($toRole)
    {
        $this->toRole = $toRole;
        return $this;
    }

    /**
     * Gets as fromRole
     *
     * @return string
     */
    public function getFromRole()
    {
        return $this->fromRole;
    }

    /**
     * Sets a new fromRole
     *
     * @param string $fromRole
     * @return self
     */
    public function setFromRole($fromRole)
    {
        $this->fromRole = $fromRole;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'NavigationProperty';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return array_merge(
            [
                new AttributeContainer('Name', $this->getName()),
                new AttributeContainer('Relationship', $this->getRelationship()),
                new AttributeContainer('ToRole', $this->getToRole()),
                new AttributeContainer('FromRole', $this->getFromRole()),
            ],
            $this->getAttributesHasAccessors()
        );
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [
            $this->getDocumentation(),
            $this->getValueAnnotation()
        ];
    }
}
