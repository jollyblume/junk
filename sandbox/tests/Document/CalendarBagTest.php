<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\CalendarBag;
use App\Document\CalendarNode;

class CalendarBagTest extends TestCase {
    public function testGetSemanticNodeType() {
        $bag = new CalendarBag();
        $this->assertEquals('Calendar', $bag->getSemanticNodeType());
    }

    public function testAddCalendarNode() {
        $bag = new CalendarBag();
        $child = new CalendarNode();
        $child->setNodename('test child');
        $bag->add($child);
        $this->assertEquals($child, $bag->getCalendarNode('test child'));
    }

    public function testRemoveCalendarNode() {
        $bag = new CalendarBag();
        $child = new CalendarNode();
        $child->setNodename('test child');
        $bag->add($child);
        $bag->removeElement($child);
        $this->assertFalse($bag->hasCalendarNode($child));
    }

    public function testRemoveCalendarName() {
        $bag = new CalendarBag();
        $child = new CalendarNode();
        $child->setNodename('test child');
        $bag->add($child);
        $bag->remove('test child');
        $this->assertFalse($bag->hasCalendarName('test child'));
    }

    public function testSetCalendarNode() {
        $bag = new CalendarBag();
        $child = new CalendarNode();
        $child->setNodename('test child');
        $bag->set('test child', $child);
        $this->assertTrue($bag->hasCalendarName('test child'));
    }
}
