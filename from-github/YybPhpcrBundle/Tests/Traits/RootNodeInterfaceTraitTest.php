<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Tests\Traits;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class RootNodeInterfaceTraitTest extends TraitTestBase
{
    public function testOutboundProviders()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');

        $this->assertCount(3, $rootNode->getOutboundProviders());
        $this->assertContains('getParentNode', $rootNode->getOutboundProviders());
        $this->assertContains('getChildNodes', $rootNode->getOutboundProviders());
        $this->assertContains('getLinkNodes', $rootNode->getOutboundProviders());
        $this->assertNotContains('getLinkedRootNode', $rootNode->getOutboundProviders());
    }

    public function testGetNodeName()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');

        $this->assertEquals('testRoot', $rootNode->getNodeName());
    }

    public function testGetDocumentId()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');

        $this->assertEquals('/testPath/testRoot', $rootNode->getDocumentId());
    }

    public function testGetParentDocument()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');

        $this->assertNull($rootNode->getParentDocument());
    }

    public function testGetParentNode()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');

        $this->assertNull($rootNode->getParentNode());
    }

    public function testGetNodePath()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');

        $this->assertEquals('/', $rootNode->getNodePath());
    }

    public function testGetRoot()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');

        $this->assertEquals($rootNode, $rootNode->getRootNode());
    }

    public function testGetLedge()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');

        $this->assertEquals($rootNode, $rootNode->getLedgeNode());
    }

    public function testIsRoot()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');

        $this->assertTrue($rootNode->isRootNode());
    }

    public function testIsLedge()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');

        $this->assertTrue($rootNode->isLedgeNode());
    }

    public function testIsLinkable()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');

        $this->assertTrue($rootNode->isLinkableNode());
    }
}
