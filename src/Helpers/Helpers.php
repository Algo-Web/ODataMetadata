<?php


namespace AlgoWeb\ODataMetadata\Helpers;


use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\StringConst;

abstract class Helpers
{
    public const AssociationNameEscapeChar = '_';
    public const AssociationNameEscapeString = "_";
    public const AssociationNameEscapeStringEscaped = "__";

    public static function GetPathSegmentEntityType(ITypeReference $segmentType): IEntityType
    {
        return ($segmentType->IsCollection() ? $segmentType->AsCollection()->ElementType() : $segmentType)->AsEntity()->EntityDefinition();
    }
    public static function FindAcrossModels(IModel $model, string $qualifiedName,callable $finder, $ambiguousCreator)
    {
        $candidate = $finder($model, $qualifiedName);

        foreach ($model->getReferencedModels() as $reference) {
            $fromReference = $finder($reference, $qualifiedName);
            if ($fromReference != null) {
                $candidate = $candidate == null ? $fromReference : $ambiguousCreator($candidate, $fromReference);
            }
        }

        return $candidate;
    }


    /**
     * @param string $typeOf Type of the annotation being returned.
     * @param $annotation
     * @return mixed|null
     */
    public static function AnnotationValue(string $typeOf, $annotation)
    {
        if ($annotation != null)
        {
            $isSpecificAnnotation = is_a($annotation, $typeOf);
            if ($isSpecificAnnotation)
            {
                return $annotation;
            }

            /**if ($annotation instanceof IValue)
            {
            }*/

            throw new InvalidOperationException(StringConst::Annotations_TypeMismatch(get_class($annotation), $typeOf));
        }

        return null;
    }

    public static function classNameToLocalName(string $className) : string{
        // Use the name of the type as its local name for annotations.
        // Filter out special characters to produce a valid name:
        // '.'                      Appears in qualified names.
        // '`', '[', ']', ','       Appear in generic instantiations.
        // '+'                      Appears in names of local classes.
        return str_replace(
            "_",
            "_____",
            str_replace(
                '.',
                '_',
                str_replace(
                    "[",
                    "",
                    str_replace(
                        "]",
                        "",
                        str_replace(
                            ",",
                            "__",
                            str_replace(
                                "`",
                                "___",
                                str_replace(
                                    "+",
                                    "____",
                                    $className
                                )
                            )
                        )
                    )
                )
            )
        );
    }

    /**
     * Gets the namespace used for the association serialized for a navigation property.
     *
     * @param IModel $model Model containing the navigation property.
     * @param INavigationProperty $property The navigation property.
     * @return string The association namespace.
     */
    public static function GetAssociationNamespace(IModel $model, INavigationProperty $property): string
    {
        $property->PopulateCaches();
        $associationNamespace = $model->GetAnnotationValue('string', $property, EdmConstants::InternalUri, CsdlConstants::AssociationNamespaceAnnotation);
        if ($associationNamespace == null)
        {
            $associationNamespace = $property->GetPrimary()->DeclaringEntityType()->getNamespace();
        }

        return $associationNamespace;
    }


    public static function GetQualifiedAndEscapedPropertyName(INavigationProperty $property): string
    {
        return
            str_replace('.', self::AssociationNameEscapeChar,self::EscapeName($property->DeclaringEntityType()->getNamespace())) .
            self::AssociationNameEscapeChar .
            self::EscapeName($property->DeclaringEntityType()->getNamespace()) .
            self::AssociationNameEscapeChar .
            self::EscapeName($property->getName());
    }

    private static function EscapeName(string $name):string
    {
        return str_replace(self::AssociationNameEscapeString, self::AssociationNameEscapeStringEscaped, $name);
    }
}