<?php
namespace MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the Enum Component of  MetadataV3\edm\TCollectionExpressionType
 *
 *
 * XSD Type: GExpression
 */
trait EnumTrait
{
    /**
     * @property string[] $enum
     */
    private $enum = array(
        
    );
    

    /**
     * Adds as enum
     *
     * @return self
     * @param string $enum
     */
    public function addToEnum($enum)
    {
        $this->enum[] = $enum;
        return $this;
    }

    /**
     * isset enum
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetEnum($index)
    {
        return isset($this->enum[$index]);
    }

    /**
     * unset enum
     *
     * @param scalar $index
     * @return void
     */
    public function unsetEnum($index)
    {
        unset($this->enum[$index]);
    }

    /**
     * Gets as enum
     *
     * @return string[]
     */
    public function getEnum()
    {
        return $this->enum;
    }

    /**
     * Sets a new enum
     *
     * @param string $enum
     * @return self
     */
    public function setEnum(array $enum)
    {
        $this->enum = $enum;
        return $this;
    }
}
