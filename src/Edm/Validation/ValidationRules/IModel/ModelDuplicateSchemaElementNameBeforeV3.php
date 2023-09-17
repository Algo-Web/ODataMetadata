<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IModel;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\ValidationHelper;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Helpers\EdmElementComparer;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Structure\HashSetInternal;

/**
 * Validates every schema element in the current model (except for entity containers) is unique across all referenced
 * models.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IModel
 */
class ModelDuplicateSchemaElementNameBeforeV3 extends ModelRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $model)
    {
        assert($model instanceof IModel);
        $nonFunctionNameList = new HashSetInternal();
        $functionDictionary  = [];
        $items               = $model->getSchemaElements();
        foreach ($items as $item) {
            $duplicate = false;
            $fullName  = $item->fullName();
            if (!$item->getSchemaElementKind()->isEntityContainer()) {
                $function = $item;
                if ($function instanceof IFunction) {
                    // If a non-function already exists with the same name, stop processing as a function, as it is
                    // irrelevant it will always be an error.
                    if ($nonFunctionNameList->contains($fullName)) {
                        $duplicate = true;
                    } else {
                        $functionList = null;
                        if (isset($functionDictionary[$fullName])) {
                            if (count(array_filter($functionDictionary[$fullName], function ($value) use ($function) {
                                return EdmElementComparer::isFunctionSignatureEquivalentTo($function, $value);
                            })) !== 0) {
                                $duplicate = true;
                            }
                        } else {
                            $functionDictionary[$fullName] = [];
                        }
                        $functionDictionary[$fullName][] = $function;
                    }

                    if (!$duplicate) {
                        $duplicate = ValidationHelper::functionOrNameExistsInReferencedModel(
                            $model,
                            $function,
                            $fullName,
                            false
                        );
                    }
                } else {
                    if (!$nonFunctionNameList->add($fullName)) {
                        $duplicate = true;
                    } else {
                        if (isset($functionDictionary[$fullName])) {
                            $duplicate = true;
                        } else {
                            $duplicate = ValidationHelper::itemExistsInReferencedModel($model, $fullName, false);
                        }
                    }
                }

                if ($duplicate) {
                    EdmUtil::checkArgumentNull($item->location(), 'item->Location');
                    $context->addError(
                        $item->location(),
                        EdmErrorCode::AlreadyDefined(),
                        StringConst::EdmModel_Validator_Semantic_SchemaElementNameAlreadyDefined($fullName)
                    );
                }
            }
        }
    }
}
