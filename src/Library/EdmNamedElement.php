<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Interfaces\INamedElement;

/**
 * Class EdmNamedElement.
 *
 * Common base class for all named EDM elements.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
class EdmNamedElement extends EdmElement implements INamedElement
{
    /**
     * @var string
     */
    private $name;

    /**
     * Initializes a new instance of the EdmNamedElement class.
     *
     * @param string $name name of the element
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string|null gets the name of this element
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
