<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Writer;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\OdataVersions;
use DOMDocument;
use DOMElement;

class WriterContext
{
    private $namespaceContainer;

    private $odataVersion;
    /**
     * @var DOMDocument
     */
    private $baseDocument;
    /**
     * @var array<string,string>
     */
    private $namespaceRegister = [];

    public function __construct(OdataVersions $version, DOMDocument $document = null)
    {
        $this->odataVersion       = $version;
        $this->baseDocument       = $document ?? new DOMDocument();
        $this->namespaceContainer = new Namespaces($version);
        $this->registerNamespace('edmx', $this->getEdmxNamespace());
        $this->registerNamespaces();
    }

    public function getBaseDocument(): DOMDocument
    {
        return $this->baseDocument;
    }

    public function getEdmNamespace()
    {
        return $this->namespaceContainer->getEdmNamespace();
    }
    public function getEdmxNamespace()
    {
        return $this->namespaceContainer->getEdmxNamespace();
    }
    public function getMetadataNamespace()
    {
        return $this->namespaceContainer->getMetadataNamespace();
    }
    public function getDataServiceNamespace()
    {
        return $this->namespaceContainer->getDataServiceNamespace();
    }
    public function getAnnotationsNamespace()
    {
        return $this->namespaceContainer->getAnnotationsNamespace();
    }
    public function getOdataVersion(): string
    {
        return strval($this->odataVersion);
    }

    public function registerNamespace($prefix, $namespace)
    {
        $this->namespaceRegister[$prefix] = $namespace;
    }

    public function getNamespaceForPrefix($prefix)
    {
        return $this->namespaceRegister[$prefix];
    }

    protected function createElement($namespace, $name): DOMElement
    {
        return $this->baseDocument->createElementNS($namespace, $name);
    }

    public function createEdmElement(string $name): DOMElement
    {
        return $this->createElement($this->getEdmNamespace(), $name);
    }
    public function createEdmxElement(string $name): DOMElement
    {
        return $this->createElement($this->getEdmxNamespace(), $name);
    }

    public function shouldWriteV2(): bool
    {
        return
            $this->odataVersion == OdataVersions::TWO() ||
            $this->odataVersion == OdataVersions::THREE();
    }
    public function shouldWriteV3(): bool
    {
        return $this->odataVersion == OdataVersions::THREE();
    }
    public function getXml()
    {
        return $this->baseDocument->saveXML();
    }

    /**
     * @param  DomBase    $rootNode
     * @param  bool       $isTopLevel
     * @return DOMElement
     */
    public function write(DomBase $rootNode, bool $isTopLevel = true): DOMElement
    {
        $prefix        = null;
        $qualifiedName = $rootNode->getDomName();
        if (strpos($qualifiedName, ':') !== false) {
            $prefix = substr($qualifiedName, 0, strpos($qualifiedName, ':'));
        }
        $domElement = $this->baseDocument->createElementNS($this->getNamespaceForPrefix($prefix), $qualifiedName);
        if ($isTopLevel) {
            $this->setUpNamespaces($domElement);
        }

        $domElement->textContent = $rootNode->getTextContent();

        foreach ($rootNode->getAttributes($this) as $attribute) {
            if ($this->shouldWrite($attribute)) {
                $attribute->apply($domElement, $this);
            }
        }
        foreach (array_filter($rootNode->getChildElements()) as $childNode) {
            $childElement = $this->write($childNode, false);

            $domElement->appendChild($childElement);
        }
        return $domElement;
    }

    protected function shouldWrite(IAttribute $attribute)
    {
        return
            (
                OdataVersions::TWO() == $attribute->getAttributeForVersion() && $this->shouldWriteV2() ||
                OdataVersions::THREE() == $attribute->getAttributeForVersion() && $this->shouldWriteV3() ||
                OdataVersions::ONE() == $attribute->getAttributeForVersion()
            ) &&
            !in_array($this->getOdataVersion(), $attribute->getAttributeProhibitedVersion());
    }

    private function registerNamespaces()
    {
        $this->registerNamespace(null, $this->getEdmNamespace());
        $this->registerNamespace('annotations', $this->getAnnotationsNamespace());
        $this->registerNamespace('metadata', $this->getMetadataNamespace());
        $this->registerNamespace('edmx', $this->getEdmxNamespace());
    }

    private function setUpNamespaces(DOMElement $rootElement)
    {
        foreach ($this->namespaceRegister as $prefix => $namespace) {
            $qualifiedName = $prefix === '' ? 'xmlns' : 'xmlns:' . $prefix;
            $rootElement->setAttributeNS(
                'http://www.w3.org/2000/xmlns/',
                $qualifiedName,
                $namespace
            );
        }
    }
}
