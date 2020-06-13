<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation;

use AlgoWeb\ODataMetadata\Interfaces\ILocation;

/**
 * Class EdmError
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
     * @param ILocation|null $errorLocation The location where the error occurred.
     * @param EdmErrorCode $errorCode An Enum representing the error.
     * @param string $errorMessage A human readable message describing the error.
     */
    public function __construct(?ILocation $errorLocation, EdmErrorCode $errorCode, string $errorMessage)
    {
        $this->location = $errorLocation;
        $this->code = $errorCode;
        $this->message = $errorMessage;
    }
    /**
     * @return ILocation|null Gets the location of the error in the file in which it occurred.
     */
    public function getErrorLocation(): ?ILocation
    {
        return $this->location;
    }

    /**
     * @return EdmErrorCode Gets the code representing the error.
     */
    public function getErrorCode(): EdmErrorCode
    {
        return $this->code;
    }

    /**
     * @return string Gets a human readable string describing the error.
     */
    public function getErrorMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string A string representation of the error.
     */
    public function __toString(): string
    {
        if (null !== $this->location && !$this->location instanceof ObjectLocation) {
            return $this->code->getKey() . '=' . $this->code->getValue() . ':' . $this->message . ':' . strval($this->location);
        }
        return $this->code->getKey() . '=' . $this->code->getValue() . ':' . $this->message;
    }
}