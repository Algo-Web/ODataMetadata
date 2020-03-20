<?php


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;


use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic\TIfExpressionType;

trait HasIfExpression
{
    /**
     * @var TIfExpressionType[] $if
     */
    private $if = [

    ];


    /**
     * Adds as if
     *
     * @param TIfExpressionType $if
     *@return self
     */
    public function addToIf(TIfExpressionType $if)
    {
        $this->if[] = $if;
        return $this;
    }

    /**
     * isset if
     *
     * @param int|string $index
     * @return bool
     */
    public function issetIf($index)
    {
        return isset($this->if[$index]);
    }

    /**
     * unset if
     *
     * @param int|string $index
     * @return void
     */
    public function unsetIf($index)
    {
        unset($this->if[$index]);
    }

    /**
     * Gets as if
     *
     * @return TIfExpressionType[]
     */
    public function getIf()
    {
        return $this->if;
    }

    /**
     * Sets a new if
     *
     * @param TIfExpressionType[] $if
     * @return self
     */
    public function setIf(array $if)
    {
        $this->if = $if;
        return $this;
    }

}