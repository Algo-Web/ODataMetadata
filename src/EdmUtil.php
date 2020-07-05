<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata;

use AlgoWeb\ODataMetadata\Csdl\Internal\Semantics\BadElements\UnresolvedFunction;
use AlgoWeb\ODataMetadata\Exception\ArgumentNullException;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainerElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionBase;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;

/**
 * Class EdmUtil.
 * @package AlgoWeb\ODataMetadata
 * @internal
 */
class EdmUtil
{
    // this is what we should be doing for CDM schemas
    // the RegEx for valid identifiers are taken from the C# Language Specification (2.4.2 Identifiers)
    // (except that we exclude _ as a valid starting character).
    // This results in a somewhat smaller set of identifier from what System.CodeDom.Compiler.CodeGenerator.IsValidLanguageIndependentIdentifier
    // allows. Not all identifiers allowed by IsValidLanguageIndependentIdentifier are valid in C#.IsValidLanguageIndependentIdentifier allows:
    //    Mn, Mc, and Pc as a leading character (which the spec and C# (at least for some Mn and Mc characters) do not allow)
    //    characters that Char.GetUnicodeCategory says are in Nl and Cf but which the RegEx does not accept (and which C# does allow).
    //
    // we could create the StartCharacterExp and OtherCharacterExp dynamically to force inclusion of the missing Nl and Cf characters...
    private const StartCharacterExp = "[\p{Ll}\p{Lu}\p{Lt}\p{Lo}\p{Lm}\p{Nl}]";
    private const OtherCharacterExp = "[\p{Ll}\p{Lu}\p{Lt}\p{Lo}\p{Lm}\p{Nl}\p{Mn}\p{Mc}\p{Nd}\p{Pc}\p{Cf}]";

    //private const NameExp = self::StartCharacterExp . self::OtherCharacterExp . "{0,}";

    public static function IsNullOrWhiteSpaceInternal(?string $value): bool
    {
        return null === $value || '' === trim($value);
    }

    public static function checkArgumentNull($value, string $parameterName)
    {
        if (null === $value) {
            throw new ArgumentNullException($parameterName);
        }

        return $value;
    }

    // This is testing if the name can be parsed and serialized, not if it is valid.
    public static function IsQualifiedName(string $name): bool
    {
        $nameTokens = explode('.', $name);
        if (count($nameTokens) < 2) {
            return false;
        }

        foreach ($nameTokens as $token) {
            if (empty($token)) {
                return false;
            }
        }

        return true;
    }

    public static function TryGetNamespaceNameFromQualifiedName(
        string $qualifiedName,
        ?string &$namespaceName,
        ?string &$name
    ): bool {
        // Qualified name can be a function import name which is separated by '/'
        $lastSlash = strrpos($qualifiedName, '/');
        if (false === $lastSlash) {
            // Not a FunctionImport
            $lastDot = strrpos($qualifiedName, '.');
            if (false === $lastDot) {
                $namespaceName = '';
                $name          = $qualifiedName;
                return false;
            }

            $namespaceName = substr($qualifiedName, 0, $lastDot);
            $name          = substr($qualifiedName, $lastDot + 1);
            return true;
        }

        $namespaceName = substr($qualifiedName, 0, $lastSlash);
        $name          = substr($qualifiedName, $lastSlash + 1);
        return true;
    }

    public static function FullyQualifiedName(IVocabularyAnnotatable $element): ?string
    {
        if ($element instanceof ISchemaElement) {
            if ($element instanceof IFunction) {
                return self::ParameterizedName($element);
            } else {
                return $element->FullName();
            }
        } else {
            if ($element instanceof IEntityContainerElement) {
                $container = $element->getContainer();
                $fullName  = (null !== $container) ? $container->FullName() : '';
                if ($element instanceof IFunctionImport) {
                    return $fullName . '/' . self::ParameterizedName($element);
                } else {
                    return $fullName . '/' . $element->getName();
                }
            } else {
                if ($element instanceof IProperty) {
                    $declaringSchemaType = $element->getDeclaringType();
                    if ($declaringSchemaType instanceof ISchemaType) {
                        $propertyOwnerName = self::FullyQualifiedName($declaringSchemaType);
                        if (null !== $propertyOwnerName) {
                            return $propertyOwnerName . '/' . $element->getName();
                        }
                    }
                } else {
                    if ($element instanceof IFunctionParameter) {
                        $parameterOwnerName = self::FullyQualifiedName($element->getDeclaringFunction());
                        if (null !== $parameterOwnerName) {
                            return $parameterOwnerName . '/' . $element->getName();
                        }
                    }
                }
            }
        }

        return null;
    }


    public static function ParameterizedName(IFunctionBase $function): string
    {
        $index          = 0;
        $parameterCount = count($function->getParameters());
        $s              = '';
        if ($function instanceof UnresolvedFunction) {
            EdmUtil::checkArgumentNull($function->getNamespace(), 'function->getNamespace');
            $s .= $function->getNamespace();
            $s .= '/';
            $s .= $function->getName();

            return $s;
        }

        // If we have a function (rather than a function import), we want the parameterized name to include the namespace
        if ($function instanceof ISchemaElement) {
            EdmUtil::checkArgumentNull($function->getNamespace(), 'function->getNamespace');
            $s .= $function->getNamespace();
            $s .= '.';
        }

        $s .= $function->getName();
        $s .= '(';
        foreach ($function->getParameters() as $parameter) {
            if ($parameter->getType()->IsCollection()) {
                $typeName = CsdlConstants::Value_Collection . '(' . $parameter->getType()->AsCollection()->ElementType()->FullName() . ')';
            } elseif ($parameter->getType()->IsEntityReference()) {
                $typeName = CsdlConstants::Value_Ref . '(' . $parameter->getType()->AsEntityReference()->EntityType()->FullName() . ')';
            } else {
                $typeName = $parameter->getType()->FullName();
            }

            $s .= $typeName;
            ++$index;
            if ($index < $parameterCount) {
                $s .= ', ';
            }
        }

        $s .= ')';
        return $s;
    }
    public static function IsValidDottedName(string $name): bool
    {
        // Each part of the dotted name needs to be a valid name.
        return array_reduce(explode('.', $name), function (bool $carry, string $part): bool {
            $carry &= self::IsValidUndottedName($part);
            return $carry;
        }, true);
    }
    public static function IsValidUndottedName(string $name): bool
    {
        $nameExp = '^' . self::StartCharacterExp . self::OtherCharacterExp . '{0,}';
        return !empty($name) && preg_match($nameExp, $name);
    }
}
