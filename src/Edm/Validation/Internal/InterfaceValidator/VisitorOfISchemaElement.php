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
    protected $lookup = [];

    public function __construct()
    {
        $this->lookup[SchemaElementKind::TypeDefinition()->getKey()] = ISchemaType::class;
        $this->lookup[SchemaElementKind::Function()->getKey()] = IFunction::class;
        $this->lookup[SchemaElementKind::ValueTerm()->getKey()] = IValueTerm::class;
        $this->lookup[SchemaElementKind::EntityContainer()->getKey()] = IEntityContainer::class;
    }

    protected function VisitT($item, array &$followup, array &$references): iterable
    {
        assert($item instanceof ISchemaElement);
        $errors = [];

        if (null === $item->getNamespace()) {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $item,
                    'Namespace'
                ),
                $errors
            );
        }

        $kind = $item->getSchemaElementKind();
        $key = $kind->getKey();

        if (array_key_exists($key, $this->lookup)) {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                    $item,
                    $item->getSchemaElementKind(),
                    'SchemaElementKind',
                    $this->lookup[$key]
                ),
                $errors
            );
        } else {
            switch ($kind) {
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
        }

        return $errors ?? [];
    }

    public function forType(): string
    {
        return ISchemaElement::class;
    }
}
