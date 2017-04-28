<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edmx;
/**
 * Class representing TIncludeAnnotationsType
 *
 *
 * XSD Type: TIncludeAnnotations
 */
class TIncludeAnnotationsType
{

    /**
     * @property string $termNamespace
     */
    private $termNamespace = null;

    /**
     * @property string $qualifier
     */
    private $qualifier = null;

    /**
     * @property string $targetNamespace
     */
    private $targetNamespace = null;

    /**
     * Gets as termNamespace
     *
     * @return string
     */
    public function getTermNamespace()
    {
        return $this->termNamespace;
    }

    /**
     * Sets a new termNamespace
     *
     * @param string $termNamespace
     * @return self
     */
    public function setTermNamespace($termNamespace)
    {
        $this->termNamespace = $termNamespace;
        return $this;
    }

    /**
     * Gets as qualifier
     *
     * @return string
     */
    public function getQualifier()
    {
        return $this->qualifier;
    }

    /**
     * Sets a new qualifier
     *
     * @param string $qualifier
     * @return self
     */
    public function setQualifier($qualifier)
    {
        $this->qualifier = $qualifier;
        return $this;
    }

    /**
     * Gets as targetNamespace
     *
     * @return string
     */
    public function getTargetNamespace()
    {
        return $this->targetNamespace;
    }

    /**
     * Sets a new targetNamespace
     *
     * @param string $targetNamespace
     * @return self
     */
    public function setTargetNamespace($targetNamespace)
    {
        $this->targetNamespace = $targetNamespace;
        return $this;
    }
}
