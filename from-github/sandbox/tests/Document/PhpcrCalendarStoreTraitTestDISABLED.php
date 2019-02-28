<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\Traits\PhpcrCalendarStoreTrait;
use App\Model\CalendarInterface;
use App\Model\CalendarStoreInterface;

class PhpcrCalendarStoreTraitTest extends TestCase {
    public function testSetCalendarBagSetsBag() {
        $trait = $this->getMockForTrait(PhpcrCalendarStoreTrait::class);
        $bag = $this->createMock(CalendarStoreInterface::class);
        $bag->method('getNodename')->willReturn('testbag');
        $trait->setCalendarNodes($bag);
        $this->assertEquals($bag, $trait->getCalendarNodes());
    }

    public function testAddCalendarNode() {
        $trait = $this->getMockForTrait(PhpcrCalendarStoreTrait::class);
        $node = $this->createMock(CalendarInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addCalendarNode($node);
        $this->assertEquals($node, $trait->getCalendarNode('testnode'));
    }

    public function testRemoveCalendarNode() {
        $trait = $this->getMockForTrait(PhpcrCalendarStoreTrait::class);
        $node = $this->createMock(CalendarInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addCalendarNode($node);
        $trait->removeCalendarNode($node);
        $this->assertFalse($trait->hasCalendarNode($node));
    }

    public function testRemoveCalendarName() {
        $trait = $this->getMockForTrait(PhpcrCalendarStoreTrait::class);
        $node = $this->createMock(CalendarInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addCalendarNode($node);
        $trait->removeCalendarName('testnode');
        $this->assertFalse($trait->hasCalendarName('testnode'));
    }

    public function testSetCalendarNode() {
        $trait = $this->getMockForTrait(PhpcrCalendarStoreTrait::class);
        $node = $this->createMock(CalendarInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->setCalendarNode('testnode', $node);
        $this->assertTrue($trait->hasCalendarNode($node));
    }
}
