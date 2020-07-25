<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17/06/20
 * Time: 11:14 PM.
 */
namespace AlgoWeb\ODataMetadata\Tests\Unit\Csdl\Internal\Serialization;

use AlgoWeb\ODataMetadata\Csdl\Internal\Serialization\EdmModelCsdlSerializationVisitor;
use AlgoWeb\ODataMetadata\Csdl\Internal\Serialization\EdmSchema;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Interfaces\IDocumentation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Library\EdmEntityType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Version;
use Mockery as m;

class EdmModelCsdlSerializationVisitorTest extends TestCase
{
    public function simpleTypeReferenceProvider(): array
    {
        $result   = [];
        $result[] = [PrimitiveTypeKind::Decimal(), 'Edm.Decimal'];
        $result[] = [PrimitiveTypeKind::Time(), 'Edm.Time'];
        $result[] = [PrimitiveTypeKind::Geometry(), 'Edm.Geometry'];

        return $result;
    }

    /**
     * @dataProvider simpleTypeReferenceProvider
     *
     * @param  PrimitiveTypeKind                                      $type
     * @param  string                                                 $expType
     * @throws \AlgoWeb\ODataMetadata\Exception\NotSupportedException
     * @throws \ReflectionException
     */
    public function testProcessSimpleTypeReference(PrimitiveTypeKind $type, string $expType)
    {
        $doc = m::mock(IDocumentation::class)->makePartial();
        $doc->shouldReceive('getSummary')->andReturn('');
        $doc->shouldReceive('getDescription')->andReturn('');

        $model = m::mock(IModel::class)->makePartial();
        $model->shouldReceive('GetNamespaceAliases')->andReturn([]);
        $model->shouldReceive('getDirectValueAnnotationsManager->GetDirectValueAnnotations')->andReturn([]);
        $model->shouldReceive('findDeclaredVocabularyAnnotations')->andReturn([]);
        $model->shouldReceive('GetAnnotationValue')->andReturn($doc);
        $writer  = $this->getWriter();
        $version = Version::v3();

        $foo = new EdmModelCsdlSerializationVisitor($model, $writer, $version);

        $entityType = new EdmEntityType('namespace', 'any');
        $entityType->AddStructuralProperty('employee_id', $type, false);
        $schema = new EdmSchema('namespace');
        $schema->addSchemaElement($entityType);

        $foo->visitEdmSchema($schema, []);

        $tail = '" ConcurrencyMode="None" Nullable="false"';
        if ('Edm.Geometry' == $expType) {
            $tail .= ' SRID="0"';
        }
        $tail .= '>';

        $writer->endElement();
        $expected = '<?xml version="1.0"?>' . PHP_EOL . '<Schema Namespace="namespace">' . PHP_EOL;
        $expected .= '    <EntityType Name="any" OpenType="true">' . PHP_EOL;
        $expected .= '        <Documentation/>' . PHP_EOL;
        $expected .= '        <Property Name="employee_id" Type="' . $expType . $tail . PHP_EOL;
        $expected .= '            <Documentation/>' . PHP_EOL;
        $expected .= '        </Property>' . PHP_EOL;
        $expected .= '    </EntityType>' . PHP_EOL . '</Schema>' . PHP_EOL;
        $actual = $writer->outputMemory(true);

        $this->assertXmlStringEqualsXmlString($expected, $actual);
    }

    public function constantTypeReferenceProvider(): array
    {
        $result = [];



        return $result;
    }


    /**
     * @return \XMLWriter
     */
    protected function getWriter(): \XMLWriter
    {
        $writer = new \XMLWriter();
        $writer->openMemory();
        $writer->startDocument();
        $writer->setIndent(true);
        $writer->setIndentString('    ');
        return $writer;
    }
}
