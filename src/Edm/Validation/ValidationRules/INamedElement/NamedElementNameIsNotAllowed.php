<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INamedElement;

use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\INamedElement;
use AlgoWeb\ODataMetadata\StringConst;

/**
 *  Validates that an element name matches the allowed pattern of names according to the CSDL spec.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEdmNamedElement
 */
class NamedElementNameIsNotAllowed extends NamedElementRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $item)
    {
        assert($item instanceof INamedElement);
        // Don't run this rule for IDirectValueAnnotation,
        // We validate the name of IEdmDirectionValueAnnotation in a separate validation rule,
        // DirectValueAnnotationHasXmlSerializableName.
        if ($item instanceof IDirectValueAnnotation) {
            return;
        }

        if (!EdmUtil::isNullOrWhiteSpaceInternal($item->getName()) &&
            mb_strlen($item->getName()) <= CsdlConstants::Max_NameLength && mb_strlen($item->getName()) > 0) {
            if (!EdmUtil::isValidUndottedName($item->getName())) {
                EdmUtil::checkArgumentNull($item->location(), 'item->Location');
                $context->addError(
                    $item->location(),
                    EdmErrorCode::InvalidName(),
                    StringConst::EdmModel_Validator_Syntactic_EdmModel_NameIsNotAllowed($item->getName())
                );
            }
        }
    }
}
