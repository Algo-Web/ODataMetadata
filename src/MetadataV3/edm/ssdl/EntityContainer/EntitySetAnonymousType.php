<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer;

use AlgoWeb\ODataMetadata\EntityStoreSchemaGenerator\TSourceTypeTrait;
use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TCommandTextTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TSimpleIdentifierTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TQualifiedNameTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TUndottedIdentifierTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType;

/**
 * Class representing EntitySetAnonymousType
 */
class EntitySetAnonymousType extends IsOK
{
    use TSimpleIdentifierTrait, TUndottedIdentifierTrait, TQualifiedNameTrait, TSourceTypeTrait, TCommandTextTrait;
    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $entityType
     */
    private $entityType = null;

    /**
     * @property string $schema
     */
    private $schema = null;

    /**
     * @property string $table
     */
    private $table = null;

    /**
     * @property string $type
     */
    private $type = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property string $definingQuery
     */
    private $definingQuery = null;

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
     * Gets as entityType
     *
     * @return string
     */
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * Sets a new entityType
     *
     * @param  string $entityType
     * @return self
     */
    public function setEntityType($entityType)
    {
        $this->entityType = $entityType;
        return $this;
    }

    /**
     * Gets as schema
     *
     * @return string
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Sets a new schema
     *
     * @param  string $schema
     * @return self
     */
    public function setSchema($schema)
    {
        $this->schema = $schema;
        return $this;
    }

    /**
     * Gets as table
     *
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Sets a new table
     *
     * @param  string $table
     * @return self
     */
    public function setTable($table)
    {
        $this->table = $table;
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
     * Gets as documentation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Gets as definingQuery
     *
     * @return string
     */
    public function getDefiningQuery()
    {
        return $this->definingQuery;
    }

    /**
     * Sets a new definingQuery
     *
     * @param  string $definingQuery
     * @return self
     */
    public function setDefiningQuery($definingQuery)
    {
        $this->definingQuery = $definingQuery;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isTUndottedIdentifierValid($this->name)) {
            $msg = "Name must be a valid TUndottedIdentifier";
            return false;
        }
        if (!$this->isTQualifiedNameValid($this->entityType)) {
            $msg = "Entity type must be a valid TQualifiedName";
            return false;
        }
        if (null != $this->schema && !$this->isTSimpleIdentifierValid($this->schema)) {
            $msg = "Schema must be a valid TSimpleIdentifier";
            return false;
        }
        if (null != $this->table && !$this->isTSimpleIdentifierValid($this->table)) {
            $msg = "Table must be a valid TSimpleIdentifier";
            return false;
        }
        if (null != $this->type && !$this->isTSourceTypeValid($this->type)) {
            $msg = "Type must be a valid TSourceType";
            return false;
        }
        if (null != $this->definingQuery && !$this->isTCommandTextValid($this->definingQuery)) {
            $msg = "Defining query must be a valid TCommandText";
            return false;
        }
        if (!$this->isObjectNullOrType(
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType',
            $this->documentation,
            $msg
        )
        ) {
            return false;
        }

        return true;
    }
}
