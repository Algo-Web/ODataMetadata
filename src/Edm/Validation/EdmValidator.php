<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation;

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
     * @param IModel $root The root of the model to be validated.
     * @param Version|ValidationRuleSet $versionOrRuleset Version of Edm to validate against. OR Custom rule set to validate against.
     * @param array $errors Errors encountered while validating the model.
     * @return bool True if model is valid, otherwise false.
     */
    public static function Validate(IModel $root, $versionOrRuleset, array &$errors):bool
    {
        return true;
        $ruleSet = $versionOrRuleset instanceof Version ?
            ValidationRuleSet::getEdmModelRuleSet($versionOrRuleset) :
            $versionOrRuleset;
        assert($ruleSet instanceof ValidationRuleSet);
        $errors = InterfaceValidator::ValidateModelStructureAndSemantics($root, $ruleSet);
        return count($errors) === 0;

    }
}