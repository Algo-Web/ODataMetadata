<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.11 ReferentialConstraint.
 *
 * In Entity Data Model (EDM), a ReferentialConstraint element can exist between the key of one entity type and the
 * primitive property or properties of an associated entity type. A referential constraint is a constraint on the keys
 * contained in the association type. In CSDL 1.0, CSDL 1.1, and CSDL 1.2, the referential constraint can exist only
 * between the key properties of associated entities.
 *
 * The two entity types are in a Principal-to-Dependent relationship, which can also be thought of as a type of
 * parent-child relationship. When entities are related by an Association that specifies a referential constraint
 * between the keys of the two entities, the dependent (child) entity object cannot exist without a valid relationship
 * to a principal (parent) entity object.
 *
 * ReferentialConstraint MUST specify which end is the PrincipalRole and which end is the DependentRole for the
 * referential constraint.
 *
 * The following is an example of ReferentialConstraint.
 *
 *     <Association Name="FK_Employee_Employee_ManagerID">
 *         <End Role="Employee" Type="Adventureworks.Store.Employee" Multiplicity="1" />
 *         <End Role="Manager" Type="Adventureworks.Store.Manager" Multiplicity="0..1" />
 *         <ReferentialConstraint>
 *             <Principal Role="Employee">
 *                 <PropertyRef Name="EmployeeID" />
 *             </Principal>
 *             <Dependent Role="Manager">
 *                 <PropertyRef Name="ManagerID" />
 *             </Dependent>
 *         </ReferentialConstraint>
 *     </Association>
 *
 * The following rules apply to the ReferentialConstraint element:
 * - ReferentialConstraint MUST define exactly one Principal end role element and exactly one Dependent end role element.
 * - ReferentialConstraint can contain any number of AnnotationAttribute attributes. The full names of the
 * AnnotationAttribute attributes cannot collide.
 * - A ReferentialConstraint element can contain a maximum of one Documentation element.
 * - ReferentialConstraint can contain any number of AnnotationElement elements.
 * - Child elements of ReferentialConstraint are to appear in this sequence:
 * - - Documentation,
 * - - Principal,
 * - - Dependent,
 * - - AnnotationElement.
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl10.4
 * XSD Type: TConstraint
 */
class ReferentialConstraint extends EdmBase
{
    use HasDocumentation;

    /**
     * @var ReferentialConstraintRole $principal
     */
    private $principal = null;

    /**
     * @var ReferentialConstraintRole $dependent
     */
    private $dependent = null;

    /**
     * Gets as principal.
     *
     * @return ReferentialConstraintRole
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

    /**
     * Sets a new principal.
     *
     * @param  ReferentialConstraintRole $principal
     * @return self
     */
    public function setPrincipal(ReferentialConstraintRole $principal)
    {
        $this->principal = $principal;
        $principal->setIsPrincipal(true);

        return $this;
    }

    /**
     * Gets as dependent.
     *
     * @return ReferentialConstraintRole
     */
    public function getDependent()
    {
        return $this->dependent;
    }

    /**
     * Sets a new dependent.
     *
     * @param  ReferentialConstraintRole $dependent
     * @return self
     */
    public function setDependent(ReferentialConstraintRole $dependent)
    {
        $dependent->setIsPrincipal(false);
        $this->dependent = $dependent;
        return $this;
    }


    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'ReferentialConstraint';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [
            $this->getDocumentation(),
            $this->getPrincipal(),
            $this->getDependent()
        ];
    }
}
