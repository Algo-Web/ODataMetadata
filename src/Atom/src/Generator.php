<?php

namespace AlgoWeb\ODataMetadata\Atom;

/**
 * Class representing Generator
 */
class Generator
{

    /**
     * @property string $base
     */
    private $base = null;

    /**
     * @property string $lang
     */
    private $lang = null;

    /**
     * @property mixed $uri
     */
    private $uri = null;

    /**
     * @property mixed $version
     */
    private $version = null;

    /**
     * Gets as base
     *
     * @return string
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * Sets a new base
     *
     * @param string $base
     * @return self
     */
    public function setBase($base)
    {
        $this->base = $base;
        return $this;
    }

    /**
     * Gets as lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Sets a new lang
     *
     * @param string $lang
     * @return self
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
        return $this;
    }

    /**
     * Gets as uri
     *
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Sets a new uri
     *
     * @param mixed $uri
     * @return self
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * Gets as version
     *
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Sets a new version
     *
     * @param mixed $version
     * @return self
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }


}

