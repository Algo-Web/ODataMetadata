<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Structure;

class Tuple
{
    private $item1;
    private $item2;

    /**
     * Tuple constructor.
     * @param mixed $item1
     * @param mixed $item2
     */
    public function __construct($item1, $item2)
    {
        $this->item1 = $item1;
        $this->item2 = $item2;
    }

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
}
