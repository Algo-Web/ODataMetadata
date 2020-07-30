<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Visitor;

use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;

interface IDefinitionComponentsVisitor
{
    public function startNavigationProperty(INavigationProperty $property): void;
    public function endNavigationProperty(INavigationProperty $property): void;
    public function startStructuralProperty(IStructuralProperty $property): void;
    public function endStructuralProperty(IStructuralProperty $property): void;
    public function startProperty(IProperty $property): void;
    public function endProperty(IProperty $property): void;
    public function startEnumMember(IEnumMember $enumMember): void;
    public function endEnumMember(IEnumMember $enumMember): void;
}
