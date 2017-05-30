<?php

namespace AlgoWeb\ODataMetadata\Atom;

/**
 * Class representing Category
 */
class Category extends UndefinedContentType
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
     * @property mixed $term
     */
    private $term = null;

    /**
     * @property mixed $scheme
     */
    private $scheme = null;

    /**
     * @property mixed $label
     */
    private $label = null;

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
     * Gets as term
     *
     * @return mixed
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * Sets a new term
     *
     * @param mixed $term
     * @return self
     */
    public function setTerm($term)
    {
        $this->term = $term;
        return $this;
    }

    /**
     * Gets as scheme
     *
     * @return mixed
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * Sets a new scheme
     *
     * @param mixed $scheme
     * @return self
     */
    public function setScheme($scheme)
    {
        $this->scheme = $scheme;
        return $this;
    }

    /**
     * Gets as label
     *
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Sets a new label
     *
     * @param mixed $label
     * @return self
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }


}

