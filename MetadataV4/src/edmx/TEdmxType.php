<?php

namespace MetadataV4\edmx;

/**
 * Class representing TEdmxType
 *
 *
 * XSD Type: TEdmx
 */
class TEdmxType
{

    /**
     * @property float $version
     */
    private $version = null;

    /**
     * @property \MetadataV4\edmx\TReferenceType[] $reference
     */
    private $reference = array(
        
    );

    /**
     * @property \MetadataV4\edm\Schema[] $dataServices
     */
    private $dataServices = null;

    /**
     * Gets as version
     *
     * @return float
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Sets a new version
     *
     * @param float $version
     * @return self
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Adds as reference
     *
     * @return self
     * @param \MetadataV4\edmx\TReferenceType $reference
     */
    public function addToReference(\MetadataV4\edmx\TReferenceType $reference)
    {
        $this->reference[] = $reference;
        return $this;
    }

    /**
     * isset reference
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetReference($index)
    {
        return isset($this->reference[$index]);
    }

    /**
     * unset reference
     *
     * @param scalar $index
     * @return void
     */
    public function unsetReference($index)
    {
        unset($this->reference[$index]);
    }

    /**
     * Gets as reference
     *
     * @return \MetadataV4\edmx\TReferenceType[]
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Sets a new reference
     *
     * @param \MetadataV4\edmx\TReferenceType[] $reference
     * @return self
     */
    public function setReference(array $reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * Adds as schema
     *
     * @return self
     * @param \MetadataV4\edm\Schema $schema
     */
    public function addToDataServices(\MetadataV4\edm\Schema $schema)
    {
        $this->dataServices[] = $schema;
        return $this;
    }

    /**
     * isset dataServices
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetDataServices($index)
    {
        return isset($this->dataServices[$index]);
    }

    /**
     * unset dataServices
     *
     * @param scalar $index
     * @return void
     */
    public function unsetDataServices($index)
    {
        unset($this->dataServices[$index]);
    }

    /**
     * Gets as dataServices
     *
     * @return \MetadataV4\edm\Schema[]
     */
    public function getDataServices()
    {
        return $this->dataServices;
    }

    /**
     * Sets a new dataServices
     *
     * @param \MetadataV4\edm\Schema[] $dataServices
     * @return self
     */
    public function setDataServices(array $dataServices)
    {
        $this->dataServices = $dataServices;
        return $this;
    }


}

