<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edmx;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV4\edm\IsOKTraits\TNamespaceNameTrait;
use AlgoWeb\ODataMetadata\MetadataV4\edm\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TIncludeAnnotationsType
 *
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

    protected function IsOK(&$msg)
    {
        if (!$this->isStringNotNullOrEmpty($this->termNamespace)) {
            $msg = "Term Namespace Must be defined";
            return false;
        }
        if (!$this->IsTNamespaceNameValid($this->termNamespace)) {
            $msg = "Term Namespace Must be a valid NameSpace";
            return false;
        }


        if (null != $this->qualifier) {
            if (!is_string($this->qualifier)) {
                $msg = "qualifier must be either a string or null";
                return false;
            }
            if (!$this->IsTSimpleIdentifierValid($this->qualifier)) {
                $msg = "qualifier Must be a valid TSimpleIdentifyer";
                return false;
            }
        }
        if (null != $this->targetNamespace) {
            if (!is_string($this->targetNamespace)) {
                $msg = "targetNamespace must be either a string or null";
                return false;
            }
            if (!$this->$this->IsTNamespaceNameValid($this->targetNamespace)) {
                $msg = "targetNamespace Must be a valid TNAmespace";
                return false;
            }
        }
        return true;
    }
}
