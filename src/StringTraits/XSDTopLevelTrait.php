<?php

namespace AlgoWeb\ODataMetadata\StringTraits;

trait XSDTopLevelTrait
{
    use XMLStringTrait;

    public function normaliseString($input)
    {
        if (!is_string($input) || !is_numeric($input)) {
            throw new \InvalidArgumentException("Input must be a string");
        }
        $result = $this->replaceString($input);
        return $result;
    }

    public function token($input)
    {
        if (!is_string($input) || !is_numeric($input)) {
            throw new \InvalidArgumentException("Input must be a string");
        }
        $result = $this->collapseString($input);
        return $result;
    }

    public function string($input)
    {
        if (!is_string($input) || !is_numeric($input)) {
            throw new \InvalidArgumentException("Input must be a string");
        }
        $result = $this->preserveString($input);
        return $result;
    }

    public function integer($input)
    {
        $input = $this->collapseString($input);
        if (!is_numeric($input)) {
            throw new \InvalidArgumentException("Input must be numeric");
        }
        $integral = intval($input);
        if ($input != $integral) {
            throw new \InvalidArgumentException("Input must be integer");
        }
        return $integral;
    }

    public function nonNegativeInteger($input)
    {
        $input = $this->integer($input);
        if (0 > $input) {
            throw new \InvalidArgumentException("Input must be non-negative integer");
        }
        return $input;
    }

    public function decimal($input)
    {
        $input = $this->collapseString($input);
        if (!is_numeric($input)) {
            throw new \InvalidArgumentException("Input must be numeric");
        }
        return floatval($input);
    }

    public function double($input)
    {
        return $this->decimal($input);
    }

    public function dateTime($input)
    {
        $isString = is_string($input);
        if (!$isString && !$input instanceof \DateTime) {
            throw new \InvalidArgumentException("Input must be resolvable to a date/time");
        }
        if ($isString) {
            $input = $this->collapseString($input);
            $rawDate = new \DateTime($input);
        } else {
            $rawDate = $input;
        }

        return $rawDate->format('Y-m-d') . 'T' . $rawDate->format('H:i:s');
    }

    public function hexBinary($input)
    {
        if (!is_string($input) || !is_numeric($input)) {
            throw new \InvalidArgumentException("Input must be a string");
        }

        $input = $this->collapseString(strtolower($input));
        $check = hexdec(dechex($input));
        if ($input != $check) {
            throw new \InvalidArgumentException("Input must be valid hexadecimal");
        }
        return $check;
    }
}
