<?php

namespace MetadataV3\edm;

/**
 * Class representing TParameterReferenceExpressionType
 *
 *
 * XSD Type: TParameterReferenceExpression
 */
class TParameterReferenceExpressionType
{

    /**
     * @property string $name
     */
    private $name = null;

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


}

