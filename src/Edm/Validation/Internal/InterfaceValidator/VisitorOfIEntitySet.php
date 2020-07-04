<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\INavigationTargetMapping;

class VisitorOfIEntitySet extends VisitorOfT
{
    protected function VisitT($item, array &$followup, array &$references): ?iterable
    {
        assert($item instanceof IEntitySet);
        $errors = [];

        if (null !== $item->getElementType()) {
            $references[] = $item->getElementType();
        } else {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $item,
                    'ElementType'
                ),
                $errors
            );
        }

        // Navigation targets are not EDM elements, so we expand and process them here instead of adding them as
        // followups.
        $navTargetMappings = [];
        InterfaceValidator::ProcessEnumerable(
            $item,
            $item->getNavigationTargets(),
            'NavigationTargets',
            $navTargetMappings,
            $errors
        );
        /** @var INavigationTargetMapping $navTargetMapping */
        foreach ($navTargetMappings as $navTargetMapping) {
            if (null !== $navTargetMapping->getNavigationProperty()) {
                $references[] = $navTargetMapping->getNavigationProperty();
            } else {
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CreatePropertyMustNotBeNullError(
                        $navTargetMapping,
                        'NavigationProperty'
                    ),
                    $errors
                );
            }

            if (null !== $navTargetMapping->getTargetEntitySet()) {
                $references[] = $navTargetMapping->getTargetEntitySet();
            } else {
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CreatePropertyMustNotBeNullError(
                        $navTargetMapping,
                        'TargetEntitySet'
                    ),
                    $errors
                );
            }
        }

        return $errors;
    }

    public function forType(): string
    {
        return IEntitySet::class;
    }
}
