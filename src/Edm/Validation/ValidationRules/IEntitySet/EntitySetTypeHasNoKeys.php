<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that there is no entity set whose entity type has no key.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet
 */
class EntitySetTypeHasNoKeys extends EntitySetRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $entitySet)
    {
        assert($entitySet instanceof IEntitySet);
        if ((
            $entitySet->getElementType()->key() === null ||
                count($entitySet->getElementType()->key()) !== 0
        ) &&
            !$context->checkIsBad($entitySet->getElementType())) {
            EdmUtil::checkArgumentNull($entitySet->location(), 'entitySet->Location');
            $context->addError(
                $entitySet->location(),
                EdmErrorCode::EntitySetTypeHasNoKeys(),
                StringConst::EdmModel_Validator_Semantic_EntitySetTypeHasNoKeys(
                    $entitySet->getName(),
                    $entitySet->getElementType()->getName()
                )
            );
        }
    }
}
