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
    protected function ProcessTerm(ITerm $term): void
    {
        // Do not visit NamedElement as that gets visited by other means.
    }

    protected function ProcessValueTerm(IValueTerm $term): void
    {
        /*
         * @var EdmModelVisitor $this
         */
        $this->ProcessSchemaElement($term);
        $this->ProcessTerm($term);
        $this->VisitTypeReference($term->getType());
    }
}
