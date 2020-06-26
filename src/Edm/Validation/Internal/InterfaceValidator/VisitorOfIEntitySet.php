<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;


use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\INavigationTargetMapping;

class VisitorOfIEntitySet extends VisitorOfT
{

    protected function VisitT($item, array &$followup, array &$references): iterable
    {
        assert($item instanceof IEntitySet);
        $errors = null;

        if ($item->getElementType() != null)
        {
            $references[] = $item->getElementType();
        }
        else
        {
            InterfaceValidator::CollectErrors(
                InterfaceValidator::CreatePropertyMustNotBeNullError(
                    $item,
                    "ElementType"
                ),
                $errors);
        }

        // Navigation targets are not EDM elements, so we expand and process them here instead of adding them as followups.
        $navTargetMappings = [];
        InterfaceValidator::ProcessEnumerable(
            $item,
            $item->getNavigationTargets(),
            "NavigationTargets",
            $navTargetMappings,
            $errors);
        /**
         * @var INavigationTargetMapping $navTargetMapping
         */
        foreach ($navTargetMappings as $navTargetMapping)
        {
            if ($navTargetMapping->getNavigationProperty() != null)
            {
                $references[] = $navTargetMapping->getNavigationProperty();
            }
            else
            {
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CreatePropertyMustNotBeNullError(
                        $navTargetMapping,
                        "NavigationProperty"
                    ),
                    $errors);
            }

            if ($navTargetMapping->getTargetEntitySet() != null)
            {
                $references[] = $navTargetMapping->getTargetEntitySet();
            }
            else
            {
                InterfaceValidator::CollectErrors(
                    InterfaceValidator::CreatePropertyMustNotBeNullError(
                        $navTargetMapping,
                        "TargetEntitySet"
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