<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\OnAction\ActionType;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.10 OnDelete
 *
 * The OnDelete element is a trigger that is associated with a relationship. The action is performed on one end of the
 * relationship when the state of the other side of the relationship changes.
 *
 * The following is an example of the OnDelete element.
 *
 *     <Association Name="CProductCategory">
 *         <End Type="Self.CProduct" Multiplicity="*" />
 *         <End Type="Self.CCategory" Multiplicity="0..1">
 *             <OnDelete Action="Cascade" />
 *         </End>
 *     </Association>
 *
 * The following rules apply to the OnDelete element:
 * - OnDelete MUST specify the action.
 * - OnDelete can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute
 *   attributes cannot collide.
 * - The OnDelete element can contain a maximum of one Documentation element.
 * - OnDelete can contain any number of AnnotationElement elements.
 * - Child elements of OnDelete are to appear in this sequence: Documentation, AnnotationElement.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl10.3
 * XSD Type: TOnAction
 */
class OnDelete extends EdmBase
{
    use HasDocumentation;
    /**
     * @var ActionType $action
     */
    private $action;
    public function __construct(ActionType $action, Documentation $documentation = null)
    {
        $this
            ->setAction($action)
            ->setDocumentation($documentation);
    }

    /**
     * Gets as action
     *
     * @return ActionType
     */
    public function getAction(): ActionType
    {
        return $this->action;
    }

    /**
     * Sets a new action
     *
     * @param ActionType $action
     * @return self
     */
    public function setAction(ActionType $action):self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'OnDelete';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('Action', $this->getAction())
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [$this->getDocumentation()];
    }
}

