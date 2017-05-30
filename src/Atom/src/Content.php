<?php

namespace AlgoWeb\ODataMetadata\Atom;

/**
 * Class representing Content
 */
class Content
{

    /**
     * @property string $type
     */
    private $type = null;

    /**
     * @property string $base
     */
    private $base = null;

    /**
     * @property string $lang
     */
    private $lang = null;

    /**
     * @property mixed $src
     */
    private $src = null;

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
     * Gets as src
     *
     * @return mixed
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * Sets a new src
     *
     * @param mixed $src
     * @return self
     */
    public function setSrc($src)
    {
        $this->src = $src;
        return $this;
    }
}
