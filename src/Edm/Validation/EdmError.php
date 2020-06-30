<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation;

use AlgoWeb\ODataMetadata\Interfaces\ILocation;

/**
 * Class EdmError.
 *
 * Represents a reportable error in EDM
 *
 * @package AlgoWeb\ODataMetadata\Validation
 */
class EdmError
{
    /**
     * @var ILocation|null
     */
    private $location;
    /**
     * @var EdmErrorCode
     */
    private $code;
    /**
     * @var string
     */
    private $message;

    /**
     * Initializes a new instance of the EdmError class.
     *
     * @param ILocation|null $errorLocation the location where the error occurred
     * @param EdmErrorCode   $errorCode     an Enum representing the error
     * @param string         $errorMessage  a human readable message describing the error
     */
    public function __construct(?ILocation $errorLocation, EdmErrorCode $errorCode, string $errorMessage)
    {
        $this->location = $errorLocation;
        $this->code     = $errorCode;
        $this->message  = $errorMessage;
    }
    /**
     * @return ILocation|null gets the location of the error in the file in which it occurred
     */
    public function getErrorLocation(): ?ILocation
    {
        return $this->location;
    }

    /**
     * @return EdmErrorCode gets the code representing the error
     */
    public function getErrorCode(): EdmErrorCode
    {
        return $this->code;
    }

    /**
     * @return string gets a human readable string describing the error
     */
    public function getErrorMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string a string representation of the error
     */
    public function __toString(): string
    {
        if (null !== $this->location && !$this->location instanceof ObjectLocation) {
            return $this->code->getKey() . '=' . $this->code->getValue() . ':' . $this->message . ':' . strval($this->location);
        }
        return $this->code->getKey() . '=' . $this->code->getValue() . ':' . $this->message;
    }
}
