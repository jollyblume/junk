<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Tests\Traits;

use Doctrine\ODM\PHPCR\Document\Generic;

class ChildNodesInterfaceTraitTest extends TraitTestBase
{
    public function testCollectionInitialized()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');

        $this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection', $rootNode->getChildren());
        $this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection', $rootNode->getChildNodes());
    }

    public function testGetChildNodesReturnsOnlyNodes()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');
        $ignoredNode = new Generic();
        $ignoredNode->setNodename('testIgnoredNode');
        $ignoredNode->setParentDocument($rootNode);
        $rootNode->getChildren()->set('testIgnoredNode', $ignoredNode);
        $this->createNodeImplementation($rootNode, 'testNode');

        $this->assertTrue($rootNode->getChildren()->containsKey('testIgnoredNode'));
        $this->assertTrue($rootNode->getChildren()->containsKey('testNode'));
        $this->assertFalse($rootNode->getChildNodes()->containsKey('testIgnoredNode'));
        $this->assertTrue($rootNode->getChildNodes()->containsKey('testNode'));
    }

    public function testGetChildNodesIgnoresHiddenChildren()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');
        $ignoredNode = new Generic();
        $ignoredNode->setNodename('testIgnoredNode');
        $ignoredNode->setParentDocument($rootNode);
        $rootNode->getChildren()->set('testIgnoredNode', $ignoredNode);
        $this->createHiddenNodeImplementation($rootNode, 'testHiddenNode');
        $this->createNodeImplementation($rootNode, 'testNode');

        $this->assertTrue($rootNode->getChildren()->containsKey('testIgnoredNode'));
        $this->assertTrue($rootNode->getChildren()->containsKey('testHiddenNode'));
        $this->assertTrue($rootNode->getChildren()->containsKey('testNode'));
        $this->assertFalse($rootNode->getChildNodes()->containsKey('testIgnoredNode'));
        $this->assertFalse($rootNode->getChildNodes()->containsKey('testHiddenNode'));
        $this->assertTrue($rootNode->getChildNodes()->containsKey('testNode'));
    }

        public function testGetHiddenNodesIgnoresChildNodes()
        {
            $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');
            $ignoredNode = new Generic();
            $ignoredNode->setNodename('testIgnoredNode');
            $ignoredNode->setParentDocument($rootNode);
            $rootNode->getChildren()->set('testIgnoredNode', $ignoredNode);
            $this->createHiddenNodeImplementation($rootNode, 'testHiddenNode');
            $this->createNodeImplementation($rootNode, 'testNode');

            $this->assertTrue($rootNode->getChildren()->containsKey('testIgnoredNode'));
            $this->assertTrue($rootNode->getChildren()->containsKey('testHiddenNode'));
            $this->assertTrue($rootNode->getChildren()->containsKey('testNode'));
            $this->assertFalse($rootNode->getHiddenNodes()->containsKey('testIgnoredNode'));
            $this->assertTrue($rootNode->getHiddenNodes()->containsKey('testHiddenNode'));
            $this->assertFalse($rootNode->getHiddenNodes()->containsKey('testNode'));
        }
}
