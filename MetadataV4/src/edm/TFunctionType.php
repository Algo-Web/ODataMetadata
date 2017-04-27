<?php

namespace MetadataV4\edm;

/**
 * Class representing TFunctionType
 *
 *
 * XSD Type: TFunction
 */
class TFunctionType
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $entitySetPath
     */
    private $entitySetPath = null;

    /**
     * @property boolean $isBound
     */
    private $isBound = null;

    /**
     * @property boolean $isComposable
     */
    private $isComposable = null;

    /**
     * @property \MetadataV4\edm\TActionFunctionParameterType[] $parameter
     */
    private $parameter = array(
        
    );

    /**
     * @property \MetadataV4\edm\Annotation[] $annotation
     */
    private $annotation = array(
        
    );

    /**
     * @property \MetadataV4\edm\TActionFunctionReturnTypeType $returnType
     */
    private $returnType = null;

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
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as entitySetPath
     *
     * @return string
     */
    public function getEntitySetPath()
    {
        return $this->entitySetPath;
    }

    /**
     * Sets a new entitySetPath
     *
     * @param string $entitySetPath
     * @return self
     */
    public function setEntitySetPath($entitySetPath)
    {
        $this->entitySetPath = $entitySetPath;
        return $this;
    }

    /**
     * Gets as isBound
     *
     * @return boolean
     */
    public function getIsBound()
    {
        return $this->isBound;
    }

    /**
     * Sets a new isBound
     *
     * @param boolean $isBound
     * @return self
     */
    public function setIsBound($isBound)
    {
        $this->isBound = $isBound;
        return $this;
    }

    /**
     * Gets as isComposable
     *
     * @return boolean
     */
    public function getIsComposable()
    {
        return $this->isComposable;
    }

    /**
     * Sets a new isComposable
     *
     * @param boolean $isComposable
     * @return self
     */
    public function setIsComposable($isComposable)
    {
        $this->isComposable = $isComposable;
        return $this;
    }

    /**
     * Adds as parameter
     *
     * @return self
     * @param \MetadataV4\edm\TActionFunctionParameterType $parameter
     */
    public function addToParameter(\MetadataV4\edm\TActionFunctionParameterType $parameter)
    {
        $this->parameter[] = $parameter;
        return $this;
    }

    /**
     * isset parameter
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetParameter($index)
    {
        return isset($this->parameter[$index]);
    }

    /**
     * unset parameter
     *
     * @param scalar $index
     * @return void
     */
    public function unsetParameter($index)
    {
        unset($this->parameter[$index]);
    }

    /**
     * Gets as parameter
     *
     * @return \MetadataV4\edm\TActionFunctionParameterType[]
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * Sets a new parameter
     *
     * @param \MetadataV4\edm\TActionFunctionParameterType[] $parameter
     * @return self
     */
    public function setParameter(array $parameter)
    {
        $this->parameter = $parameter;
        return $this;
    }

    /**
     * Adds as annotation
     *
     * @return self
     * @param \MetadataV4\edm\Annotation $annotation
     */
    public function addToAnnotation(\MetadataV4\edm\Annotation $annotation)
    {
        $this->annotation[] = $annotation;
        return $this;
    }

    /**
     * isset annotation
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetAnnotation($index)
    {
        return isset($this->annotation[$index]);
    }

    /**
     * unset annotation
     *
     * @param scalar $index
     * @return void
     */
    public function unsetAnnotation($index)
    {
        unset($this->annotation[$index]);
    }

    /**
     * Gets as annotation
     *
     * @return \MetadataV4\edm\Annotation[]
     */
    public function getAnnotation()
    {
        return $this->annotation;
    }

    /**
     * Sets a new annotation
     *
     * @param \MetadataV4\edm\Annotation[] $annotation
     * @return self
     */
    public function setAnnotation(array $annotation)
    {
        $this->annotation = $annotation;
        return $this;
    }

    /**
     * Gets as returnType
     *
     * @return \MetadataV4\edm\TActionFunctionReturnTypeType
     */
    public function getReturnType()
    {
        return $this->returnType;
    }

    /**
     * Sets a new returnType
     *
     * @param \MetadataV4\edm\TActionFunctionReturnTypeType $returnType
     * @return self
     */
    public function setReturnType(\MetadataV4\edm\TActionFunctionReturnTypeType $returnType)
    {
        $this->returnType = $returnType;
        return $this;
    }


}

