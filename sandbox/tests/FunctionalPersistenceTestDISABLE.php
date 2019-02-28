<?php

namespace App\Tests;

use PHPCR\Util\UUIDHelper;
use Doctrine\Bundle\PHPCRBundle\ManagerRegistry;
use Doctrine\ODM\PHPCR\DocumentManager;
use App\Initializer\PhpcrInitializer;
use App\Document\RootNode;
use App\Model\ParentNodeInterface;

class FunctionalPersistenceTest extends BaseFunctionalTest
{
    protected function buildGraph()
    {
        $this->resetTestRootNodeToDefaults();
        $rootNode = $this->findTestRootNode();

        $rootNodeChildren = [
            'emailBag' => '\App\Document\EmailBag',
            'calendarBag' => '\App\Document\CalendarBag',
            'playerBag' => '\App\Document\PlayerBag',
            'leagueBag' => '\App\Document\LeagueBag',
            'locationBag' => '\App\Document\LocationBag',
        ];

        foreach ($rootNodeChildren as $nodename => $nodeclass) {
            $treeNode = new $nodeclass();
            $treeNode->setNodename($nodename);
            $rootNode->addParentNode($treeNode);
        }
        foreach ($rootNode as $treeNode) {
            $nodenames = [
                'Node 1',
                'Node 2',
                'Node 3',
            ];

            $fillTrees = [
                'Player',
                'League',
                'Location',
            ];

            foreach ($fillTrees as $bagNodeType) {
                if ($bagNodeType === $treeNode->getSemanticNodeType()) {
                    $this->populateBag($rootNode, $treeNode, $nodenames);
                }
            }
        }

        $this->persistTestNode($rootNode);
        $this->flushTestNode();

        return $rootNode;
    }

    protected function populateBag(RootNode $rootNode, ParentNodeInterface $bagNode, array $nodenames)
    {
        $rootNodename = $rootNode->getNodename();
        $bagNodename = $bagNode->getNodename();
        foreach ($nodenames as $nodename) {
            $testNodename = sprintf('%s %s %s', $rootNodename, $bagNodename, $nodename);
            $testNodeclass = sprintf('App\Document\%sNode', $bagNode->getSemanticNodeType());
            $testNode = new $testNodeclass();
            $testNode->setNodename($testNodename);
            $method = sprintf('add%sNode', $bagNode->getSemanticNodeType());
            $bagNode->$method($testNode);

            // $nodenames = [
            //     'Node Tag 1',
            //     'Node Tag 2',
            //     'Node Tag 3',
            // ];
            // $this->populateNode($testNode, $nodenames);
        }
    }

    // protected function populateNode(AbstractNode $node, array $nodenames)
    // {
    //     foreach ($nodenames as $nodename) {
    //         $tag = new GenericCookie();
    //         $tag->setNodename($nodename);
    //         $tag->setParent($node);
    //         $node->getChildren()->set($nodename, $tag);
    //     }
    // }

    public function testMoveABranch() {
        $rootNode = $this->buildGraph();
        $playerBag = $rootNode['player'];
        $playerBag->setNodename('playerMoved');
        $this->assertTrue(isset($rootNode['playerMoved']));
        $this->assertFalse(isset($rootNode['player']));
        $this->assertEquals('playerMoved', $playerBag->getNodename());
        $expected = sprintf('%s/playerMoved', $this->getBasePath());
        $this->assertEquals($expected, $playerBag->getIdentifier());
        $expectedId = sprintf('%s/playerMoved/app_test player Node 1', $this->getBasePath());
        $node = $playerBag->first();
        $this->assertEquals($expectedId, $node->getIdentifier());
        return $rootNode;
    }

    /** @depends testMoveABranch */
    public function testMoveABranchOkAfterPersist(RootNode $rootNode) {
        $this->persistTestNode($rootNode);
        $this->flushTestNode();
        $expectedId = sprintf('%s/playerMoved/app_test player Node 1', $this->getBasePath());
        $playerBag = $rootNode['playerMoved'];
        $node = $playerBag->first();
        $this->assertEquals($expectedId, $node->getIdentifier());
    }

    /** @depends testMoveABranch */
    public function testGetParentIdForRootNode(RootNode $rootNode) {
        $this->persistTestNode($rootNode);
        $this->flushTestNode();
        $this->assertEquals('/', $rootNode->getParentIdentifier());
    }

    /** @depends testMoveABranch */
    public function testSetParentToNullDisconnectsNode(RootNode $rootNode) {
        // $rootNode = $this->buildGraph();
        $emailBag = $rootNode['email'];
        $emailBag->setParent(null);
        $this->assertFalse($rootNode->hasParentName('email'));
        $this->assertFalse($rootNode->hasParentNode($emailBag));
        $this->assertNull($emailBag->getParent());
        return $rootNode;
    }

    /** @depends testSetParentToNullDisconnectsNode */
    public function testSetParentToNullAfterPersist(RootNode $rootNode) {
        $this->persistTestNode($rootNode);
        $this->flushTestNode();
        $this->assertFalse($rootNode->hasParentName('email'));
    }
}
