<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\LeagueTrash;
use App\Document\LeagueNode;

class LeagueTrashTest extends TestCase
{
    public function testGetNodeType()
    {
        $trashBag = new LeagueTrash();
        $this->assertEquals('LeagueTrash', $trashBag->getNodeType());
    }

    public function testAddLeagueTrashNode()
    {
        $trashBag = new LeagueTrash();
        $trash = $this->createMock(LeagueNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addLeagueTrashNode($trash);
        $this->assertEquals($trash, $trashBag->getLeagueTrashNode('testnodename'));
    }

    public function testRemoveLeagueTrashNode()
    {
        $trashBag = new LeagueTrash();
        $trash = $this->createMock(LeagueNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addLeagueTrashNode($trash);
        $trashBag->removeLeagueTrashNode($trash);
        $this->assertFalse($trashBag->hasLeagueTrashNode($trash));
    }

    public function testRemoveLeagueTrashName()
    {
        $trashBag = new LeagueTrash();
        $trash = $this->createMock(LeagueNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addLeagueTrashNode($trash);
        $trashBag->removeLeagueTrashName('testnodename');
        $this->assertFalse($trashBag->hasLeagueTrashName('testnodename'));
    }

    public function testGetLeagueTrashNode()
    {
        $trashBag = new LeagueTrash();
        $trash = $this->createMock(LeagueNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addLeagueTrashNode($trash);
        $gottenTrash = $trashBag->getLeagueNode('testnodename');
        $this->assertEquals($trash, $gottenTrash);
    }

    public function testSetLeagueTrashNode()
    {
        $this->markTestSkipped('need functional test');
    }
}
