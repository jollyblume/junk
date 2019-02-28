<?php

namespace OldApp\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\CalendarTrash;
use App\Document\CalendarNode;

class CalendarTrashTest extends TestCase
{
    public function testGetNodeType()
    {
        $trashBag = new CalendarTrash();
        $this->assertEquals('CalendarTrash', $trashBag->getNodeType());
    }

    public function testAddCalendarTrashNode()
    {
        $trashBag = new CalendarTrash();
        $trash = $this->createMock(CalendarNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addCalendarTrashNode($trash);
        $this->assertEquals($trash, $trashBag->getCalendarTrashNode('testnodename'));
    }

    public function testRemoveCalendarTrashNode()
    {
        $trashBag = new CalendarTrash();
        $trash = $this->createMock(CalendarNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addCalendarTrashNode($trash);
        $trashBag->removeCalendarTrashNode($trash);
        $this->assertFalse($trashBag->hasCalendarTrashNode($trash));
    }

    public function testRemoveCalendarTrashName()
    {
        $trashBag = new CalendarTrash();
        $trash = $this->createMock(CalendarNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addCalendarTrashNode($trash);
        $trashBag->removeCalendarTrashName('testnodename');
        $this->assertFalse($trashBag->hasCalendarTrashName('testnodename'));
    }

    public function testGetCalendarTrashNode()
    {
        $trashBag = new CalendarTrash();
        $trash = $this->createMock(CalendarNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addCalendarTrashNode($trash);
        $gottenTrash = $trashBag->getCalendarNode('testnodename');
        $this->assertEquals($trash, $gottenTrash);
    }

    public function testSetCalendarTrashNode()
    {
        $this->markTestSkipped('need functional test');
    }
}
