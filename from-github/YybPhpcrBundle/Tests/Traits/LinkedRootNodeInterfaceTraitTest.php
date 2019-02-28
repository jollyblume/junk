<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Tests\Traits;

class LinkedRootNodeInterfaceTraitTest extends TraitTestBase
{
    public function testLinkedRootNodeInitialized()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');
        $ledgeNode = $this->getRootNodeImplementation('/testPath/testLedge');
        $arcNode = $this->createArcNodeImplementation($rootNode, '/testNode', $ledgeNode);

        $this->assertContains('getLinkedRootNode', $arcNode->getOutboundProviders());
    }

    public function testSetParentNode()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');
        $ledgeNode = $this->getRootNodeImplementation('/testPath/testLedge');

        $this->assertEquals($ledgeNode, $ledgeNode->setParentNode($rootNode));

        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\ArcNodeInterface', $ledgeNode->getParentNode());
        $this->assertTrue($rootNode->getChildren()->containsKey($ledgeNode->getNodeName()));
        $this->assertTrue($rootNode->getChildNodes()->containsKey($ledgeNode->getNodeName()));
        $this->assertEquals($rootNode->getChildNodes()->get($ledgeNode->getNodeName()), $ledgeNode->getParentNode());
        $this->assertEquals($ledgeNode, $rootNode->getChildNodes()->get($ledgeNode->getNodeName())->getLinkedRootNode());

        $this->assertTrue($rootNode->isLedgeNode());
        $this->assertTrue($rootNode->isRootNode());
        $this->assertTrue($ledgeNode->isLedgeNode());
        $this->assertFalse($ledgeNode->isRootNode());

        $this->assertNull($ledgeNode->getParentDocument());

        $this->assertEquals('/', $rootNode->getNodePath());
        $this->assertEquals('/testLedge', $rootNode->getChildNodes()->get($ledgeNode->getNodeName())->getNodePath());
        $this->assertEquals('/testLedge', $ledgeNode->getNodePath());
    }
}
