<?php


namespace AlgoWeb\ODataMetadata\Library;


use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\IStringTypeReference;
use AlgoWeb\ODataMetadata\StringConst;


/**
 * Represents a reference to an EDM string type.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
class EdmStringTypeReference extends EdmPrimitiveTypeReference implements IStringTypeReference
{
    /**
     * @var bool
     */
    private $isUnbounded;
    /**
     * @var int|null
     */
    private $maxLength;
    /**
     * @var bool|null
     */
    private $isFixedLength;
    /**
     * @var bool|null
     */
    private $isUnicode;
    /**
     * @var string|null
     */
    private $collation;

    public function __construct(
        IPrimitiveType $definition,
        bool $isNullable,
        bool $isUnbounded = false,
        ?int $maxLength = null,
        ?bool $isFixedLength = null,
        ?bool $isUnicode = null,
        ?string $collation = null)
    {
        parent::__construct($definition, $isNullable);
        if ($isUnbounded && $maxLength !== null)
        {
            throw new InvalidOperationException(StringConst::EdmModel_Validator_Semantic_IsUnboundedCannotBeTrueWhileMaxLengthIsNotNull());
        }
        $this->isUnbounded =$isUnbounded;
        $this->maxLength = $maxLength;
        $this->isFixedLength = $isFixedLength;
        $this->isUnicode = $isUnicode;
        $this->collation = $collation;
    }

    /**
     *  Gets a value indicating whether this string type specifies fixed length.
     *
     * @return bool|null
     */
    public function isFixedLength(): ?bool
    {
        return $this->isFixedLength;
    }

    /**
     * Gets a value indicating whether this string type specifies the maximum allowed length.
     *
     * @return bool
     */
    public function isUnbounded(): bool
    {
        return $this->isUnbounded;
    }

    /**
     * Gets the maximum length of this string type.
     *
     * @return int|null
     */
    public function getMaxLength(): ?int
    {
        return $this->maxLength;
    }

    /**
     *  Gets a value indicating whether this string type supports unicode encoding.
     *
     * @return bool|null
     */
    public function isUnicode(): ?bool
    {
        return $this->isUnicode;
    }

    /**
     * Gets a string representing the collation of this string type.
     *
     * @return string|null
     */
    public function getCollation(): ?string
    {
        return $this->collation;
    }
}