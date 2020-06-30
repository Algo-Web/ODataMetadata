<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainerElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\INamedElement;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;

trait ProcessDataModel
{
    protected function ProcessEntityContainer(IEntityContainer $container): void
    {
        /**
         * @var EdmModelVisitor $this
         */
        $this->startElement($container, __METHOD__);
        $this->ProcessVocabularyAnnotatable($container);
        $this->ProcessNamedElement($container);
        $this->VisitEntityContainerElements($container->getElements());
        $this->endElement($container, __METHOD__);
    }

    protected function ProcessEntityContainerElement(IEntityContainerElement $element): void
    {
        /**
         * @var EdmModelVisitor $this
         */
        $this->startElement($element, __METHOD__);
        $this->ProcessNamedElement($element);
        $this->endElement($element, __METHOD__);
    }

    protected function ProcessEntitySet(IEntitySet $set): void
    {
        /**
         * @var EdmModelVisitor $this
         */
        $this->startElement($set, __METHOD__);
        $this->ProcessEntityContainerElement($set);
        $this->endElement($set, __METHOD__);
    }
}
