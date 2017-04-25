<?php

namespace MetadataV3\edm;

/**
 * Class representing TFunctionImportReturnTypeType
 *
 *
 * XSD Type: TFunctionImportReturnType
 */
class TFunctionImportReturnTypeType
{

    /**
     * @property string $type
     */
    private $type = null;

    /**
     * @property \MetadataV3\edm\TOperandType $entitySet
     */
    private $entitySet = null;

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
     * @param string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Gets as entitySet
     *
     * @return \MetadataV3\edm\TOperandType
     */
    public function getEntitySet()
    {
        return $this->entitySet;
    }

    /**
     * Sets a new entitySet
     *
     * @param \MetadataV3\edm\TOperandType $entitySet
     * @return self
     */
    public function setEntitySet(\MetadataV3\edm\TOperandType $entitySet)
    {
        $this->entitySet = $entitySet;
        return $this;
    }
}
