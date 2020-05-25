<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\MetadataV3;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Entity;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Schema;
use AlgoWeb\ODataMetadata\MetadataV3\Edmx\Edmx;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class CompleteTest extends TestCase
{
    public function testFromSample()
    {
        $edmx   = new Edmx();
        $schema = new Schema('NorthwindModel');
        $edmx->addToDataServices($schema);
        //$categoryEntity = new Entity();
        $this->assertTrue(true);
    }
}
