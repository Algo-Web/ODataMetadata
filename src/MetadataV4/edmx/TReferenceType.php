<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edmx;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation;

/**
 * Class representing TReferenceType
 *
 * XSD Type: TReference
 */
class TReferenceType extends IsOK
{

    /**
     * @property string $uri
     */
    private $uri = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edmx\TIncludeType[] $include
     */
    private $include = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edmx\TIncludeAnnotationsType[] $includeAnnotations
     */
    private $includeAnnotations = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[] $annotation
     */
    private $annotation = array();

    /**
     * Gets as uri
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Sets a new uri
     *
     * @param  string $uri
     * @return self
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * Adds as include
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edmx\TIncludeType $include
     */
    public function addToInclude(TIncludeType $include)
    {
        $this->include[] = $include;
        return $this;
    }

    /**
     * isset include
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetInclude($index)
    {
        return isset($this->include[$index]);
    }

    /**
     * unset include
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetInclude($index)
    {
        unset($this->include[$index]);
    }

    /**
     * Gets as include
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edmx\TIncludeType[]
     */
    public function getInclude()
    {
        return $this->include;
    }

    /**
     * Sets a new include
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edmx\TIncludeType[] $include
     * @return self
     */
    public function setInclude(array $include)
    {
        $this->include = $include;
        return $this;
    }

    /**
     * Adds as includeAnnotations
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edmx\TIncludeAnnotationsType $includeAnnotations
     */
    public function addToIncludeAnnotations(TIncludeAnnotationsType $includeAnnotations)
    {
        $this->includeAnnotations[] = $includeAnnotations;
        return $this;
    }

    /**
     * isset includeAnnotations
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetIncludeAnnotations($index)
    {
        return isset($this->includeAnnotations[$index]);
    }

    /**
     * unset includeAnnotations
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetIncludeAnnotations($index)
    {
        unset($this->includeAnnotations[$index]);
    }

    /**
     * Gets as includeAnnotations
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edmx\TIncludeAnnotationsType[]
     */
    public function getIncludeAnnotations()
    {
        return $this->includeAnnotations;
    }

    /**
     * Sets a new includeAnnotations
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edmx\TIncludeAnnotationsType[] $includeAnnotations
     * @return self
     */
    public function setIncludeAnnotations(array $includeAnnotations)
    {
        $this->includeAnnotations = $includeAnnotations;
        return $this;
    }

    /**
     * Adds as annotation
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation $annotation
     */
    public function addToAnnotation(Annotation $annotation)
    {
        $this->annotation[] = $annotation;
        return $this;
    }

    /**
     * isset annotation
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetAnnotation($index)
    {
        return isset($this->annotation[$index]);
    }

    /**
     * unset annotation
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetAnnotation($index)
    {
        unset($this->annotation[$index]);
    }

    /**
     * Gets as annotation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[]
     */
    public function getAnnotation()
    {
        return $this->annotation;
    }

    /**
     * Sets a new annotation
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[] $annotation
     * @return self
     */
    public function setAnnotation(array $annotation)
    {
        $this->annotation = $annotation;
        return $this;
    }

    protected function isOK(&$msg = null)
    {
        if (!$this->isURLValid($this->uri)) {
            $msg = "Uri must be valid";
            return false;
        }

        if (!$this->isValidArray($this->include, \AlgoWeb\ODataMetadata\MetadataV4\edmx\TIncludeType, 1)) {
            $msg = "Include is not a valid array";
            return false;
        }
        if (!$this->isValidArray(
            $this->includeAnnotations,
            \AlgoWeb\ODataMetadata\MetadataV4\edmx\TIncludeAnnotationsType,
            1
        )
        ) {
            $msg = "IncludeAnnotations is not a valid array";
            return false;
        }
        if (!$this->isValidArray($this->annotation, \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation, 1)) {
            $msg = "Annotation is not a valid array";
            return false;
        }
        if (!$this->isChildArrayOK($this->include, $msg)) {
            return false;
        }
        if (!$this->isChildArrayOK($this->includeAnnotations, $msg)) {
            return false;
        }
        if (!$this->isChildArrayOK($this->annotation, $msg)) {
            return false;
        }
        return true;
    }
}
