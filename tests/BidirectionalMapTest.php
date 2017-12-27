<?php

namespace AlgoWeb\ODataMetadata\Tests;

use AlgoWeb\ODataMetadata\BidirectionalMap;

class BidirectionalMapTest extends TestCase
{
    public function testRemoveKeyAndValueFromEmpty()
    {
        $foo = new BidirectionalMap();
        $this->assertNull($foo->removeKey('key'));
        $this->assertNull($foo->removeValue('value'));
    }

    public function testPut()
    {
        $foo = new BidirectionalMap();

        $foo->put('foo', 'bar');
        $this->assertEquals(1, count($foo->getAllKeys()));
        $this->assertEquals(1, count($foo->getAllValues()));
    }

    public function testPutAllThenReset()
    {
        $foo = new BidirectionalMap();

        $foo->putAll(['foo' => 'bar']);
        $this->assertEquals(1, count($foo->getAllKeys()));
        $this->assertEquals(1, count($foo->getAllValues()));
        $foo->reset();
        $this->assertEquals(0, count($foo->getAllKeys()));
        $this->assertEquals(0, count($foo->getAllValues()));
    }

    public function testGetKeyAndValueSeparately()
    {
        $foo = new BidirectionalMap();

        $foo->putAll(['foo' => 'bar']);
        $this->assertEquals('bar', $foo->getValue('foo'));
        $this->assertEquals('foo', $foo->getKey('bar'));
        $foo->reset();
        $this->assertEquals(null, $foo->getValue('foo'));
        $this->assertEquals(null, $foo->getKey('bar'));
    }

    public function testPutWithOverlappingKeys()
    {
        $foo = new BidirectionalMap();

        $foo->put('foo', 'bar');
        $this->assertEquals('bar', $foo->getValue('foo'));
        $this->assertEquals('foo', $foo->getKey('bar'));

        $foo->put('foo', 'rebar');
        $this->assertEquals(null, $foo->getKey('bar'));
        $this->assertEquals('rebar', $foo->getValue('foo'));
        $this->assertEquals('foo', $foo->getKey('rebar'));
    }

    public function testPutWithOverlappingValues()
    {
        $foo = new BidirectionalMap();

        $foo->put('foo', 'bar');
        $this->assertEquals('bar', $foo->getValue('foo'));
        $this->assertEquals('foo', $foo->getKey('bar'));

        $foo->put('nufoo', 'bar');
        $this->assertEquals('nufoo', $foo->getKey('bar'));
        $this->assertEquals(null, $foo->getValue('foo'));
        $this->assertEquals('bar', $foo->getValue('nufoo'));
    }
}
