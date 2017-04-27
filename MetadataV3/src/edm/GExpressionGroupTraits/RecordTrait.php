<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the Record Component of  MetadataV3\edm\TCollectionExpressionType
 *
 *
 * XSD Type: GExpression
 */
trait RecordTrait
{

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TRecordExpressionType[] $record
     */
    private $record = array(
        
    );

    
    /**
     * Adds as record
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TRecordExpressionType $record
     */
    public function addToRecord(TRecordExpressionType $record)
    {
        $this->record[] = $record;
        return $this;
    }

    /**
     * isset record
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetRecord($index)
    {
        return isset($this->record[$index]);
    }

    /**
     * unset record
     *
     * @param scalar $index
     * @return void
     */
    public function unsetRecord($index)
    {
        unset($this->record[$index]);
    }

    /**
     * Gets as record
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TRecordExpressionType[]
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * Sets a new record
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TRecordExpressionType[] $record
     * @return self
     */
    public function setRecord(array $record)
    {
        $this->record = $record;
        return $this;
    }
}
