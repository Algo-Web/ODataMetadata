<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Groups;

use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TAnnotationsType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TUsingType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermType;

trait GSchemaBodyElementsTrait
{
    use IsOKToolboxTrait;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TUsingType[] $using
     */
    private $using = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationType[] $association
     */
    private $association = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypeType[] $complexType
     */
    private $complexType = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType[] $entityType
     */
    private $entityType = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeType[] $enumType
     */
    private $enumType = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermType[] $valueTerm
     */
    private $valueTerm = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionType[] $function
     */
    private $function = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TAnnotationsType[] $annotations
     */
    private $annotations = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer[] $entityContainer
     */
    private $entityContainer = [];

    /**
     * Adds as using
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TUsingType $using
     */
    public function addToUsing(TUsingType $using)
    {
        $msg = null;
        if (!$using->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->using[] = $using;
        return $this;
    }

    /**
     * isset using
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetUsing($index)
    {
        return isset($this->using[$index]);
    }

    /**
     * unset using
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetUsing($index)
    {
        unset($this->using[$index]);
    }

    /**
     * Gets as using
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TUsingType[]
     */
    public function getUsing()
    {
        return $this->using;
    }

    /**
     * Sets a new using
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TUsingType[] $using
     * @return self
     */
    public function setUsing(array $using)
    {
        $msg = null;
        if (!$this->isValidArrayOK($using, '\AlgoWeb\ODataMetadata\MetadataV3\edm\TUsingType', $msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->using = $using;
        return $this;
    }

    /**
     * Adds as association
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationType $association
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationType[]
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Sets a new association
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationType[] $association
     * @return self
     */
    public function setAssociation(array $association)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $association,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->association = $association;
        return $this;
    }

    /**
     * Adds as complexType
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypeType $complexType
     */
    public function addToComplexType(TComplexTypeType $complexType)
    {
        $msg = null;
        if (!$complexType->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->complexType[] = $complexType;
        return $this;
    }

    /**
     * isset complexType
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetComplexType($index)
    {
        return isset($this->complexType[$index]);
    }

    /**
     * unset complexType
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetComplexType($index)
    {
        unset($this->complexType[$index]);
    }

    /**
     * Gets as complexType
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypeType[]
     */
    public function getComplexType()
    {
        return $this->complexType;
    }

    /**
     * Sets a new complexType
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypeType[] $complexType
     * @return self
     */
    public function setComplexType(array $complexType)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $complexType,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypeType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->complexType = $complexType;
        return $this;
    }

    /**
     * Adds as entityType
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType $entityType
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType[]
     */
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * Sets a new entityType
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType[] $entityType
     * @return self
     */
    public function setEntityType(array $entityType)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $entityType,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->entityType = $entityType;
        return $this;
    }

    /**
     * Adds as enumType
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeType $enumType
     */
    public function addToEnumType(TEnumTypeType $enumType)
    {
        $msg = null;
        if (!$enumType->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->enumType[] = $enumType;
        return $this;
    }

    /**
     * isset enumType
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetEnumType($index)
    {
        return isset($this->enumType[$index]);
    }

    /**
     * unset enumType
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetEnumType($index)
    {
        unset($this->enumType[$index]);
    }

    /**
     * Gets as enumType
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeType[]
     */
    public function getEnumType()
    {
        return $this->enumType;
    }

    /**
     * Sets a new enumType
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeType[] $enumType
     * @return self
     */
    public function setEnumType(array $enumType)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $enumType,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->enumType = $enumType;
        return $this;
    }

    /**
     * Adds as valueTerm
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermType $valueTerm
     */
    public function addToValueTerm(TValueTermType $valueTerm)
    {
        $msg = null;
        if (!$valueTerm->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->valueTerm[] = $valueTerm;
        return $this;
    }

    /**
     * isset valueTerm
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetValueTerm($index)
    {
        return isset($this->valueTerm[$index]);
    }

    /**
     * unset valueTerm
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetValueTerm($index)
    {
        unset($this->valueTerm[$index]);
    }

    /**
     * Gets as valueTerm
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermType[]
     */
    public function getValueTerm()
    {
        return $this->valueTerm;
    }

    /**
     * Sets a new valueTerm
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermType[] $valueTerm
     * @return self
     */
    public function setValueTerm(array $valueTerm)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $valueTerm,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->valueTerm = $valueTerm;
        return $this;
    }

    /**
     * Adds as function
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionType $function
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionType[]
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Sets a new function
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionType[] $function
     * @return self
     */
    public function setFunction(array $function)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $function,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->function = $function;
        return $this;
    }

    /**
     * Adds as annotations
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TAnnotationsType $annotations
     */
    public function addToAnnotations(TAnnotationsType $annotations)
    {
        $msg = null;
        if (!$annotations->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->annotations[] = $annotations;
        return $this;
    }

    /**
     * isset annotations
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetAnnotations($index)
    {
        return isset($this->annotations[$index]);
    }

    /**
     * unset annotations
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetAnnotations($index)
    {
        unset($this->annotations[$index]);
    }

    /**
     * Gets as annotations
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TAnnotationsType[]
     */
    public function getAnnotations()
    {
        return $this->annotations;
    }

    /**
     * Sets a new annotations
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TAnnotationsType[] $annotations
     * @return self
     */
    public function setAnnotations(array $annotations)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $annotations,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TAnnotationsType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->annotations = $annotations;
        return $this;
    }

    /**
     * Adds as entityContainer
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer $entityContainer
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer[]
     */
    public function getEntityContainer()
    {
        return $this->entityContainer;
    }

    /**
     * Sets a new entityContainer
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer[] $entityContainer
     * @return self
     */
    public function setEntityContainer(array $entityContainer)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $entityContainer,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer',
            $msg,
            1,
            1
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->entityContainer = $entityContainer;
        return $this;
    }


    public function isGSchemaBodyElementsValid(&$msg = null)
    {
        if (!$this->isValidArrayOK($this->using, '\AlgoWeb\ODataMetadata\MetadataV3\edm\TUsingType', $msg)) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->association,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationType',
            $msg
        )
        ) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->complexType,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypeType',
            $msg
        )
        ) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->entityType,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType',
            $msg
        )
        ) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->enumType,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeType',
            $msg
        )
        ) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->valueTerm,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermType',
            $msg
        )
        ) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->function,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionType',
            $msg
        )
        ) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->annotations,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TAnnotationsType',
            $msg
        )
        ) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->entityContainer,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer',
            $msg,
            1,
            1
        )
        ) {
            return false;
        }

        return true;
    }
}
