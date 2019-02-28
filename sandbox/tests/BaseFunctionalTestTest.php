<?php

namespace App\Tests;

use PHPCR\Util\UUIDHelper;
use Doctrine\Bundle\PHPCRBundle\ManagerRegistry;
use Doctrine\ODM\PHPCR\DocumentManager;
use App\Data\DataManager;
use App\Initializer\PhpcrInitializer;
use App\Document\RootNode;
use App\Document\PlayerBag;

class BaseFunctionalTestTest extends BaseFunctionalTest
{
    public function testGetBasePath()
    {
        $basePath = BaseFunctionalTest::BASE_PATH;
        $this->assertEquals($basePath, $this->getBasePath());
    }

    public function testGetFullPath()
    {
        $basePath = BaseFunctionalTest::BASE_PATH;
        $fullPath = sprintf('%s/%s', $basePath, 'player');
        $this->assertEquals($fullPath, $this->getFullPath('player'));
    }

    public function testGetFullPathWithEmptyPath()
    {
        $basePath = BaseFunctionalTest::BASE_PATH;
        $this->assertEquals($basePath, $this->getFullPath(''));
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function testGetUuidTrue()
    {
        $uuid = UUIDHelper::generateUUID();
        $this->assertTrue($this->isUuid($uuid));
    }

    public function testGetUuidFalse()
    {
        $uuid = 'testfakeuuid';
        $this->assertFalse($this->isUuid($uuid));
    }

    public function testGetRegistry()
    {
        $registry = $this->getRegistry();
        $this->assertInstanceOf(ManagerRegistry::class, $registry);
    }

    public function testGetManager()
    {
        $manager = $this->getManager();
        $this->assertInstanceOf(DocumentManager::class, $manager);
    }

    public function testGetPhpcrInitializer()
    {
        $initializer = $this->getPhpcrInitializer();
        $this->assertInstanceOf(PhpcrInitializer::class, $initializer);
    }

    public function testGetTreeNodeDataCount()
    {
        $this->assertCount(7, $this->getTreeNodeData());
    }

    public function testGetTreeNodesCount()
    {
        $this->assertCount(7, $this->getTreeNodes());
    }

    public function testGetDocumentNodesCount()
    {
        $this->assertCount(7, $this->getDocumentNodes());
    }

    public function testFindTestNodeNullIfMissing()
    {
        $this->removeTestRootNode();
        $testNode = $this->findTestNode();
        $this->assertNull($testNode);
    }

    public function testFindTestNodeIfExisting()
    {
        $this->resetTestRootNode();
        $testNode = $this->findTestNode();
        $this->assertInstanceOf(RootNode::class, $testNode);
    }

    public function testRemoveTestNodeHandleNode()
    {
        $this->resetTestRootNode();
        $rootNode = $this->findTestRootNode();
        $this->assertNotNull($rootNode);
        $this->removeTestNode($rootNode);
        $rootNode = $this->findTestRootNode();
        $this->assertNull($rootNode);
    }

    /**
     * @expectedException \App\Exception\UnexpectedNullException
     */
    public function testRemoveTestNodeThrowsIfNull()
    {
        $this->removeTestNode(null);
    }

    public function testResetTestRootNode()
    {
        $this->resetTestRootNode();
        $rootNode = $this->findTestRootNode();
        $this->assertNotNull($rootNode);
        $this->assertCount(0, $rootNode);
    }

    public function testResetTestRootNodeToDefaults()
    {
        $this->resetTestRootNodeToDefaults();
        $countTreeClasses = count($this->getTreeNodeData());
        $rootNode = $this->findTestRootNode();
        $this->assertNotNull($rootNode);
        $countTreeNodes = $rootNode->count();
        $this->assertEquals($countTreeClasses, $countTreeNodes);
    }

    public function testPersistFlushTestNode()
    {
        $this->resetTestRootNode();

        $rootNode = $this->findTestRootNode();
        $this->assertNotNull($rootNode);

        $tree = new PlayerBag();
        $tree->setNodename('testTree')->setParent($rootNode);
        $this->persistTestNode();
        $this->flushTestNode();
        $this->assertTrue(isset($rootNode['testTree']));
        $foundTree = $this->findTestNode('testTree');
        $this->assertNotNull($foundTree);
    }
}
