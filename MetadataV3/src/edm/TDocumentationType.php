<?php

namespace MetadataV3\edm;

/**
 * Class representing TDocumentationType
 *
 * The Documentation element is used to provide documentation of comments on the
 * contents of the XML file. It is valid under Schema, Type, Index and Relationship
 * elements.
 * XSD Type: TDocumentation
 */
class TDocumentationType
{

    /**
     * @property \MetadataV3\edm\TTextType $summary
     */
    private $summary = null;

    /**
     * @property \MetadataV3\edm\TTextType $longDescription
     */
    private $longDescription = null;

    /**
     * Gets as summary
     *
     * @return \MetadataV3\edm\TTextType
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Sets a new summary
     *
     * @param \MetadataV3\edm\TTextType $summary
     * @return self
     */
    public function setSummary(\MetadataV3\edm\TTextType $summary)
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * Gets as longDescription
     *
     * @return \MetadataV3\edm\TTextType
     */
    public function getLongDescription()
    {
        return $this->longDescription;
    }

    /**
     * Sets a new longDescription
     *
     * @param \MetadataV3\edm\TTextType $longDescription
     * @return self
     */
    public function setLongDescription(\MetadataV3\edm\TTextType $longDescription)
    {
        $this->longDescription = $longDescription;
        return $this;
    }
}
