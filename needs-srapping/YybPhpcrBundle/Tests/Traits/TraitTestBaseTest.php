<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Tests\Traits;

class TraitTestBaseTest extends TraitTestBase
{
    public function testRootNodeInterfaces()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');

        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\NodeInterface', $rootNode);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\ArcNodeInterface', $rootNode);
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\BranchNodeInterface', $rootNode);
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\RootNodeInterface', $rootNode);
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\ChildNodesInterface', $rootNode);
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkNodesInterface', $rootNode);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkedRootNodeInterface', $rootNode);
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkableInterface', $rootNode);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\AccountableInterface', $rootNode);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\HiddenChildInterface', $rootNode);
    }

    public function testNodeInterfaces()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');
        $node = $this->createNodeImplementation($rootNode, 'testNode');

        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\NodeInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\ArcNodeInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\BranchNodeInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\RootNodeInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\ChildNodesInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkNodesInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkedRootNodeInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkableInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\AccountableInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\HiddenChildInterface', $node);
    }

        public function testHiddenNodeInterfaces()
        {
            $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');
            $node = $this->createHiddenNodeImplementation($rootNode, 'testNode');

            $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\NodeInterface', $node);
            $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\ArcNodeInterface', $node);
            $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\BranchNodeInterface', $node);
            $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\RootNodeInterface', $node);
            $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\ChildNodesInterface', $node);
            $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkNodesInterface', $node);
            $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkedRootNodeInterface', $node);
            $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkableInterface', $node);
            $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\AccountableInterface', $node);
            $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\HiddenChildInterface', $node);
        }

    public function testArcNodeInterfaces()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');
        $node = $this->createArcNodeImplementation($rootNode, 'testArcNode');

        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\NodeInterface', $node);
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\ArcNodeInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\BranchNodeInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\RootNodeInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\ChildNodesInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkNodesInterface', $node);
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkedRootNodeInterface', $node);
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkableInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\AccountableInterface', $node);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\HiddenChildInterface', $node);
    }
}
