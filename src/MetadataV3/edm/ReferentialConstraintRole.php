<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.12 ReferentialConstraint Role
 *
 * When defining ReferentialConstraint elements, Role MUST be used to indicate which end of the association is the Principal and which end of the relationship is the Dependent. Thus, the ReferentialConstraint contains two Role definitions: the Principal and the Dependent.
 *
 * ReferentialConstraintRole usage conforms to the ordering rules for the child elements of ReferentialConstraint, as defined in ReferentialConstraint (section 2.1.11).
 *
 * The following example of the ReferentialConstraintRole defines Principal and Dependent elements.
 *
 *     <ReferentialConstraint>
 *         <Principal Role="Employee">
 *             <PropertyRef Name="EmployeeID" />
 *         </Principal>
 *         <Dependent Role="Manager">
 *             <PropertyRef Name="ManagerID" />
 *         </Dependent>
 *     </ReferentialConstraint>
 *
 * 2.1.12.1 Principal
 *
 * The following example shows the usage of the PrincipalRole element in defining a ReferentialConstraint element.
 *
 *     <Principal Role="Employee">
 *         <PropertyRef Name="EmployeeID" />
 *     </Principal>
 *
 * The following rules apply to the PrincipalRole element:
 * - One PrincipalRole MUST be used to define the Principal end of the ReferentialConstraint.
 * - Each PrincipalRole specifies one and only one Role attribute that is of type SimpleIdentifier.
 * - Principal has one or more PropertyRef elements. Each PropertyRef element specifies a name by using the Name attribute.
 * - For each Principal, a PropertyRef definition cannot specify a Name value that is specified for another PropertyRef.
 * - PropertyRef is used to specify the properties that participate in the PrincipalRole of the ReferentialConstraint.
 * - Each PropertyRef element on the Principal corresponds to a PropertyRef on the Dependent. The Principal and the Dependent of the ReferentialConstraint contains the same number of PropertyRef elements. The PropertyRef elements on the Dependent are listed in the same order as the corresponding PropertyRef elements on the Principal.
 * - The Principal of a ReferentialConstraint MUST specify all properties that constitute the Key of the EntityType that forms the Principal of the ReferentialConstraint.
 * - The Multiplicity of the PrincipalRole is 1. For CSDL 2.0 and CSDL 3.0, the Multiplicity of the PrincipalRole can be 1 or 0.1.
 * - The data type of each property that is defined in the PrincipalRole MUST be the same as the data type of the corresponding property that is specified in the DependentRole.
 * - In CSDL 2.0 and CSDL 3.0, Principal can contain any number of AnnotationElement elements.
 * - Child elements of Principal are to appear in this sequence: PropertyRef, AnnotationElement.
 *
 * 2.1.12.2 Dependent
 *
 * The following example shows the usage of the DependentRole element in defining a ReferentialConstraint.
 *
 *     <Dependent Role="Manager">
 *         <PropertyRef Name="ManagerID" />
 *     </Dependent>
 *
 * The following rules apply to the DependentRole element:
 * - One DependentRole MUST be used to define the Dependent end of the ReferentialConstraint.
 * - Each DependentRole MUST specify one and only one Role attribute that is of type SimpleIdentifier.
 * - Dependent has one or more PropertyRef elements that specify a name by using the Name attribute.
 * - For each Dependent, a PropertyRef definition cannot specify a Name value that is specified for another PropertyRef.
 * - PropertyRef is used to specify the properties that participate in the DependentRole of the ReferentialConstraint.
 * - Each PropertyRef element on the Principal corresponds to a PropertyRef on the Dependent. The Principal and the
 * Dependent of the ReferentialConstraint contain the same number of PropertyRef elements. The PropertyRef elements on
 * the Dependent are listed in the same order as the corresponding PropertyRef elements on the Principal.
 * - The data type of each property that is defined in the Principal Role MUST be the same as the data type of the
 * corresponding property specified in the DependentRole.
 * - In CSDL 2.0 and CSDL 3.0, Dependent can contain any number of AnnotationElement elements.
 * - Child elements of Dependent are to appear in this sequence: PropertyRef, AnnotationElement.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl10.5
 * XSD Type: TReferentialConstraintRoleElement
 */
class ReferentialConstraintRole extends EdmBase
{

    /**
     * @var string $role
     */
    private $role;

    private $isPrincipal = true;

    /**
     * @var PropertyRef $propertyRef
     */
    private $propertyRef ;

    public function __construct(string $role, PropertyRef $propertyRef)
    {
        $this->setRole($role)
            ->setPropertyRef($propertyRef);
    }

    /**
     * Gets as role
     *
     * @return string
     */
    public function getRole():string
    {
        return $this->role;
    }

    /**
     * Sets a new role
     *
     * @param string $role
     * @return self
     */
    public function setRole(string $role) : self
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Gets as role
     *
     * @return PropertyRef
     */
    public function getPropertyRef(): PropertyRef
    {
        return $this->propertyRef;
    }

    /**
     * Sets a new role
     *
     * @param PropertyRef $role
     * @return self
     */
    public function setPropertyRef(PropertyRef $role) : self
    {
        $this->propertyRef = $role;
        return $this;
    }

    public function setIsPrincipal(bool $isPrincipal) : self
    {
        $this->isPrincipal = $isPrincipal;
        return $this;
    }
    public function getIsPrincipal() : bool
    {
        return $this->isPrincipal;
    }
    /**
     * @return string
     */
    public function getDomName(): string
    {
        return $this->isPrincipal ? 'Principal' :'Dependent';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('Role', $this->getRole())
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [
            $this->propertyRef
        ];
    }
}

