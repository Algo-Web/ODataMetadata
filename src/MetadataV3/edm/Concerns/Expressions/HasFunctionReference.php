<?php


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic\TFunctionReferenceExpressionType;

trait HasFunctionReference
{
    /**
     * @var TFunctionReferenceExpressionType[] $functionReference
     */
    private $functionReference = [

    ];

    /**
     * Adds as functionReference.
     *
     * @param TFunctionReferenceExpressionType $functionReference
     *@return self
     */
    public function addToFunctionReference(TFunctionReferenceExpressionType $functionReference)
    {
        $this->functionReference[] = $functionReference;
        return $this;
    }

    /**
     * isset functionReference.
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetFunctionReference($index)
    {
        return isset($this->functionReference[$index]);
    }

    /**
     * unset functionReference.
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetFunctionReference($index)
    {
        unset($this->functionReference[$index]);
    }

    /**
     * Gets as functionReference.
     *
     * @return TFunctionReferenceExpressionType[]
     */
    public function getFunctionReference()
    {
        return $this->functionReference;
    }

    /**
     * Sets a new functionReference.
     *
     * @param  TFunctionReferenceExpressionType[] $functionReference
     * @return self
     */
    public function setFunctionReference(array $functionReference)
    {
        $this->functionReference = $functionReference;
        return $this;
    }
}
