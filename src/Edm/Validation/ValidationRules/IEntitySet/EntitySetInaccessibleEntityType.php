<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\Helpers;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;

/**
 * Validates that the entity type of an entity set can be found from the model being validated.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet
 */
class EntitySetInaccessibleEntityType extends EntitySetRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $entitySet)
    {
        assert($entitySet instanceof IEntitySet);
        if (!$context->checkIsBad($entitySet->getElementType())) {
            Helpers::checkForUnreachableTypeError($context, $entitySet->getElementType(), $entitySet->location());
        }
    }
}
