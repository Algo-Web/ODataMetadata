<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edmx;

/**
 * Class representing TReferenceType
 *
 *
 * XSD Type: TReference
 */
class TReferenceType
{

    /**
     * @property string $uri
     */
    private $uri = null;

    /**
     * @property \MetadataV4\edmx\TIncludeType[] $include
     */
    private $include = array(
        
    );

    /**
     * @property \MetadataV4\edmx\TIncludeAnnotationsType[] $includeAnnotations
     */
    private $includeAnnotations = array(
        
    );

    /**
     * @property \MetadataV4\edm\Annotation[] $annotation
     */
    private $annotation = array(
        
    );

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
     * @param string $uri
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
     * @param \MetadataV4\edmx\TIncludeType $include
     */
    public function addToInclude(\MetadataV4\edmx\TIncludeType $include)
    {
        $this->include[] = $include;
        return $this;
    }

    /**
     * isset include
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetInclude($index)
    {
        return isset($this->include[$index]);
    }

    /**
     * unset include
     *
     * @param scalar $index
     * @return void
     */
    public function unsetInclude($index)
    {
        unset($this->include[$index]);
    }

    /**
     * Gets as include
     *
     * @return \MetadataV4\edmx\TIncludeType[]
     */
    public function getInclude()
    {
        return $this->include;
    }

    /**
     * Sets a new include
     *
     * @param \MetadataV4\edmx\TIncludeType[] $include
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
     * @param \MetadataV4\edmx\TIncludeAnnotationsType $includeAnnotations
     */
    public function addToIncludeAnnotations(\MetadataV4\edmx\TIncludeAnnotationsType $includeAnnotations)
    {
        $this->includeAnnotations[] = $includeAnnotations;
        return $this;
    }

    /**
     * isset includeAnnotations
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetIncludeAnnotations($index)
    {
        return isset($this->includeAnnotations[$index]);
    }

    /**
     * unset includeAnnotations
     *
     * @param scalar $index
     * @return void
     */
    public function unsetIncludeAnnotations($index)
    {
        unset($this->includeAnnotations[$index]);
    }

    /**
     * Gets as includeAnnotations
     *
     * @return \MetadataV4\edmx\TIncludeAnnotationsType[]
     */
    public function getIncludeAnnotations()
    {
        return $this->includeAnnotations;
    }

    /**
     * Sets a new includeAnnotations
     *
     * @param \MetadataV4\edmx\TIncludeAnnotationsType[] $includeAnnotations
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
}
