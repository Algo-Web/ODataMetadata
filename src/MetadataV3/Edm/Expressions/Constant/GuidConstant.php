<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Constant;

use InvalidArgumentException;

/**
 * Class representing TGuidConstantExpressionType.
 *
 * 16.1.7 The Edm:Guid Constant Expression
 *
 * The Edm:Guid constant expression evaluates to a primitive 32-character string value. A guid expression MUST be
 * assigned a value of the type [xs:guid][csdl19].
 *
 * A guid expression may be written with either element notation or attribute notation, as shown in the following
 * examples:
 *
 *     <ValueAnnotation Term="org.example.display.Id" Guid="21EC2020-3AEA-1069-A2DD-08002B30309D" />
 *
 *     <ValueAnnotation Term="org.example.display.Id">
 *         <Guid>21EC2020-3AEA-1069-A2DD-08002B30309D</Guid>
 *     </ValueAnnotation>
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl16.1.7
 * XSD Type: TGuidConstantExpression
 */
class GuidConstant extends ConstantBase
{
    /**
     * Construct.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value.
     *
     * @param  string $value
     * @return string
     */
    public function value(string $value = null): string
    {
        if (null !== $value) {
            $hexPattern  = '[a-fA-F0-9]';
            $guidPattern = sprintf('/%1$s{8}-%1$s{4}-%1$s{4}-%1$s{4}-%1$s{12}/m', $hexPattern);
            if (!$this->completelyMatchesPattern($value, $guidPattern)) {
                throw new InvalidArgumentException(
                    sprintf('%s Should be assigned strings matching %s', __CLASS__, $guidPattern)
                );
            }

            $this->__value = $value;
        }
        return $this->__value;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'Guid';
    }
}
