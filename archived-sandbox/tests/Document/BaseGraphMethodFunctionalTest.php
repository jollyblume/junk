<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\RootNode;
use App\Document\BagInterface;
use App\Document\AbstractNode;
use App\Document\GenericCookie;

abstract class BaseGraphMethodFunctionalTest extends TestCase
{
    protected function buildGraph(RootNode $rootNode)
    {
        $rootNodeChildren = [
            'emailTree' => '\App\Document\EmailTree',
            'calendarTree' => '\App\Document\CalendarTree',
            'playerTree' => '\App\Document\PlayerTree',
            'leagueTree' => '\App\Document\LeagueTree',
            'locationTree' => '\App\Document\LocationTree',
            'emailTrash' => '\App\Document\EmailTrash',
            'calendarTrash' => '\App\Document\CalendarTrash',
            'playerTrash' => '\App\Document\PlayerTrash',
            'leagueTrash' => '\App\Document\LeagueTrash',
            'locationTrash' => '\App\Document\LocationTrash',
            'matchTrash' => '\App\Document\MatchTrash',
            'teamTrash' => '\App\Document\TeamTrash',
            'tournamentTrash' => '\App\Document\TournamentTrash',
        ];

        foreach ($rootNodeChildren as $nodename => $nodeclass) {
            $treeNode = new $nodeclass();
            $treeNode->setNodename($nodename);
            $rootNode->addTreeNode($treeNode);
        }
        foreach ($rootNode->getChildren() as $treeNode) {
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
                if ($bagNodeType === $treeNode->getNodeType()) {
                    $this->populateBag($rootNode, $treeNode, $nodenames);
                }
            }
        }

        return $rootNode;
    }

    protected function populateBag(RootNode $rootNode, BagInterface $bagNode, array $nodenames)
    {
        $rootNodename = $rootNode->getNodename();
        $bagNodename = $bagNode->getNodename();
        foreach ($nodenames as $nodename) {
            $testNodename = sprintf('%s %s %s', $rootNodename, $bagNodename, $nodename);
            $testNodeclass = sprintf('App\Document\%sNode', $bagNode->getNodeType());
            $testNode = new $testNodeclass();
            $testNode->setNodename($testNodename);
            $method = sprintf('add%sNode', $bagNode->getNodeType());
            $bagNode->$method($testNode);

            $nodenames = [
                'Node Tag 1',
                'Node Tag 2',
                'Node Tag 3',
            ];
            $this->populateNode($testNode, $nodenames);
        }
    }

    protected function populateNode(AbstractNode $node, array $nodenames)
    {
        foreach ($nodenames as $nodename) {
            $tag = new GenericCookie();
            $tag->setNodename($nodename);
            $tag->setParent($node);
            $node->getChildren()->set($nodename, $tag);
        }
    }
}
