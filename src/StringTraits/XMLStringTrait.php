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
        if (!is_string($string)) {
            throw new \InvalidArgumentException("Input must be a string");
        }
        return $string;
    }

    /**
     * @param string $string
     * @return mixed
     */
    public function replaceString($string)
    {
        if (!is_string($string)) {
            throw new \InvalidArgumentException("Input must be a string");
        }
        $string = preg_replace('/\s/', ' ', $string);
        return $string;
    }

    /**
     * @param string $string
     * @return mixed
     */
    public function collapseString($string)
    {
        if (!is_string($string)) {
            throw new \InvalidArgumentException("Input must be a string");
        }
        $string = $this->replaceString(trim($string));
        $string = preg_replace('/[ ]+/', ' ', $string);
        return $string;
    }
}
