<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;

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
        foreach ($elements as $element) {
            switch ($element->getContainerElementKind()) {
                case ContainerElementKind::EntitySet():
                    assert($element instanceof IEntitySet);
                    $this->processEntitySet($element);
                    break;
                case ContainerElementKind::FunctionImport():
                    assert($element instanceof IFunctionImport);
                    $this->processFunctionImport($element);
                    break;
                case ContainerElementKind::None():
                    assert($element instanceof IEntityContainerElement);
                    $this->processEntityContainerElement($element);
                    break;
                default:
                    throw new InvalidOperationException(StringConst::UnknownEnumVal_ContainerElementKind($element->getContainerElementKind()->getKey()));
            }
        }
    }

    abstract public function processEntityContainerElement(IEntityContainerElement $element): void;
    abstract public function processFunctionImport(IFunctionImport $element): void;
    abstract public function processEntitySet(IEntitySet $element): void;
}
