<?php

namespace AlgoWeb\ODataMetadata\Atom;

/**
 * Class representing EntryType
 *
 *
 * XSD Type: entryType
 */
class EntryType
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
     * @property \AlgoWeb\ODataMetadata\Atom\Author[] $author
     */
    private $author = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\Atom\Category[] $category
     */
    private $category = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\Atom\Content[] $content
     */
    private $content = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\Atom\Contributor[] $contributor
     */
    private $contributor = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\Atom\Id[] $id
     */
    private $id = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\Atom\Link[] $link
     */
    private $link = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\Atom\Published[] $published
     */
    private $published = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\Atom\Rights[] $rights
     */
    private $rights = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\Atom\Source[] $source
     */
    private $source = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\Atom\Summary[] $summary
     */
    private $summary = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\Atom\Title[] $title
     */
    private $title = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\Atom\Updated[] $updated
     */
    private $updated = array(
        
    );

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
     * Adds as author
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\Atom\Author $author
     */
    public function addToAuthor(\AlgoWeb\ODataMetadata\Atom\Author $author)
    {
        $this->author[] = $author;
        return $this;
    }

    /**
     * isset author
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetAuthor($index)
    {
        return isset($this->author[$index]);
    }

    /**
     * unset author
     *
     * @param scalar $index
     * @return void
     */
    public function unsetAuthor($index)
    {
        unset($this->author[$index]);
    }

    /**
     * Gets as author
     *
     * @return \AlgoWeb\ODataMetadata\Atom\Author[]
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Sets a new author
     *
     * @param \AlgoWeb\ODataMetadata\Atom\Author[] $author
     * @return self
     */
    public function setAuthor(array $author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Adds as category
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\Atom\Category $category
     */
    public function addToCategory(\AlgoWeb\ODataMetadata\Atom\Category $category)
    {
        $this->category[] = $category;
        return $this;
    }

    /**
     * isset category
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetCategory($index)
    {
        return isset($this->category[$index]);
    }

    /**
     * unset category
     *
     * @param scalar $index
     * @return void
     */
    public function unsetCategory($index)
    {
        unset($this->category[$index]);
    }

    /**
     * Gets as category
     *
     * @return \AlgoWeb\ODataMetadata\Atom\Category[]
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Sets a new category
     *
     * @param \AlgoWeb\ODataMetadata\Atom\Category[] $category
     * @return self
     */
    public function setCategory(array $category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Adds as content
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\Atom\Content $content
     */
    public function addToContent(\AlgoWeb\ODataMetadata\Atom\Content $content)
    {
        $this->content[] = $content;
        return $this;
    }

    /**
     * isset content
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetContent($index)
    {
        return isset($this->content[$index]);
    }

    /**
     * unset content
     *
     * @param scalar $index
     * @return void
     */
    public function unsetContent($index)
    {
        unset($this->content[$index]);
    }

    /**
     * Gets as content
     *
     * @return \AlgoWeb\ODataMetadata\Atom\Content[]
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets a new content
     *
     * @param \AlgoWeb\ODataMetadata\Atom\Content[] $content
     * @return self
     */
    public function setContent(array $content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Adds as contributor
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\Atom\Contributor $contributor
     */
    public function addToContributor(\AlgoWeb\ODataMetadata\Atom\Contributor $contributor)
    {
        $this->contributor[] = $contributor;
        return $this;
    }

    /**
     * isset contributor
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetContributor($index)
    {
        return isset($this->contributor[$index]);
    }

    /**
     * unset contributor
     *
     * @param scalar $index
     * @return void
     */
    public function unsetContributor($index)
    {
        unset($this->contributor[$index]);
    }

    /**
     * Gets as contributor
     *
     * @return \AlgoWeb\ODataMetadata\Atom\Contributor[]
     */
    public function getContributor()
    {
        return $this->contributor;
    }

    /**
     * Sets a new contributor
     *
     * @param \AlgoWeb\ODataMetadata\Atom\Contributor[] $contributor
     * @return self
     */
    public function setContributor(array $contributor)
    {
        $this->contributor = $contributor;
        return $this;
    }

    /**
     * Adds as id
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\Atom\Id $id
     */
    public function addToId(\AlgoWeb\ODataMetadata\Atom\Id $id)
    {
        $this->id[] = $id;
        return $this;
    }

    /**
     * isset id
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetId($index)
    {
        return isset($this->id[$index]);
    }

    /**
     * unset id
     *
     * @param scalar $index
     * @return void
     */
    public function unsetId($index)
    {
        unset($this->id[$index]);
    }

    /**
     * Gets as id
     *
     * @return \AlgoWeb\ODataMetadata\Atom\Id[]
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets a new id
     *
     * @param \AlgoWeb\ODataMetadata\Atom\Id[] $id
     * @return self
     */
    public function setId(array $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Adds as link
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\Atom\Link $link
     */
    public function addToLink(\AlgoWeb\ODataMetadata\Atom\Link $link)
    {
        $this->link[] = $link;
        return $this;
    }

    /**
     * isset link
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetLink($index)
    {
        return isset($this->link[$index]);
    }

    /**
     * unset link
     *
     * @param scalar $index
     * @return void
     */
    public function unsetLink($index)
    {
        unset($this->link[$index]);
    }

    /**
     * Gets as link
     *
     * @return \AlgoWeb\ODataMetadata\Atom\Link[]
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Sets a new link
     *
     * @param \AlgoWeb\ODataMetadata\Atom\Link[] $link
     * @return self
     */
    public function setLink(array $link)
    {
        $this->link = $link;
        return $this;
    }

    /**
     * Adds as published
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\Atom\Published $published
     */
    public function addToPublished(\AlgoWeb\ODataMetadata\Atom\Published $published)
    {
        $this->published[] = $published;
        return $this;
    }

    /**
     * isset published
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetPublished($index)
    {
        return isset($this->published[$index]);
    }

    /**
     * unset published
     *
     * @param scalar $index
     * @return void
     */
    public function unsetPublished($index)
    {
        unset($this->published[$index]);
    }

    /**
     * Gets as published
     *
     * @return \AlgoWeb\ODataMetadata\Atom\Published[]
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Sets a new published
     *
     * @param \AlgoWeb\ODataMetadata\Atom\Published[] $published
     * @return self
     */
    public function setPublished(array $published)
    {
        $this->published = $published;
        return $this;
    }

    /**
     * Adds as rights
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\Atom\Rights $rights
     */
    public function addToRights(\AlgoWeb\ODataMetadata\Atom\Rights $rights)
    {
        $this->rights[] = $rights;
        return $this;
    }

    /**
     * isset rights
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetRights($index)
    {
        return isset($this->rights[$index]);
    }

    /**
     * unset rights
     *
     * @param scalar $index
     * @return void
     */
    public function unsetRights($index)
    {
        unset($this->rights[$index]);
    }

    /**
     * Gets as rights
     *
     * @return \AlgoWeb\ODataMetadata\Atom\Rights[]
     */
    public function getRights()
    {
        return $this->rights;
    }

    /**
     * Sets a new rights
     *
     * @param \AlgoWeb\ODataMetadata\Atom\Rights[] $rights
     * @return self
     */
    public function setRights(array $rights)
    {
        $this->rights = $rights;
        return $this;
    }

    /**
     * Adds as source
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\Atom\Source $source
     */
    public function addToSource(\AlgoWeb\ODataMetadata\Atom\Source $source)
    {
        $this->source[] = $source;
        return $this;
    }

    /**
     * isset source
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetSource($index)
    {
        return isset($this->source[$index]);
    }

    /**
     * unset source
     *
     * @param scalar $index
     * @return void
     */
    public function unsetSource($index)
    {
        unset($this->source[$index]);
    }

    /**
     * Gets as source
     *
     * @return \AlgoWeb\ODataMetadata\Atom\Source[]
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Sets a new source
     *
     * @param \AlgoWeb\ODataMetadata\Atom\Source[] $source
     * @return self
     */
    public function setSource(array $source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * Adds as summary
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\Atom\Summary $summary
     */
    public function addToSummary(\AlgoWeb\ODataMetadata\Atom\Summary $summary)
    {
        $this->summary[] = $summary;
        return $this;
    }

    /**
     * isset summary
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetSummary($index)
    {
        return isset($this->summary[$index]);
    }

    /**
     * unset summary
     *
     * @param scalar $index
     * @return void
     */
    public function unsetSummary($index)
    {
        unset($this->summary[$index]);
    }

    /**
     * Gets as summary
     *
     * @return \AlgoWeb\ODataMetadata\Atom\Summary[]
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Sets a new summary
     *
     * @param \AlgoWeb\ODataMetadata\Atom\Summary[] $summary
     * @return self
     */
    public function setSummary(array $summary)
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * Adds as title
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\Atom\Title $title
     */
    public function addToTitle(\AlgoWeb\ODataMetadata\Atom\Title $title)
    {
        $this->title[] = $title;
        return $this;
    }

    /**
     * isset title
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetTitle($index)
    {
        return isset($this->title[$index]);
    }

    /**
     * unset title
     *
     * @param scalar $index
     * @return void
     */
    public function unsetTitle($index)
    {
        unset($this->title[$index]);
    }

    /**
     * Gets as title
     *
     * @return \AlgoWeb\ODataMetadata\Atom\Title[]
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets a new title
     *
     * @param \AlgoWeb\ODataMetadata\Atom\Title[] $title
     * @return self
     */
    public function setTitle(array $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Adds as updated
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\Atom\Updated $updated
     */
    public function addToUpdated(\AlgoWeb\ODataMetadata\Atom\Updated $updated)
    {
        $this->updated[] = $updated;
        return $this;
    }

    /**
     * isset updated
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetUpdated($index)
    {
        return isset($this->updated[$index]);
    }

    /**
     * unset updated
     *
     * @param scalar $index
     * @return void
     */
    public function unsetUpdated($index)
    {
        unset($this->updated[$index]);
    }

    /**
     * Gets as updated
     *
     * @return \AlgoWeb\ODataMetadata\Atom\Updated[]
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Sets a new updated
     *
     * @param \AlgoWeb\ODataMetadata\Atom\Updated[] $updated
     * @return self
     */
    public function setUpdated(array $updated)
    {
        $this->updated = $updated;
        return $this;
    }
}
