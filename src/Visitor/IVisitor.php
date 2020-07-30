<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Visitor;

interface IVisitor extends
    IAnnotationsVisitor,
    IBaseElementTypesVisitor,
    IDataModelVisitor,
    IDefinitionComponentsVisitor,
    IExpressionsVisitors,
    IFunctionRelatedVisitor,
    ITermsVisitor,
    ITypeDefinitionsVisitor,
    ITypeReferencesVisitor
{
}
