<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;


use DateTime;

trait HasDateTimeExpression
{
    /**
     * @var DateTime[] $dateTime
     */
    private $dateTime = [

    ];


    /**
     * Adds as dateTime
     *
     * @return self
     * @param DateTime $dateTime
     */
    public function addToDateTime(DateTime $dateTime)
    {
        $this->dateTime[] = $dateTime;
        return $this;
    }

    /**
     * isset dateTime
     *
     * @param int|string $index
     * @return bool
     */
    public function issetDateTime($index)
    {
        return isset($this->dateTime[$index]);
    }

    /**
     * unset dateTime
     *
     * @param int|string $index
     * @return void
     */
    public function unsetDateTime($index)
    {
        unset($this->dateTime[$index]);
    }

    /**
     * Gets as dateTime
     *
     * @return DateTime[]
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Sets a new dateTime
     *
     * @param DateTime[] $dateTime
     * @return self
     */
    public function setDateTime(array $dateTime)
    {
        $this->dateTime = $dateTime;
        return $this;
    }

}