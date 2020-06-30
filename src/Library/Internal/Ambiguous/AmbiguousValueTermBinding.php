<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Internal\Ambiguous;

use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Enums\TermKind;
use AlgoWeb\ODataMetadata\Helpers\SchemaElementHelpers;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadType;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadTypeReference;

class AmbiguousValueTermBinding extends AmbiguousBinding implements IValueTerm
{
    use SchemaElementHelpers;

    /**
     * @var IValueTerm
     */
    private $first;

    public function __construct(IValueTerm $first, IValueTerm $second)
    {
        parent::__construct($first, $second);
        $this->first = $first;
    }

    /**
     * Gets the kind of this schema element.
     *
     * @return SchemaElementKind
     */
    public function getSchemaElementKind(): SchemaElementKind
    {
        return SchemaElementKind::ValueTerm();
    }

    /**
     * Gets the namespace this schema element belongs to.
     *
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->first->getNamespace() ?? '';
    }

    /**
     * Gets the kind of a term.
     *
     * @return TermKind
     */
    public function getTermKind(): TermKind
    {
        return TermKind::Value();
    }

    /**
     * Gets the type of this term.
     *
     * @return ITypeReference|null
     */
    public function getType(): ?ITypeReference
    {
        return $this->computeType();
    }

    private function computeType(): ITypeReference
    {
        return new BadTypeReference(new BadType($this->getErrors()), true);
    }
}
