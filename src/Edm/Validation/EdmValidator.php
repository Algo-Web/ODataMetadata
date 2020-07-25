<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Version;

/**
 * Collection of validation methods.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation
 */
abstract class EdmValidator
{
    /**
     * Validate the IEdmModel and all of its properties given certain version or Ruleset.
     *
     * @param  IModel                    $root             the root of the model to be validated
     * @param  Version|ValidationRuleSet $versionOrRuleset Version of Edm to validate against. OR Custom rule set to validate against.
     * @param  array                     $errors           errors encountered while validating the model
     * @throws \ReflectionException
     * @return bool                      true if model is valid, otherwise false
     */
    public static function validate(IModel $root, $versionOrRuleset, array &$errors): bool
    {
        $ruleSet = $versionOrRuleset instanceof Version ?
            ValidationRuleSet::getEdmModelRuleSet($versionOrRuleset) :
            $versionOrRuleset;
        assert($ruleSet instanceof ValidationRuleSet);
        $errors = InterfaceValidator::validateModelStructureAndSemantics($root, $ruleSet);
        return count($errors) === 0;
    }
}
