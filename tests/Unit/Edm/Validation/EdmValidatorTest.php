<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 30/07/20
 * Time: 9:54 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmValidator;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotationsManager;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Version;
use Mockery as m;

class EdmValidatorTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testValidate()
    {
        $annotate = m::mock(IDirectValueAnnotationsManager::class);
        $annotate->shouldReceive('getDirectValueAnnotations')->andReturn([]);

        $model = m::mock(IModel::class);
        $model->shouldReceive('getDirectValueAnnotationsManager')->andReturn($annotate);
        $model->shouldReceive('getSchemaElements')->andReturn([]);

        $errors = [];
        $version = Version::v1point1();

        $res = EdmValidator::validate($model, $version, $errors);
        $this->assertTrue($res);
        $this->assertEquals(0, count($errors));
    }
}
