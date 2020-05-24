<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;


use DateTime;

trait HasDateTimeOffsetExpression
{
    /**
     * @var DateTime[] $dateTimeOffset
     */
    private $dateTimeOffset = [

    ];
    /**
     * Adds as dateTimeOffset
     *
     * @return self
     * @param DateTime $dateTimeOffset
     */
    public function addToDateTimeOffset(DateTime $dateTimeOffset)
    {
        $this->dateTimeOffset[] = $dateTimeOffset;
        return $this;
    }

    /**
     * isset dateTimeOffset
     *
     * @param int|string $index
     * @return bool
     */
    public function issetDateTimeOffset($index)
    {
        return isset($this->dateTimeOffset[$index]);
    }

    /**
     * unset dateTimeOffset
     *
     * @param int|string $index
     * @return void
     */
    public function unsetDateTimeOffset($index)
    {
        unset($this->dateTimeOffset[$index]);
    }

    /**
     * Gets as dateTimeOffset
     *
     * @return DateTime[]
     */
    public function getDateTimeOffset()
    {
        return $this->dateTimeOffset;
    }

    /**
     * Sets a new dateTimeOffset
     *
     * @param DateTime[] $dateTimeOffset
     * @return self
     */
    public function setDateTimeOffset(array $dateTimeOffset)
    {
        $this->dateTimeOffset = $dateTimeOffset;
        return $this;
    }

}