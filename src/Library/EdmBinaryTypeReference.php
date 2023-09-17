<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Interfaces\IBinaryTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;

/**
 * Represents a reference to an EDM binary type.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
class EdmBinaryTypeReference extends EdmPrimitiveTypeReference implements IBinaryTypeReference
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
     *  Initializes a new instance of the EdmBinaryTypeReference class.
     *
     * @param IPrimitiveType $definition    the type this reference refers to
     * @param bool           $isNullable    denotes whether the type can be nullable
     * @param bool           $isUnbounded   denotes whether the max length is the maximum allowed value
     * @param int|null       $maxLength     maximum length of a value of this type
     * @param bool|null      $isFixedLength denotes whether the length can vary
     */
    public function __construct(
        IPrimitiveType $definition,
        bool $isNullable,
        bool $isUnbounded = false,
        ?int $maxLength = null,
        ?bool $isFixedLength = null
    ) {
        parent::__construct($definition, $isNullable);
        $this->isUnbounded   = $isUnbounded;
        $this->maxLength     = $maxLength;
        $this->isFixedLength = $isFixedLength;
    }

    /**
     * Gets a value indicating whether this type specifies fixed length.
     *
     * @return bool|null
     */
    public function isFixedLength(): ?bool
    {
        return $this->isFixedLength;
    }

    /**
     * Gets a value indicating whether this type specifies the maximum allowed length.
     *
     * @return bool
     */
    public function isUnBounded(): bool
    {
        return $this->isUnbounded;
    }

    /**
     * Gets the maximum length of this type.
     *
     * @return int|null
     */
    public function getMaxLength(): ?int
    {
        return $this->maxLength;
    }
}
