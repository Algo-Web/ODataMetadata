<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;

trait ProcessTerms
{
    protected function processTerm(ITerm $term): void
    {
        // Do not visit NamedElement as that gets visited by other means.
    }

    protected function processValueTerm(IValueTerm $term): void
    {
        /** @var EdmModelVisitor $this */
        $this->processSchemaElement($term);
        $this->processTerm($term);
        $this->visitTypeReference($term->getType());
    }
}
