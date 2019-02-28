<?php

namespace OldApp\Tests\Data;

use App\Tests\BaseFunctionalTest;
use App\Document\PlayerTree;

class DataManagerFunctionalTest extends BaseFunctionalTest
{
    public function testGetManager()
    {
        $dataManager = $this->getDataManager();
        $manager = $this->getManager();
        $this->assertEquals($manager, $dataManager->getManager());
    }

    public function testGetRootNode()
    {
        $dataManager = $this->getDataManager();
        $rootNode = $this->findTestRootNode();
        $this->assertEquals($rootNode, $dataManager->getRootNode());
    }

    /**
     * @expectedException  \App\Exception\RootNodeMissingException
     */
    public function testGetRootNodeThrowsIfMissing()
    {
        $this->removeTestRootNode();
        $dataManager = $this->getDataManager();
        $dataManager->getRootNode();
    }

    public function testFind()
    {
        $dataManager = $this->getDataManager();
        $this->resetTestRootNode();
        $expected = $this->findTestRootNode();
        $foundRootNode = $dataManager->find($this->getBasePath());
        $this->assertEquals($expected, $foundRootNode);
    }

    public function testPersistAlsoPersistsSibling()
    {
        $dataManager = $this->getDataManager();
        $this->resetTestRootNode();
        $rootNode = $this->findTestRootNode();
        $playerTree = new PlayerTree();
        $playerTree->setNodename('testplayer')->setParent($rootNode);
        $leagueTree = new PlayerTree();
        $leagueTree->setNodename('testleague')->setParent($rootNode);
        $rootNode->addTreeNode($playerTree)->addTreeNode($leagueTree);
        $dataManager->persist($playerTree);
        $dataManager->flush();
        $path = $this->getFullPath('testleague');
        $foundLeagueTree = $dataManager->find($path);
        $this->assertNotNull($foundLeagueTree);
    }
}
