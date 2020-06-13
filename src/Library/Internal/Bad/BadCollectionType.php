<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

class BadCollectionType extends BadType implements ICollectionType
{
    /**
     * @var ITypeReference
     */
    private $elementType;

    /**
     * BadCollectionType constructor.
     * @param EdmError[] $errors
     */
    public function __construct(array $errors)
    {
        parent::__construct($errors);
        $this->elementType =  new BadTypeReference(new BadType($errors), true);
    }
    public function getTypeKind(): TypeKind
    {
        return TypeKind::Collection();
    }

    /**
     * @return ITypeReference gets the element type of this collection
     */
    public function getElementType(): ITypeReference
    {
        return $this->elementType;
    }
}
