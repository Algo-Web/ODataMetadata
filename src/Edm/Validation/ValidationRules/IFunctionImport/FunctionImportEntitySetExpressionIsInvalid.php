<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that the entity set of a function import is defined using a path or an entity set reference expression.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport
 */
class FunctionImportEntitySetExpressionIsInvalid extends FunctionImportRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $functionImport)
    {
        assert($functionImport instanceof IFunctionImport);
        if ($functionImport->getEntitySet() != null)
        {
            if (
                !$functionImport->getEntitySet()->getExpressionKind()->isEntitySetReference() &&
                !$functionImport->getEntitySet()->getExpressionKind()->isPath()
            )
            {
                $context->AddError(
                    $functionImport->Location(),
                    EdmErrorCode::FunctionImportEntitySetExpressionIsInvalid(),
                    StringConst::EdmModel_Validator_Semantic_FunctionImportEntitySetExpressionKindIsInvalid(
                        $functionImport->getName(),
                        $functionImport->getEntitySet()->getExpressionKind()->getKey())
                );
            }
            else
            {
                /**
                 * @var IEntitySet $entitySet;
                 */
                $entitySet = null;
                /**
                 * @var IFunctionParameter $parameter
                 */
                $parameter = null;
                /**
                 * @var INavigationProperty[] $path
                 */
                $path = null;
                if (
                    !$functionImport->TryGetStaticEntitySet($entitySet) &&
                    !$functionImport->TryGetRelativeEntitySetPath($context->getModel(), $parameter, $path)
                )
                {
                    $context->AddError(
                        $functionImport->Location(),
                        EdmErrorCode::FunctionImportEntitySetExpressionIsInvalid(),
                        StringConst::EdmModel_Validator_Semantic_FunctionImportEntitySetExpressionIsInvalid($functionImport->getName()));
                }
            }
        }    }
}