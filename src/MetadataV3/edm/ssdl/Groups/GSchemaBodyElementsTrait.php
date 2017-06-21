<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl;

use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;

trait GSchemaBodyElementsTrait
{
    use IsOKToolboxTrait;
    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TAssociationType[] $association
     */
    private $association = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TEntityTypeType[] $entityType
     */
    private $entityType = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer[] $entityContainer
     */
    private $entityContainer = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TFunctionType[] $function
     */
    private $function = [];

    /**
     * Adds as association
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TAssociationType $association
     */
    public function addToAssociation(TAssociationType $association)
    {
        $msg = null;
        if (!$association->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->association[] = $association;
        return $this;
    }

    /**
     * isset association
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetAssociation($index)
    {
        return isset($this->association[$index]);
    }

    /**
     * unset association
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetAssociation($index)
    {
        unset($this->association[$index]);
    }

    /**
     * Gets as association
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TAssociationType[]
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Sets a new association
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TAssociationType[] $association
     * @return self
     */
    public function setAssociation(array $association)
    {
        if (!$this->isValidArrayOK(
            $association,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TAssociationType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->association = $association;
        return $this;
    }

    /**
     * Adds as entityType
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TEntityTypeType $entityType
     */
    public function addToEntityType(TEntityTypeType $entityType)
    {
        $msg = null;
        if (!$entityType->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->entityType[] = $entityType;
        return $this;
    }

    /**
     * isset entityType
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetEntityType($index)
    {
        return isset($this->entityType[$index]);
    }

    /**
     * unset entityType
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetEntityType($index)
    {
        unset($this->entityType[$index]);
    }

    /**
     * Gets as entityType
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TEntityTypeType[]
     */
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * Sets a new entityType
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TEntityTypeType[] $entityType
     * @return self
     */
    public function setEntityType(array $entityType)
    {
        $this->entityType = $entityType;
        return $this;
    }

    /**
     * Adds as entityContainer
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer $entityContainer
     */
    public function addToEntityContainer(EntityContainer $entityContainer)
    {
        $msg = null;
        if (!$entityContainer->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->entityContainer[] = $entityContainer;
        return $this;
    }

    /**
     * isset entityContainer
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetEntityContainer($index)
    {
        return isset($this->entityContainer[$index]);
    }

    /**
     * unset entityContainer
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetEntityContainer($index)
    {
        unset($this->entityContainer[$index]);
    }

    /**
     * Gets as entityContainer
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer[]
     */
    public function getEntityContainer()
    {
        return $this->entityContainer;
    }

    /**
     * Sets a new entityContainer
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer[] $entityContainer
     * @return self
     */
    public function setEntityContainer(array $entityContainer)
    {
        if (!$this->isValidArrayOK(
            $entityContainer,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer',
            $msg,
            1
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->entityContainer = $entityContainer;
        return $this;
    }

    /**
     * Adds as function
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TFunctionType $function
     */
    public function addToFunction(TFunctionType $function)
    {
        $msg = null;
        if (!$function->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->function[] = $function;
        return $this;
    }

    /**
     * isset function
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetFunction($index)
    {
        return isset($this->function[$index]);
    }

    /**
     * unset function
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetFunction($index)
    {
        unset($this->function[$index]);
    }

    /**
     * Gets as function
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TFunctionType[]
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Sets a new function
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TFunctionType[] $function
     * @return self
     */
    public function setFunction(array $function)
    {
        if (!$this->isValidArrayOK(
            $function,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TFunctionType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->function = $function;
        return $this;
    }

    public function isBodyElementsOK(&$msg = null)
    {
        if (!$this->isValidArrayOK(
            $this->association,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TAssociationType',
            $msg
        )
        ) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->entityType,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TEntityTypeType',
            $msg
        )
        ) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->entityContainer,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer',
            $msg,
            1
        )
        ) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->function,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TFunctionType',
            $msg
        )
        ) {
            return false;
        }
        return true;
    }
}
