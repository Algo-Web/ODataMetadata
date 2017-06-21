<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edmx;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV4\edm\IsOKTraits\TNamespaceNameTrait;
use AlgoWeb\ODataMetadata\MetadataV4\edm\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TIncludeAnnotationsType
 *
 * XSD Type: TIncludeAnnotations
 */
class TIncludeAnnotationsType extends IsOK
{
    use TNamespaceNameTrait, TSimpleIdentifierTrait;

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
     * @param  string $termNamespace
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
     * @param  string $qualifier
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
     * @param  string $targetNamespace
     * @return self
     */
    public function setTargetNamespace($targetNamespace)
    {
        $this->targetNamespace = $targetNamespace;
        return $this;
    }

    protected function isOK(&$msg)
    {
        if (!$this->isStringNotNullOrEmpty($this->termNamespace)) {
            $msg = "Term namespace must be defined";
            return false;
        }
        if (!$this->isTNamespaceNameValid($this->termNamespace)) {
            $msg = "Term namespace must be a valid NameSpace";
            return false;
        }


        if (null != $this->qualifier) {
            if (!is_string($this->qualifier)) {
                $msg = "Qualifier must be either a string or null";
                return false;
            }
            if (!$this->isTSimpleIdentifierValid($this->qualifier)) {
                $msg = "Qualifier must be a valid TSimpleIdentifier";
                return false;
            }
        }
        if (null != $this->targetNamespace) {
            if (!is_string($this->targetNamespace)) {
                $msg = "TargetNamespace must be either a string or null";
                return false;
            }
            if (!$this->$this->IsTNamespaceNameValid($this->targetNamespace)) {
                $msg = "TargetNamespace must be a valid TNamespace";
                return false;
            }
        }
        return true;
    }
}
