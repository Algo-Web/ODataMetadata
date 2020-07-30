<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\Enums\ContainerElementKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainerElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\StringConst;

trait VisitDataModel
{
    /**
     * @param IEntityContainerElement[] $elements
     */
    public function visitEntityContainerElements(array $elements): void
    {
        /** @var EdmModelVisitor $self */
        $self = $this;
        foreach ($elements as $element) {
            switch ($element->getContainerElementKind()) {
                case ContainerElementKind::EntitySet():
                    assert($element instanceof IEntitySet);
                    $self->processEntitySet($element);
                    break;
                case ContainerElementKind::FunctionImport():
                    assert($element instanceof IFunctionImport);
                    $self->processFunctionImport($element);
                    break;
                case ContainerElementKind::None():
                    assert($element instanceof IEntityContainerElement);
                    $self->processEntityContainerElement($element);
                    break;
                default:
                    throw new InvalidOperationException(
                        StringConst::UnknownEnumVal_ContainerElementKind($element->getContainerElementKind()->getKey())
                    );
            }
        }
    }
}
