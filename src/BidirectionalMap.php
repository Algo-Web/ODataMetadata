<?php

namespace AlgoWeb\ODataMetadata;

class BidirectionalMap
{
    private $keyToValue = [];
    private $valueToKey = [];

    public function reset()
    {
        $this->keyToValue = [];
        $this->valueToKey = [];
    }

    public function hasKey($key)
    {
        return isset($this->keyToValue[$key]);
    }

    public function hasValue($value)
    {
        return isset($this->valueToKey[$value]);
    }

    public function getKey($value)
    {
        if ($this->hasValue($value)) {
            return $this->valueToKey[$value];
        }
        return null;
    }

    public function getValue($key)
    {
        if ($this->hasKey($key)) {
            return $this->keyToValue[$key];
        }
        return null;
    }

    public function getAllKeys()
    {
        if (0 !== count($this->keyToValue)) {
            return array_keys($this->keyToValue);
        }
        return $this->keyToValue;
    }

    public function getAllValues()
    {
        if (0 !== count($this->valueToKey)) {
            return array_keys($this->valueToKey);
        }
        return $this->valueToKey;
    }

    public function putAll($array)
    {
        foreach ($array as $key => $value) {
            $this->put($key, $value);
        }
    }

    public function put($key, $value)
    {
        if ($this->hasKey($key)) {
            $this->removeKey($key);
        }
        if ($this->hasValue($value)) {
            $this->removeValue($value);
        }
        $this->keyToValue[$key] = $value;
        $this->valueToKey[$value] = $key;
    }

    public function removeKey($key)
    {
        if (!$this->hasKey($key)) {
            return null;
        }
        unset($this->valueToKey[$this->keyToValue[$key]]);
        $v = $this->keyToValue[$key];
        unset($this->keyToValue[$key]);
        return $v;
    }

    public function removeValue($value)
    {
        if (!$this->hasValue($value)) {
            return null;
        }
        unset($this->keyToValue[$this->valueToKey[$value]]);
        $k = $this->valueToKey[$value];
        unset($this->valueToKey[$k]);
        return $k;
    }
}
