<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\StringConst;

class VisitorOfIStructuredType extends VisitorOfT
{
    protected function VisitT($type, array &$followup, array &$references): iterable
    {
        assert($type instanceof IStructuredType);
        $errors = null;
        InterfaceValidator::ProcessEnumerable($type, $type->getDeclaredProperties(), 'DeclaredProperties', $followup, $errors);

        if ($type->getBaseType() != null) {
            $visitedTypes   = [];
            $visitedTypes[] = $type;
            /**
             * @var IStructuredType|null $currentBaseType
             */
            for ($currentBaseType = $type->getBaseType(); $currentBaseType != null; $currentBaseType = $currentBaseType->getBaseType()) {
                if (in_array($currentBaseType, $visitedTypes)) {
                    $typeName = $type instanceof ISchemaType ? $type->FullName() : get_class($type);
                    InterfaceValidator::CollectErrors(
                        new EdmError(
                            InterfaceValidator::GetLocation($type),
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
