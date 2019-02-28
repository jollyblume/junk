<?php

namespace OldApp\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\TournamentTrash;
use App\Document\TournamentNode;

class TournamentTrashTest extends TestCase
{
    public function testGetNodeType()
    {
        $trashBag = new TournamentTrash();
        $this->assertEquals('TournamentTrash', $trashBag->getNodeType());
    }

    public function testAddTournamentTrashNode()
    {
        $trashBag = new TournamentTrash();
        $trash = $this->createMock(TournamentNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addTournamentTrashNode($trash);
        $this->assertEquals($trash, $trashBag->getTournamentTrashNode('testnodename'));
    }

    public function testRemoveTournamentTrashNode()
    {
        $trashBag = new TournamentTrash();
        $trash = $this->createMock(TournamentNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addTournamentTrashNode($trash);
        $trashBag->removeTournamentTrashNode($trash);
        $this->assertFalse($trashBag->hasTournamentTrashNode($trash));
    }

    public function testRemoveTournamentTrashName()
    {
        $trashBag = new TournamentTrash();
        $trash = $this->createMock(TournamentNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addTournamentTrashNode($trash);
        $trashBag->removeTournamentTrashName('testnodename');
        $this->assertFalse($trashBag->hasTournamentTrashName('testnodename'));
    }

    public function testGetTournamentTrashNode()
    {
        $trashBag = new TournamentTrash();
        $trash = $this->createMock(TournamentNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addTournamentTrashNode($trash);
        $gottenTrash = $trashBag->getTournamentNode('testnodename');
        $this->assertEquals($trash, $gottenTrash);
    }

    public function testSetTournamentTrashNode()
    {
        $this->markTestSkipped('need functional test');
    }
}
