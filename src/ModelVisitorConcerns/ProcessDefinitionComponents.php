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
    protected function ProcessNavigationProperty(INavigationProperty $property): void
    {
        /**
         * @var EdmModelVisitor $this
         */
        $this->startElement($property, __METHOD__);
        $this->ProcessProperty($property);
        $this->endElement($property, __METHOD__);
    }

    protected function ProcessStructuralProperty(IStructuralProperty $property): void
    {
        /**
         * @var EdmModelVisitor $this
         */
        $this->startElement($property, __METHOD__);
        $this->ProcessProperty($property);
        $this->endElement($property, __METHOD__);
    }

    protected function ProcessProperty(IProperty $property): void
    {
        /**
         * @var EdmModelVisitor $this
         */
        $this->startElement($property, __METHOD__);
        $this->ProcessVocabularyAnnotatable($property);
        $this->ProcessNamedElement($property);
        $this->VisitTypeReference($property->getType());
        $this->endElement($property, __METHOD__);
    }

    protected function ProcessEnumMember(IEnumMember $enumMember): void
    {
        /**
         * @var EdmModelVisitor $this
         */
        $this->startElement($enumMember, __METHOD__);
        $this->ProcessNamedElement($enumMember);
        $this->endElement($enumMember, __METHOD__);
    }
}
