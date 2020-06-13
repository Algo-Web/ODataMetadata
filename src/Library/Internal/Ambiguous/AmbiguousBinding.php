<?php


namespace AlgoWeb\ODataMetadata\Library\Internal\Ambiguous;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Interfaces\INamedElement;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadElement;

/**
 * Represents a name binding to more than one item.
 *
 * @package AlgoWeb\ODataMetadata\Library\Internal
 */
class AmbiguousBinding extends BadElement
{
    /**
     * @var INamedElement[]
     */
    private $bindings = [];

    public function __construct(INamedElement $first, INamedElement $second)
    {
        parent::__construct(
            [
                new EdmError(
                    null,
                    EdmErrorCode::BadAmbiguousElementBinding(),
                    sprintf('The name \'%s\' is ambiguous.', $first->getName())
                )
            ]
        );
        $this->addBinding($first);
        $this->addBinding($second);
    }

    public function getName(): string {
        if(isset($this->bindings[0])){
            return $this->bindings[0]->getName();
        }
        return '';
    }

    public function addBinding(INamedElement $binding): void
    {
        if(!in_array($binding, $this->bindings)){
            $this->bindings[] =  $binding;
        }
    }

    /**
     * @return INamedElement[]
     */
    public function getBindings(): array
    {
        return $this->bindings;
    }
}