<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Visitor;

use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainerElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;

interface IDataModelVisitor
{
    public function startEntityContainer(IEntityContainer $container): void;
    public function endEntityContainer(IEntityContainer $container): void;
    public function startEntityContainerElement(IEntityContainerElement $element): void;
    public function endEntityContainerElement(IEntityContainerElement $element): void;
    public function startEntitySet(IEntitySet $set): void;
    public function endEntitySet(IEntitySet $set): void;
}
