<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\PlayerTrash;
use App\Document\PlayerNode;

class PlayerTrashTest extends TestCase
{
    public function testGetNodeType()
    {
        $trashBag = new PlayerTrash();
        $this->assertEquals('PlayerTrash', $trashBag->getNodeType());
    }

    public function testAddPlayerTrashNode()
    {
        $trashBag = new PlayerTrash();
        $trash = $this->createMock(PlayerNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addPlayerTrashNode($trash);
        $this->assertEquals($trash, $trashBag->getPlayerTrashNode('testnodename'));
    }

    public function testRemovePlayerTrashNode()
    {
        $trashBag = new PlayerTrash();
        $trash = $this->createMock(PlayerNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addPlayerTrashNode($trash);
        $trashBag->removePlayerTrashNode($trash);
        $this->assertFalse($trashBag->hasPlayerTrashNode($trash));
    }

    public function testRemovePlayerTrashName()
    {
        $trashBag = new PlayerTrash();
        $trash = $this->createMock(PlayerNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addPlayerTrashNode($trash);
        $trashBag->removePlayerTrashName('testnodename');
        $this->assertFalse($trashBag->hasPlayerTrashName('testnodename'));
    }

    public function testGetPlayerTrashNode()
    {
        $trashBag = new PlayerTrash();
        $trash = $this->createMock(PlayerNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addPlayerTrashNode($trash);
        $gottenTrash = $trashBag->getPlayerNode('testnodename');
        $this->assertEquals($trash, $gottenTrash);
    }

    public function testSetPlayerTrashNode()
    {
        $this->markTestSkipped('need functional test');
    }
}
