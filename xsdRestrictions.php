<?php
/**
 * Created by PhpStorm.
 * User: Doc
 * Date: 4/30/2017
 * Time: 1:29 PM
 */

namespace AlgoWeb\ODataMetadata;

/**
 * Class xsdRestrictions
 * @package AlgoWeb\ODataMetadata
 */
class xsdRestrictions
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
     * @param $string string the string to check
     * @return bool if it is valid
     */
    public function isNCName($string)
    {
        return (preg_match("[\i-[:]][\c-[:]]*", $string) == 1) && $this->isName($string);
    }

    /**
     * Checks if is ivalid Name
     *
     *
     * <xsd:simpleType name="Name" id="Name">
     *     <xsd:restriction base="xsd:token">
     *         <xsd:pattern value="\i\c*"/>
     *     </xsd:restriction>
     * </xsd:simpleType>
     *
     * @param $string string the string to check
     * @return bool  if it is valid
     */
    public function isName($string)
    {
        return (preg_match("\i\c*", $string) == 1);
    }
}