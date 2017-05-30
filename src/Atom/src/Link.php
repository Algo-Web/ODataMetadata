<?php

namespace AlgoWeb\ODataMetadata\Atom;

/**
 * Class representing Link
 */
class Link extends UndefinedContentType
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
     * @property mixed $href
     */
    private $href = null;

    /**
     * @property mixed $rel
     */
    private $rel = null;

    /**
     * @property string $type
     */
    private $type = null;

    /**
     * @property string $hreflang
     */
    private $hreflang = null;

    /**
     * @property mixed $title
     */
    private $title = null;

    /**
     * @property mixed $length
     */
    private $length = null;

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
     * Gets as href
     *
     * @return mixed
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * Sets a new href
     *
     * @param mixed $href
     * @return self
     */
    public function setHref($href)
    {
        $this->href = $href;
        return $this;
    }

    /**
     * Gets as rel
     *
     * @return mixed
     */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     * Sets a new rel
     *
     * @param mixed $rel
     * @return self
     */
    public function setRel($rel)
    {
        $this->rel = $rel;
        return $this;
    }

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
     * Gets as hreflang
     *
     * @return string
     */
    public function getHreflang()
    {
        return $this->hreflang;
    }

    /**
     * Sets a new hreflang
     *
     * @param string $hreflang
     * @return self
     */
    public function setHreflang($hreflang)
    {
        $this->hreflang = $hreflang;
        return $this;
    }

    /**
     * Gets as title
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets a new title
     *
     * @param mixed $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Gets as length
     *
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Sets a new length
     *
     * @param mixed $length
     * @return self
     */
    public function setLength($length)
    {
        $this->length = $length;
        return $this;
    }
}
