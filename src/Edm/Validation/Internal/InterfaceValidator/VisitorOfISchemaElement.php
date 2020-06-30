<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;

final class VisitorOfISchemaElement extends VisitorOfT
{
    protected function VisitT($item, array &$followup, array &$references): iterable
    {
        assert($item instanceof ISchemaElement);
        $errors =[];

        switch ($item->getSchemaElementKind()) {
                    case SchemaElementKind::TypeDefinition():
                        InterfaceValidator::CollectErrors(
                            InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                                $item,
                                $item->getSchemaElementKind(),
                                'SchemaElementKind',
                                ISchemaType::class
                            ),
                            $errors
                        );
                        break;

                    case SchemaElementKind::Function():
                        InterfaceValidator::CollectErrors(
                            InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                                $item,
                                $item->getSchemaElementKind(),
                                'SchemaElementKind',
                                IFunction::class
                            ),
                            $errors
                        );
                        break;

                    case SchemaElementKind::ValueTerm():
                        InterfaceValidator::CollectErrors(
                            InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                                $item,
                                $item->getSchemaElementKind(),
                                'SchemaElementKind',
                                IValueTerm::class
                            ),
                            $errors
                        );
                        break;

                    case SchemaElementKind::EntityContainer():
                        InterfaceValidator::CollectErrors(
                            InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                                $item,
                                $item->getSchemaElementKind(),
                                'SchemaElementKind',
                                IEntityContainer::class
                            ),
                            $errors
                        );
                        break;

                    case SchemaElementKind::None():
                        break;

                    default:
                        InterfaceValidator::CollectErrors(
                            InterfaceValidator::CreateEnumPropertyOutOfRangeError(
                                $item,
                                $item->getSchemaElementKind(),
                                'SchemaElementKind'
                            ),
                            $errors
                        );
                        break;
                }

        if ($item->getNamespace() == null) {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $item,
                    'Namespace'
                ),
                $errors
            );
        }

        return $errors;
    }

    public function forType(): string
    {
        return ISchemaElement::class;
    }
}
