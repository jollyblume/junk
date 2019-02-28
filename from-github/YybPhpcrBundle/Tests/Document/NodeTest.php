<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Tests\Document;

use YoYogaBear\Bundle\PhpcrBundle\Document\
{
    Node,
    RootNode
};

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class NodeTest extends \PHPUnit\Framework\TestCase
{
    public function testImplementsNodeInteface()
    {
        $rootNode = new RootNode('/testRootNode');
        $ledgeNode = new RootNode('/testLedgeNode');
        $node = new Node($rootNode, 'testNode', $ledgeNode);

        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\NodeInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\ArcNodeInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\RootNodeInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\BranchNodeInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\ChildNodesInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkNodesInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkableInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\AccountableInterface', $node);
    }

    public function testTraits()
    {
        $rootNode = new RootNode('/testRootNode');
        $ledgeNode = new RootNode('/testLedgeNode');
        $node = new Node($rootNode, 'testNode', $ledgeNode);
        $reflectionClass = new \reflectionClass($node);
        $traitNames = $reflectionClass->getTraitNames();

        $this->assertCount(1, $traitNames);
        $this->assertContains('YoYogaBear\Bundle\PhpcrBundle\Traits\NodeInterfaceTrait', $traitNames, implode(', ', $traitNames));
    }
}
