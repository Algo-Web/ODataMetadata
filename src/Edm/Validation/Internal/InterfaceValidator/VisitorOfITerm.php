<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;


use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Enums\TermKind;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;

class VisitorOfITerm extends VisitorOfT
{

    protected function VisitT($term, array &$followup, array &$references): iterable
    {
        assert($term instanceof ITerm);
        $termKindError = null;

        switch ($term->getTermKind())
        {
            case TermKind::Type():
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                        $term,
                        $term->getTermKind(),
                        "TermKind",
                        ISchemaType::class
                    ),
                    $termKindError
                );
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                        $term, $term->getTermKind(),
                        "TermKind",
                        IStructuredType::class
                    ),
                    $termKindError
                );
                break;

            case TermKind::Value():
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                        $term,
                        $term->getTermKind(),
                        "TermKind",
                        IValueTerm::class
                    ),
                    $termKindError
                );
                break;

            case TermKind::None():
                break;

            default:
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CreateInterfaceKindValueUnexpectedError(
                        $term,
                        $term->getTermKind()->getKey(),
                        "TermKind"
                    ),
                    $termKindError
                );
                break;
        }

        return $termKindError;
    }

    public function forType(): string
    {
        return ITerm::class;
    }
}