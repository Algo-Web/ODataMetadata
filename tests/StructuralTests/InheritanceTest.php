<?php /** @noinspection ALL */

namespace AlgoWeb\ODataMetadata\Tests\StructuralTests;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\Helpers;
use AlgoWeb\ODataMetadata\Enums\Enum;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEdmValidCoreModelElement;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use SplFileInfo;

class InheritanceTest extends TestCase
{
    /**
     * @param $className
     * @dataProvider concreteValidationClasses
     */
    public function testAllRulesInheritValidationRule($className){
        $this->assertTrue(is_subclass_of($className, ValidationRule::class), 'All Validation Rules Should Inherit from ' . ValidationRule::class);
        $this->assertNotEquals(ValidationRule::class, get_parent_class(new $className), 'All Validation Rules should have a middle parent that defines its type');
    }

    /**
     * @param $className
     * @dataProvider concreteEnums
     */
    public function testAllEnumsInheritEnum($className){
        $this->assertTrue(is_subclass_of($className, Enum::class), sprintf( '%s does not inherit from %s', $className, Enum::class));
    }

    /**
     * @param $interfaceName
     * @dataProvider allInterfaces
     */
    public function testAllInterfacesExistAsInterfaces($interfaceName){
        $this->assertTrue(interface_exists($interfaceName), sprintf('%s does not exist', $interfaceName));
        $this->assertTrue((new ReflectionClass($interfaceName))->isInterface(), sprintf('%s lives alongside interfaces but is not an interface', $interfaceName));
    }

    public function concreteValidationClasses()
    {
        return $this->wrapInArray(
            $this->filterAbstractClasses(
                $this->allChildClasses(Helpers::class)
            )
        );
    }

    public function allInterfaces(): array {
        return $this->wrapInArray(
                $this->allChildClasses(IEdmElement::class)
        );
    }
    public function concreteEnums(): array {
        return $this->wrapInArray(
            $this->filterAbstractClasses(
                $this->allChildClasses(Enum::class)
            )
        );
    }
    public function allChildClasses($baseClass):array{
        $enumDir = dirname((new ReflectionClass($baseClass))->getFilename());
        $baseNamespace = (new ReflectionClass($baseClass))->getNamespaceName();
        $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($enumDir));
        $classes = [];
        foreach($rii as $file){
            assert($file instanceof SplFileInfo);
            if ($file->isDir()){
                continue;
            }
            $className = substr($file->getFilename(),0, -4);
            $path = explode(DIRECTORY_SEPARATOR ,  substr($file->getPath(),strlen($enumDir)));

            //$classNamespace = $file->getPath() === $enumDir ? null : implode('\\', $path);

            $classes[] = implode('\\', array_filter(array_merge([$baseNamespace], $path, [$className])));
        }
        return $classes;
    }


    public function filterAbstractClasses(array $classes): array
    {
        return array_filter($classes, function (string $class){
            return !(new ReflectionClass($class))->isAbstract();
        });
    }

    public function wrapInArray($items): array
    {
        return array_reduce($items, function(array $carry, string $ruleClass){
            $carry[] = [$ruleClass];
            return $carry;
        }, []);
    }
}