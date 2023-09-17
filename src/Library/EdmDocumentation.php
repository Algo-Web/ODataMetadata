<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Interfaces\IDocumentation;

class EdmDocumentation implements IDocumentation
{
    private $summary;
    private $description;

    /**
     * Initializes a new instance of the EdmDocumentation class.
     *
     * @param string|null $summery     summary of the documentation
     * @param string|null $description the documentation contents
     */
    private function __construct(?string $summery, ?string $description)
    {
        $this->summary     = $summery;
        $this->description = $description;
    }

    /**
     * @return string|null gets a summary of this documentation
     */
    public function getSummary(): ?string
    {
        return $this->summary;
    }

    /**
     * @return string|null gets a long description of this documentation
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
}
