<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\INavigationTargetMapping;

class VisitorOfIEntitySet extends VisitorOfT
{
    protected function visitT($item, array &$followup, array &$references): ?iterable
    {
        assert($item instanceof IEntitySet);
        $errors = [];

        $references[] = $item->getElementType();

        // Navigation targets are not EDM elements, so we expand and process them here instead of adding them as
        // followups.
        $navTargetMappings = [];
        InterfaceValidator::processEnumerable(
            $item,
            $item->getNavigationTargets(),
            'NavigationTargets',
            $navTargetMappings,
            $errors
        );
        /** @var INavigationTargetMapping $navTargetMapping */
        foreach ($navTargetMappings as $navTargetMapping) {
            $references[] = $navTargetMapping->getNavigationProperty();

            $references[] = $navTargetMapping->getTargetEntitySet();
        }

        return $errors;
    }

    public function forType(): string
    {
        return IEntitySet::class;
    }
}
