<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Internal;

/**
 * Provides a caching mechanism for semantic properties.
 *
 * Using a Cache requires a function to compute the cached value at first access and a function
 * to create a result when the computation of the value involves a cyclic dependency. (The second
 * function can be omitted if a cycle is impossible.)
 *
 * @package AlgoWeb\ODataMetadata\Edm\Internal
 */
class Cache
{
    private $value = null;
    private $containerType;
    private $propertyType;

    /**
     * Cache constructor.
     * @param string $tContainer Type of the element that contains the cached property
     * @param string $tProperty  Type of the cached property
     */
    public function __construct(string $tContainer, string $tProperty)
    {
        $this->containerType = $tContainer;
        $this->propertyType  = $tProperty;
    }

    /**
     * In order to detect the boundaries of a cycle, we use two sentinel values. When we encounter the first
     * sentinel, we know that a cycle exists and that we are a point on that cycle.
     * When we reach an instance of the second sentinel, we know we have made a complete circuit of the cycle and that
     * every node in the cycle has been marked with the second sentinel.
     * @param  mixed    $container
     * @param  callable $compute
     * @return mixed;
     */
    public function getValue($container, callable $compute)
    {
        if ($this->value === CacheHelper::getUnknown()) {
            $this->value = $compute($container);
        }
        return $this->value;
    }

    public function clear(): void
    {
        if ($this->value !== CacheHelper::getCycleSentinel() && $this->value !== CacheHelper::getSecondPassCycleSentinel()) {
            $this->value = CacheHelper::getUnknown();
        }
    }
}
