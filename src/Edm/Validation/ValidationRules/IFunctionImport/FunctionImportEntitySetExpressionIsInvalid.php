<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
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
        EdmUtil::checkArgumentNull($functionImport->location(), 'functionImport->Location');
        if (null !== $functionImport->getEntitySet()) {
            if (!$functionImport->getEntitySet()->getExpressionKind()->isEntitySetReference() &&
                !$functionImport->getEntitySet()->getExpressionKind()->isPath()
            ) {
                $context->addError(
                    $functionImport->location(),
                    EdmErrorCode::FunctionImportEntitySetExpressionIsInvalid(),
                    StringConst::EdmModel_Validator_Semantic_FunctionImportEntitySetExpressionKindIsInvalid(
                        $functionImport->getName(),
                        $functionImport->getEntitySet()->getExpressionKind()->getKey()
                    )
                );
            } else {
                /** @var IEntitySet $entitySet */
                $entitySet = null;
                /** @var IFunctionParameter $parameter */
                $parameter = null;
                /** @var INavigationProperty[] $path */
                $path = null;
                if (!$functionImport->tryGetStaticEntitySet($entitySet) &&
                    !$functionImport->tryGetRelativeEntitySetPath($context->getModel(), $parameter, $path)
                ) {
                    $context->addError(
                        $functionImport->location(),
                        EdmErrorCode::FunctionImportEntitySetExpressionIsInvalid(),
                        StringConst::EdmModel_Validator_Semantic_FunctionImportEntitySetExpressionIsInvalid($functionImport->getName())
                    );
                }
            }
        }
    }
}
