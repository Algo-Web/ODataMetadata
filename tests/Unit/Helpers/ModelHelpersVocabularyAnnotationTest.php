<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26/07/20
 * Time: 3:27 AM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;
use AlgoWeb\ODataMetadata\Library\Core\EdmCoreModel;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class ModelHelpersVocabularyAnnotationTest extends TestCase
{
    public function testFindVocabularyAnnotationsWithNullTerm()
    {
        $this->markTestSkipped();
        $foo = new EdmCoreModel();
        $this->assertTrue($foo instanceof IModel);

        $element = m::mock(IVocabularyAnnotatable::class);

        $term = null;
        $qual = null;
        $type = null;
        $this->assertNull($term);
        $this->assertFalse(is_string($term));
        $this->assertFalse($term instanceof ITerm);

        $res = $foo->findVocabularyAnnotations($element, $term, $qual, $type);
        $this->assertFalse($res instanceof \Generator);
    }
}
