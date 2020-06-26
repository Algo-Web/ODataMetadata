<?php


namespace AlgoWeb\ODataMetadata\Util;


class XmlCharType
{
    #region "Constants"
    // Characters defined in the XML 1.0 Fourth Edition
    // Whitespace chars -- Section 2.3 [3]
    // Letters -- Appendix B [84]
    // Starting NCName characters -- Section 2.3 [5] (Starting Name characters without ':')
    // NCName characters -- Section 2.3 [4]          (Name characters without ':')
    // Character data characters -- Section 2.2 [2]
    // PubidChar ::=  #x20 | #xD | #xA | [a-zA-Z0-9] | [-'()+,./:=?;!*#@$_%] Section 2.3 of spec
    protected const  fWhitespace = 1;
    protected const  fLetter = 2;
    protected const  fNCStartNameSC = 4;
    protected const  fNCNameSC = 8;
    protected const  fCharData = 16;
    protected const  fNCNameXml4e = 32;
    protected const  fText = 64;
    protected const  fAttrValue = 128;

    protected const s_Whitespace =
        "\u{0009}\u{000a}\u{000d}\u{000d}  ";
    // XML 1.0 Fourth Edition definitions for name characters
    //
    protected const  s_LetterXml4e =
        "\u{0041}\u{005a}\u{0061}\u{007a}\u{00c0}\u{00d6}\u{00d8}\u{00f6}" .
        "\u{00f8}\u{0131}\u{0134}\u{013e}\u{0141}\u{0148}\u{014a}\u{017e}" .
        "\u{0180}\u{01c3}\u{01cd}\u{01f0}\u{01f4}\u{01f5}\u{01fa}\u{0217}" .
        "\u{0250}\u{02a8}\u{02bb}\u{02c1}\u{0386}\u{0386}\u{0388}\u{038a}" .
        "\u{038c}\u{038c}\u{038e}\u{03a1}\u{03a3}\u{03ce}\u{03d0}\u{03d6}" .
        "\u{03da}\u{03da}\u{03dc}\u{03dc}\u{03de}\u{03de}\u{03e0}\u{03e0}" .
        "\u{03e2}\u{03f3}\u{0401}\u{040c}\u{040e}\u{044f}\u{0451}\u{045c}" .
        "\u{045e}\u{0481}\u{0490}\u{04c4}\u{04c7}\u{04c8}\u{04cb}\u{04cc}" .
        "\u{04d0}\u{04eb}\u{04ee}\u{04f5}\u{04f8}\u{04f9}\u{0531}\u{0556}" .
        "\u{0559}\u{0559}\u{0561}\u{0586}\u{05d0}\u{05ea}\u{05f0}\u{05f2}" .
        "\u{0621}\u{063a}\u{0641}\u{064a}\u{0671}\u{06b7}\u{06ba}\u{06be}" .
        "\u{06c0}\u{06ce}\u{06d0}\u{06d3}\u{06d5}\u{06d5}\u{06e5}\u{06e6}" .
        "\u{0905}\u{0939}\u{093d}\u{093d}\u{0958}\u{0961}\u{0985}\u{098c}" .
        "\u{098f}\u{0990}\u{0993}\u{09a8}\u{09aa}\u{09b0}\u{09b2}\u{09b2}" .
        "\u{09b6}\u{09b9}\u{09dc}\u{09dd}\u{09df}\u{09e1}\u{09f0}\u{09f1}" .
        "\u{0a05}\u{0a0a}\u{0a0f}\u{0a10}\u{0a13}\u{0a28}\u{0a2a}\u{0a30}" .
        "\u{0a32}\u{0a33}\u{0a35}\u{0a36}\u{0a38}\u{0a39}\u{0a59}\u{0a5c}" .
        "\u{0a5e}\u{0a5e}\u{0a72}\u{0a74}\u{0a85}\u{0a8b}\u{0a8d}\u{0a8d}" .
        "\u{0a8f}\u{0a91}\u{0a93}\u{0aa8}\u{0aaa}\u{0ab0}\u{0ab2}\u{0ab3}" .
        "\u{0ab5}\u{0ab9}\u{0abd}\u{0abd}\u{0ae0}\u{0ae0}\u{0b05}\u{0b0c}" .
        "\u{0b0f}\u{0b10}\u{0b13}\u{0b28}\u{0b2a}\u{0b30}\u{0b32}\u{0b33}" .
        "\u{0b36}\u{0b39}\u{0b3d}\u{0b3d}\u{0b5c}\u{0b5d}\u{0b5f}\u{0b61}" .
        "\u{0b85}\u{0b8a}\u{0b8e}\u{0b90}\u{0b92}\u{0b95}\u{0b99}\u{0b9a}" .
        "\u{0b9c}\u{0b9c}\u{0b9e}\u{0b9f}\u{0ba3}\u{0ba4}\u{0ba8}\u{0baa}" .
        "\u{0bae}\u{0bb5}\u{0bb7}\u{0bb9}\u{0c05}\u{0c0c}\u{0c0e}\u{0c10}" .
        "\u{0c12}\u{0c28}\u{0c2a}\u{0c33}\u{0c35}\u{0c39}\u{0c60}\u{0c61}" .
        "\u{0c85}\u{0c8c}\u{0c8e}\u{0c90}\u{0c92}\u{0ca8}\u{0caa}\u{0cb3}" .
        "\u{0cb5}\u{0cb9}\u{0cde}\u{0cde}\u{0ce0}\u{0ce1}\u{0d05}\u{0d0c}" .
        "\u{0d0e}\u{0d10}\u{0d12}\u{0d28}\u{0d2a}\u{0d39}\u{0d60}\u{0d61}" .
        "\u{0e01}\u{0e2e}\u{0e30}\u{0e30}\u{0e32}\u{0e33}\u{0e40}\u{0e45}" .
        "\u{0e81}\u{0e82}\u{0e84}\u{0e84}\u{0e87}\u{0e88}\u{0e8a}\u{0e8a}" .
        "\u{0e8d}\u{0e8d}\u{0e94}\u{0e97}\u{0e99}\u{0e9f}\u{0ea1}\u{0ea3}" .
        "\u{0ea5}\u{0ea5}\u{0ea7}\u{0ea7}\u{0eaa}\u{0eab}\u{0ead}\u{0eae}" .
        "\u{0eb0}\u{0eb0}\u{0eb2}\u{0eb3}\u{0ebd}\u{0ebd}\u{0ec0}\u{0ec4}" .
        "\u{0f40}\u{0f47}\u{0f49}\u{0f69}\u{10a0}\u{10c5}\u{10d0}\u{10f6}" .
        "\u{1100}\u{1100}\u{1102}\u{1103}\u{1105}\u{1107}\u{1109}\u{1109}" .
        "\u{110b}\u{110c}\u{110e}\u{1112}\u{113c}\u{113c}\u{113e}\u{113e}" .
        "\u{1140}\u{1140}\u{114c}\u{114c}\u{114e}\u{114e}\u{1150}\u{1150}" .
        "\u{1154}\u{1155}\u{1159}\u{1159}\u{115f}\u{1161}\u{1163}\u{1163}" .
        "\u{1165}\u{1165}\u{1167}\u{1167}\u{1169}\u{1169}\u{116d}\u{116e}" .
        "\u{1172}\u{1173}\u{1175}\u{1175}\u{119e}\u{119e}\u{11a8}\u{11a8}" .
        "\u{11ab}\u{11ab}\u{11ae}\u{11af}\u{11b7}\u{11b8}\u{11ba}\u{11ba}" .
        "\u{11bc}\u{11c2}\u{11eb}\u{11eb}\u{11f0}\u{11f0}\u{11f9}\u{11f9}" .
        "\u{1e00}\u{1e9b}\u{1ea0}\u{1ef9}\u{1f00}\u{1f15}\u{1f18}\u{1f1d}" .
        "\u{1f20}\u{1f45}\u{1f48}\u{1f4d}\u{1f50}\u{1f57}\u{1f59}\u{1f59}" .
        "\u{1f5b}\u{1f5b}\u{1f5d}\u{1f5d}\u{1f5f}\u{1f7d}\u{1f80}\u{1fb4}" .
        "\u{1fb6}\u{1fbc}\u{1fbe}\u{1fbe}\u{1fc2}\u{1fc4}\u{1fc6}\u{1fcc}" .
        "\u{1fd0}\u{1fd3}\u{1fd6}\u{1fdb}\u{1fe0}\u{1fec}\u{1ff2}\u{1ff4}" .
        "\u{1ff6}\u{1ffc}\u{2126}\u{2126}\u{212a}\u{212b}\u{212e}\u{212e}" .
        "\u{2180}\u{2182}\u{3007}\u{3007}\u{3021}\u{3029}\u{3041}\u{3094}" .
        "\u{30a1}\u{30fa}\u{3105}\u{312c}\u{4e00}\u{9fa5}\u{ac00}\u{d7a3}";

    protected const s_NCStartName =
        "\u{0041}\u{005a}\u{005f}\u{005f}\u{0061}\u{007a}" .
        "\u{00c0}\u{00d6}\u{00d8}\u{00f6}\u{00f8}\u{0131}\u{0134}\u{013e}" .
        "\u{0141}\u{0148}\u{014a}\u{017e}\u{0180}\u{01c3}\u{01cd}\u{01f0}" .
        "\u{01f4}\u{01f5}\u{01fa}\u{0217}\u{0250}\u{02a8}\u{02bb}\u{02c1}" .
        "\u{0386}\u{0386}\u{0388}\u{038a}\u{038c}\u{038c}\u{038e}\u{03a1}" .
        "\u{03a3}\u{03ce}\u{03d0}\u{03d6}\u{03da}\u{03da}\u{03dc}\u{03dc}" .
        "\u{03de}\u{03de}\u{03e0}\u{03e0}\u{03e2}\u{03f3}\u{0401}\u{040c}" .
        "\u{040e}\u{044f}\u{0451}\u{045c}\u{045e}\u{0481}\u{0490}\u{04c4}" .
        "\u{04c7}\u{04c8}\u{04cb}\u{04cc}\u{04d0}\u{04eb}\u{04ee}\u{04f5}" .
        "\u{04f8}\u{04f9}\u{0531}\u{0556}\u{0559}\u{0559}\u{0561}\u{0586}" .
        "\u{05d0}\u{05ea}\u{05f0}\u{05f2}\u{0621}\u{063a}\u{0641}\u{064a}" .
        "\u{0671}\u{06b7}\u{06ba}\u{06be}\u{06c0}\u{06ce}\u{06d0}\u{06d3}" .
        "\u{06d5}\u{06d5}\u{06e5}\u{06e6}\u{0905}\u{0939}\u{093d}\u{093d}" .
        "\u{0958}\u{0961}\u{0985}\u{098c}\u{098f}\u{0990}\u{0993}\u{09a8}" .
        "\u{09aa}\u{09b0}\u{09b2}\u{09b2}\u{09b6}\u{09b9}\u{09dc}\u{09dd}" .
        "\u{09df}\u{09e1}\u{09f0}\u{09f1}\u{0a05}\u{0a0a}\u{0a0f}\u{0a10}" .
        "\u{0a13}\u{0a28}\u{0a2a}\u{0a30}\u{0a32}\u{0a33}\u{0a35}\u{0a36}" .
        "\u{0a38}\u{0a39}\u{0a59}\u{0a5c}\u{0a5e}\u{0a5e}\u{0a72}\u{0a74}" .
        "\u{0a85}\u{0a8b}\u{0a8d}\u{0a8d}\u{0a8f}\u{0a91}\u{0a93}\u{0aa8}" .
        "\u{0aaa}\u{0ab0}\u{0ab2}\u{0ab3}\u{0ab5}\u{0ab9}\u{0abd}\u{0abd}" .
        "\u{0ae0}\u{0ae0}\u{0b05}\u{0b0c}\u{0b0f}\u{0b10}\u{0b13}\u{0b28}" .
        "\u{0b2a}\u{0b30}\u{0b32}\u{0b33}\u{0b36}\u{0b39}\u{0b3d}\u{0b3d}" .
        "\u{0b5c}\u{0b5d}\u{0b5f}\u{0b61}\u{0b85}\u{0b8a}\u{0b8e}\u{0b90}" .
        "\u{0b92}\u{0b95}\u{0b99}\u{0b9a}\u{0b9c}\u{0b9c}\u{0b9e}\u{0b9f}" .
        "\u{0ba3}\u{0ba4}\u{0ba8}\u{0baa}\u{0bae}\u{0bb5}\u{0bb7}\u{0bb9}" .
        "\u{0c05}\u{0c0c}\u{0c0e}\u{0c10}\u{0c12}\u{0c28}\u{0c2a}\u{0c33}" .
        "\u{0c35}\u{0c39}\u{0c60}\u{0c61}\u{0c85}\u{0c8c}\u{0c8e}\u{0c90}" .
        "\u{0c92}\u{0ca8}\u{0caa}\u{0cb3}\u{0cb5}\u{0cb9}\u{0cde}\u{0cde}" .
        "\u{0ce0}\u{0ce1}\u{0d05}\u{0d0c}\u{0d0e}\u{0d10}\u{0d12}\u{0d28}" .
        "\u{0d2a}\u{0d39}\u{0d60}\u{0d61}\u{0e01}\u{0e2e}\u{0e30}\u{0e30}" .
        "\u{0e32}\u{0e33}\u{0e40}\u{0e45}\u{0e81}\u{0e82}\u{0e84}\u{0e84}" .
        "\u{0e87}\u{0e88}\u{0e8a}\u{0e8a}\u{0e8d}\u{0e8d}\u{0e94}\u{0e97}" .
        "\u{0e99}\u{0e9f}\u{0ea1}\u{0ea3}\u{0ea5}\u{0ea5}\u{0ea7}\u{0ea7}" .
        "\u{0eaa}\u{0eab}\u{0ead}\u{0eae}\u{0eb0}\u{0eb0}\u{0eb2}\u{0eb3}" .
        "\u{0ebd}\u{0ebd}\u{0ec0}\u{0ec4}\u{0f40}\u{0f47}\u{0f49}\u{0f69}" .
        "\u{10a0}\u{10c5}\u{10d0}\u{10f6}\u{1100}\u{1100}\u{1102}\u{1103}" .
        "\u{1105}\u{1107}\u{1109}\u{1109}\u{110b}\u{110c}\u{110e}\u{1112}" .
        "\u{113c}\u{113c}\u{113e}\u{113e}\u{1140}\u{1140}\u{114c}\u{114c}" .
        "\u{114e}\u{114e}\u{1150}\u{1150}\u{1154}\u{1155}\u{1159}\u{1159}" .
        "\u{115f}\u{1161}\u{1163}\u{1163}\u{1165}\u{1165}\u{1167}\u{1167}" .
        "\u{1169}\u{1169}\u{116d}\u{116e}\u{1172}\u{1173}\u{1175}\u{1175}" .
        "\u{119e}\u{119e}\u{11a8}\u{11a8}\u{11ab}\u{11ab}\u{11ae}\u{11af}" .
        "\u{11b7}\u{11b8}\u{11ba}\u{11ba}\u{11bc}\u{11c2}\u{11eb}\u{11eb}" .
        "\u{11f0}\u{11f0}\u{11f9}\u{11f9}\u{1e00}\u{1e9b}\u{1ea0}\u{1ef9}" .
        "\u{1f00}\u{1f15}\u{1f18}\u{1f1d}\u{1f20}\u{1f45}\u{1f48}\u{1f4d}" .
        "\u{1f50}\u{1f57}\u{1f59}\u{1f59}\u{1f5b}\u{1f5b}\u{1f5d}\u{1f5d}" .
        "\u{1f5f}\u{1f7d}\u{1f80}\u{1fb4}\u{1fb6}\u{1fbc}\u{1fbe}\u{1fbe}" .
        "\u{1fc2}\u{1fc4}\u{1fc6}\u{1fcc}\u{1fd0}\u{1fd3}\u{1fd6}\u{1fdb}" .
        "\u{1fe0}\u{1fec}\u{1ff2}\u{1ff4}\u{1ff6}\u{1ffc}\u{2126}\u{2126}" .
        "\u{212a}\u{212b}\u{212e}\u{212e}\u{2180}\u{2182}\u{3007}\u{3007}" .
        "\u{3021}\u{3029}\u{3041}\u{3094}\u{30a1}\u{30fa}\u{3105}\u{312c}" .
        "\u{4e00}\u{9fa5}\u{ac00}\u{d7a3}";
    protected const s_NCName =
        "\u{002d}\u{002e}\u{0030}\u{0039}\u{0041}\u{005a}\u{005f}\u{005f}" .
        "\u{0061}\u{007a}\u{00b7}\u{00b7}\u{00c0}\u{00d6}\u{00d8}\u{00f6}" .
        "\u{00f8}\u{0131}\u{0134}\u{013e}\u{0141}\u{0148}\u{014a}\u{017e}" .
        "\u{0180}\u{01c3}\u{01cd}\u{01f0}\u{01f4}\u{01f5}\u{01fa}\u{0217}" .
        "\u{0250}\u{02a8}\u{02bb}\u{02c1}\u{02d0}\u{02d1}\u{0300}\u{0345}" .
        "\u{0360}\u{0361}\u{0386}\u{038a}\u{038c}\u{038c}\u{038e}\u{03a1}" .
        "\u{03a3}\u{03ce}\u{03d0}\u{03d6}\u{03da}\u{03da}\u{03dc}\u{03dc}" .
        "\u{03de}\u{03de}\u{03e0}\u{03e0}\u{03e2}\u{03f3}\u{0401}\u{040c}" .
        "\u{040e}\u{044f}\u{0451}\u{045c}\u{045e}\u{0481}\u{0483}\u{0486}" .
        "\u{0490}\u{04c4}\u{04c7}\u{04c8}\u{04cb}\u{04cc}\u{04d0}\u{04eb}" .
        "\u{04ee}\u{04f5}\u{04f8}\u{04f9}\u{0531}\u{0556}\u{0559}\u{0559}" .
        "\u{0561}\u{0586}\u{0591}\u{05a1}\u{05a3}\u{05b9}\u{05bb}\u{05bd}" .
        "\u{05bf}\u{05bf}\u{05c1}\u{05c2}\u{05c4}\u{05c4}\u{05d0}\u{05ea}" .
        "\u{05f0}\u{05f2}\u{0621}\u{063a}\u{0640}\u{0652}\u{0660}\u{0669}" .
        "\u{0670}\u{06b7}\u{06ba}\u{06be}\u{06c0}\u{06ce}\u{06d0}\u{06d3}" .
        "\u{06d5}\u{06e8}\u{06ea}\u{06ed}\u{06f0}\u{06f9}\u{0901}\u{0903}" .
        "\u{0905}\u{0939}\u{093c}\u{094d}\u{0951}\u{0954}\u{0958}\u{0963}" .
        "\u{0966}\u{096f}\u{0981}\u{0983}\u{0985}\u{098c}\u{098f}\u{0990}" .
        "\u{0993}\u{09a8}\u{09aa}\u{09b0}\u{09b2}\u{09b2}\u{09b6}\u{09b9}" .
        "\u{09bc}\u{09bc}\u{09be}\u{09c4}\u{09c7}\u{09c8}\u{09cb}\u{09cd}" .
        "\u{09d7}\u{09d7}\u{09dc}\u{09dd}\u{09df}\u{09e3}\u{09e6}\u{09f1}" .
        "\u{0a02}\u{0a02}\u{0a05}\u{0a0a}\u{0a0f}\u{0a10}\u{0a13}\u{0a28}" .
        "\u{0a2a}\u{0a30}\u{0a32}\u{0a33}\u{0a35}\u{0a36}\u{0a38}\u{0a39}" .
        "\u{0a3c}\u{0a3c}\u{0a3e}\u{0a42}\u{0a47}\u{0a48}\u{0a4b}\u{0a4d}" .
        "\u{0a59}\u{0a5c}\u{0a5e}\u{0a5e}\u{0a66}\u{0a74}\u{0a81}\u{0a83}" .
        "\u{0a85}\u{0a8b}\u{0a8d}\u{0a8d}\u{0a8f}\u{0a91}\u{0a93}\u{0aa8}" .
        "\u{0aaa}\u{0ab0}\u{0ab2}\u{0ab3}\u{0ab5}\u{0ab9}\u{0abc}\u{0ac5}" .
        "\u{0ac7}\u{0ac9}\u{0acb}\u{0acd}\u{0ae0}\u{0ae0}\u{0ae6}\u{0aef}" .
        "\u{0b01}\u{0b03}\u{0b05}\u{0b0c}\u{0b0f}\u{0b10}\u{0b13}\u{0b28}" .
        "\u{0b2a}\u{0b30}\u{0b32}\u{0b33}\u{0b36}\u{0b39}\u{0b3c}\u{0b43}" .
        "\u{0b47}\u{0b48}\u{0b4b}\u{0b4d}\u{0b56}\u{0b57}\u{0b5c}\u{0b5d}" .
        "\u{0b5f}\u{0b61}\u{0b66}\u{0b6f}\u{0b82}\u{0b83}\u{0b85}\u{0b8a}" .
        "\u{0b8e}\u{0b90}\u{0b92}\u{0b95}\u{0b99}\u{0b9a}\u{0b9c}\u{0b9c}" .
        "\u{0b9e}\u{0b9f}\u{0ba3}\u{0ba4}\u{0ba8}\u{0baa}\u{0bae}\u{0bb5}" .
        "\u{0bb7}\u{0bb9}\u{0bbe}\u{0bc2}\u{0bc6}\u{0bc8}\u{0bca}\u{0bcd}" .
        "\u{0bd7}\u{0bd7}\u{0be7}\u{0bef}\u{0c01}\u{0c03}\u{0c05}\u{0c0c}" .
        "\u{0c0e}\u{0c10}\u{0c12}\u{0c28}\u{0c2a}\u{0c33}\u{0c35}\u{0c39}" .
        "\u{0c3e}\u{0c44}\u{0c46}\u{0c48}\u{0c4a}\u{0c4d}\u{0c55}\u{0c56}" .
        "\u{0c60}\u{0c61}\u{0c66}\u{0c6f}\u{0c82}\u{0c83}\u{0c85}\u{0c8c}" .
        "\u{0c8e}\u{0c90}\u{0c92}\u{0ca8}\u{0caa}\u{0cb3}\u{0cb5}\u{0cb9}" .
        "\u{0cbe}\u{0cc4}\u{0cc6}\u{0cc8}\u{0cca}\u{0ccd}\u{0cd5}\u{0cd6}" .
        "\u{0cde}\u{0cde}\u{0ce0}\u{0ce1}\u{0ce6}\u{0cef}\u{0d02}\u{0d03}" .
        "\u{0d05}\u{0d0c}\u{0d0e}\u{0d10}\u{0d12}\u{0d28}\u{0d2a}\u{0d39}" .
        "\u{0d3e}\u{0d43}\u{0d46}\u{0d48}\u{0d4a}\u{0d4d}\u{0d57}\u{0d57}" .
        "\u{0d60}\u{0d61}\u{0d66}\u{0d6f}\u{0e01}\u{0e2e}\u{0e30}\u{0e3a}" .
        "\u{0e40}\u{0e4e}\u{0e50}\u{0e59}\u{0e81}\u{0e82}\u{0e84}\u{0e84}" .
        "\u{0e87}\u{0e88}\u{0e8a}\u{0e8a}\u{0e8d}\u{0e8d}\u{0e94}\u{0e97}" .
        "\u{0e99}\u{0e9f}\u{0ea1}\u{0ea3}\u{0ea5}\u{0ea5}\u{0ea7}\u{0ea7}" .
        "\u{0eaa}\u{0eab}\u{0ead}\u{0eae}\u{0eb0}\u{0eb9}\u{0ebb}\u{0ebd}" .
        "\u{0ec0}\u{0ec4}\u{0ec6}\u{0ec6}\u{0ec8}\u{0ecd}\u{0ed0}\u{0ed9}" .
        "\u{0f18}\u{0f19}\u{0f20}\u{0f29}\u{0f35}\u{0f35}\u{0f37}\u{0f37}" .
        "\u{0f39}\u{0f39}\u{0f3e}\u{0f47}\u{0f49}\u{0f69}\u{0f71}\u{0f84}" .
        "\u{0f86}\u{0f8b}\u{0f90}\u{0f95}\u{0f97}\u{0f97}\u{0f99}\u{0fad}" .
        "\u{0fb1}\u{0fb7}\u{0fb9}\u{0fb9}\u{10a0}\u{10c5}\u{10d0}\u{10f6}" .
        "\u{1100}\u{1100}\u{1102}\u{1103}\u{1105}\u{1107}\u{1109}\u{1109}" .
        "\u{110b}\u{110c}\u{110e}\u{1112}\u{113c}\u{113c}\u{113e}\u{113e}" .
        "\u{1140}\u{1140}\u{114c}\u{114c}\u{114e}\u{114e}\u{1150}\u{1150}" .
        "\u{1154}\u{1155}\u{1159}\u{1159}\u{115f}\u{1161}\u{1163}\u{1163}" .
        "\u{1165}\u{1165}\u{1167}\u{1167}\u{1169}\u{1169}\u{116d}\u{116e}" .
        "\u{1172}\u{1173}\u{1175}\u{1175}\u{119e}\u{119e}\u{11a8}\u{11a8}" .
        "\u{11ab}\u{11ab}\u{11ae}\u{11af}\u{11b7}\u{11b8}\u{11ba}\u{11ba}" .
        "\u{11bc}\u{11c2}\u{11eb}\u{11eb}\u{11f0}\u{11f0}\u{11f9}\u{11f9}" .
        "\u{1e00}\u{1e9b}\u{1ea0}\u{1ef9}\u{1f00}\u{1f15}\u{1f18}\u{1f1d}" .
        "\u{1f20}\u{1f45}\u{1f48}\u{1f4d}\u{1f50}\u{1f57}\u{1f59}\u{1f59}" .
        "\u{1f5b}\u{1f5b}\u{1f5d}\u{1f5d}\u{1f5f}\u{1f7d}\u{1f80}\u{1fb4}" .
        "\u{1fb6}\u{1fbc}\u{1fbe}\u{1fbe}\u{1fc2}\u{1fc4}\u{1fc6}\u{1fcc}" .
        "\u{1fd0}\u{1fd3}\u{1fd6}\u{1fdb}\u{1fe0}\u{1fec}\u{1ff2}\u{1ff4}" .
        "\u{1ff6}\u{1ffc}\u{20d0}\u{20dc}\u{20e1}\u{20e1}\u{2126}\u{2126}" .
        "\u{212a}\u{212b}\u{212e}\u{212e}\u{2180}\u{2182}\u{3005}\u{3005}" .
        "\u{3007}\u{3007}\u{3021}\u{302f}\u{3031}\u{3035}\u{3041}\u{3094}" .
        "\u{3099}\u{309a}\u{309d}\u{309e}\u{30a1}\u{30fa}\u{30fc}\u{30fe}" .
        "\u{3105}\u{312c}\u{4e00}\u{9fa5}\u{ac00}\u{d7a3}";
    protected const s_NCNameXml4e =
        "\u{002d}\u{002e}\u{0030}\u{0039}\u{0041}\u{005a}\u{005f}\u{005f}" .
        "\u{0061}\u{007a}\u{00b7}\u{00b7}\u{00c0}\u{00d6}\u{00d8}\u{00f6}" .
        "\u{00f8}\u{0131}\u{0134}\u{013e}\u{0141}\u{0148}\u{014a}\u{017e}" .
        "\u{0180}\u{01c3}\u{01cd}\u{01f0}\u{01f4}\u{01f5}\u{01fa}\u{0217}" .
        "\u{0250}\u{02a8}\u{02bb}\u{02c1}\u{02d0}\u{02d1}\u{0300}\u{0345}" .
        "\u{0360}\u{0361}\u{0386}\u{038a}\u{038c}\u{038c}\u{038e}\u{03a1}" .
        "\u{03a3}\u{03ce}\u{03d0}\u{03d6}\u{03da}\u{03da}\u{03dc}\u{03dc}" .
        "\u{03de}\u{03de}\u{03e0}\u{03e0}\u{03e2}\u{03f3}\u{0401}\u{040c}" .
        "\u{040e}\u{044f}\u{0451}\u{045c}\u{045e}\u{0481}\u{0483}\u{0486}" .
        "\u{0490}\u{04c4}\u{04c7}\u{04c8}\u{04cb}\u{04cc}\u{04d0}\u{04eb}" .
        "\u{04ee}\u{04f5}\u{04f8}\u{04f9}\u{0531}\u{0556}\u{0559}\u{0559}" .
        "\u{0561}\u{0586}\u{0591}\u{05a1}\u{05a3}\u{05b9}\u{05bb}\u{05bd}" .
        "\u{05bf}\u{05bf}\u{05c1}\u{05c2}\u{05c4}\u{05c4}\u{05d0}\u{05ea}" .
        "\u{05f0}\u{05f2}\u{0621}\u{063a}\u{0640}\u{0652}\u{0660}\u{0669}" .
        "\u{0670}\u{06b7}\u{06ba}\u{06be}\u{06c0}\u{06ce}\u{06d0}\u{06d3}" .
        "\u{06d5}\u{06e8}\u{06ea}\u{06ed}\u{06f0}\u{06f9}\u{0901}\u{0903}" .
        "\u{0905}\u{0939}\u{093c}\u{094d}\u{0951}\u{0954}\u{0958}\u{0963}" .
        "\u{0966}\u{096f}\u{0981}\u{0983}\u{0985}\u{098c}\u{098f}\u{0990}" .
        "\u{0993}\u{09a8}\u{09aa}\u{09b0}\u{09b2}\u{09b2}\u{09b6}\u{09b9}" .
        "\u{09bc}\u{09bc}\u{09be}\u{09c4}\u{09c7}\u{09c8}\u{09cb}\u{09cd}" .
        "\u{09d7}\u{09d7}\u{09dc}\u{09dd}\u{09df}\u{09e3}\u{09e6}\u{09f1}" .
        "\u{0a02}\u{0a02}\u{0a05}\u{0a0a}\u{0a0f}\u{0a10}\u{0a13}\u{0a28}" .
        "\u{0a2a}\u{0a30}\u{0a32}\u{0a33}\u{0a35}\u{0a36}\u{0a38}\u{0a39}" .
        "\u{0a3c}\u{0a3c}\u{0a3e}\u{0a42}\u{0a47}\u{0a48}\u{0a4b}\u{0a4d}" .
        "\u{0a59}\u{0a5c}\u{0a5e}\u{0a5e}\u{0a66}\u{0a74}\u{0a81}\u{0a83}" .
        "\u{0a85}\u{0a8b}\u{0a8d}\u{0a8d}\u{0a8f}\u{0a91}\u{0a93}\u{0aa8}" .
        "\u{0aaa}\u{0ab0}\u{0ab2}\u{0ab3}\u{0ab5}\u{0ab9}\u{0abc}\u{0ac5}" .
        "\u{0ac7}\u{0ac9}\u{0acb}\u{0acd}\u{0ae0}\u{0ae0}\u{0ae6}\u{0aef}" .
        "\u{0b01}\u{0b03}\u{0b05}\u{0b0c}\u{0b0f}\u{0b10}\u{0b13}\u{0b28}" .
        "\u{0b2a}\u{0b30}\u{0b32}\u{0b33}\u{0b36}\u{0b39}\u{0b3c}\u{0b43}" .
        "\u{0b47}\u{0b48}\u{0b4b}\u{0b4d}\u{0b56}\u{0b57}\u{0b5c}\u{0b5d}" .
        "\u{0b5f}\u{0b61}\u{0b66}\u{0b6f}\u{0b82}\u{0b83}\u{0b85}\u{0b8a}" .
        "\u{0b8e}\u{0b90}\u{0b92}\u{0b95}\u{0b99}\u{0b9a}\u{0b9c}\u{0b9c}" .
        "\u{0b9e}\u{0b9f}\u{0ba3}\u{0ba4}\u{0ba8}\u{0baa}\u{0bae}\u{0bb5}" .
        "\u{0bb7}\u{0bb9}\u{0bbe}\u{0bc2}\u{0bc6}\u{0bc8}\u{0bca}\u{0bcd}" .
        "\u{0bd7}\u{0bd7}\u{0be7}\u{0bef}\u{0c01}\u{0c03}\u{0c05}\u{0c0c}" .
        "\u{0c0e}\u{0c10}\u{0c12}\u{0c28}\u{0c2a}\u{0c33}\u{0c35}\u{0c39}" .
        "\u{0c3e}\u{0c44}\u{0c46}\u{0c48}\u{0c4a}\u{0c4d}\u{0c55}\u{0c56}" .
        "\u{0c60}\u{0c61}\u{0c66}\u{0c6f}\u{0c82}\u{0c83}\u{0c85}\u{0c8c}" .
        "\u{0c8e}\u{0c90}\u{0c92}\u{0ca8}\u{0caa}\u{0cb3}\u{0cb5}\u{0cb9}" .
        "\u{0cbe}\u{0cc4}\u{0cc6}\u{0cc8}\u{0cca}\u{0ccd}\u{0cd5}\u{0cd6}" .
        "\u{0cde}\u{0cde}\u{0ce0}\u{0ce1}\u{0ce6}\u{0cef}\u{0d02}\u{0d03}" .
        "\u{0d05}\u{0d0c}\u{0d0e}\u{0d10}\u{0d12}\u{0d28}\u{0d2a}\u{0d39}" .
        "\u{0d3e}\u{0d43}\u{0d46}\u{0d48}\u{0d4a}\u{0d4d}\u{0d57}\u{0d57}" .
        "\u{0d60}\u{0d61}\u{0d66}\u{0d6f}\u{0e01}\u{0e2e}\u{0e30}\u{0e3a}" .
        "\u{0e40}\u{0e4e}\u{0e50}\u{0e59}\u{0e81}\u{0e82}\u{0e84}\u{0e84}" .
        "\u{0e87}\u{0e88}\u{0e8a}\u{0e8a}\u{0e8d}\u{0e8d}\u{0e94}\u{0e97}" .
        "\u{0e99}\u{0e9f}\u{0ea1}\u{0ea3}\u{0ea5}\u{0ea5}\u{0ea7}\u{0ea7}" .
        "\u{0eaa}\u{0eab}\u{0ead}\u{0eae}\u{0eb0}\u{0eb9}\u{0ebb}\u{0ebd}" .
        "\u{0ec0}\u{0ec4}\u{0ec6}\u{0ec6}\u{0ec8}\u{0ecd}\u{0ed0}\u{0ed9}" .
        "\u{0f18}\u{0f19}\u{0f20}\u{0f29}\u{0f35}\u{0f35}\u{0f37}\u{0f37}" .
        "\u{0f39}\u{0f39}\u{0f3e}\u{0f47}\u{0f49}\u{0f69}\u{0f71}\u{0f84}" .
        "\u{0f86}\u{0f8b}\u{0f90}\u{0f95}\u{0f97}\u{0f97}\u{0f99}\u{0fad}" .
        "\u{0fb1}\u{0fb7}\u{0fb9}\u{0fb9}\u{10a0}\u{10c5}\u{10d0}\u{10f6}" .
        "\u{1100}\u{1100}\u{1102}\u{1103}\u{1105}\u{1107}\u{1109}\u{1109}" .
        "\u{110b}\u{110c}\u{110e}\u{1112}\u{113c}\u{113c}\u{113e}\u{113e}" .
        "\u{1140}\u{1140}\u{114c}\u{114c}\u{114e}\u{114e}\u{1150}\u{1150}" .
        "\u{1154}\u{1155}\u{1159}\u{1159}\u{115f}\u{1161}\u{1163}\u{1163}" .
        "\u{1165}\u{1165}\u{1167}\u{1167}\u{1169}\u{1169}\u{116d}\u{116e}" .
        "\u{1172}\u{1173}\u{1175}\u{1175}\u{119e}\u{119e}\u{11a8}\u{11a8}" .
        "\u{11ab}\u{11ab}\u{11ae}\u{11af}\u{11b7}\u{11b8}\u{11ba}\u{11ba}" .
        "\u{11bc}\u{11c2}\u{11eb}\u{11eb}\u{11f0}\u{11f0}\u{11f9}\u{11f9}" .
        "\u{1e00}\u{1e9b}\u{1ea0}\u{1ef9}\u{1f00}\u{1f15}\u{1f18}\u{1f1d}" .
        "\u{1f20}\u{1f45}\u{1f48}\u{1f4d}\u{1f50}\u{1f57}\u{1f59}\u{1f59}" .
        "\u{1f5b}\u{1f5b}\u{1f5d}\u{1f5d}\u{1f5f}\u{1f7d}\u{1f80}\u{1fb4}" .
        "\u{1fb6}\u{1fbc}\u{1fbe}\u{1fbe}\u{1fc2}\u{1fc4}\u{1fc6}\u{1fcc}" .
        "\u{1fd0}\u{1fd3}\u{1fd6}\u{1fdb}\u{1fe0}\u{1fec}\u{1ff2}\u{1ff4}" .
        "\u{1ff6}\u{1ffc}\u{20d0}\u{20dc}\u{20e1}\u{20e1}\u{2126}\u{2126}" .
        "\u{212a}\u{212b}\u{212e}\u{212e}\u{2180}\u{2182}\u{3005}\u{3005}" .
        "\u{3007}\u{3007}\u{3021}\u{302f}\u{3031}\u{3035}\u{3041}\u{3094}" .
        "\u{3099}\u{309a}\u{309d}\u{309e}\u{30a1}\u{30fa}\u{30fc}\u{30fe}" .
        "\u{3105}\u{312c}\u{4e00}\u{9fa5}\u{ac00}\u{d7a3}";

    protected const s_CharData =
        "\u{0009}\u{000a}\u{000d}\u{000d}\u{0020}\u{d7ff}\u{e000}\u{fffd}";


    protected const s_Text = // TextChar = CharData - { 0xA | 0xD | '<' | '&' | 0x9 | ']' | 0xDC00 - 0xDFFF }
        "\u{0020}\u{0025}\u{0027}\u{003b}\u{003d}\u{005c}\u{005e}\u{d7ff}\u{e000}\u{fffd}";


    protected const s_AttrValue = // AttrValueChar = CharData - { 0xA | 0xD | 0x9 | '<' | '>' | '&' | '\'' | '"' | 0xDC00 - 0xDFFF }
        "\u{0020}\u{0021}\u{0023}\u{0025}\u{0028}\u{003b}\u{003d}\u{003d}\u{003f}\u{d7ff}\u{e000}\u{fffd}";
    #endregion

    #region "Static"
    /**
     * @var int[]
     */
    protected static $s_CharProperties = null;

    protected static $m_CharProperties = null;

    public static function InitInstance(): void
    {
        if (self::$m_CharProperties != null) {
            return;
        }
        if(file_exists('XmlCharType.bin')){
            $file = fopen('XmlCharType.bin', 'rb');
            self::$m_CharProperties = fopen('php://memory', 'w+b');
            stream_copy_to_stream($file,self::$m_CharProperties);
            fclose($file);
            return;
        }

        $chProps = [];
        self::$s_CharProperties = $chProps;
        self::SetProperties(self::s_Whitespace, self::fWhitespace);
        self::SetProperties(self::s_LetterXml4e, self::fLetter);
        self::SetProperties(self::s_NCStartName, self::fNCStartNameSC);
        self::SetProperties(self::s_NCName, self::fNCNameSC);
        self::SetProperties(self::s_CharData, self::fCharData);
        self::SetProperties(self::s_NCNameXml4e, self::fNCNameXml4e);
        self::SetProperties(self::s_Text, self::fText);
        self::SetProperties(self::s_AttrValue, self::fAttrValue);
        self::generateFile();
    }

    private static function SetProperties(string $ranges, int $value): void
    {
        assert(mb_strlen($ranges, 'UTF-8') % 2 === 0);
        for ($p = 0; $p < mb_strlen($ranges, 'UTF-8'); $p +=2)
        {
            $str1 = mb_substr($ranges,$p,1,'UTF-8');
            $str2 = mb_substr($ranges,$p+1,1,'UTF-8');
            for ($i = mb_ord($str1),
                 $last = mb_ord($str2); $i <= $last; $i++)
            {
                if(!isset(self::$s_CharProperties[$i])){
                    self::$s_CharProperties[$i] = $value;
                }
                self::$s_CharProperties[$i] |= $value;
            }
        }
    }
    protected static function generateFile(){
        $fileArray = [];
        for($i = 0; $i < 65536; $i++){
            $fileArray[$i] = XmlCharType::$s_CharProperties[$i] ?? 0;
        }
        $bin = fopen('XmlCharType.bin', 'w+b');
        self::$m_CharProperties = fopen('php://memory', 'w+b');
        foreach($fileArray as $enum){
            fwrite($bin, chr($enum));
            fwrite(self::$m_CharProperties, chr($enum));
        }
        fclose($bin);
    }
    #endregion

    private static $instance = null;
    public static function Instance(){
        self::InitInstance();
        $umArray = new UnmanagedByteArray(self::$m_CharProperties);
        return self::$instance ?? self::$instance = new self($umArray);
    }

    private $charProperties = null;

    public function __construct(&$charProperties)
    {
        assert(is_array($charProperties) || $charProperties instanceof \ArrayAccess);
        $this->charProperties = $charProperties;
    }

    public function IsStartNCNameChar(string $ch): bool{
            assert(mb_strlen($ch, 'UTF-8') === 1);
        return ($this->charProperties[mb_ord($ch, 'UTF-8')] & self::fNCStartNameSC) !== 0;
    }

    public function IsNCNameChar(string $ch): bool{
        return ($this->charProperties[mb_ord($ch, 'UTF-8')] & self::fNCNameSC) !== 0;
    }
}

