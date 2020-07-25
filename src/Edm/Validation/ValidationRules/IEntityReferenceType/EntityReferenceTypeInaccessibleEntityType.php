<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityReferenceType;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\Helpers;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;

/**
 * Validates that the entity type wrapped in this entity reference can be found through the model being validated.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityReferenceType
 */
class EntityReferenceTypeInaccessibleEntityType extends EntityReferenceTypeRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $entityReferenceType)
    {
        assert($entityReferenceType instanceof IEntityReferenceType);
        $entityType = $entityReferenceType->getEntityType();
        EdmUtil::checkArgumentNull($entityType, 'entityReferenceType->getEntityType');
        if ($context->checkIsBad($entityType)) {
            EdmUtil::checkArgumentNull($entityReferenceType->Location(), 'entityReferenceType->Location');
            Helpers::checkForUnreachableTypeError($context, $entityType, $entityReferenceType->Location());
        }
    }
}
