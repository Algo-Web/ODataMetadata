<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Structure\HashSetInternal;

class VisitorOfIStructuredType extends VisitorOfT
{
    protected function visitT($type, array &$followup, array &$references): ?iterable
    {
        assert($type instanceof IStructuredType);
        $errors = [];
        InterfaceValidator::processEnumerable(
            $type,
            $type->getDeclaredProperties(),
            'DeclaredProperties',
            $followup,
            $errors
        );

        if (null !== $type->getBaseType()) {
            $visitedTypes   = new HashSetInternal();
            $visitedTypes->add($type);
            /** @var IStructuredType|null $currentBaseType */
            for ($currentBaseType = $type->getBaseType(); null !== $currentBaseType; $currentBaseType = $currentBaseType->getBaseType()
            ) {
                if ($visitedTypes->contains($currentBaseType)) {
                    $typeName = $type instanceof ISchemaType ? $type->fullName() : get_class($type);
                    InterfaceValidator::collectErrors(
                        new EdmError(
                            InterfaceValidator::getLocation($type),
                            EdmErrorCode::InterfaceCriticalCycleInTypeHierarchy(),
                            StringConst::EdmModel_Validator_Syntactic_InterfaceCriticalCycleInTypeHierarchy($typeName)
                        ),
                        $errors
                    );
                    break;
                }
            }

            $references[] = $type->getBaseType();
        }

        return $errors;
    }

    public function forType(): string
    {
        return IStructuredType::class;
    }
}
