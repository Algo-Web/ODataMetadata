<?php

namespace AlgoWeb\ODataMetadata\StringTraits;

trait XMLStringTrait
{
    /**
     * @param string $string
     * @return mixed
     */
    public function preserveString($string)
    {
        return $string;
    }

    /**
     * @param string $string
     * @return mixed
     */
    public function replaceString($string)
    {
        $string = preg_replace('/\s/', ' ', $string);
        return $string;
    }

    /**
     * @param string $string
     * @return mixed
     */
    public function collapseString($string)
    {
        $string = $this->replaceString(trim($string));
        $string = preg_replace('/[ ]+/', ' ', $string);
        return $string;
    }
}
