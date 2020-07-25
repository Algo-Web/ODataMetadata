<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IModel;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\ValidationHelper;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Structure\HashSetInternal;

/**
 * Validates that there are not duplicate properties in an entity key.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IModel
 */
class ModelDuplicateEntityContainerName extends ModelRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $model)
    {
        assert($model instanceof IModel);
        $entityContainerNameList = new HashSetInternal();
        foreach ($model->getSchemaElements() as $item) {
            if (!$item instanceof IEntityContainer) {
                continue;
            }
            ValidationHelper::addMemberNameToHashSet(
                $item,
                $entityContainerNameList,
                $context,
                EdmErrorCode::DuplicateEntityContainerName(),
                StringConst::EdmModel_Validator_Semantic_DuplicateEntityContainerName($item->getName()),
                false
            );
        }
    }
}
