<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IModel;

final class VisitorOfIModel extends VisitorOfT
{
    protected function VisitT($item, array &$followup, array &$references): ?iterable
    {
        assert($item instanceof IModel);
        $errors = [];
        InterfaceValidator::ProcessEnumerable($item, $item->getSchemaElements(), 'SchemaElements', $followup, $errors);
        InterfaceValidator::ProcessEnumerable(
            $item,
            $item->getVocabularyAnnotations(),
            'VocabularyAnnotations',
            $followup,
            $errors
        );
        return $errors;
    }

    public function forType(): string
    {
        return IModel::class;
    }
}
