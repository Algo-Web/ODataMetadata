<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

use AlgoWeb\ODataMetadata\xsdRestrictions;

trait TSimpleIdentifierTrait
{
    protected static $v3SimpleIdentifierCache = [];
    protected static $v3SimpleIdentifierRegex = '/[\p{L}\p{Nl}][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}/';

    use xsdRestrictions;

    public function isTSimpleIdentifierValid($string)
    {
        if (!(is_string($string) && (trim($string) == $string) && 480 >= strlen($string))) {
            return false;
        }
        if (isset(static::$v3SimpleIdentifierCache[$string])) {
            return static::$v3SimpleIdentifierCache[$string];
        }
        //The below pattern represents the allowed identifiers in ECMA specification
        /*
         * Match a single character present in the list below [\p{L}\p{Nl}]
         * \p{L} matches any kind of letter from any language
         * \p{Nl} matches a number that looks like a letter, such as a Roman numeral
         * Match a single character present in the list below [\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}
         * {0,} Quantifier — Matches between zero and unlimited times, as many times as possible,
         * giving back as needed (greedy)
         * \p{L} matches any kind of letter from any language
         * \p{Nl} matches a number that looks like a letter, such as a Roman numeral
         * \p{Nd} matches a digit zero through nine in any script except ideographic scripts
         * \p{Mn} matches a character intended to be combined with another character without taking up extra space
         * (e.g. accents, umlauts, etc.)
         * \p{Mc} matches a character intended to be combined with another character that takes up extra space
         * (vowel signs in many Eastern languages)
         * \p{Pc} matches a punctuation character such as an underscore that connects words
         * \p{Cf} matches invisible formatting indicator
         */
        $result = $this->matchesRegexPattern(static::$v3SimpleIdentifierRegex, $string);
        static::$v3SimpleIdentifierCache[$string] = $result;
        return $result;
    }
}
