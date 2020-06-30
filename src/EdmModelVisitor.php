<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata;

use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\ModelVisitorConcerns\ProcessAnnotations;
use AlgoWeb\ODataMetadata\ModelVisitorConcerns\ProcessBaseElementTypes;
use AlgoWeb\ODataMetadata\ModelVisitorConcerns\ProcessDataModel;
use AlgoWeb\ODataMetadata\ModelVisitorConcerns\ProcessDefinitionComponents;
use AlgoWeb\ODataMetadata\ModelVisitorConcerns\ProcessExpressions;
use AlgoWeb\ODataMetadata\ModelVisitorConcerns\ProcessFunctionRelated;
use AlgoWeb\ODataMetadata\ModelVisitorConcerns\ProcessTerms;
use AlgoWeb\ODataMetadata\ModelVisitorConcerns\ProcessTypeDefinitions;
use AlgoWeb\ODataMetadata\ModelVisitorConcerns\ProcessTypeReferences;
use AlgoWeb\ODataMetadata\ModelVisitorConcerns\VisitAnnotations;
use AlgoWeb\ODataMetadata\ModelVisitorConcerns\VisitDataModel;
use AlgoWeb\ODataMetadata\ModelVisitorConcerns\VisitElements;
use AlgoWeb\ODataMetadata\ModelVisitorConcerns\VisitExpressions;
use AlgoWeb\ODataMetadata\ModelVisitorConcerns\VisitFunctionRelated;
use AlgoWeb\ODataMetadata\ModelVisitorConcerns\VisitTypeDefinitions;
use AlgoWeb\ODataMetadata\ModelVisitorConcerns\VisitTypeReferences;
use AlgoWeb\ODataMetadata\Visitor\IVisitor;
use SplObjectStorage;

class EdmModelVisitor
{
    use VisitAnnotations;
    use VisitDataModel;
    use VisitElements;
    use VisitExpressions;
    use VisitFunctionRelated;
    use VisitTypeDefinitions;
    use VisitTypeReferences;
    use ProcessAnnotations;
    use ProcessBaseElementTypes;
    use ProcessDataModel;
    use ProcessDefinitionComponents;
    use ProcessExpressions;
    use ProcessFunctionRelated;
    use ProcessTerms;
    use ProcessTypeDefinitions;
    use ProcessTypeDefinitions;
    use ProcessTypeReferences;
    /**
     * @var SplObjectStorage|IVisitor[]
     */
    private $visitors;

    protected static function visitCollection(iterable $collection, callable $visitMethod): void
    {
        foreach ($collection as $element) {
            $visitMethod($element);
        }
    }

    /**
     * @var IModel
     */
    protected $model;

    public function __construct(IModel $model)
    {
        $this->model                 = $model;
        $this->visitors              = new SplObjectStorage();
        $this->cloneElementContainer = new SplObjectStorage();
    }
    public function visit(): void
    {
        $this->visitEdmModel();
    }
    protected function visitEdmModel(): void
    {
        $this->processModel($this->model);
    }

    protected function ProcessModel(IModel $model): void
    {
        $this->ProcessElement($model);
        $this->VisitSchemaElements($model->getSchemaElements());
        $this->VisitVocabularyAnnotations($model->getVocabularyAnnotations());
    }

    public function addVisitor(IVisitor $visitor): self
    {
        $this->visitors[] = $visitor;
        return $this;
    }
    public function removeVisitor(IVisitor $visitor): self
    {
        if ($this->visitors->contains($visitor)) {
            $this->visitors->detach($visitor);
        }
        return $this;
    }

    public function hasVisitor(IVisitor $visitor): bool
    {
        return $this->visitors->contains($visitor);
    }

    /**
     * @var SplObjectStorage
     */
    private $cloneElementContainer;
    protected function startElement(IEdmElement $element, string $method): void
    {
        $method       = $this->sanitizeMethodName($method);
        $elementClone = clone $element;
        $this->cloneElementContainer->offsetSet($element, $elementClone);
        foreach ($this->visitors as $visitor) {
            $visitor->{'start' . $method}($elementClone);
        }
    }

    protected function endElement(IEdmElement $element, string $method): void
    {
        $method       = $this->sanitizeMethodName($method);
        $elementClone =  $this->cloneElementContainer->offsetGet($element);
        foreach ($this->visitors as $visitor) {
            $visitor->{'end' . $method}($elementClone);
        }
    }
    private function sanitizeMethodName(string $methodName): string
    {
        return substr($methodName, 7);
    }
}
