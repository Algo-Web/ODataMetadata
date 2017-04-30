<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edmx;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\xsdRestrictions;

/**
 * Class representing TIncludeAnnotationsType
 *
 *
 * XSD Type: TIncludeAnnotations
 */
class TIncludeAnnotationsType extends IsOK
{
    use xsdRestrictions;

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
        if (!$this->isNCName($this->termNamespace)) {
            $msg = "Term Namespace Must be a valid NCName";
            return false;
        }
        //<!-- one or more SimpleIdentifiers separated by dots -->
        if (!$this->MatchesRegexPattern("[\p{L}\p{Nl}_][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}(\.[\p{L}\p{Nl}_][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}){0,}", $this->termNamespace)) {
            $msg = "the term namespace dose not match the regex in the xsd.";
            return false;
        }

        if (null != $this->qualifier) {
            if (!is_string($this->qualifier)) {
                $msg = "qualifier must be either a string or null";
                return false;
            }
            if (!$this->isNCName($this->qualifier)) {
                $msg = "qualifier Must be a valid NCName";
                return false;
            }
            if (strlen($this->qualifier > 128)) {
                $msg = "the maximum length permitted for qualifier is 128";
                return false;
            }
            //      <!-- ECMAScript identifiers not starting with a '$' -->
            if (!$this->MatchesRegexPattern("[\p{L}\p{Nl}_][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}", $this->qualifier)) {
                $msg = "the qualifier dose not match the regex in the xsd.";
                return false;
            }
        }
        if (null != $this->targetNamespace) {
            if (!is_string($this->targetNamespace)) {
                $msg = "targetNamespace must be either a string or null";
                return false;
            }
            if (!$this->isNCName($this->targetNamespace)) {
                $msg = "targetNamespace Must be a valid NCName";
                return false;
            }
            //<!-- one or more SimpleIdentifiers separated by dots -->
            if (!$this->MatchesRegexPattern("[\p{L}\p{Nl}_][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}(\.[\p{L}\p{Nl}_][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}){0,}", $this->targetNamespace)) {
                $msg = "the targetNamespace dose not match the regex in the xsd.";
                return false;
            }
        }
        return true;
    }
}
