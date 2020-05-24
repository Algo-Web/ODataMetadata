<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs\INominalType;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs\IScalarType;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs\IStructuralTypes;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs\IType;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

trait HasType
{
    use HasFacets;
    /**
     * @var IType $type
     */
    private $type = null;


    /**
     * Gets as type
     *
     * @return IType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets a new type
     *
     * @param IType $type
     * @return self
     */
    public function setType(IType $type)
    {
        $this->type = $type;
        return $this;
    }
    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributesHasType(): array
    {
        $base = [];
        $type = $this->getType();
        if ($type instanceof IScalarType) {
            $base = array_merge($base, $this->getAttributesHasFacets());
        }
        if ($type instanceof INominalType) {
            $base[] = new AttributeContainer("Type", $type->getName());
        }
        return $base;
    }
    public function getChildElementsHasType(): IType
    {
        return $this->getType() instanceof IStructuralTypes ? $this->getType() : null;
    }
}
