<?php

namespace OldApp\Tests\Document\Traits;

use App\Document\PlayerNode;
use App\Document\RootNode;
use App\Tests\Document\BaseGraphMethodFunctionalTest;

class PrivateNodeInterfaceFunctionalTest extends BaseGraphMethodFunctionalTest
{
    /** @var array */
    private $root1;

    /**
     * @before
     */
    protected function buildTestTree()
    {
        $rootNode = new RootNode();
        $rootNode->setId('/root1');
        $this->buildGraph($rootNode);
        $this->root1 = $rootNode;
    }

    public function testValidateRootNode()
    {
        $rootNode = $this->root1;
        // todo better validation
        $this->assertInstanceOf(RootNode::class, $rootNode);
    }

    public function testGetRootNodeOnRootNode()
    {
        $rootNode = $this->root1;
        $this->assertEquals($rootNode, $rootNode->getRootNode());
    }

    public function testGetRootNodeOnDisconnectedNode()
    {
        $disconnectedNode = new PlayerNode();
        $this->assertNull($disconnectedNode->getRootNode());
    }

    public function testGetRootNodeOnTreeNode()
    {
        $rootNode = $this->root1;
        $rootNodeChildren = $rootNode->getChildren();
        $treeNode = $rootNodeChildren->first();
        $gottenRootNode = $treeNode->getRootNode();
        $this->assertEquals($rootNode, $gottenRootNode);
    }

    public function testGetRootNodeOnDocumentNode()
    {
        $rootNode = $this->root1;
        $playerTree = $rootNode->getChildren()->get('playertree');
        $playerNode = $playerTree->getPlayerNode('root1-playertree-node-1');
        $this->assertEquals($rootNode, $playerNode->getRootNode());
    }
}
