<?php

namespace AlgoWeb\ODataMetadata\App;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;

/**
 * Class representing AppServiceType
 *
 *
 * XSD Type: appServiceType
 */
class AppServiceType extends IsOK
{
    use IsOKToolboxTrait;

    /**
     * @property \AlgoWeb\ODataMetadata\Atom\Author $author
     */
    private $author = null;

    /**
     * @property \AlgoWeb\ODataMetadata\App\Workspace[] $workspace
     */
    private $workspace = array();

    /**
     * Gets as author
     *
     * @return \AlgoWeb\ODataMetadata\Atom\Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Sets a new author
     *
     * @param \AlgoWeb\ODataMetadata\Atom\Author $author
     * @return self
     */
    public function setAuthor(\AlgoWeb\ODataMetadata\Atom\Author $author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Adds as workspace
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\App\Workspace $workspace
     */
    public function addToWorkspace(\AlgoWeb\ODataMetadata\App\Workspace $workspace)
    {
        $this->workspace[] = $workspace;
        return $this;
    }

    /**
     * isset workspace
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetWorkspace($index)
    {
        return isset($this->workspace[$index]);
    }

    /**
     * unset workspace
     *
     * @param scalar $index
     * @return void
     */
    public function unsetWorkspace($index)
    {
        unset($this->workspace[$index]);
    }

    /**
     * Gets as workspace
     *
     * @return \AlgoWeb\ODataMetadata\App\Workspace[]
     */
    public function getWorkspace()
    {
        return $this->workspace;
    }

    /**
     * Sets a new workspace
     *
     * @param \AlgoWeb\ODataMetadata\App\Workspace[] $workspace
     * @return self
     */
    public function setWorkspace(array $workspace)
    {
        $this->workspace = $workspace;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isObjectNullOrType('\AlgoWeb\ODataMetadata\Atom\Author', $this->author, $msg)) {
            return false;
        }
        if ($this->isObjectNullOrOK($this->author, $msg)) {
            return false;
        }
        if ($this->isValidArrayOK($this->workspace, '\AlgoWeb\ODataMetadata\App\Workspace', $msg, 1)) {
            return false;
        }
        return true;
    }
}
