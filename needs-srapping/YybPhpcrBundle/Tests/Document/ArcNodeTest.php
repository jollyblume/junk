<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Tests\Document;

use YoYogaBear\Bundle\PhpcrBundle\Document\
{
    ArcNode,
    RootNode
};

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class ArcNodeTest extends \PHPUnit\Framework\TestCase
{
    public function testImplementsNodeInteface()
    {
        $rootNode = new RootNode('/testRootNode');
        $ledgeNode = new RootNode('/testLedgeNode');
        $node = new ArcNode($rootNode, 'testNode', $ledgeNode);

        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\NodeInterface', $node);
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\ArcNodeInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\RootNodeInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\BranchNodeInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\ChildNodesInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkNodesInterface', $node);
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkableInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\AccountableInterface', $node);
    }

    public function testTraits()
    {
        $rootNode = new RootNode('/testRootNode');
        $ledgeNode = new RootNode('/testLedgeNode');
        $node = new ArcNode($rootNode, 'testNode', $ledgeNode);
        $reflectionClass = new \reflectionClass($node);
        $traitNames = $reflectionClass->getTraitNames();

        $this->assertCount(3, $traitNames);
        $this->assertContains('YoYogaBear\Bundle\PhpcrBundle\Traits\NodeInterfaceTrait', $traitNames, implode(', ', $traitNames));
        $this->assertContains('YoYogaBear\Bundle\PhpcrBundle\Traits\LinkedRootNodeInterfaceTrait', $traitNames, implode(', ', $traitNames));
        $this->assertContains('YoYogaBear\Bundle\PhpcrBundle\Traits\LinkableInterfaceTrait', $traitNames, implode(', ', $traitNames));
    }
}
