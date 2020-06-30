<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Enums\ContainerElementKind;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainerElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;

final class VisitorOfIEntityContainerElement extends VisitorOfT
{
    protected function VisitT($item, array &$followup, array &$references): ?iterable
    {
        assert($item instanceof IEntityContainerElement);
        $termKindError = null;
        switch ($item->getContainerElementKind()) {
            case ContainerElementKind::EntitySet():
                $termKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($item, $item->getContainerElementKind(), 'ContainerElementKind', IEntitySet::class);
                break;

            case ContainerElementKind::FunctionImport():
                $termKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError($item, $item->getContainerElementKind(), 'ContainerElementKind', IFunctionImport::class);
                break;

            case ContainerElementKind::None():
                break;
            default:
                $termKindError = InterfaceValidator::CreateEnumPropertyOutOfRangeError($item, $item->getContainerElementKind(), 'ContainerElementKind');
                break;
        }

        return null !== $termKindError ? [ $termKindError ] : null;
    }

    public function forType(): string
    {
        return IEntityContainerElement::class;
    }
}
