<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Annotations;

use AlgoWeb\ODataMetadata\Helpers\ValueAnnotationHelpers;
use AlgoWeb\ODataMetadata\Helpers\VocabularyAnnotationHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IValueAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;
use AlgoWeb\ODataMetadata\Library\EdmElement;

/**
 * Represents an EDM value annotation.
 *
 * @package AlgoWeb\ODataMetadata\Library\Annotations
 */
class EdmValueAnnotation extends EdmVocabularyAnnotation implements IValueAnnotation
{
    use ValueAnnotationHelpers;

    private $value;

    /**
     * Initializes a new instance of the EdmValueAnnotation class.
     * @param IVocabularyAnnotatable $target    element the annotation applies to
     * @param ITerm                  $term      term bound by the annotation
     * @param string                 $qualifier qualifier used to discriminate between multiple bindings of the same property or type
     * @param IExpression            $value     expression producing the value of the annotation
     */
    public function __construct(IVocabularyAnnotatable $target, ITerm $term, string $qualifier, IExpression $value)
    {
        parent::__construct($target, $term, $qualifier);
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue(): IExpression
    {
        return $this->value;
    }
}
