<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Tests\Document;

use YoYogaBear\Bundle\PhpcrBundle\Document\
{
    BranchNode,
    RootNode
};

class BranchNodeTest extends \PHPUnit\Framework\TestCase
{
    public function testImplementsNodeInteface()
    {
        $rootNode = new RootNode('/testRootNode');
        $node = new BranchNode($rootNode, 'testNode');

        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\NodeInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\ArcNodeInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\RootNodeInterface', $node);
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\BranchNodeInterface', $node);
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\ChildNodesInterface', $node);
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkNodesInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkableInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\AccountableInterface', $node);
    }

    public function testTraits()
    {
        $rootNode = new RootNode('/testRootNode');
        $node = new BranchNode($rootNode, 'testNode');
        $reflectionClass = new \reflectionClass($node);
        $traitNames = $reflectionClass->getTraitNames();

        $this->assertCount(3, $traitNames);
        $this->assertContains('YoYogaBear\Bundle\PhpcrBundle\Traits\NodeInterfaceTrait', $traitNames, implode(', ', $traitNames));
        $this->assertContains('YoYogaBear\Bundle\PhpcrBundle\Traits\ChildNodesInterfaceTrait', $traitNames, implode(', ', $traitNames));
        $this->assertContains('YoYogaBear\Bundle\PhpcrBundle\Traits\LinkNodesInterfaceTrait', $traitNames, implode(', ', $traitNames));
    }
}
