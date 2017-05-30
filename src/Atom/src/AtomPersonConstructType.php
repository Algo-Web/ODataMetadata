<?php

namespace AlgoWeb\ODataMetadata\Atom;

/**
 * Class representing AtomPersonConstructType
 *
 *
 * XSD Type: atomPersonConstruct
 */
class AtomPersonConstructType
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
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $uri
     */
    private $uri = null;

    /**
     * @property string $email
     */
    private $email = null;

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
     * Gets as email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets a new email
     *
     * @param string $email
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }


}

