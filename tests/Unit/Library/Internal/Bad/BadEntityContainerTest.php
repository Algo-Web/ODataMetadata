<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 10/07/20
 * Time: 6:37 PM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadEntityContainer;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class BadEntityContainerTest extends TestCase
{
    public function testCreateWithNullName()
    {
        $foo = new BadEntityContainer(null, []);
        $this->assertEquals('', $foo->getName());
        $this->assertEquals('', $foo->getNameSpace());
    }

    public function testCreateWithNonNullName()
    {
        $foo = new BadEntityContainer('name', []);
        $this->assertEquals('name', $foo->getName());
        $this->assertEquals('', $foo->getNameSpace());
    }

    public function testGetElements()
    {
        $foo = new BadEntityContainer('name', []);

        $expected = [];
        $actual   = $foo->getElements();
        $this->assertEquals($expected, $actual);
    }

    public function testFindEntitySet()
    {
        $foo = new BadEntityContainer('name', []);

        $expected = null;
        $actual   = $foo->findEntitySet('');
        $this->assertEquals($expected, $actual);
    }

    public function testFindFunctionImports()
    {
        $foo = new BadEntityContainer('name', []);

        $expected = [];
        $actual   = $foo->findFunctionImports('');
        $this->assertEquals($expected, $actual);
    }

    public function testIsDefault()
    {
        $foo = new BadEntityContainer('name', []);

        $expected = null;
        $actual   = $foo->isDefault();
        $this->assertEquals($expected, $actual);
    }

    public function testIsLazyLoadEnabled()
    {
        $foo = new BadEntityContainer('name', []);

        $expected = null;
        $actual   = $foo->isLazyLoadEnabled();
        $this->assertEquals($expected, $actual);
    }

    public function testGetSchemaElementKind()
    {
        $foo = new BadEntityContainer('name', []);

        $expected = SchemaElementKind::EntityContainer();
        $actual   = $foo->getSchemaElementKind();
        $this->assertEquals($expected, $actual);
    }
}
