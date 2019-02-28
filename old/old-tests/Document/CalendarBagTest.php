<?php

namespace OldApp\Tests\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\CalendarBag;
use App\Document\CalendarNode;
use App\Document\AbstractNode;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;
use function array_keys;
use function array_search;
use function array_values;
use function count;
use function current;
use function end;
use function key;
use function next;
use function reset;

/**
 * CalendarBagTest
 *
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class CalendarBagTest extends TestCase {
    public function testGetNodeType() {
        $bag = new CalendarBag();
        $this->assertEquals('Calendar', $bag->getNodeType());
    }

    public function testSupportsTrue() {
        $bag = new CalendarBag();
        $node = $this->createMock(CalendarNode::class);
        $this->assertTrue($bag->supports($node));
    }

    public function testSupportsFalse() {
        $bag = new CalendarBag();
        $calendarNode = $this->createMock(AbstractNode::class);
        $this->assertFalse($bag->supports($calendarNode));
    }

    public function testConstructSetChildren(): void {
        $bag = new CalendarBag();
        $this->assertInstanceOf(ArrayCollection::class, $bag->getChildren());
    }

    public function testAddCalendarNode() {
        $bag = new CalendarBag();
        $calendarNode = $this->createMock(CalendarNode::class);
        $calendarNode->method('getNodename')->willReturn('testnodename');
        $bag->addCalendarNode($calendarNode);
        $this->assertTrue($bag->hasCalendarNode($calendarNode));
    }

    public function testGetCalendarNode() {
        $bag = new CalendarBag();
        $calendarNode1 = $this->createMock(CalendarNode::class);
        $calendarNode1->method('getNodename')->willReturn('testnodename1');
        $calendarNode2 = $this->createMock(CalendarNode::class);
        $calendarNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addCalendarNode($calendarNode1);
        $bag->addCalendarNode($calendarNode2);

        $this->assertEquals($calendarNode2, $bag->getCalendarNode('testnodename2'));
    }

    public function testHasCalendarName() {
        $bag = new CalendarBag();
        $calendarNode = $this->createMock(CalendarNode::class);
        $calendarNode->method('getNodename')->willReturn('testnodename');
        $bag->addCalendarNode($calendarNode);
        $this->assertTrue($bag->hasCalendarName('testnodename'));
    }

    public function testRemoveCalendarNode() {
        $bag = new CalendarBag();
        $calendarNode = $this->createMock(CalendarNode::class);
        $calendarNode->method('getNodename')->willReturn('testnodename');
        $bag->addCalendarNode($calendarNode);
        $bag->removeCalendarNode($calendarNode);
        $this->assertFalse($bag->hasCalendarNode($calendarNode));
    }

    public function testRemoveCalendarName() {
        $bag = new CalendarBag();
        $calendarNode = $this->createMock(CalendarNode::class);
        $calendarNode->method('getNodename')->willReturn('testnodename');
        $bag->addCalendarNode($calendarNode);
        $bag->removeCalendarName('testnodename');
        $this->assertFalse($bag->hasCalendarName('testnodename'));
    }
}
