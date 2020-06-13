<?php


namespace AlgoWeb\ODataMetadata\Library\Values;


use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPropertyValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IValue;
use AlgoWeb\ODataMetadata\StringConst;

class EdmPropertyValue implements IPropertyValue
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var IValue
     */
    private $value;


    /**
     * Initializes a new instance of the "EdmPropertyValue" class with non-initialized "Value" property.
     * This constructor allows setting Value property once after EdmPropertyValue has been constructed.
     * @param string $name Name of the property for which this provides a value.
     * @param IValue|null $value Value of the property. one set it can not be changed.
     */
    public function __construct(string $name, IValue $value = null)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return IValue Gets the data stored in this value.
     */
    public function getValue(): ?IValue
    {
        return $this->value;
    }

    /**
     *  sets the value of the property.
     *
     * The value can be initialized only once either using the constructor or by assigning value directly to this property.
     * once initialized it can not be changed
     * @param IValue $value the value for the property.
     * @return EdmPropertyValue
     */
    public function setValue(IValue $value): self
    {
        if ($this->value != null) {
            throw new InvalidOperationException(StringConst::ValueHasAlreadyBeenSet());
        }
        $this->value = $value;
        return $this;
    }

    /**
     * @return string Gets the name of the property this value is associated with.
     */
    public function getName(): string
    {
        return $this->name;
    }

}