<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Enums;

use BadMethodCallException;

abstract class Enum extends \MyCLabs\Enum\Enum
{
    protected function isFlag($flag): bool
    {
        return $this->value === $flag;
    }

    /**
     * @param  string               $name
     * @param  mixed                $arguments
     * @throws \ReflectionException
     * @return bool
     */
    public function __call(string $name, $arguments)
    {
        $array     = static::toArray();
        $regexBase = '/(is)(%s)/m';
        $regexFull = sprintf($regexBase, implode('$|', array_keys($array)));
        preg_match($regexFull, $name, $match);
        if (count($match)>0 && $match[0] === $name) {
            return $this->{$match[1] . 'Flag'}($array[$match[2]], $arguments[0] ?? null);
        }
        throw new BadMethodCallException(sprintf('Enum %s not found on %s', $name, get_class($this)));
    }

    /**
     * @param  self ...$candidates
     * @return bool
     */
    public function isAnyOf(self ...$candidates): bool
    {
        foreach ($candidates as $candidate) {
            if ($this->isFlag($candidate->getValue())) {
                return true;
            }
        }
        return false;
    }

    /**
     * Returns the enum key (i.e. the constant name).
     *
     * @return string
     */
    public function getKey()
    {
        return strval(parent::getKey());
    }
}
