<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Trait VisitElements.
 * @package AlgoWeb\ODataMetadata\ModelVisitorConcerns
 */
trait VisitElements
{
    /**
     * @param ISchemaElement[] $elements
     */
    public function visitSchemaElements(array $elements): void
    {
        /** @var EdmModelVisitor $this */
        self::visitCollection($elements, [$this, 'VisitSchemaElement']);
    }

    public function visitSchemaElement(ISchemaElement $element): void
    {
        /** @var EdmModelVisitor $this */
        switch ($element->getSchemaElementKind()) {
            case SchemaElementKind::Function():
                assert($element instanceof IFunction);
                $this->processFunction($element);
                break;
            case SchemaElementKind::TypeDefinition():
                assert($element instanceof IType);
                $this->visitSchemaType($element);
                break;
            case SchemaElementKind::ValueTerm():
                assert($element instanceof IValueTerm);
                $this->processValueTerm($element);
                break;
            case SchemaElementKind::EntityContainer():
                assert($element instanceof IEntityContainer);
                $this->processEntityContainer($element);
                break;
            case SchemaElementKind::None():
                $this->processSchemaElement($element);
                break;
            default:
                throw new InvalidOperationException(
                    StringConst::UnknownEnumVal_SchemaElementKind($element->getSchemaElementKind()->getKey())
                );
        }
    }
}
