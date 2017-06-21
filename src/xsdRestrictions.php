<?php
/**
 * Created by PhpStorm.
 * User: Doc
 * Date: 4/30/2017
 * Time: 1:29 PM
 */

namespace AlgoWeb\ODataMetadata;

/**
 * trait xsdRestrictions
 *
 * @package AlgoWeb\ODataMetadata
 */
trait xsdRestrictions
{
    /**
     * Checks if it is a valid NCName
     *
     * <xsd:simpleType name="NCName" id="NCName">
     *     <xsd:restriction base="xsd:Name">
     *         <xsd:pattern value="[\i-[:]][\c-[:]]*"/>
     *     </xsd:restriction>
     * </xsd:simpleType>
     *
     * @param  string $string the string to check
     * @return bool if it is valid
     */
    protected function isNCName($string)
    {
        return $this->matchesRegexPattern("[\i-[:]][\c-[:]]*", $string) && $this->isName($string);
    }

    /**
     * Checks a pattern against a string
     *
     * @param  string $pattern the regex pattern
     * @param  string $string  the string to check
     * @return bool true if string matches pattern
     */
    protected function matchesRegexPattern($pattern, $string)
    {
        $matches = null;
        return (1 == preg_match($pattern, $string, $matches) && $string == $matches[0]);
    }

    /**
     * Checks if is ivalid Name
     *
     * <xsd:simpleType name="Name" id="Name">
     *     <xsd:restriction base="xsd:token">
     *         <xsd:pattern value="\i\c*"/>
     *     </xsd:restriction>
     * </xsd:simpleType>
     *
     * @param  string $string the string to check
     * @return bool  if it is valid
     */
    protected function isName($string)
    {
        return $this->matchesRegexPattern("\i\c*", $string);
    }
}
