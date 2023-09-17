<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;

trait SimpleICheckable
{
    /**
     * @var EdmError[]
     */
    private $errors;

    /**
     * @return EdmError[] gets an error if one exists with the current object
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
