<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits\TQualifiedNameTrait;
use AlgoWeb\ODataMetadata\MetadataV4\edm\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TAssociationSetMappingType
 *
 * Type for AssociationSetMapping element
 *
 * XSD Type: TAssociationSetMapping
 */
class TAssociationSetMappingType extends IsOK
{
    use TSimpleIdentifierTrait, TQualifiedNameTrait {
        TSimpleIdentifierTrait::isNCName insteadof TQualifiedNameTrait;
        TSimpleIdentifierTrait::matchesRegexPattern insteadof TQualifiedNameTrait;
        TSimpleIdentifierTrait::isName insteadof TQualifiedNameTrait;
    }

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $typeName
     */
    private $typeName = null;

    /**
     * @property string $storeEntitySet
     */
    private $storeEntitySet = null;

    /**
     * @property string $queryView
     */
    private $queryView = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEndPropertyType[] $endProperty
     */
    private $endProperty = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TConditionType[] $condition
     */
    private $condition = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TAssociationSetModificationFunctionMappingType
     * $modificationFunctionMapping
     */
    private $modificationFunctionMapping = null;

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
        if (!$this->isStringNotNullOrEmpty($name)) {
            $msg = 'Name cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
        if (!$this->isTSimpleIdentifierValid($name)) {
            $msg = 'Name must be a valid TSimpleIdentifier';
            throw new \InvalidArgumentException($msg);
        }
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as typeName
     *
     * @return string
     */
    public function getTypeName()
    {
        return $this->typeName;
    }

    /**
     * Sets a new typeName
     *
     * @param  string $typeName
     * @return self
     */
    public function setTypeName($typeName)
    {
        if (null != $typeName && !$this->isStringNotNullOrEmpty($typeName)) {
            $msg = 'Type name cannot be empty';
            throw new \InvalidArgumentException($msg);
        }
        if (null != $typeName && !$this->isTQualifiedNameValid($typeName)) {
            $msg = 'Type name must be a valid TQualifiedName';
            throw new \InvalidArgumentException($msg);
        }
        $this->typeName = $typeName;
        return $this;
    }

    /**
     * Gets as storeEntitySet
     *
     * @return string
     */
    public function getStoreEntitySet()
    {
        return $this->storeEntitySet;
    }

    /**
     * Sets a new storeEntitySet
     *
     * @param  string $storeEntitySet
     * @return self
     */
    public function setStoreEntitySet($storeEntitySet)
    {
        if (null != $storeEntitySet && !$this->isStringNotNullOrEmpty($storeEntitySet)) {
            $msg = 'Store entity set cannot be empty';
            throw new \InvalidArgumentException($msg);
        }
        $this->storeEntitySet = $storeEntitySet;
        return $this;
    }

    /**
     * Gets as queryView
     *
     * @return string
     */
    public function getQueryView()
    {
        return $this->queryView;
    }

    /**
     * Sets a new queryView
     *
     * @param  string $queryView
     * @return self
     */
    public function setQueryView($queryView)
    {
        if (null != $queryView && !$this->isStringNotNullOrEmpty($queryView)) {
            $msg = 'Query view cannot be empty';
            throw new \InvalidArgumentException($msg);
        }
        $this->queryView = $queryView;
        return $this;
    }

    /**
     * Adds as endProperty
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEndPropertyType $endProperty
     */
    public function addToEndProperty(TEndPropertyType $endProperty)
    {
        $msg = null;
        if (!$endProperty->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->endProperty[] = $endProperty;
        return $this;
    }

    /**
     * isset endProperty
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetEndProperty($index)
    {
        return isset($this->endProperty[$index]);
    }

    /**
     * unset endProperty
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetEndProperty($index)
    {
        unset($this->endProperty[$index]);
    }

    /**
     * Gets as endProperty
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEndPropertyType[]
     */
    public function getEndProperty()
    {
        return $this->endProperty;
    }

    /**
     * Sets a new endProperty
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEndPropertyType[] $endProperty
     * @return self
     */
    public function setEndProperty(array $endProperty)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $endProperty,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEndPropertyType',
            $msg,
            0,
            2
        )
        ) {
            throw new \InvalidArgumentException("End property array not a valid array, or has more than 2 elements");
        }
        $this->endProperty = $endProperty;
        return $this;
    }

    /**
     * Adds as condition
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TConditionType $condition
     */
    public function addToCondition(TConditionType $condition)
    {
        $msg = null;
        if (!$condition->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->condition[] = $condition;
        return $this;
    }

    /**
     * isset condition
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetCondition($index)
    {
        return isset($this->condition[$index]);
    }

    /**
     * unset condition
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetCondition($index)
    {
        unset($this->condition[$index]);
    }

    /**
     * Gets as condition
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TConditionType[]
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Sets a new condition
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TConditionType[] $condition
     * @return self
     */
    public function setCondition(array $condition)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $condition,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TConditionType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->condition = $condition;
        return $this;
    }

    /**
     * Gets as modificationFunctionMapping
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TAssociationSetModificationFunctionMappingType
     */
    public function getModificationFunctionMapping()
    {
        return $this->modificationFunctionMapping;
    }

    /**
     * Sets a new modificationFunctionMapping
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TAssociationSetModificationFunctionMappingType
     * $modificationFunctionMapping
     * @return self
     */
    public function setModificationFunctionMapping(TAssociationSetModificationFunctionMappingType $modificationFunctionMapping)
    {
        $msg = null;
        if (!$modificationFunctionMapping->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->modificationFunctionMapping = $modificationFunctionMapping;
        return $this;
    }
    
    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->name)) {
            $msg = 'Name cannot be null or empty';
            return false;
        }
        if (null != $this->typeName && !$this->isStringNotNullOrEmpty($this->typeName)) {
            $msg = 'Type name cannot be empty';
            return false;
        }
        if (null != $this->storeEntitySet && !$this->isStringNotNullOrEmpty($this->storeEntitySet)) {
            $msg = 'Store entity set cannot be empty';
            return false;
        }
        if (null != $this->queryView && !$this->isStringNotNullOrEmpty($this->queryView)) {
            $msg = 'Query view cannot be empty';
            return false;
        }

        if (!$this->isTSimpleIdentifierValid($this->name)) {
            $msg = 'Name must be a valid TSimpleIdentifier';
            return false;
        }
        if (null != $this->typeName && !$this->isTQualifiedNameValid($this->typeName)) {
            $msg = 'Type name must be a valid TQualifiedName';
            return false;
        }
        if (null != $this->modificationFunctionMapping && !$this->modificationFunctionMapping->isOK($msg)) {
            return false;
        }
        if (!$this->isValidArray(
            $this->endProperty,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEndPropertyType',
            0,
            2
        )
        ) {
            $msg = "End property array not a valid array, or has more than 2 elements";
            return false;
        }
        if (!$this->isChildArrayOK($this->endProperty, $msg)) {
            return false;
        }
        if (!$this->isValidArray(
            $this->endProperty,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TConditionType'
        )
        ) {
            $msg = "Condition array not a valid array";
            return false;
        }
        if (!$this->isChildArrayOK($this->condition, $msg)) {
            return false;
        }

        return true;
    }
}
