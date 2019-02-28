<?php

namespace OldApp\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\TeamTrash;
use App\Document\TeamNode;

class TeamTrashTest extends TestCase
{
    public function testGetNodeType()
    {
        $trashBag = new TeamTrash();
        $this->assertEquals('TeamTrash', $trashBag->getNodeType());
    }

    public function testAddTeamTrashNode()
    {
        $trashBag = new TeamTrash();
        $trash = $this->createMock(TeamNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addTeamTrashNode($trash);
        $this->assertEquals($trash, $trashBag->getTeamTrashNode('testnodename'));
    }

    public function testRemoveTeamTrashNode()
    {
        $trashBag = new TeamTrash();
        $trash = $this->createMock(TeamNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addTeamTrashNode($trash);
        $trashBag->removeTeamTrashNode($trash);
        $this->assertFalse($trashBag->hasTeamTrashNode($trash));
    }

    public function testRemoveTeamTrashName()
    {
        $trashBag = new TeamTrash();
        $trash = $this->createMock(TeamNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addTeamTrashNode($trash);
        $trashBag->removeTeamTrashName('testnodename');
        $this->assertFalse($trashBag->hasTeamTrashName('testnodename'));
    }

    public function testGetTeamTrashNode()
    {
        $trashBag = new TeamTrash();
        $trash = $this->createMock(TeamNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addTeamTrashNode($trash);
        $gottenTrash = $trashBag->getTeamNode('testnodename');
        $this->assertEquals($trash, $gottenTrash);
    }

    public function testSetTeamTrashNode()
    {
        $this->markTestSkipped('need functional test');
    }
}
