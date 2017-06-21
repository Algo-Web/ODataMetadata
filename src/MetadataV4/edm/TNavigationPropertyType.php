<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TNavigationPropertyType
 *
 * XSD Type: TNavigationProperty
 */
class TNavigationPropertyType extends IsOK
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $type
     */
    private $type = null;

    /**
     * @property boolean $nullable
     */
    private $nullable = null;

    /**
     * @property string $partner
     */
    private $partner = null;

    /**
     * @property boolean $containsTarget
     */
    private $containsTarget = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TReferentialConstraintType[] $referentialConstraint
     */
    private $referentialConstraint = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TOnDeleteType[] $onDelete
     */
    private $onDelete = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[] $annotation
     */
    private $annotation = array();

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
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets a new type
     *
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Gets as nullable
     *
     * @return boolean
     */
    public function getNullable()
    {
        return $this->nullable;
    }

    /**
     * Sets a new nullable
     *
     * @param  boolean $nullable
     * @return self
     */
    public function setNullable($nullable)
    {
        $this->nullable = $nullable;
        return $this;
    }

    /**
     * Gets as partner
     *
     * @return string
     */
    public function getPartner()
    {
        return $this->partner;
    }

    /**
     * Sets a new partner
     *
     * @param  string $partner
     * @return self
     */
    public function setPartner($partner)
    {
        $this->partner = $partner;
        return $this;
    }

    /**
     * Gets as containsTarget
     *
     * @return boolean
     */
    public function getContainsTarget()
    {
        return $this->containsTarget;
    }

    /**
     * Sets a new containsTarget
     *
     * @param  boolean $containsTarget
     * @return self
     */
    public function setContainsTarget($containsTarget)
    {
        $this->containsTarget = $containsTarget;
        return $this;
    }

    /**
     * Adds as referentialConstraint
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TReferentialConstraintType $referentialConstraint
     */
    public function addToReferentialConstraint(TReferentialConstraintType $referentialConstraint)
    {
        $this->referentialConstraint[] = $referentialConstraint;
        return $this;
    }

    /**
     * isset referentialConstraint
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetReferentialConstraint($index)
    {
        return isset($this->referentialConstraint[$index]);
    }

    /**
     * unset referentialConstraint
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetReferentialConstraint($index)
    {
        unset($this->referentialConstraint[$index]);
    }

    /**
     * Gets as referentialConstraint
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TReferentialConstraintType[]
     */
    public function getReferentialConstraint()
    {
        return $this->referentialConstraint;
    }

    /**
     * Sets a new referentialConstraint
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TReferentialConstraintType[] $referentialConstraint
     * @return self
     */
    public function setReferentialConstraint(array $referentialConstraint)
    {
        $this->referentialConstraint = $referentialConstraint;
        return $this;
    }

    /**
     * Adds as onDelete
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TOnDeleteType $onDelete
     */
    public function addToOnDelete(TOnDeleteType $onDelete)
    {
        $this->onDelete[] = $onDelete;
        return $this;
    }

    /**
     * isset onDelete
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetOnDelete($index)
    {
        return isset($this->onDelete[$index]);
    }

    /**
     * unset onDelete
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetOnDelete($index)
    {
        unset($this->onDelete[$index]);
    }

    /**
     * Gets as onDelete
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TOnDeleteType[]
     */
    public function getOnDelete()
    {
        return $this->onDelete;
    }

    /**
     * Sets a new onDelete
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TOnDeleteType[] $onDelete
     * @return self
     */
    public function setOnDelete(array $onDelete)
    {
        $this->onDelete = $onDelete;
        return $this;
    }

    /**
     * Adds as annotation
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation $annotation
     */
    public function addToAnnotation(Annotation $annotation)
    {
        $this->annotation[] = $annotation;
        return $this;
    }

    /**
     * isset annotation
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetAnnotation($index)
    {
        return isset($this->annotation[$index]);
    }

    /**
     * unset annotation
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetAnnotation($index)
    {
        unset($this->annotation[$index]);
    }

    /**
     * Gets as annotation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[]
     */
    public function getAnnotation()
    {
        return $this->annotation;
    }

    /**
     * Sets a new annotation
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[] $annotation
     * @return self
     */
    public function setAnnotation(array $annotation)
    {
        $this->annotation = $annotation;
        return $this;
    }
}
