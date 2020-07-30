<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 30/07/20
 * Time: 10:10 PM.
 */

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\IModel;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IModel\ModelDuplicateEntityContainerName;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class ModelDuplicateEntityContainerNameTest extends TestCase
{
    public function testInvokeWithFilteredItems()
    {
        $model   = m::mock(IModel::class);
        $context = new ValidationContext($model, function (IEdmElement $one): bool {
            return false;
        });

        $loc = m::mock(ILocation::class);

        $import  = m::mock(IFunctionImport::class);
        $import->shouldReceive('location')->andReturn($loc);

        $schema = m::mock(IEntityContainer::class);
        $schema->shouldReceive('getName')->andReturn('entity');
        $schema->shouldReceive('fullName')->andReturn('entity');

        $schemaElements = [$schema, null];

        $element = m::mock(IModel::class)->makePartial();
        $element->shouldReceive('getSchemaElements')->andReturn($schemaElements);

        $foo = new ModelDuplicateEntityContainerName();

        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals(0, count($errors));
    }
}
