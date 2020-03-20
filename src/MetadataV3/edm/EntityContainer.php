<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\AccessorType;
use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\HasValueAnnotation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityContainer\AssociationSet;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityContainer\EntitySet;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityContainer\FunctionImport;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.14 EntityContainer.
 *
 * EntityContainer is conceptually similar to a database or data source. It groups EntitySet, AssociationSet, and
 * FunctionImport child elements that represent a data source.
 *
 * The following is an example of the EntityContainer element.
 *
 * <EntityContainer Name="Model1Container" >
 * <EntitySet Name="CustomerSet" EntityType="Model1.Customer" />
 * <EntitySet Name="OrderSet" EntityType="Model1.Order" />
 * <AssociationSet Name="CustomerOrder" Association="Model1.CustomerOrder">
 * <End Role="Customer" EntitySet="CustomerSet" />
 * <End Role="Order" EntitySet="OrderSet" />
 * </AssociationSet>
 * </EntityContainer>
 *
 * The following rules apply to the EntityContainer element:
 * - EntityContainer MUST have a Name attribute defined that is of type SimpleIdentifier.
 * - EntityContainer can define an Extends attribute, which, if present, refers to another EntityContainer in scope
 * by name.
 * - EntityContainer elements that extend another EntityContainer inherit all of the extended EntitySet, AssociationSet,
 *   and FunctionImport child elements from that EntityContainer.
 * - EntityContainer can contain a maximum of one Documentation element.
 * - EntityContainer can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute
 *   attributes cannot collide.
 * - EntityContainer can contain any number of FunctionImport, EntitySet, and AssociationSet elements, which can be
 *   defined in any order.
 * - FunctionImport, EntitySet, and AssociationSet names within an EntityContainer cannot collide.
 * - If present, the Documentation child element MUST precede FunctionImport, EntitySet, and AssociationSet child
 *   elements.
 * - In CSDL 2.0 and CSDL 3.0, EntityContainer can contain any number of AnnotationElement elements.
 * - In CSDL 3.0, EntityContainer can contain any number of ValueAnnotation elements.
 * - In the sequence of child elements under EntityContainer, AnnotationElement follows all other elements.
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl12.1
 */
class EntityContainer extends EdmBase
{
    /*
     * EntityContainer can contain a maximum of one Documentation element.
     * If present, the Documentation child element MUST precede FunctionImport, EntitySet, and AssociationSet
     * child elements.
     */
    use HasDocumentation,
        /*
         * In CSDL 3.0, EntityContainer can contain any number of ValueAnnotation elements.
         */
        HasValueAnnotation;
    /**
     * @var string $name entityContainer MUST have a Name attribute defined that is of type SimpleIdentifier
     */
    private $name;

    /**
     * @var string $extends EntityContainer can define an Extends attribute, which, if present, refers to another
     *             EntityContainer in scope by name.EntityContainer elements that extend another EntityContainer inherit all of the
     *             extended EntitySet, AssociationSet, and FunctionImport child elements from that EntityContainer.
     */
    private $extends = null;

    /**
     * @var AccessorType $typeAccess
     */
    private $typeAccess = null;

    /**
     * @var bool $isDefaultEntityContainer
     */
    private $isDefaultEntityContainer = false;

    /**
     * @var bool $lazyLoadingEnabled
     */
    private $lazyLoadingEnabled = null;
    /**
     * EntityContainer can contain any number of FunctionImport, EntitySet, and AssociationSet elements, which can be
     * defined in any order.
     *
     * FunctionImport, EntitySet, and AssociationSet names within an EntityContainer cannot collide.
     */
    /**
     * @var FunctionImport[] $functionImport
     */
    private $functionImport = [];

    /**
     * @var EntitySet[] $entitySet
     */
    private $entitySet = [];

    /**
     * @var AssociationSet[] $associationSet
     */
    private $associationSet = [];

    public function __construct(
        string $name,
        bool $isDefaultEntityContainer = false,
        Documentation $documentation= null,
        bool $lazyLoadingEnabled = false)
    {
        $this->setName($name)
            ->setIsDefaultEntityContainer($isDefaultEntityContainer)
            ->setLazyLoadingEnabled($lazyLoadingEnabled)
            ->setDocumentation($documentation);
    }

    /**
     * Gets as name.
     *
     * @return string
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * Sets a new name.
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name):self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as extends.
     *
     * @return string|null
     */
    public function getExtends(): ?string
    {
        return $this->extends;
    }

    /**
     * Sets a new extends.
     *
     * @param  string|null $extends
     * @return self
     */
    public function setExtends(?string $extends): self
    {
        $this->extends = $extends;
        return $this;
    }

    /**
     * Gets as typeAccess.
     *
     * @return AccessorType
     */
    public function getTypeAccess()
    {
        return $this->typeAccess;
    }

    /**
     * Sets a new typeAccess.
     *
     * @param  AccessorType $typeAccess
     * @return self
     */
    public function setTypeAccess(AccessorType $typeAccess): self
    {
        $this->typeAccess = $typeAccess;
        return $this;
    }

    /**
     * Gets as lazyLoadingEnabled.
     *
     * @return bool
     */
    public function getLazyLoadingEnabled(): bool
    {
        return $this->lazyLoadingEnabled;
    }

    /**
     * Sets a new lazyLoadingEnabled.
     *
     * @param  bool $lazyLoadingEnabled
     * @return self
     */
    public function setLazyLoadingEnabled(bool $lazyLoadingEnabled): self
    {
        $this->lazyLoadingEnabled = $lazyLoadingEnabled;
        return $this;
    }

    /**
     * Gets as IsDefaultEntityContainer.
     *
     * @return bool
     */
    public function getIsDefaultEntityContainer(): bool
    {
        return $this->isDefaultEntityContainer;
    }

    /**
     * Sets a new isDefaultEntityContainer.
     *
     * @param  bool $isDefaultEntityContainer
     * @return self
     */
    public function setIsDefaultEntityContainer(bool $isDefaultEntityContainer): self
    {
        $this->isDefaultEntityContainer = $isDefaultEntityContainer;
        return $this;
    }
    /**
     * Adds as functionImport.
     *
     * @param FunctionImport $functionImport
     *@return self
     */
    public function addToFunctionImport(FunctionImport $functionImport): self
    {
        $this->functionImport[] = $functionImport;
        return $this;
    }

    /**
     * isset functionImport.
     *
     * @param  int  $index
     * @return bool
     */
    public function issetFunctionImport(int $index): bool
    {
        return isset($this->functionImport[$index]);
    }

    /**
     * unset functionImport.
     *
     * @param  int  $index
     * @return void
     */
    public function unsetFunctionImport(int $index): void
    {
        unset($this->functionImport[$index]);
    }

    /**
     * Gets as functionImport.
     *
     * @return FunctionImport[]
     */
    public function getFunctionImport(): array
    {
        return $this->functionImport;
    }

    /**
     * Sets a new functionImport.
     *
     * @param  FunctionImport[] $functionImport
     * @return self
     */
    public function setFunctionImport(array $functionImport): self
    {
        $this->functionImport = $functionImport;
        return $this;
    }

    /**
     * Adds as entitySet.
     *
     * @param  EntitySet $entitySet
     * @return self
     */
    public function addToEntitySet(EntitySet $entitySet): self
    {
        $this->entitySet[] = $entitySet;
        return $this;
    }

    /**
     * isset entitySet.
     *
     * @param  int  $index
     * @return bool
     */
    public function issetEntitySet(int $index): bool
    {
        return isset($this->entitySet[$index]);
    }

    /**
     * unset entitySet.
     *
     * @param  int  $index
     * @return void
     */
    public function unsetEntitySet(int $index): void
    {
        unset($this->entitySet[$index]);
    }

    /**
     * Gets as entitySet.
     *
     * @return EntitySet[]
     */
    public function getEntitySet(): array
    {
        return $this->entitySet;
    }

    /**
     * Sets a new entitySet.
     *
     * @param  EntitySet[] $entitySet
     * @return self
     */
    public function setEntitySet(array $entitySet): self
    {
        $this->entitySet = $entitySet;
        return $this;
    }

    /**
     * Adds as associationSet.
     *
     * @param  AssociationSet $associationSet
     * @return self
     */
    public function addToAssociationSet(AssociationSet $associationSet): self
    {
        $this->associationSet[] = $associationSet;
        return $this;
    }

    /**
     * isset associationSet.
     *
     * @param  int  $index
     * @return bool
     */
    public function issetAssociationSet(int $index):bool
    {
        return isset($this->associationSet[$index]);
    }

    /**
     * unset associationSet.
     *
     * @param  int  $index
     * @return void
     */
    public function unsetAssociationSet(int $index): void
    {
        unset($this->associationSet[$index]);
    }

    /**
     * Gets as associationSet.
     *
     * @return AssociationSet[]
     */
    public function getAssociationSet(): array
    {
        return $this->associationSet;
    }

    /**
     * Sets a new associationSet.
     *
     * @param  AssociationSet[] $associationSet
     * @return self
     */
    public function setAssociationSet(array $associationSet): self
    {
        $this->associationSet = $associationSet;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'EntityContainer';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('Name', $this->getName()),
            new AttributeContainer('Extends', $this->getExtends(), true),
            new AttributeContainer('metadata:IsDefaultEntityContainer', $this->getIsDefaultEntityContainer()),
            new AttributeContainer('annotations:LazyLoadingEnabled', $this->getLazyLoadingEnabled()),
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return array_merge(
            [$this->getDocumentation()],
            $this->getFunctionImport(),
            $this->getEntitySet(),
            $this->getAssociationSet(),
            [$this->getValueAnnotation()]
        );
    }
}
