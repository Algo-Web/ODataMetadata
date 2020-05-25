<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs;

/**
 * nominal type: A designation that applies to the types that can be referenced. Nominal types include all primitive
 * types and named EDM types. Nominal types are frequently used inline with collection in the following format:
 * collection(nominal_type).
 *
 * types include:
 * EntityType
 * ComplexType
 * Primitive type
 * EnumType
 * EDMSimpleType
 */
interface INominalType extends IType
{
    public function getName(): string;
}
