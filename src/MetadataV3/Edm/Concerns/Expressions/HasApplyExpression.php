<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic\TApplyExpressionType;

trait HasApplyExpression
{
    /**
     * @var TApplyExpressionType[] $apply
     */
    private $apply = [

    ];

    /**
     * Adds as apply.
     *
     * @param TApplyExpressionType $apply
     *@return self
     */
    public function addToApply(TApplyExpressionType $apply)
    {
        $this->apply[] = $apply;
        return $this;
    }

    /**
     * isset apply.
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetApply($index)
    {
        return isset($this->apply[$index]);
    }

    /**
     * unset apply.
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetApply($index)
    {
        unset($this->apply[$index]);
    }

    /**
     * Gets as apply.
     *
     * @return TApplyExpressionType[]
     */
    public function getApply()
    {
        return $this->apply;
    }

    /**
     * Sets a new apply.
     *
     * @param  TApplyExpressionType[] $apply
     * @return self
     */
    public function setApply(array $apply)
    {
        $this->apply = $apply;
        return $this;
    }
}
