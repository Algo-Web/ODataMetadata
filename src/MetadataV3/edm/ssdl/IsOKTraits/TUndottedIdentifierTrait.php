<?php
/**
 * Created by PhpStorm.
 * User: Doc
 * Date: 5/1/2017
 * Time: 9:09 PM
 */

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits;


class TUndottedIdentifierTrait
{
    public function isTUndottedIdentifierValid($string)
    {
        //      <!-- no periods -->
        $regex = '[^.]{1,}';
        return $this->matchesRegexPattern($regex, $string);
    }
}