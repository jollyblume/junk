<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Tests\Traits;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class NodeInterfaceTraitTest extends TraitTestBase
{
        public function testOutboundProviders()
        {
            $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');
            $node = $this->createNodeImplementation($rootNode, 'testNode');

            $this->assertCount(1, $node->getOutboundProviders());
            $this->assertContains('getParentNode', $node->getOutboundProviders());
            $this->assertNotContains('getChildNodes', $node->getOutboundProviders());
            $this->assertNotContains('getLinkNodes', $node->getOutboundProviders());
            $this->assertNotContains('getLinkedRootNode', $node->getOutboundProviders());
        }

        public function testGetNodeName()
        {
            $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');
            $node = $this->createNodeImplementation($rootNode, 'testNode');

            $this->assertEquals('testNode', $node->getNodeName());
        }

        public function testGetDocumentId()
        {
            $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');
            $node = $this->createNodeImplementation($rootNode, 'testNode');

            $this->assertEquals('/testPath/testRoot/testNode', $node->getDocumentId());
        }

        public function testGetParentDocument()
        {
            $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');
            $node = $this->createNodeImplementation($rootNode, 'testNode');

            $this->assertEquals($rootNode, $node->getParentDocument());
        }

        public function testGetParentNode()
        {
            $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');
            $node = $this->createNodeImplementation($rootNode, 'testNode');

            $this->assertEquals($rootNode, $node->getParentNode());
        }

        public function testGetNodePath()
        {
            $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');
            $node = $this->createNodeImplementation($rootNode, 'testNode');

            $this->assertEquals('/testNode', $node->getNodePath());
        }

        public function testGetRoot()
        {
            $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');
            $node = $this->createNodeImplementation($rootNode, 'testNode');

            $this->assertEquals($rootNode, $node->getRootNode());
        }

        public function testGetLedge()
        {
            $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');
            $node = $this->createNodeImplementation($rootNode, 'testNode');

            $this->assertEquals($rootNode, $node->getLedgeNode());
        }

        public function testIsRoot()
        {
            $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');
            $node = $this->createNodeImplementation($rootNode, 'testNode');

            $this->assertFalse($node->isRootNode());
        }

        public function testIsLedge()
        {
            $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');
            $node = $this->createNodeImplementation($rootNode, 'testNode');

            $this->assertFalse($node->isLedgeNode());
        }

        public function testIsLinkable()
        {
            $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');
            $node = $this->createNodeImplementation($rootNode, 'testNode');

            $this->assertFalse($node->isLinkableNode());
        }
}
