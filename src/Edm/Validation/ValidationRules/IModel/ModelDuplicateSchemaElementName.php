<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IModel;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\ValidationHelper;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Helpers\EdmElementComparer;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Structure\HashSetInternal;

/**
 * Validates every schema element in the current model is unique across all referenced models.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IModel
 */
class ModelDuplicateSchemaElementName extends ModelRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $model)
    {
        assert($model instanceof IModel);
        $nonFunctionNameList = new HashSetInternal();
        $functionDictionary = [];
        foreach ($model->getSchemaElements() as $item)
        {
            $duplicate = false;
            $fullName = $item->FullName();
            $function = $item;
            if ($function instanceof IFunction)
            {
                // If a non-function already exists with the same name, stop processing as a function, as it is irrelevant it will always be an error.
                if ($nonFunctionNameList->contains($fullName))
                {
                    $duplicate = true;
                }
                else
                {
                    $functionList = null;
                    if (isset($function[$fullName]))
                    {
                        if (count(array_filter($function[$fullName], [EdmElementComparer::class, 'isFunctionSignatureEquivalentTo'])) !== 0)
                        {
                            $duplicate = true;
                        }
                    }
                    else
                    {
                        $functionDictionary[$fullName] = [];
                    }
                    $functionDictionary[$fullName][] = $function;
                }

                if (!$duplicate)
                {
                    $duplicate = ValidationHelper::FunctionOrNameExistsInReferencedModel($model, $function, $fullName, true);
                }
            }
            else
            {
                if (!$nonFunctionNameList->add($fullName))
                {
                    $duplicate = true;
                }
                else
                {
                    if (isset($functionDictionary[$fullName]))
                    {
                        $duplicate = true;
                    }
                    else
                    {
                        $duplicate = ValidationHelper::ItemExistsInReferencedModel($model,$fullName, true);
                    }
                }
            }

            if ($duplicate)
            {
                $context->AddError(
                    $item->Location(),
                    EdmErrorCode::AlreadyDefined(),
                    StringConst::EdmModel_Validator_Semantic_SchemaElementNameAlreadyDefined($fullName)
                );
            }
        }
    }
}