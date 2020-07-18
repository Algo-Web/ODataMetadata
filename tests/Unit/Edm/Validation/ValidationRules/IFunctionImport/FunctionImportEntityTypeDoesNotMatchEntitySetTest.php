<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17/07/20
 * Time: 4:49 PM
 */

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportEntityTypeDoesNotMatchEntitySet;
use AlgoWeb\ODataMetadata\Exception\ArgumentNullException;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class FunctionImportEntityTypeDoesNotMatchEntitySetTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testInvokeWithNullLocation()
    {
        $model = m::mock(IModel::class);
        $context = new ValidationContext($model, function(IEdmElement $one): bool { return false; });
        $import = m::mock(IFunctionImport::class);
        $import->shouldReceive('Location')->andReturn(null);

        $foo = new FunctionImportEntityTypeDoesNotMatchEntitySet();

        $this->expectException(ArgumentNullException::class);
        $this->expectExceptionMessage('Value for parameter functionImport->Location cannot be null.');
        $foo->__invoke($context, $import);
    }

    public function nullSetAndOrTypeProvider(): array
    {
        $result = [];
        $result[] = [true, true];
        $result[] = [true, false];
        $result[] = [false, true];

        return $result;
    }

    /**
     * @dataProvider nullSetAndOrTypeProvider
     *
     * @param bool $nullSet
     * @param bool $nullType
     * @throws \ReflectionException
     */
    public function testInvokeWithIncompleteEntitySetAndOrType(bool $nullSet, bool $nullType)
    {
        $model = m::mock(IModel::class);
        $context = new ValidationContext($model, function(IEdmElement $one): bool { return false; });

        $loc = m::mock(ILocation::class);
        $import = m::mock(IFunctionImport::class);
        $import->shouldReceive('Location')->andReturn($loc);
        if ($nullSet) {
            $import->shouldReceive('getEntitySet')->andReturn(null);
        } else {
            $expr = m::mock(IExpression::class);
            $import->shouldReceive('getEntitySet')->andReturn($expr);
        }

        if ($nullType) {
            $import->shouldReceive('getReturnType')->andReturn(null);
        } else {
            $typeRef = m::mock(ITypeReference::class);
            $import->shouldReceive('getReturnType')->andReturn($typeRef);
        }

        $foo = new FunctionImportEntityTypeDoesNotMatchEntitySet();
        $foo->__invoke($context, $import);

        $errors = $context->getErrors();
        $this->assertEquals(0, count($errors));
    }

    public function testInvokeWithFunctionImportReturnTypeNotCollectionNotEntity()
    {
        $model = m::mock(IModel::class);
        $context = new ValidationContext($model, function(IEdmElement $one): bool { return false; });

        $loc = m::mock(ILocation::class);
        $import = m::mock(IFunctionImport::class);
        $import->shouldReceive('Location')->andReturn($loc);
        $import->shouldReceive('getName')->andReturn('name');

        $expr = m::mock(IExpression::class);
        $import->shouldReceive('getEntitySet')->andReturn($expr);

        $rType = m::mock(IType::class);
        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('IsCollection')->andReturn(false);
        $typeRef->shouldReceive('IsEntity')->andReturn(false);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $import->shouldReceive('getReturnType')->andReturn($typeRef);

        $isColl = $import->getReturnType()->IsCollection();
        $this->assertFalse($isColl);

        $foo = new FunctionImportEntityTypeDoesNotMatchEntitySet();
        $foo->__invoke($context, $import);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];

        $errorCode = EdmErrorCode::FunctionImportSpecifiesEntitySetButDoesNotReturnEntityType();
        $this->assertEquals($errorCode, $error->getErrorCode());
        $expected = 'The function import \'name\' specifies an entity set but does not return entities.';
        $this->assertEquals($expected, $error->getErrorMessage());
    }

    public function testInvokeWithFunctionImportReturnTypeNotCollectionNotEntityCheckedIsBad()
    {
        $model = m::mock(IModel::class);
        $context = new ValidationContext($model, function(IEdmElement $one): bool { return true; });

        $loc = m::mock(ILocation::class);
        $import = m::mock(IFunctionImport::class);
        $import->shouldReceive('Location')->andReturn($loc);
        $import->shouldReceive('getName')->andReturn('name');

        $expr = m::mock(IExpression::class);
        $import->shouldReceive('getEntitySet')->andReturn($expr);

        $rType = m::mock(IType::class);
        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('IsCollection')->andReturn(false);
        $typeRef->shouldReceive('IsEntity')->andReturn(false);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);

        $import->shouldReceive('getReturnType')->andReturn($typeRef);

        $isColl = $import->getReturnType()->IsCollection();
        $this->assertFalse($isColl);

        $foo = new FunctionImportEntityTypeDoesNotMatchEntitySet();
        $foo->__invoke($context, $import);

        $errors = $context->getErrors();
        $this->assertEquals(0, count($errors));
    }

    public function testInvokeWithFunctionImportReturnTypeNotCollectionNotEntityCheckedIsBadNullDefinition()
    {
        $model = m::mock(IModel::class);
        $context = new ValidationContext($model, function(IEdmElement $one): bool { return true; });

        $loc = m::mock(ILocation::class);
        $import = m::mock(IFunctionImport::class);
        $import->shouldReceive('Location')->andReturn($loc);
        $import->shouldReceive('getName')->andReturn('name');

        $expr = m::mock(IExpression::class);
        $import->shouldReceive('getEntitySet')->andReturn($expr);

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('IsCollection')->andReturn(false);
        $typeRef->shouldReceive('IsEntity')->andReturn(false);
        $typeRef->shouldReceive('getDefinition')->andReturn(null);

        $import->shouldReceive('getReturnType')->andReturn($typeRef);

        $isColl = $import->getReturnType()->IsCollection();
        $this->assertFalse($isColl);

        $foo = new FunctionImportEntityTypeDoesNotMatchEntitySet();
        $this->expectException(ArgumentNullException::class);
        $this->expectExceptionMessage('Value for parameter elementType->getDefinition cannot be null.');
        $foo->__invoke($context, $import);
    }

    public function isStaticEntitySetProvider(): array
    {
        $result = [];
        $result[] = [false, false, false, false, 0];
        $result[] = [true, false, false, false, 1];
        $result[] = [false, true, false, false, 1];
        $result[] = [true, true, false, false, 1];
        $result[] = [false, false, true, false, 1];
        $result[] = [true, false, true, false, 1];
        $result[] = [false, true, true, false, 1];
        $result[] = [true, true, true, false, 1];
        $result[] = [false, false, false, true, 1];
        $result[] = [true, false, false, true, 1];
        $result[] = [false, true, false, true, 1];
        $result[] = [true, true, false, true, 1];
        $result[] = [false, false, true, true, 1];
        $result[] = [true, false, true, true, 1];
        $result[] = [false, true, true, true, 1];
        $result[] = [true, true, true, true, 1];

        return $result;
    }

    /**
     * @dataProvider isStaticEntitySetProvider
     *
     * @param bool $isOrInherits
     * @param bool $entityTypeBad
     * @param bool $entitySetBad
     * @param bool $entitySetElementTypeBad
     * @param int $numErrors
     * @throws \ReflectionException
     */
    public function testInvokeIsCollectionIsEntityIsStaticEntitySet(bool $isOrInherits, bool $entityTypeBad, bool $entitySetBad, bool $entitySetElementTypeBad, int $numErrors)
    {
        $model = m::mock(IModel::class);
        $context = new ValidationContext($model, function (IEdmElement $one) use ($entityTypeBad, $entitySetBad, $entitySetElementTypeBad): bool {
            if ($one instanceof IEntityType) {
                if (null !== $one->getDeclaredKey()) {
                    return $entitySetElementTypeBad;
                }
                return $entityTypeBad;
            }
            if ($one instanceof IExpression) {
                return $entitySetBad;
            }
            return true;
        });

        $elementType = m::mock(IEntityType::class);
        $elementType->shouldReceive('FullName')->andReturn('FullName');
        $elementType->shouldReceive('getDeclaredKey')->andReturn([]);

        $expr = m::mock(IExpression::class);
        $expr->shouldReceive('getElementType')->andReturn($elementType);
        $expr->shouldReceive('getName')->andReturn('exprName');
        $loc = m::mock(ILocation::class);
        $import = m::mock(IFunctionImport::class);
        $import->shouldReceive('Location')->andReturn($loc);
        $import->shouldReceive('getName')->andReturn('name');
        $import->shouldReceive('TryGetStaticEntitySet')
            ->with(m::on(function (&$data) use ($expr) {
                $data = $expr;
                return true;
            }))
            ->andReturn(true);

        $nuExpr = m::mock(IExpression::class);
        $import->shouldReceive('getEntitySet')->andReturn($nuExpr);

        $eType = m::mock(IEntityType::class);
        $eType->shouldReceive('FullName')->andReturn('FullName');
        $eType->shouldReceive('IsOrInheritsFrom')->andReturn($isOrInherits);
        $eType->shouldReceive('getDeclaredKey')->andReturn(null);

        $sType = m::mock(IType::class);
        $nuType = m::mock(ITypeReference::class);
        $nuType->shouldReceive('getDefinition')->andReturn($sType);
        $nuType->shouldReceive('IsEntity')->andReturn(true);
        $nuType->shouldReceive('AsEntity->EntityDefinition')->andReturn($eType);
        $collection = m::mock(ICollectionTypeReference::class);
        $collection->shouldReceive('ElementType')->andReturn($nuType);

        $rType = m::mock(IType::class);
        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('IsCollection')->andReturn(true);
        $typeRef->shouldReceive('IsEntity')->andReturn(true);
        $typeRef->shouldReceive('getDefinition')->andReturn($rType);
        $typeRef->shouldReceive('AsEntity->EntityDefinition')->andReturn($eType);
        $typeRef->shouldReceive('AsCollection')->andReturn($collection);

        $import->shouldReceive('getReturnType')->andReturn($typeRef);

        // pre-check individual components of $isBad check
        $this->assertEquals($isOrInherits, $eType->IsOrInheritsFrom($sType));
        $this->assertEquals($entitySetBad, $context->checkIsBad($expr));
        $this->assertEquals($entityTypeBad, $context->checkIsBad($eType));
        $this->assertEquals($entitySetElementTypeBad, $context->checkIsBad($elementType));

        $foo = new FunctionImportEntityTypeDoesNotMatchEntitySet();

        $foo->__invoke($context, $import);

        $errors = $context->getErrors();
        $this->assertEquals($numErrors, count($errors));
    }

    public function isEntityAsPathProvider(): array
    {
        $result = [];
        /*
        $result[] = [true, true, true, true, true, 0];
        $result[] = [false, false, true, true, true, 0];
        */
        $result[] = [false, true, true, true, true, 0];
        //$result[] = [true, false, false, false, false, 1];
        $result[] = [false, true, false, false, false, 1];
        /*
        $result[] = [true, false, false, false, true, 0];
        $result[] = [true, false, false, true, false, 0];
        $result[] = [true, false, false, true, true, 0];
        $result[] = [true, false, true, false, false, 0];
        $result[] = [true, false, true, false, true, 0];
        $result[] = [true, false, true, true, false, 0];
        */

        return $result;
    }

    /**
     * @dataProvider isEntityAsPathProvider
     *
     * @param bool $isPathEmpty
     * @param bool $isCollection
     * @param bool $isOrInherits
     * @param bool $entityTypeBad
     * @param bool $isDefinitionBad
     * @param int $numErrors
     * @throws \ReflectionException
     */
    public function testInvokeIsEntityAsPath(
        bool $isPathEmpty,
        bool $isCollection,
        bool $isOrInherits,
        bool $entityTypeBad,
        bool $isDefinitionBad,
        int $numErrors
    ) {
        $model = m::mock(IModel::class);
        $isBadFunction = function (IEdmElement $one) use ($entityTypeBad, $isDefinitionBad): bool {
            if ($one instanceof IEntityType) {
                return $entityTypeBad;
            }
            if ($one instanceof IType) {
                return $isDefinitionBad;
            }
            return true;
        };

        $context = new ValidationContext($model, $isBadFunction);

        $nuExpr = m::mock(IExpression::class);
        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('IsCollection')->andReturn($isCollection);
        $typeRef->shouldReceive('FullName')->andReturn('typeRef');
        $typeRef->shouldReceive('getNullable')->andReturn(false)->never();
        $entityType = m::mock(IEntityType::class);
        if ($isCollection) {
            $rType = m::mock(IType::class);
            $elementType = m::mock(ITypeReference::class);
            $elementType->shouldReceive('getDefinition')->andReturn($rType);
            $elementType->shouldReceive('IsEntity')->andReturn(true);
            $elementType->shouldReceive('AsEntity->EntityDefinition')->andReturn($entityType);
            $elementType->shouldReceive('getNullable')->andReturn(false)->never();
            $elementType->shouldReceive('FullName')->andReturn('elementType');

            $collection = m::mock(ICollectionTypeReference::class);
            $collection->shouldReceive('ElementType')->andReturn($elementType);
            $collection->shouldReceive('EntityDefinition')->andReturn($entityType);
            $collection->shouldReceive('getNullable')->andReturn(false)->never();

            $typeRef->shouldReceive('AsCollection')->andReturn($collection);
        } else {
            $rType = m::mock(IType::class);
            $typeRef->shouldReceive('getDefinition')->andReturn($rType);
            $typeRef->shouldReceive('IsEntity')->andReturn(true);
            $typeRef->shouldReceive('AsEntity->EntityDefinition')->andReturn($entityType);
        }

        $entityType->shouldReceive('IsOrInheritsFrom')->andReturn($isOrInherits);

        $loc = m::mock(ILocation::class);
        $import = m::mock(IFunctionImport::class);
        $import->shouldReceive('Location')->andReturn($loc);
        $import->shouldReceive('getName')->andReturn('name');
        $import->shouldReceive('getReturnType')->andReturn($typeRef);
        $import->shouldReceive('getEntitySet')->andReturn($nuExpr);
        $import->shouldReceive('TryGetStaticEntitySet')->andReturn(false);
        $import->shouldReceive('TryGetRelativeEntitySetPath')
            ->withArgs((function (IModel $model, &$parameter, &$path) use ($isCollection, $isPathEmpty) {
                $nuType = m::mock(ITypeReference::class);
                $nuType->shouldReceive('IsCollection')->andReturn($isCollection);
                $nuType->shouldReceive('getNullable')->andReturn(false)->never();
                $typeRef = m::mock(ITypeReference::class);
                $typeRef->shouldReceive('IsCollection')->andReturn($isCollection);
                $typeRef->shouldReceive('getType')->andReturn($nuType);
                $nuType->shouldReceive('STOP')->andReturn('HAMMERTIME');
                $defType = m::mock(IType::class);
                if ($isCollection) {
                    $oldType = m::mock(ITypeReference::class);
                    $oldType->shouldReceive('getDefinition')->andReturn($defType)->once();
                    $collection = m::mock(ICollectionTypeReference::class);
                    $collection->shouldReceive('ElementType')->andReturn($oldType);
                    $typeRef->shouldReceive('AsCollection')->andReturn($collection);
                    $nuType->shouldReceive('AsCollection')->andReturn($collection);
                } else {
                    $nuType->shouldReceive('getDefinition')->andReturn($defType)->once();
                    $typeRef->shouldReceive('getDefinition')->andReturn($defType)->once();
                }

                $parameter = m::mock(IFunctionParameter::class);
                $parameter->shouldReceive('getType')->andReturn($typeRef);
                if ($isPathEmpty) {
                    $path = [];
                } else {
                    $path = [$typeRef];
                }
                return true;
            }))
            ->andReturn(true);

        $foo = new FunctionImportEntityTypeDoesNotMatchEntitySet();

        $foo->__invoke($context, $import);

        $errors = $context->getErrors();
        $this->assertEquals($numErrors, count($errors));
    }
}
