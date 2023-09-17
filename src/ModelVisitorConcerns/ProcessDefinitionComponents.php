<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;
use AlgoWeb\ODataMetadata\Interfaces\INamedElement;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;

trait ProcessDefinitionComponents
{
    protected function processNavigationProperty(INavigationProperty $property): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($property, __METHOD__);
        $this->processProperty($property);
        $this->endElement($property, __METHOD__);
    }

    protected function processStructuralProperty(IStructuralProperty $property): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($property, __METHOD__);
        $this->processProperty($property);
        $this->endElement($property, __METHOD__);
    }

    protected function processProperty(IProperty $property): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($property, __METHOD__);
        $this->processVocabularyAnnotatable($property);
        $this->processNamedElement($property);
        $this->visitTypeReference($property->getType());
        $this->endElement($property, __METHOD__);
    }

    protected function processEnumMember(IEnumMember $enumMember): void
    {
        /** @var EdmModelVisitor $this */
        $this->startElement($enumMember, __METHOD__);
        $this->processNamedElement($enumMember);
        $this->endElement($enumMember, __METHOD__);
    }
}
