<?php


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic\TRecordExpressionType;

trait HasRecordExpression
{
    /**
     * @var TRecordExpressionType[] $record
     */
    private $record = [

    ];

    /**
     * Adds as record.
     *
     * @param TRecordExpressionType $record
     *@return self
     */
    public function addToRecord(TRecordExpressionType $record)
    {
        $this->record[] = $record;
        return $this;
    }

    /**
     * isset record.
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetRecord($index)
    {
        return isset($this->record[$index]);
    }

    /**
     * unset record.
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetRecord($index)
    {
        unset($this->record[$index]);
    }

    /**
     * Gets as record.
     *
     * @return TRecordExpressionType[]
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * Sets a new record.
     *
     * @param  TRecordExpressionType[] $record
     * @return self
     */
    public function setRecord(array $record)
    {
        $this->record = $record;
        return $this;
    }
}
