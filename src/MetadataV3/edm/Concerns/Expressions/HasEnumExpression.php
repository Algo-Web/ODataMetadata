<?php


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;


trait HasEnumExpression
{
    /**
     * @var string[] $enum
     */
    private $enum = [

    ];

    /**
     * Adds as enum
     *
     * @return self
     * @param string $enum
     */
    public function addToEnum($enum)
    {
        $this->enum[] = $enum;
        return $this;
    }

    /**
     * isset enum
     *
     * @param int|string $index
     * @return bool
     */
    public function issetEnum($index)
    {
        return isset($this->enum[$index]);
    }

    /**
     * unset enum
     *
     * @param int|string $index
     * @return void
     */
    public function unsetEnum($index)
    {
        unset($this->enum[$index]);
    }

    /**
     * Gets as enum
     *
     * @return string[]
     */
    public function getEnum()
    {
        return $this->enum;
    }

    /**
     * Sets a new enum
     *
     * @param string[] $enum
     * @return self
     */
    public function setEnum(array $enum)
    {
        $this->enum = $enum;
        return $this;
    }
}