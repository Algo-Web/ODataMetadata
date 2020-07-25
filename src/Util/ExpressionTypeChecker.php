<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Util;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Helpers\EdmElementComparer;
use AlgoWeb\ODataMetadata\Helpers\ToTraceString;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IApplyExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IAssertTypeExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IBinaryConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IBooleanConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ICollectionExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDateTimeConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDateTimeOffsetConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDecimalConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IFloatingConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IGuidConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIfExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIntegerConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpressionReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\INullExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPathExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IRecordExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IStringConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ITimeConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionBase;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPrimitiveValue;
use AlgoWeb\ODataMetadata\Library\Core\EdmCoreModel;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Structure\HashSetInternal;

/**
 * Collection of methods to assert that an expression is of the required type.
 *
 * @package AlgoWeb\ODataMetadata\Util
 */
abstract class ExpressionTypeChecker
{
    private static $promotionMap = null;

    private static function getPromotionMap(): array
    {
        return self::$promotionMap ?? self::$promotionMap = [
            PrimitiveTypeKind::Byte()->getValue() => [
                PrimitiveTypeKind::Int16()->getValue() => true,
                PrimitiveTypeKind::Int32()->getValue() => true,
                PrimitiveTypeKind::Int64()->getValue() => true,
            ],
            PrimitiveTypeKind::SByte()->getValue() => [
                PrimitiveTypeKind::Int16()->getValue() => true,
                PrimitiveTypeKind::Int32()->getValue() => true,
                PrimitiveTypeKind::Int64()->getValue() => true,
            ],
            PrimitiveTypeKind::Int16()->getValue() => [
                PrimitiveTypeKind::Int32()->getValue() => true,
                PrimitiveTypeKind::Int64()->getValue() => true,
            ],
            PrimitiveTypeKind::Int32()->getValue() => [
                PrimitiveTypeKind::Int64()->getValue() => true,
            ],
            PrimitiveTypeKind::Single()->getValue() => [
                PrimitiveTypeKind::Double()->getValue() => true,
            ],
            PrimitiveTypeKind::GeographyCollection()->getValue() => [
                PrimitiveTypeKind::Geography()->getValue() => true,
            ],
            PrimitiveTypeKind::GeographyLineString()->getValue() => [
                PrimitiveTypeKind::Geography()->getValue() => true,
            ],
            PrimitiveTypeKind::GeographyMultiLineString()->getValue() => [
                PrimitiveTypeKind::Geography()->getValue() => true,
            ],
            PrimitiveTypeKind::GeographyMultiPoint()->getValue() => [
                PrimitiveTypeKind::Geography()->getValue() => true,
            ],
            PrimitiveTypeKind::GeographyMultiPolygon()->getValue() => [
                PrimitiveTypeKind::Geography()->getValue() => true,
            ],
            PrimitiveTypeKind::GeographyPoint()->getValue() => [
                PrimitiveTypeKind::Geography()->getValue() => true,
            ],
            PrimitiveTypeKind::GeographyPolygon()->getValue() => [
                PrimitiveTypeKind::Geography()->getValue() => true,
            ],
            PrimitiveTypeKind::GeometryCollection()->getValue() => [
                PrimitiveTypeKind::Geometry()->getValue() => true,
            ],
            PrimitiveTypeKind::GeometryLineString()->getValue() => [
                PrimitiveTypeKind::Geometry()->getValue() => true,
            ],
            PrimitiveTypeKind::GeometryMultiLineString()->getValue() => [
                PrimitiveTypeKind::Geometry()->getValue() => true,
            ],
            PrimitiveTypeKind::GeometryMultiPoint()->getValue() => [
                PrimitiveTypeKind::Geometry()->getValue() => true,
            ],
            PrimitiveTypeKind::GeometryMultiPolygon()->getValue() => [
                PrimitiveTypeKind::Geometry()->getValue() => true,
            ],
            PrimitiveTypeKind::GeometryPoint()->getValue() => [
                PrimitiveTypeKind::Geometry()->getValue() => true,
            ],
            PrimitiveTypeKind::GeometryPolygon()->getValue() => [
                PrimitiveTypeKind::Geometry()->getValue() => true,
            ],
        ];
    }

    /**
     * Determines if the type of an expression is compatible with the provided type.
     *
     * If the expression has an associated type, this function will check that it matches the expected type and stop
     * looking further. If an expression claims a type, it must be validated that the type is valid for the expression.
     * If the expression does not claim a type this method will attempt to check the validity of the expression itself
     * with the asserted type.
     *
     * @param  IExpression|null    $expression       the expression to assert the type of
     * @param  ITypeReference|null $type             the type to assert the expression as
     * @param  IType|null          $context          the context paths are to be evaluated in
     * @param  bool                $matchExactly     Must the expression must match the asserted type exactly, or simply be compatible?
     * @param  iterable            $discoveredErrors errors produced if the expression does not match the specified type
     * @return bool                a value indicating whether the expression is valid for the given type or not
     */
    public static function tryAssertType(
        IExpression $expression = null,
        ITypeReference $type = null,
        IType $context = null,
        bool $matchExactly = false,
        iterable &$discoveredErrors = []
    ): bool {
        EdmUtil::checkArgumentNull($expression, 'expression');

        // If we don't have a type to assert this passes vacuously.
        if (null === $type || $type->typeKind()->isNone()) {
            $discoveredErrors = [];
            return true;
        }

        switch ($expression->/* @scrutinizer ignore-call */getExpressionKind()) {
            case ExpressionKind::IntegerConstant():
            case ExpressionKind::StringConstant():
            case ExpressionKind::BinaryConstant():
            case ExpressionKind::BooleanConstant():
            case ExpressionKind::DateTimeConstant():
            case ExpressionKind::DateTimeOffsetConstant():
            case ExpressionKind::DecimalConstant():
            case ExpressionKind::FloatingConstant():
            case ExpressionKind::GuidConstant():
            case ExpressionKind::TimeConstant():
                /** @var IPrimitiveValue $primitiveValue */
                $primitiveValue = $expression;
                assert($primitiveValue instanceof IPrimitiveValue);
                if (null !== $primitiveValue->getType()) {
                    return self::testTypeReferenceMatch(
                        $primitiveValue->getType(),
                        $type,
                        $expression->/* @scrutinizer ignore-call */ Location(),
                        $matchExactly,
                        $discoveredErrors
                    );
                }
                return self::tryAssertPrimitiveAsType($primitiveValue, $type, $discoveredErrors);
            case ExpressionKind::Null():
                assert($expression instanceof INullExpression);
                return self::tryAssertNullAsType($expression, $type, $discoveredErrors);
            case ExpressionKind::Path():
                assert($expression instanceof IPathExpression);
                EdmUtil::checkArgumentNull($context, 'context');
                return self::tryAssertPathAsType($expression, $type, $context, $matchExactly, $discoveredErrors);
            case ExpressionKind::FunctionApplication():
                /** @var IApplyExpression $applyExpression */
                $applyExpression = $expression;
                assert($applyExpression instanceof IApplyExpression);
                if (null !== $applyExpression->getAppliedFunction()) {
                    $function = $applyExpression->getAppliedFunction();
                    if (null !== $function && $function instanceof IFunctionBase) {
                        EdmUtil::checkArgumentNull($function->getReturnType(), 'function->getReturnType');
                        EdmUtil::checkArgumentNull($applyExpression->Location(), 'expression->Location');
                        return self::testTypeReferenceMatch(
                            $function->getReturnType(),
                            $type,
                            $applyExpression->Location(),
                            $matchExactly,
                            $discoveredErrors
                        );
                    }
                }

                // If we don't have the applied function we just assume that it will work.
                $discoveredErrors = [];
                return true;
            case ExpressionKind::If():
                assert($expression instanceof IIfExpression);
                return self::tryAssertIfAsType($expression, $type, $context, $matchExactly, $discoveredErrors);
            case ExpressionKind::IsType():
                $coreModel = EdmCoreModel::getInstance();
                $boolean   = $coreModel->GetBoolean(false);
                EdmUtil::checkArgumentNull($expression->Location(), 'expression->Location');
                return self::testTypeReferenceMatch(
                    $boolean,
                    $type,
                    $expression->Location(),
                    $matchExactly,
                    $discoveredErrors
                );
            case ExpressionKind::Record():
                /** @var IRecordExpression $recordExpression */
                $recordExpression = $expression;
                assert($recordExpression instanceof IRecordExpression);
                if (null !== $recordExpression->getDeclaredType()) {
                    return self::testTypeReferenceMatch(
                        $recordExpression->getDeclaredType(),
                        $type,
                        $expression->Location(),
                        $matchExactly,
                        $discoveredErrors
                    );
                }

                return self::tryAssertRecordAsType(
                    $recordExpression,
                    $type,
                    $context,
                    $matchExactly,
                    $discoveredErrors
                );
            case ExpressionKind::Collection():
                /** @var ICollectionExpression $collectionExpression */
                $collectionExpression = $expression;
                EdmUtil::checkArgumentNull($context, 'context');
                assert($collectionExpression instanceof ICollectionExpression);
                if (null !== $collectionExpression->getDeclaredType()) {
                    return self::testTypeReferenceMatch(
                        $collectionExpression->getDeclaredType(),
                        $type,
                        $expression->Location(),
                        $matchExactly,
                        $discoveredErrors
                    );
                }

                return self::tryAssertCollectionAsType(
                    $collectionExpression,
                    $type,
                    $context,
                    $matchExactly,
                    $discoveredErrors
                );
            case ExpressionKind::Labeled():
                assert($expression instanceof ILabeledExpression);
                return self::tryAssertType(
                    $expression->getExpression(),
                    $type,
                    $context,
                    $matchExactly,
                    $discoveredErrors
                );
            case ExpressionKind::AssertType():
                assert($expression instanceof IAssertTypeExpression);
                return self::testTypeReferenceMatch(
                    $expression->getType(),
                    $type,
                    $expression->Location(),
                    $matchExactly,
                    $discoveredErrors
                );
            case ExpressionKind::LabeledExpressionReference():
                assert($expression instanceof ILabeledExpressionReferenceExpression);
                return self::tryAssertType(
                    $expression->getReferencedLabeledExpression(),
                    $type,
                    null,
                    false,
                    $discoveredErrors
                );
            default:
                $discoveredErrors = [
                    new EdmError(
                        $expression->Location(),
                        EdmErrorCode::ExpressionNotValidForTheAssertedType(),
                        StringConst::EdmModel_Validator_Semantic_ExpressionNotValidForTheAssertedType()
                    )
                ];
                return false;
        }
    }

    public static function tryAssertPrimitiveAsType(
        IPrimitiveValue $expression,
        ITypeReference $type,
        iterable &$discoveredErrors
    ): bool {
        if (!$type->isPrimitive()) {
            $discoveredErrors =  [
                new EdmError(
                    $expression->Location(),
                    EdmErrorCode::PrimitiveConstantExpressionNotValidForNonPrimitiveType(),
                    StringConst::EdmModel_Validator_Semantic_PrimitiveConstantExpressionNotValidForNonPrimitiveType()
                )
            ];
            return false;
        }

        switch ($expression->getValueKind()) {
            case ValueKind::Binary():
                assert($expression instanceof IBinaryConstantExpression);
                return self::tryAssertBinaryConstantAsType($expression, $type, $discoveredErrors);
            case ValueKind::Boolean():
                assert($expression instanceof IBooleanConstantExpression);
                return self::tryAssertBooleanConstantAsType($expression, $type, $discoveredErrors);
            case ValueKind::DateTime():
                assert($expression instanceof IDateTimeConstantExpression);
                return self::tryAssertDateTimeConstantAsType($expression, $type, $discoveredErrors);
            case ValueKind::DateTimeOffset():
                assert($expression instanceof IDateTimeOffsetConstantExpression);
                return self::tryAssertDateTimeOffsetConstantAsType($expression, $type, $discoveredErrors);
            case ValueKind::Decimal():
                assert($expression instanceof IDecimalConstantExpression);
                return self::tryAssertDecimalConstantAsType($expression, $type, $discoveredErrors);
            case ValueKind::Floating():
                assert($expression instanceof IFloatingConstantExpression);
                return self::tryAssertFloatingConstantAsType($expression, $type, $discoveredErrors);
            case ValueKind::Guid():
                assert($expression instanceof IGuidConstantExpression);
                return self::tryAssertGuidConstantAsType($expression, $type, $discoveredErrors);
            case ValueKind::Integer():
                assert($expression instanceof IIntegerConstantExpression);
                return self::tryAssertIntegerConstantAsType($expression, $type, $discoveredErrors);
            case ValueKind::String():
                assert($expression instanceof IStringConstantExpression);
                return self::tryAssertStringConstantAsType($expression, $type, $discoveredErrors);
            case ValueKind::Time():
                assert($expression instanceof ITimeConstantExpression);
                return self::tryAssertTimeConstantAsType($expression, $type, $discoveredErrors);
            default:
                $discoveredErrors = [
                    new EdmError(
                        $expression->Location(),
                        EdmErrorCode::ExpressionPrimitiveKindNotValidForAssertedType(),
                        StringConst::EdmModel_Validator_Semantic_ExpressionPrimitiveKindNotValidForAssertedType()
                    )
                ];
                return false;
        }
    }

    protected static function tryAssertNullAsType(
        INullExpression $expression,
        ITypeReference $type,
        iterable &$discoveredErrors
    ): bool {
        if (!$type->getNullable()) {
            $discoveredErrors = [
                new EdmError(
                    $expression->Location(),
                    EdmErrorCode::NullCannotBeAssertedToBeANonNullableType(),
                    StringConst::EdmModel_Validator_Semantic_NullCannotBeAssertedToBeANonNullableType()
                )
            ];
            return false;
        }

        $discoveredErrors = [];
        return true;
    }

    protected static function tryAssertPathAsType(
        IPathExpression $expression,
        ITypeReference $type,
        IType $context,
        bool $matchExactly,
        iterable &$discoveredErrors
    ): bool {
        $structuredContext = $context;
        assert($structuredContext instanceof IStructuredType);

        $result = $context;
        $loc    = $expression->Location();
        EdmUtil::checkArgumentNull($loc, 'expression->Location');
        EdmUtil::checkArgumentNull($type->getDefinition(), 'type->getDefinition');

        foreach ($expression->getPath() as $segment) {
            $structuredResult = $result;
            if (!$structuredResult instanceof IStructuredType) {
                $discoveredErrors = [
                    new EdmError(
                        $loc,
                        EdmErrorCode::PathIsNotValidForTheGivenContext(),
                        StringConst::EdmModel_Validator_Semantic_PathIsNotValidForTheGivenContext($segment)
                    )
                ];
                return false;
            }

            $resultProperty = $structuredResult->findProperty($segment);
            $result         = (null !== $resultProperty) ? $resultProperty->getType()->getDefinition() : null;

            // If the path is not resolved, it could refer to an open type, and we can't assert its type.
            if (null === $result) {
                $discoveredErrors = [];
                return true;
            }
        }

        return self::testTypeMatch(
            $result,
            $type->getDefinition(),
            $loc,
            $matchExactly,
            $discoveredErrors
        );
    }

    protected static function tryAssertIfAsType(
        IIfExpression $expression,
        ITypeReference $type,
        IType $context,
        bool $matchExactly,
        &$discoveredErrors
    ): bool {
        $ifTrueErrors  = [];
        $ifFalseErrors = [];
        $success       = self::tryAssertType($expression->getTrueExpression(), $type, $context, $matchExactly, $ifTrueErrors);
        $success &= self::tryAssertType(
            $expression->getFalseExpression(),
            $type,
            $context,
            $matchExactly,
            $ifFalseErrors
        );
        if (!$success) {
            $discoveredErrors = array_merge($ifTrueErrors, $ifFalseErrors);
        } else {
            $discoveredErrors = [];
        }

        return boolval($success);
    }

    public static function tryAssertRecordAsType(
        IRecordExpression $expression,
        ITypeReference $type,
        ?IType $context,
        bool $matchExactly,
        iterable &$discoveredErrors
    ): bool {
        EdmUtil::checkArgumentNull($expression, 'expression');
        EdmUtil::checkArgumentNull($type, 'type');

        if (!$type->isStructured()) {
            $discoveredErrors = [
                new EdmError(
                    $expression->Location(),
                    EdmErrorCode::RecordExpressionNotValidForNonStructuredType(),
                    StringConst::EdmModel_Validator_Semantic_RecordExpressionNotValidForNonStructuredType()
                )
            ];
            return false;
        }

        $foundProperties = new HashSetInternal();
        $errors          = [];

        $structuredType = $type->asStructured();
        $definition     = $structuredType->getDefinition();
        assert($definition instanceof IStructuredType);
        foreach ($definition->Properties() as $typeProperty) {
            $expressionProperty = null;
            foreach ($expression->getProperties() as $p) {
                if ($p->getName() === $typeProperty->getName()) {
                    $expressionProperty = $p;
                    break;
                }
            }
            if (null === $expressionProperty) {
                $errors[] = new EdmError(
                    $expression->Location(),
                    EdmErrorCode::RecordExpressionMissingRequiredProperty(),
                    StringConst::EdmModel_Validator_Semantic_RecordExpressionMissingProperty($typeProperty->getName())
                );
            } else {
                $recursiveErrors = [];
                if (!self::tryAssertType(
                    $expressionProperty->getValue(),
                    $typeProperty->getType(),
                    $context,
                    $matchExactly,
                    $recursiveErrors
                )) {
                    foreach ($recursiveErrors as $error) {
                        $errors[] = $error;
                    }
                }

                $foundProperties[] = $typeProperty->getName();
            }
        }
        $definition = $structuredType->getDefinition();
        assert($definition instanceof IStructuredType);
        if (!$definition->isOpen()) {
            foreach ($expression->getProperties() as $property) {
                if (!$foundProperties->contains($property->getName())) {
                    $errors[] = new EdmError(
                        $expression->Location(),
                        EdmErrorCode::RecordExpressionHasExtraProperties(),
                        StringConst::EdmModel_Validator_Semantic_RecordExpressionHasExtraProperties(
                            $property->getName()
                        )
                    );
                }
            }
        }

        if (count($errors) > 0 || $errors[0]) {
            $discoveredErrors = $errors;
            return false;
        }

        $discoveredErrors = [];
        return true;
    }

    public static function tryAssertCollectionAsType(
        ICollectionExpression $expression,
        ITypeReference $type,
        IType $context,
        bool $matchExactly,
        &$discoveredErrors
    ): bool {
        if (!$type->isCollection()) {
            $discoveredErrors = [
                new EdmError(
                    $expression->Location(),
                    EdmErrorCode::CollectionExpressionNotValidForNonCollectionType(),
                    StringConst::EdmModel_Validator_Semantic_CollectionExpressionNotValidForNonCollectionType()
                )
            ];
            return false;
        }

        $collectionElementType = $type->asCollection()->ElementType();
        $success               = true;
        $errors                = [];
        $recursiveErrors       = [];
        foreach ($expression->getElements() as $element) {
            $result = self::tryAssertType(
                $element,
                $collectionElementType,
                $context,
                $matchExactly,
                $recursiveErrors
            );
            $success &= boolval($result);
            $errors = array_merge($errors, $recursiveErrors);
        }

        $discoveredErrors = $errors;
        return boolval($success);
    }

    private static function tryAssertGuidConstantAsType(
        IGuidConstantExpression $expression,
        ITypeReference $type,
        &$discoveredErrors
    ): bool {
        if (!$type->isGuid()) {
            $discoveredErrors = [
                new EdmError(
                    $expression->Location(),
                    EdmErrorCode::ExpressionPrimitiveKindNotValidForAssertedType(),
                    StringConst::EdmModel_Validator_Semantic_ExpressionPrimitiveKindNotValidForAssertedType()
                )
            ];
            return false;
        }

        $discoveredErrors = [];
        return true;
    }

    private static function tryAssertFloatingConstantAsType(
        IFloatingConstantExpression $expression,
        ITypeReference $type,
        &$discoveredErrors
    ): bool {
        if (!$type->isFloating()) {
            $discoveredErrors = [
                new EdmError(
                    $expression->Location(),
                    EdmErrorCode::ExpressionPrimitiveKindNotValidForAssertedType(),
                    StringConst::EdmModel_Validator_Semantic_ExpressionPrimitiveKindNotValidForAssertedType()
                )
            ];
            return false;
        }

        $discoveredErrors = [];
        return true;
    }

    private static function tryAssertDecimalConstantAsType(
        IDecimalConstantExpression $expression,
        ITypeReference $type,
        &$discoveredErrors
    ): bool {
        if (!$type->isDecimal()) {
            $discoveredErrors = [
                new EdmError(
                    $expression->Location(),
                    EdmErrorCode::ExpressionPrimitiveKindNotValidForAssertedType(),
                    StringConst::EdmModel_Validator_Semantic_ExpressionPrimitiveKindNotValidForAssertedType()
                )
            ];
            return false;
        }

        $discoveredErrors = [];
        return true;
    }

    private static function tryAssertDateTimeOffsetConstantAsType(
        IDateTimeOffsetConstantExpression $expression,
        ITypeReference $type,
        &$discoveredErrors
    ): bool {
        if (!$type->isDateTimeOffset()) {
            $discoveredErrors = [
                new EdmError(
                    $expression->Location(),
                    EdmErrorCode::ExpressionPrimitiveKindNotValidForAssertedType(),
                    StringConst::EdmModel_Validator_Semantic_ExpressionPrimitiveKindNotValidForAssertedType()
                )
            ];
            return false;
        }

        $discoveredErrors = [];
        return true;
    }

    private static function tryAssertDateTimeConstantAsType(
        IDateTimeConstantExpression $expression,
        ITypeReference $type,
        &$discoveredErrors
    ): bool {
        if (!$type->isDateTime()) {
            $discoveredErrors = [
                new EdmError(
                    $expression->Location(),
                    EdmErrorCode::ExpressionPrimitiveKindNotValidForAssertedType(),
                    StringConst::EdmModel_Validator_Semantic_ExpressionPrimitiveKindNotValidForAssertedType()
                )
            ];
            return false;
        }

        $discoveredErrors = [];
        return true;
    }

    private static function tryAssertTimeConstantAsType(
        ITimeConstantExpression $expression,
        ITypeReference $type,
        &$discoveredErrors
    ): bool {
        if (!$type->isTime()) {
            $discoveredErrors = [
                new EdmError(
                    $expression->Location(),
                    EdmErrorCode::ExpressionPrimitiveKindNotValidForAssertedType(),
                    StringConst::EdmModel_Validator_Semantic_ExpressionPrimitiveKindNotValidForAssertedType()
                )
            ];
            return false;
        }

        $discoveredErrors = [];
        return true;
    }

    private static function tryAssertBooleanConstantAsType(
        IBooleanConstantExpression $expression,
        ITypeReference $type,
        &$discoveredErrors
    ): bool {
        if (!$type->isBoolean()) {
            $discoveredErrors = [
                new EdmError(
                    $expression->Location(),
                    EdmErrorCode::ExpressionPrimitiveKindNotValidForAssertedType(),
                    StringConst::EdmModel_Validator_Semantic_ExpressionPrimitiveKindNotValidForAssertedType()
                )
            ];
            return false;
        }

        $discoveredErrors = [];
        return true;
    }

    private static function tryAssertStringConstantAsType(
        IStringConstantExpression $expression,
        ITypeReference $type,
        &$discoveredErrors
    ) {
        if (!$type->isString()) {
            $discoveredErrors = [
                new EdmError(
                    $expression->Location(),
                    EdmErrorCode::ExpressionPrimitiveKindNotValidForAssertedType(),
                    StringConst::EdmModel_Validator_Semantic_ExpressionPrimitiveKindNotValidForAssertedType()
                )
            ];
            return false;
        }

        EdmUtil::checkArgumentNull($expression->getValue(), 'expression->getValue');
        $stringType = $type->asString();
        if (null !== $stringType->getMaxLength() && mb_strlen($expression->getValue()) > $stringType->getMaxLength()) {
            $discoveredErrors = [
                new EdmError(
                    $expression->Location(),
                    EdmErrorCode::StringConstantLengthOutOfRange(),
                    StringConst::EdmModel_Validator_Semantic_StringConstantLengthOutOfRange(
                        mb_strlen($expression->getValue()),
                        $stringType->getMaxLength()
                    )
                )
            ];
            return false;
        }

        $discoveredErrors = [];
        return true;
    }

    private static function tryAssertIntegerConstantAsType(
        IIntegerConstantExpression $expression,
        ITypeReference $type,
        &$discoveredErrors
    ): bool {
        if (!$type->isIntegral()) {
            $discoveredErrors = [
                new EdmError(
                    $expression->Location(),
                    EdmErrorCode::ExpressionPrimitiveKindNotValidForAssertedType(),
                    StringConst::EdmModel_Validator_Semantic_ExpressionPrimitiveKindNotValidForAssertedType()
                )
            ];
            return false;
        }

        switch ($type->primitiveKind()) {
            case PrimitiveTypeKind::Int64():
                return self::tryAssertIntegerConstantInRange(
                    $expression,
                    (int)-9223372036854775808,
                    (int)9223372036854775807,
                    $discoveredErrors
                );
            case PrimitiveTypeKind::Int32():
                return self::tryAssertIntegerConstantInRange(
                    $expression,
                    -2147483648,
                    2147483647,
                    $discoveredErrors
                );
            case PrimitiveTypeKind::Int16():
                return self::tryAssertIntegerConstantInRange(
                    $expression,
                    -32768,
                    32767,
                    $discoveredErrors
                );
            case PrimitiveTypeKind::Byte():
                return self::tryAssertIntegerConstantInRange(
                    $expression,
                    0,
                    255,
                    $discoveredErrors
                );
            case PrimitiveTypeKind::SByte():
                return self::tryAssertIntegerConstantInRange(
                    $expression,
                    -128,
                    127,
                    $discoveredErrors
                );
            default:
                $discoveredErrors =  [
                    new EdmError(
                        $expression->Location(),
                        EdmErrorCode::ExpressionPrimitiveKindNotValidForAssertedType(),
                        StringConst::EdmModel_Validator_Semantic_ExpressionPrimitiveKindNotValidForAssertedType()
                    )
                ];
                return false;
        }
    }

    private static function tryAssertIntegerConstantInRange(
        IIntegerConstantExpression $expression,
        int $min,
        int $max,
        &$discoveredErrors
    ): bool {
        if ($expression->getValue() < $min || $expression->getValue() > $max) {
            $discoveredErrors = [
                new EdmError(
                    $expression->Location(),
                    EdmErrorCode::IntegerConstantValueOutOfRange(),
                    StringConst::EdmModel_Validator_Semantic_IntegerConstantValueOutOfRange()
                )
            ];
            return false;
        }

        $discoveredErrors = [];
        return true;
    }

    private static function tryAssertBinaryConstantAsType(
        IBinaryConstantExpression $expression,
        ITypeReference $type,
        &$discoveredErrors
    ): bool {
        if (!$type->isBinary()) {
            $discoveredErrors = [
                new EdmError(
                    $expression->Location(),
                    EdmErrorCode::ExpressionPrimitiveKindNotValidForAssertedType(),
                    StringConst::EdmModel_Validator_Semantic_ExpressionPrimitiveKindNotValidForAssertedType()
                )
            ];
            return false;
        }

        EdmUtil::checkArgumentNull($expression->getValue(), 'expression->getValue');
        $binaryType = $type->asBinary();
        if (null !== $binaryType->getMaxLength() && count($expression->getValue()) > $binaryType->getMaxLength()) {
            $discoveredErrors = [
                new EdmError(
                    $expression->Location(),
                    EdmErrorCode::BinaryConstantLengthOutOfRange(),
                    StringConst::EdmModel_Validator_Semantic_BinaryConstantLengthOutOfRange(
                        implode('', $expression->getValue()),
                        $binaryType->getMaxLength()
                    )
                )
            ];
            return false;
        }

        $discoveredErrors = [];
        return true;
    }

    private static function testTypeReferenceMatch(
        ITypeReference $expressionType,
        ITypeReference $assertedType,
        ?ILocation $location,
        bool $matchExactly,
        &$discoveredErrors
    ): bool {
        if (!self::testNullabilityMatch($expressionType, $assertedType, $location, $discoveredErrors)) {
            return false;
        }

        // A bad type reference matches anything (so as to avoid generating spurious errors).
        if (0 !== count($expressionType->getErrors())) {
            $discoveredErrors = [];
            return true;
        }

        EdmUtil::checkArgumentNull($expressionType->getDefinition(), 'expressionType->getDefinition');
        EdmUtil::checkArgumentNull($assertedType->getDefinition(), 'assertedType->getDefinition');

        return self::testTypeMatch(
            $expressionType->getDefinition(),
            $assertedType->getDefinition(),
            $location,
            $matchExactly,
            $discoveredErrors
        );
    }

    private static function testTypeMatch(
        IType $expressionType,
        IType $assertedType,
        ?ILocation $location,
        bool $matchExactly,
        &$discoveredErrors
    ): bool {
        if ($matchExactly) {
            if (!EdmElementComparer::isEquivalentTo($expressionType, $assertedType)) {
                $discoveredErrors = [
                    new EdmError(
                        $location,
                        EdmErrorCode::ExpressionNotValidForTheAssertedType(),
                        StringConst::EdmModel_Validator_Semantic_ExpressionNotValidForTheAssertedType()
                    )
                ];
                return false;
            }
        } else {
            // A bad type matches anything (so as to avoid generating spurious errors).
            if ($expressionType->getTypeKind()->isNone() || 0 !== count($expressionType->getErrors())) {
                $discoveredErrors = [];
                return true;
            }

            if ($expressionType->getTypeKind()->isPrimitive() && $assertedType->getTypeKind()->isPrimitive()) {
                $primitiveExpressionType = $expressionType;
                $primitiveAssertedType   = $assertedType ;
                assert($primitiveExpressionType instanceof IPrimitiveType);
                assert($primitiveAssertedType instanceof IPrimitiveType);
                if (!self::promotesTo(
                    $primitiveExpressionType->getPrimitiveKind(),
                    $primitiveAssertedType->getPrimitiveKind()
                )) {
                    $discoveredErrors = [
                        new EdmError(
                            $location,
                            EdmErrorCode::ExpressionPrimitiveKindNotValidForAssertedType(),
                            StringConst::EdmModel_Validator_Semantic_ExpressionPrimitiveKindCannotPromoteToAssertedType(
                                ToTraceString::ToTraceString(
                                    $expressionType
                                ),
                                ToTraceString::ToTraceString(
                                    $assertedType
                                )
                            )
                        )
                    ];
                    return false;
                }
            } else {
                assert($expressionType instanceof IType);
                if (!$expressionType->IsOrInheritsFrom($assertedType)) {
                    $discoveredErrors = [
                        new EdmError(
                            $location,
                            EdmErrorCode::ExpressionNotValidForTheAssertedType(),
                            StringConst::EdmModel_Validator_Semantic_ExpressionNotValidForTheAssertedType()
                        )
                    ];
                    return false;
                }
            }
        }

        $discoveredErrors = [];
        return true;
    }

    private static function testNullabilityMatch(
        ITypeReference $expressionType,
        ITypeReference $assertedType,
        ?ILocation $location,
        &$discoveredErrors
    ): bool {
        if (!$assertedType->getNullable() && $expressionType->getNullable()) {
            $discoveredErrors = [
                new EdmError(
                    $location,
                    EdmErrorCode::CannotAssertNullableTypeAsNonNullableType(),
                    StringConst::EdmModel_Validator_Semantic_CannotAssertNullableTypeAsNonNullableType(
                        $expressionType->fullName()
                    )
                )
            ];
            return false;
        }

        $discoveredErrors = [];
        return true;
    }

    private static function promotesTo(PrimitiveTypeKind $startingKind, PrimitiveTypeKind $target): bool
    {
        $promotionMap = self::getPromotionMap();
        return $startingKind === $target ||
            (
                isset($promotionMap[$startingKind->getValue()]) &&
                isset($promotionMap[$startingKind->getValue()][$target->getValue()]) &&
                $promotionMap[$startingKind->getValue()][$target->getValue()]
            );
    }
}
