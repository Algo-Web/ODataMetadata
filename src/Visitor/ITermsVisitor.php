<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Visitor;

use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;

interface ITermsVisitor
{
    public function startTerm(ITerm $term): void;
    public function endTerm(ITerm $term): void;
    public function startValueTerm(IValueTerm $term): void;
    public function endValueTerm(IValueTerm $term): void;
}
