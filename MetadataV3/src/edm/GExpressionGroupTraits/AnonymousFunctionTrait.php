<?php
namespace MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the AnonymousFunction Component of  MetadataV3\edm\TCollectionExpressionType
 *
 *
 * XSD Type: GExpression
 */
trait AnonymousFunctionTrait
{


    /**
     * @property \MetadataV3\edm\TAnonymousFunctionExpressionType[] $anonymousFunction
     */
    private $anonymousFunction = array(
        
    );

    
    /**
     * Adds as anonymousFunction
     *
     * @return self
     * @param \MetadataV3\edm\TAnonymousFunctionExpressionType $anonymousFunction
     */
    public function addToAnonymousFunction(\MetadataV3\edm\TAnonymousFunctionExpressionType $anonymousFunction)
    {
        $this->anonymousFunction[] = $anonymousFunction;
        return $this;
    }

    /**
     * isset anonymousFunction
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetAnonymousFunction($index)
    {
        return isset($this->anonymousFunction[$index]);
    }

    /**
     * unset anonymousFunction
     *
     * @param scalar $index
     * @return void
     */
    public function unsetAnonymousFunction($index)
    {
        unset($this->anonymousFunction[$index]);
    }

    /**
     * Gets as anonymousFunction
     *
     * @return \MetadataV3\edm\TAnonymousFunctionExpressionType[]
     */
    public function getAnonymousFunction()
    {
        return $this->anonymousFunction;
    }

    /**
     * Sets a new anonymousFunction
     *
     * @param \MetadataV3\edm\TAnonymousFunctionExpressionType[] $anonymousFunction
     * @return self
     */
    public function setAnonymousFunction(array $anonymousFunction)
    {
        $this->anonymousFunction = $anonymousFunction;
        return $this;
    }
}
