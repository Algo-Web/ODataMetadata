<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityReferenceType;


use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\Helpers;
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
        if (!$context->checkIsBad($entityReferenceType->getEntityType()))
        {
            Helpers::CheckForUnreachableTypeError($context, $entityReferenceType->getEntityType(), $entityReferenceType->Location());
        }
    }

}