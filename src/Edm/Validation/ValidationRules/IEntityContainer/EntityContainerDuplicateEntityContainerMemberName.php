<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityContainer;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\ValidationHelper;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Helpers\EdmElementComparer;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Structure\HashSetInternal;

/**
 * Validates that there are no duplicate names in an entity container.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityContainer
 */
class EntityContainerDuplicateEntityContainerMemberName extends EntityContainerRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $entityContainer)
    {
        assert($entityContainer instanceof IEntityContainer);
        $nonFunctionNameList = new HashSetInternal();
        $functionDictionary  = [];
        foreach ($entityContainer->getElements() as $item) {
            EdmUtil::checkArgumentNull($item->location(), 'item->Location');
            if ($item instanceof IFunctionImport) {
                $function = $item;
                if ($nonFunctionNameList->contains($item->getName())) {
                    $context->addError(
                        $item->location(),
                        EdmErrorCode::DuplicateEntityContainerMemberName(),
                        StringConst::EdmModel_Validator_Semantic_DuplicateEntityContainerMemberName($item->getName())
                    );
                }

                $functionList = null;
                if (isset($functionDictionary[$function->getName()])) {
                    $functionList = $functionDictionary[$function->getName()];
                    /** @var IFunctionImport $existingFunction */
                    foreach ($functionList as $existingFunction) {
                        if (EdmElementComparer::isFunctionSignatureEquivalentTo($function, $existingFunction)) {
                            $context->addError(
                                $item->location(),
                                EdmErrorCode::DuplicateEntityContainerMemberName(),
                                StringConst::EdmModel_Validator_Semantic_DuplicateEntityContainerMemberName($item->getName())
                            );
                            break;
                        }
                    }
                } else {
                    $functionList = [];
                }

                $functionList[]                           = $function;
                $functionDictionary[$function->getName()] = $functionList;
            } else {
                if (ValidationHelper::addMemberNameToHashSet(
                    $item,
                    $nonFunctionNameList,
                    $context,
                    EdmErrorCode::DuplicateEntityContainerMemberName(),
                    StringConst::EdmModel_Validator_Semantic_DuplicateEntityContainerMemberName($item->getName()),
                    false
                )) {
                    if (isset($functionDictionary[$item->getName()])) {
                        $context->addError(
                            $item->location(),
                            EdmErrorCode::DuplicateEntityContainerMemberName(),
                            StringConst::EdmModel_Validator_Semantic_DuplicateEntityContainerMemberName($item->getName())
                        );
                    }
                }
            }
        }
    }
}
