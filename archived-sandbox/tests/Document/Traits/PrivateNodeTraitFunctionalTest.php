<?php

namespace App\Tests\Document\Traits;

use App\Document\PlayerNode;
use App\Document\RootNode;
use App\Tests\Document\BaseGraphMethodFunctionalTest;

class PrivateNodeTraitFunctionalTest extends BaseGraphMethodFunctionalTest
{
    /** @var RootNode */
    private $root1;

    protected function buildTestTree()
    {
        $rootNode = new RootNode();
        $rootNode->setId('/root1');
        $this->buildGraph($rootNode);
        $this->root1 = $rootNode;
    }

    public function testPlayerNodeHasChildren()
    {
        $this->buildTestTree();
        $rootNode = $this->root1;
        $playerNode = $rootNode->getTreeNode('playertree')->getPlayerNode('root1-playertree-node-1');
        $this->assertCount(3, $playerNode->getChildren());
    }

    public function testMoveNodeNewParent()
    {
        $this->buildTestTree();
        $rootNode = $this->root1;
        $playerTrash = $rootNode->getTreeNode('playertrash');
        $playerTree = $rootNode->getTreeNode('playertree');
        $playerNode = $playerTree->first();
        $expectedId = '/root1/playertree/root1-playertree-node-1';
        $this->assertEquals($expectedId, $playerNode->getId());
        $playerNode->moveNode($playerTrash);
        $this->assertEquals($playerTrash, $playerNode->getParent());
        $expectedId = '/root1/playertrash/root1-playertree-node-1';
        $this->assertEquals($expectedId, $playerNode->getId());

        $moved = [
            'rootNode' => $rootNode,
            'playerTrash' => $playerTrash,
            'playerTree' => $playerTree,
            'playerNode' => $playerNode,
        ];

        return $moved;
    }

    /**
     * @depends testMoveNodeNewParent
     */
    public function testMoveNodeChildrenIdOk(array $moved)
    {
        // $rootNode = $moved['rootNode'];
        // $playerTrash = $moved['playerTrash'];
        // $playerTree = $moved['playerTree'];
        $playerNode = $moved['playerNode'];
        $playerId = $playerNode->getId();
        foreach ($playerNode->getChildren() as $nodename => $childNode) {
            $childNodeId = sprintf('%s/%s', $playerId, $nodename);
            $this->assertEquals($playerId, $childNode->getParentId());
            $this->assertEquals($childNodeId, $childNode->getId());
        }
    }

    public function testMoveNodeChangeNodenameNotParent()
    {
        $this->buildTestTree();
        $rootNode = $this->root1;
        // $playerTrash = $rootNode->getTreeNode('playertrash');
        $playerTree = $rootNode->getTreeNode('playertree');
        $playerNode = $playerTree->first();
        $playerNode->moveNode(null, 'newnodename');
        $this->assertEquals($playerTree, $playerNode->getParent());
        $this->assertEquals('newnodename', $playerNode->getNodename());
    }

    /**
     * @expectedException    \App\Exception\OutOfScopeException
     */
    public function testMoveNodeDisconnectedThrows()
    {
        $playerNode = new PlayerNode();
        $playerNode->moveNode(null, 'newnodename');
    }

    public function testModeNodeChangeNodenameAndParent()
    {
        $this->buildTestTree();
        $rootNode = $this->root1;
        $playerTrash = $rootNode->getTreeNode('playertrash');
        $playerTree = $rootNode->getTreeNode('playertree');
        $playerNode = $playerTree->first();
        $playerNode->moveNode($playerTrash, 'New Nodename');
        $this->assertEquals($playerTrash, $playerNode->getParent());
        $expectedId = '/root1/playertrash/new-nodename';
        $this->assertEquals($expectedId, $playerNode->getId());
    }

    // /**
    //  * @expectedException   \App\Exception\MissingInterfaceException
    //  */
    // public function testAssertInstanceOfPhpcrNodeInterface()
    // {
    //     $this->buildTestTree();
    //     $rootNode = $this->root1;
    //     $playerTrash = $rootNode->getTreeNode('playertrash');
    //     $playerTree = $rootNode->getTreeNode('playertree');
    //     $playerNode = $playerTree->first();
    //     $playerNode->moveNode($playerTrash, 'New Nodename');
    //     $this->assertEquals($playerTrash, $playerNode->getParent());
    //     $expectedId = '/root1/playertrash/new-nodename';
    //     $this->assertEquals($expectedId, $playerNode->getId());
    // }

    /**
     * @expectedException   \App\Exception\OutOfScopeException
     */
    public function testAssertOneOrBothParametersSet()
    {
        $this->buildTestTree();
        $rootNode = $this->root1;
        $playerTree = $rootNode->getTreeNode('playertree');
        $playerNode = $playerTree->first();
        $playerNode->moveNode(null, null);
    }
}
