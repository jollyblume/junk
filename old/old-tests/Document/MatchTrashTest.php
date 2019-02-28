<?php

namespace OldApp\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\MatchTrash;
use App\Document\MatchNode;

class MatchTrashTest extends TestCase
{
    public function testGetNodeType()
    {
        $trashBag = new MatchTrash();
        $this->assertEquals('MatchTrash', $trashBag->getNodeType());
    }

    public function testAddMatchTrashNode()
    {
        $trashBag = new MatchTrash();
        $trash = $this->createMock(MatchNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addMatchTrashNode($trash);
        $this->assertEquals($trash, $trashBag->getMatchTrashNode('testnodename'));
    }

    public function testRemoveMatchTrashNode()
    {
        $trashBag = new MatchTrash();
        $trash = $this->createMock(MatchNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addMatchTrashNode($trash);
        $trashBag->removeMatchTrashNode($trash);
        $this->assertFalse($trashBag->hasMatchTrashNode($trash));
    }

    public function testRemoveMatchTrashName()
    {
        $trashBag = new MatchTrash();
        $trash = $this->createMock(MatchNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addMatchTrashNode($trash);
        $trashBag->removeMatchTrashName('testnodename');
        $this->assertFalse($trashBag->hasMatchTrashName('testnodename'));
    }

    public function testGetMatchTrashNode()
    {
        $trashBag = new MatchTrash();
        $trash = $this->createMock(MatchNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addMatchTrashNode($trash);
        $gottenTrash = $trashBag->getMatchNode('testnodename');
        $this->assertEquals($trash, $gottenTrash);
    }

    public function testSetMatchTrashNode()
    {
        $this->markTestSkipped('need functional test');
    }
}
