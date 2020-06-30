<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Structure;

class Tuple
{
    private $item1;

    /**
     * @return mixed
     */
    public function getItem1()
    {
        return $this->item1;
    }

    /**
     * @return mixed
     */
    public function getItem2()
    {
        return $this->item2;
    }
    private $item2;

    public function __construct($item1, $item2)
    {
    }
}
