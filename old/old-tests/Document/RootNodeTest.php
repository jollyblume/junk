<?php

namespace OldApp\Tests\Document;

use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;
use App\Document\RootNode;
use App\Document\PlayerTree;

class RootNodeTest extends TestCase
{
    public function testConstructSetsChildren()
    {
        $rootNode = new RootNode();
        $this->assertInstanceOf(ArrayCollection::class, $rootNode->getChildren());
    }

    public function testAddTreeNodeIfMissing()
    {
        $tree = $this->createMock(PlayerTree::class);
        $tree->method('getNodename')->willReturn('testtree');
        $rootNode = new RootNode();
        $rootNode->addTreeNode($tree);
        $children = $rootNode->getChildren();
        $this->assertTrue($children->contains($tree));
    }

    public function testaddTreeNodeIfExists()
    {
        $tree = $this->createMock(PlayerTree::class);
        $tree->method('getNodename')->willReturn('testtree');
        $rootNode = new RootNode();
        $rootNode->addTreeNode($tree);
        $this->assertEquals($rootNode, $rootNode->addTreeNode($tree));
    }

    public function testIsRootNodeTrue()
    {
        $rootNode = new RootNode();
        $this->assertTrue($rootNode->isRootNode());
    }

    public function testHasTreeNode()
    {
        $tree = $this->createMock(PlayerTree::class);
        $tree->method('getNodename')->willReturn('testtree');
        $rootNode = new RootNode();
        $rootNode->addTreeNode($tree);
        $this->assertTrue($rootNode->hasTreeNode($tree));
    }

    public function testHasTreeName()
    {
        $tree = $this->createMock(PlayerTree::class);
        $tree->method('getNodename')->willReturn('testtree');
        $rootNode = new RootNode();
        $rootNode->addTreeNode($tree);
        $this->assertTrue($rootNode->hasTreeName('testtree'));
    }

    public function testRemoveTreeNode()
    {
        $tree = $this->createMock(PlayerTree::class);
        $tree->method('getNodename')->willReturn('testtree');
        $rootNode = new RootNode();
        $rootNode->addTreeNode($tree);
        $rootNode->removeTreeNode($tree);
        $this->assertFalse($rootNode->hasTreeNode($tree));
    }

    public function testRemoveTreeName()
    {
        $tree = $this->createMock(PlayerTree::class);
        $tree->method('getNodename')->willReturn('testtree');
        $rootNode = new RootNode();
        $rootNode->addTreeNode($tree);
        $rootNode->removeTreeName('testtree');
        $this->assertFalse($rootNode->hasTreeName('testtree'));
    }

    public function testGetTreeNode()
    {
        $tree = $this->createMock(PlayerTree::class);
        $tree->method('getNodename')->willReturn('testtree');
        $rootNode = new RootNode();
        $rootNode->addTreeNode($tree);
        $this->assertEquals($tree, $rootNode->getTreeNode('testtree'));
    }
}
