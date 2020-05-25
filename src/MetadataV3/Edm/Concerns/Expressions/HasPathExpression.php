<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;

trait HasPathExpression
{
    /**
     * @var string[] $path
     */
    private $path = [

    ];

    /**
     * Adds as path.
     *
     * @param  string $path
     * @return self
     */
    public function addToPath($path)
    {
        $this->path[] = $path;
        return $this;
    }

    /**
     * isset path.
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetPath($index)
    {
        return isset($this->path[$index]);
    }

    /**
     * unset path.
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetPath($index)
    {
        unset($this->path[$index]);
    }

    /**
     * Gets as path.
     *
     * @return string[]
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Sets a new path.
     *
     * @param  string[] $path
     * @return self
     */
    public function setPath(array $path)
    {
        $this->path = $path;
        return $this;
    }
}
