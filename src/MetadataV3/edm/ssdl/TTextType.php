<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TTextType
 *
 * TODO: I don't understand enough about the schema to do this one.
 *   <xs:complexType name="TText" mixed="true">
 '       <xs:sequence>
 '           <xs:any namespace="##other" processContents="lax" minOccurs="0" maxOccurs="unbounded" />
 '       </xs:sequence>
 '       <xs:anyAttribute processContents="lax" namespace="##other" />
 '   </xs:complexType>
 *
 * XSD Type: TText
 */
class TTextType extends IsOK
{
    public function isOK(&$msg = null)
    {
        return true;
    }
}
