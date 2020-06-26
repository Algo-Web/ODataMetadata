<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 22/06/20
 * Time: 1:36 PM
 */

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\Internal;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\ValidationHelper;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INamedElement;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Structure\HashSetInternal;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class ValidationHelperTest extends TestCase
{
    public function namespaceProvider(): array
    {
        $result = [];
        $result[] = [EdmConstants::TransientNamespace, true];
        $result[] = [EdmConstants::EdmNamespace, true];
        $result[] = ['foo', false];

        return $result;
    }

    /**
     * @dataProvider namespaceProvider
     * @param string $namespace
     * @param bool $expected
     */
    public function testIsEdmSystemNamespace(string $namespace, bool $expected)
    {
        $actual = ValidationHelper::IsEdmSystemNamespace($namespace);
        $this->assertEquals($expected, $actual);
    }

    public function addMemberNameProvider(): array
    {
        $result = [];

        $result[] = [false, false, false, false];
        $result[] = [true, false, false, false];
        $result[] = [false, true, false, true];
        $result[] = [true, true, false, true];
        $result[] = [false, false, true, false];
        $result[] = [true, false, true, false];
        $result[] = [false, true, true, true];
        $result[] = [true, true, true, true];

        return $result;
    }

    /**
     * @dataProvider addMemberNameProvider
     *
     * @param bool $isSchema
     * @param bool $inArray
     * @param bool $suppressError
     * @param bool $expected
     * @throws \ReflectionException
     */
    public function testAddMemberNameToHashSet(bool $isSchema, bool $inArray, bool $suppressError, bool $expected)
    {
        $loc = m::mock(ILocation::class)->makePartial();
        if ($isSchema) {
            $item = m::mock(INamedElement::class . ', ' . ISchemaElement::class)->makePartial();
            $item->shouldReceive('FullName')->andReturn('Name');
            $item->shouldReceive('Location')->andReturn($loc);
        } else {
            $item = m::mock(INamedElement::class)->makePartial();
            $item->shouldReceive('getName')->andReturn('Name');
            $item->shouldReceive('Location')->andReturn($loc);
        }

        if ($inArray) {
            $memList = new HashSetInternal();
            $memList->add('Name');
        } else {
            $memList = new HashSetInternal();
        }

        $model = m::mock(IModel::class);
        $context = new ValidationContext($model, function(IEdmElement $one): bool { return false; });
        $code = EdmErrorCode::InvalidElementAnnotation();

        $actual = ValidationHelper::AddMemberNameToHashSet($item, $memList, $context, $code, 'errString', $suppressError);
        $this->assertEquals($expected, $actual);

        $expectedErrors = intval(!$inArray && !$suppressError);
        $this->assertEquals($expectedErrors, count($context->getErrors()));
    }

    public function testAllPropertiesAreNullableEmptyArray()
    {
        $properties = [];

        $this->assertTrue(ValidationHelper::AllPropertiesAreNullable($properties));
    }

    public function testAllPropertiesAreNullableWithAllBitzNullable()
    {
        $prop1 = m::mock(IStructuralProperty::class)->makePartial();
        $prop1->shouldReceive('getType->getNullable')->andReturn(true);

        $prop2 = m::mock(IStructuralProperty::class)->makePartial();
        $prop2->shouldReceive('getType->getNullable')->andReturn(true);

        $properties = [$prop1, $prop2];

        $this->assertTrue(ValidationHelper::AllPropertiesAreNullable($properties));
    }

    public function testAllPropertiesAreNullableWithSomeBitzNullable()
    {
        $prop1 = m::mock(IStructuralProperty::class)->makePartial();
        $prop1->shouldReceive('getType->getNullable')->andReturn(false);

        $prop2 = m::mock(IStructuralProperty::class)->makePartial();
        $prop2->shouldReceive('getType->getNullable')->andReturn(true);

        $properties = [$prop1, $prop2];

        $this->assertFalse(ValidationHelper::AllPropertiesAreNullable($properties));
    }

    public function testAllPropertiesAreNullableWithNullGetType()
    {
        $prop1 = m::mock(IStructuralProperty::class)->makePartial();
        $prop1->shouldReceive('getType')->andReturn(null);

        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Call to a member function getNullable() on null');
        $this->assertFalse(ValidationHelper::AllPropertiesAreNullable([$prop1]));
    }

    public function testHasNullablePropertyEmptyArray()
    {
        $properties = [];

        $this->assertFalse(ValidationHelper::HasNullableProperty($properties));
    }

    public function testHasNullablePropertyWithAllBitzNullable()
    {
        $prop1 = m::mock(IStructuralProperty::class)->makePartial();
        $prop1->shouldReceive('getType->getNullable')->andReturn(true);

        $prop2 = m::mock(IStructuralProperty::class)->makePartial();
        $prop2->shouldReceive('getType->getNullable')->andReturn(true);

        $properties = [$prop1, $prop2];

        $this->assertTrue(ValidationHelper::HasNullableProperty($properties));
    }

    public function testHasNullablePropertyWithSomeBitzNullable()
    {
        $prop1 = m::mock(IStructuralProperty::class)->makePartial();
        $prop1->shouldReceive('getType->getNullable')->andReturn(false);

        $prop2 = m::mock(IStructuralProperty::class)->makePartial();
        $prop2->shouldReceive('getType->getNullable')->andReturn(true);

        $properties = [$prop1, $prop2];

        $this->assertTrue(ValidationHelper::HasNullableProperty($properties));
    }

    public function testHasNullablePropertyWithNoBitzNullable()
    {
        $prop1 = m::mock(IStructuralProperty::class)->makePartial();
        $prop1->shouldReceive('getType->getNullable')->andReturn(false);

        $prop2 = m::mock(IStructuralProperty::class)->makePartial();
        $prop2->shouldReceive('getType->getNullable')->andReturn(false);

        $properties = [$prop1, $prop2];

        $this->assertFalse(ValidationHelper::HasNullableProperty($properties));
    }

    public function testHasNullablePropertyWithNullGetType()
    {
        $prop1 = m::mock(IStructuralProperty::class)->makePartial();
        $prop1->shouldReceive('getType')->andReturn(null);

        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('Call to a member function getNullable() on null');
        $this->assertFalse(ValidationHelper::HasNullableProperty([$prop1]));
    }

    public function testPropertySetIsSubsetWithActualSubset()
    {
        $prop1 = m::mock(IStructuralProperty::class)->makePartial();
        $prop1->shouldReceive('getType->getNullable')->andReturn(false);

        $prop2 = m::mock(IStructuralProperty::class)->makePartial();
        $prop2->shouldReceive('getType->getNullable')->andReturn(false);

        $set = [$prop1, $prop2];
        $subset = [$prop2];

        $this->assertTrue(ValidationHelper::PropertySetIsSubset($set, $subset));
    }

    public function testPropertySetIsSubsetWithOverlapSet()
    {
        $prop1 = m::mock(IStructuralProperty::class)->makePartial();
        $prop1->shouldReceive('getType->getNullable')->andReturn(false);

        $prop2 = m::mock(IStructuralProperty::class)->makePartial();
        $prop2->shouldReceive('getType->getNullable')->andReturn(false);

        $prop3 = m::mock(IStructuralProperty::class)->makePartial();
        $prop3->shouldReceive('getType->getNullable')->andReturn(false);

        $set = [$prop1, $prop2];
        $subset = [$prop2, $prop3];

        $this->assertFalse(ValidationHelper::PropertySetIsSubset($set, $subset));
    }

    public function testPropertySetsAreEquivalentActualEquality()
    {
        $prop1 = m::mock(IStructuralProperty::class)->makePartial();
        $prop1->shouldReceive('getType->getNullable')->andReturn(false);

        $prop2 = m::mock(IStructuralProperty::class)->makePartial();
        $prop2->shouldReceive('getType->getNullable')->andReturn(false);

        $set1 = [$prop1, $prop2];
        $set2 = [$prop1, $prop2];

        $this->assertTrue(ValidationHelper::PropertySetsAreEquivalent($set1, $set2));
    }

    public function testPropertySetsAreEquivalentSameCountDifferentElement()
    {
        $prop1 = m::mock(IStructuralProperty::class)->makePartial();
        $prop1->shouldReceive('getType->getNullable')->andReturn(false);

        $prop2 = m::mock(IStructuralProperty::class)->makePartial();
        $prop2->shouldReceive('getType->getNullable')->andReturn(false);

        $prop3 = m::mock(IStructuralProperty::class)->makePartial();
        $prop3->shouldReceive('getType->getNullable')->andReturn(false);

        $set1 = [$prop1, $prop2];
        $set2 = [$prop1, $prop3];

        $this->assertFalse(ValidationHelper::PropertySetsAreEquivalent($set1, $set2));
    }

    public function testPropertySetsAreEquivalentDifferentCountDifferentElement()
    {
        $prop1 = m::mock(IStructuralProperty::class)->makePartial();
        $prop1->shouldReceive('getType->getNullable')->andReturn(false);

        $prop2 = m::mock(IStructuralProperty::class)->makePartial();
        $prop2->shouldReceive('getType->getNullable')->andReturn(false);

        $set1 = [$prop1, $prop2];
        $set2 = [$prop1];

        $this->assertFalse(ValidationHelper::PropertySetsAreEquivalent($set1, $set2));
    }

    public function isInterfaceCriticalProvider(): array
    {
        $low = EdmErrorCode::InterfaceCriticalPropertyValueMustNotBeNull()->getValue();
        $high = EdmErrorCode::InterfaceCriticalCycleInTypeHierarchy()->getValue();

        $result = [];
        $result[] = [$low - 1, false];
        $result[] = [$low, true];
        $result[] = [$low + 1, true];
        $result[] = [$high - 1, true];
        $result[] = [$high, true];
        $result[] = [$high + 1, false];

        return $result;
    }

    /**
     * @dataProvider isInterfaceCriticalProvider
     *
     * @param int $errorCode
     * @param bool $expected
     */
    public function testIsInterfaceCritical(int $errorCode, bool $expected)
    {
        $error = m::mock(EdmError::class);
        $error->shouldReceive("getErrorCode->getValue")->andReturn($errorCode);

        $actual = ValidationHelper::IsInterfaceCritical($error);
        $this->assertEquals($expected, $actual);
    }

    public function itemExistsInReferenceProvider(): array
    {
        $result = [];
        // declaredType, declaredValue, isEntityContainer, declaredEC, # of functions
        $result[] = [null, 'set', true, 'set', 1, true];
        $result[] = [null, 'set', false, 'set', 0, true];
        $result[] = ['set', null, true, 'set', null, true];
        $result[] = [null, null, false, 'set', 1, true];
        $result[] = [null, null, true, 'set', 0, true];
        $result[] = ['set', null, false, null, null, true];
        $result[] = [null, 'set', true, null, null, true];
        $result[] = ['set', 'set', false, 'set', 1, true];
        $result[] = ['set', null, true, null, 0, true];
        $result[] = [null, 'set', false, 'set', null, true];
        $result[] = ['set', null, true, null, 1, true];
        $result[] = [null, null, false, null, null, false];
        $result[] = ['set', 'set', true, 'set', 0, true];
        $result[] = ['set', 'set', false, null, 1, true];
        $result[] = ['set', null, false, 'set', 0, true];
        $result[] = ['set', 'set', false, 'set', null, true];
        $result[] = [null, null, false, 'null', 1, true];

        return $result;
    }

    /**
     * @dataProvider itemExistsInReferenceProvider
     *
     * @param string|null $declaredType
     * @param string|null $declaredValue
     * @param bool $isEntityContainer
     * @param string|null $declaredEC
     * @param int|null $numFunc
     * @param bool $expected
     */
    public function testItemExistsInReferenceProvider(
        ?string $declaredType,
        ?string $declaredValue,
        bool $isEntityContainer,
        ?string $declaredEC,
        ?int $numFunc,
        bool $expected
    ) {
        $decType = $declaredType ? m::mock(ISchemaType::class)->makePartial() : null;
        $decVal = $declaredValue ? m::mock(IValueTerm::class)->makePartial() : null;
        $decContainer = $declaredEC ? m::mock(IEntityContainer::class)->makePartial() : null;
        switch ($numFunc) {
            case 0:
                $decFun = [];
                break;
            case 1:
                $func = m::mock(IFunction::class)->makePartial();
                $decFun = [$func];
                break;
            default:
                $decFun = null;
                break;
        }

        $refModel = m::mock(IModel::class)->makePartial();
        $refModel->shouldReceive('findDeclaredType')->andReturn($decType);
        $refModel->shouldReceive('findDeclaredValueTerm')->andReturn($decVal);
        $refModel->shouldReceive('findDeclaredEntityContainer')->andReturn($decContainer);
        $refModel->shouldReceive('findDeclaredFunctions')->andReturn($decFun);

        $model = m::mock(IModel::class)->makePartial();
        $model->shouldReceive('getReferencedModels')->andReturn([$refModel]);

        $actual = ValidationHelper::ItemExistsInReferencedModel($model, 'Name', $isEntityContainer);
        $this->assertEquals($expected, $actual);
    }

    public function functionOrNameExistsInReferenceProvider(): array
    {
        $result = [];
        // declaredType, declaredValue, isEntityContainer, declaredEC, # of functions
        $result[] = [null, 'set', true, 'set', 1, true];
        $result[] = [null, 'set', false, 'set', 0, true];
        $result[] = ['set', null, true, 'set', null, true];
        $result[] = [null, null, false, 'set', 1, true];
        $result[] = [null, null, true, 'set', 0, true];
        $result[] = ['set', null, false, null, null, true];
        $result[] = [null, 'set', true, null, null, true];
        $result[] = ['set', 'set', false, 'set', 1, true];
        $result[] = ['set', null, true, null, 0, true];
        $result[] = [null, 'set', false, 'set', null, true];
        $result[] = ['set', null, true, null, 1, true];
        $result[] = [null, null, false, null, null, false];
        $result[] = ['set', 'set', true, 'set', 0, true];
        $result[] = ['set', 'set', false, null, 1, true];
        $result[] = ['set', null, false, 'set', 0, true];
        $result[] = ['set', 'set', false, 'set', null, true];
        $result[] = [null, null, false, 'null', 1, true];

        return $result;
    }

    /**
     * @dataProvider functionOrNameExistsInReferenceProvider
     *
     * @param string|null $declaredType
     * @param string|null $declaredValue
     * @param bool $isEntityContainer
     * @param string|null $declaredEC
     * @param int|null $numFunc
     * @param bool $expected
     */
    public function testFunctionOrNameExistsInReferenceProvider(
        ?string $declaredType,
        ?string $declaredValue,
        bool $isEntityContainer,
        ?string $declaredEC,
        ?int $numFunc,
        bool $expected
    ) {
        $decType = $declaredType ? m::mock(ISchemaType::class)->makePartial() : null;
        $decVal = $declaredValue ? m::mock(IValueTerm::class)->makePartial() : null;
        $decContainer = $declaredEC ? m::mock(IEntityContainer::class)->makePartial() : null;
        switch ($numFunc) {
            case 0:
                $decFun = [];
                break;
            case 1:
                $func = m::mock(IFunction::class)->makePartial();
                $decFun = [$func];
                break;
            default:
                $decFun = null;
                break;
        }

        $iFunc = m::mock(IFunction::class)->makePartial();
        $iFunc->shouldReceive('IsFunctionSignatureEquivalentTo')->andReturn(true);

        $refModel = m::mock(IModel::class)->makePartial();
        $refModel->shouldReceive('findDeclaredType')->andReturn($decType);
        $refModel->shouldReceive('findDeclaredValueTerm')->andReturn($decVal);
        $refModel->shouldReceive('findDeclaredEntityContainer')->andReturn($decContainer);
        $refModel->shouldReceive('findDeclaredFunctions')->andReturn($decFun);

        $model = m::mock(IModel::class)->makePartial();
        $model->shouldReceive('getReferencedModels')->andReturn([$refModel]);

        $actual = ValidationHelper::FunctionOrNameExistsInReferencedModel($model, $iFunc, 'Name', $isEntityContainer);
        $this->assertEquals($expected, $actual);
    }

    public function testTypeIndirectlyContainsTargetWhenInheritsFrom()
    {
        $source = m::mock(IEntityType::class);
        $source->shouldReceive('IsOrInheritsFrom')->andReturn(true);
        $target = m::mock(IEntityType::class);

        $context = m::mock(IModel::class)->makePartial();
        $visited = new \SplObjectStorage();

        $expected = true;
        $actual = ValidationHelper::TypeIndirectlyContainsTarget($source, $target, $visited, $context);
        $this->assertEquals($expected, $actual);

        $expected = false;
        $actual = ValidationHelper::TypeIndirectlyContainsTarget($source, $target, $visited, $context);
        $this->assertEquals($expected, $actual);
    }

    public function testTypeIndirectlyContainsTargetViaNavTypeInheritsFromTarget()
    {
        $navType2 = m::mock(IEntityType::class);
        $navType2->shouldReceive('IsOrInheritsFrom')->andReturn(false);
        $navType3 = m::mock(IEntityType::class);
        $navType3->shouldReceive('IsOrInheritsFrom')->andReturn(true);

        $navProp1 = m::mock(INavigationProperty::class)->makePartial();
        $navProp1->shouldReceive('containsTarget')->andReturn(false);
        $navProp2 = m::mock(INavigationProperty::class)->makePartial();
        $navProp2->shouldReceive('containsTarget')->andReturn(true);
        $navProp2->shouldReceive('ToEntityType')->andReturn($navType2);
        $navProp3 = m::mock(INavigationProperty::class)->makePartial();
        $navProp3->shouldReceive('containsTarget')->andReturn(true);
        $navProp3->shouldReceive('ToEntityType')->andReturn($navType3);

        $source = m::mock(IEntityType::class);
        $source->shouldReceive('IsOrInheritsFrom')->andReturn(false);
        $source->shouldReceive('NavigationProperties')->andReturn([$navProp1, $navProp3]);

        $target = m::mock(IEntityType::class);

        $context = m::mock(IModel::class)->makePartial();
        $visited = new \SplObjectStorage();

        $expected = true;
        $actual = ValidationHelper::TypeIndirectlyContainsTarget($source, $target, $visited, $context);
        $this->assertEquals($expected, $actual);
    }

    public function testTypeIndirectlyContainsTargetViaDerivedType()
    {
        $derivedType1 = m::mock(IEntityType::class);
        $derivedType1->shouldReceive('IsOrInheritsFrom')->andReturn(true);

        $derivedType2 = m::mock(IEntityType::class);
        $derivedType2->shouldReceive('IsOrInheritsFrom')->andReturn(true);

        $context = m::mock(IModel::class)->makePartial();
        $context->shouldReceive('FindAllDerivedTypes')->andReturn([$derivedType1, $derivedType2]);

        $source = m::mock(IEntityType::class);
        $source->shouldReceive('IsOrInheritsFrom')->andReturn(false);
        $source->shouldReceive('NavigationProperties')->andReturn([]);

        $target = m::mock(IEntityType::class);

        $visited = new \SplObjectStorage();

        $expected = true;
        $actual = ValidationHelper::TypeIndirectlyContainsTarget($source, $target, $visited, $context);
        $this->assertEquals($expected, $actual);
    }
}
