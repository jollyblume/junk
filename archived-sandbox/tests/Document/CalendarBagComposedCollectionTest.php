<?php

namespace App\Tests\Traits;

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
class CalendarBagComposedCollectionTest extends TestCase {
    protected function isSelectable($obj) : bool
    {
        return $obj instanceof Selectable;
    }

    public function testGet() {
        $bag = new CalendarBag();
        $calendarNode1 = $this->createMock(CalendarNode::class);
        $calendarNode1->method('getNodename')->willReturn('testnodename1');
        $calendarNode2 = $this->createMock(CalendarNode::class);
        $calendarNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addCalendarNode($calendarNode1);
        $bag->addCalendarNode($calendarNode2);

        $this->assertEquals($calendarNode2, $bag->get('testnodename2'));
    }

    public function testRemove() {
        $bag = new CalendarBag();
        $calendarNode = $this->createMock(CalendarNode::class);
        $calendarNode->method('getNodename')->willReturn('testnodename');
        $bag->addCalendarNode($calendarNode);
        $bag->remove('testnodename');
        $this->assertFalse($bag->hasCalendarName('testnodename'));
    }

    public function testRemoveElement() {
        $bag = new CalendarBag();
        $calendarNode = $this->createMock(CalendarNode::class);
        $calendarNode->method('getNodename')->willReturn('testnodename');
        $bag->addCalendarNode($calendarNode);
        $bag->removeElement($calendarNode);
        $this->assertFalse($bag->hasCalendarNode($calendarNode));
    }

    public function testOffsetSet() {
        $bag = new CalendarBag();
        $calendarNode = $this->createMock(CalendarNode::class);
        $calendarNode->method('getNodename')->willReturn('testnodename');
        $bag->offsetSet('testnodename', $calendarNode);
        $this->assertTrue($bag->hasCalendarNode($calendarNode));
    }

    public function testOffsetUnset() {
        $bag = new CalendarBag();
        $calendarNode = $this->createMock(CalendarNode::class);
        $calendarNode->method('getNodename')->willReturn('testnodename');
        $bag->offsetSet('testnodename', $calendarNode);
        $bag->offsetUnset('testnodename');
        $this->assertFalse($bag->hasCalendarName('testnodename'));
    }

    public function testSet() {
        $bag = new CalendarBag();
        $calendarNode = $this->createMock(CalendarNode::class);
        $calendarNode->method('getNodename')->willReturn('testnodename');
        $bag->set('testnodename', $calendarNode);
        $this->assertTrue($bag->hasCalendarNode($calendarNode));
    }

    public function testAdd() {
        $bag = new CalendarBag();
        $calendarNode = $this->createMock(CalendarNode::class);
        $calendarNode->method('getNodename')->willReturn('testnodename');
        $bag->add($calendarNode);
        $this->assertTrue($bag->hasCalendarNode($calendarNode));
    }

    /**
     * @expectedException   \App\Exception\PropImmutableException
     */
    public function testClearThrows() {
        $bag = new CalendarBag();
        $bag->clear();
    }

    // ***
    // *** following tests should be in a separate test suite
    // ***

    public function testFirst() {
        $bag = new CalendarBag();
        $calendarNode1 = $this->createMock(CalendarNode::class);
        $calendarNode1->method('getNodename')->willReturn('testnodename1');
        $calendarNode2 = $this->createMock(CalendarNode::class);
        $calendarNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addCalendarNode($calendarNode1);
        $bag->addCalendarNode($calendarNode2);
        self::assertSame($calendarNode1, $bag->first());
    }

    public function testLast()
    {
        $bag = new CalendarBag();
        $calendarNode1 = $this->createMock(CalendarNode::class);
        $calendarNode1->method('getNodename')->willReturn('testnodename1');
        $calendarNode2 = $this->createMock(CalendarNode::class);
        $calendarNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addCalendarNode($calendarNode1);
        $bag->addCalendarNode($calendarNode2);
        self::assertSame($calendarNode2, $bag->last());
    }

    public function testKey() : void
    {
        $bag = new CalendarBag();
        $calendarNode1 = $this->createMock(CalendarNode::class);
        $calendarNode1->method('getNodename')->willReturn('testnodename1');
        $calendarNode2 = $this->createMock(CalendarNode::class);
        $calendarNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addCalendarNode($calendarNode1);
        $bag->addCalendarNode($calendarNode2);

        self::assertSame('testnodename1', $bag->key());

        $bag->next();

        self::assertSame('testnodename2', $bag->key());
    }

    public function testCurrent() : void
    {
        $bag = new CalendarBag();
        $calendarNode1 = $this->createMock(CalendarNode::class);
        $calendarNode1->method('getNodename')->willReturn('testnodename1');
        $calendarNode2 = $this->createMock(CalendarNode::class);
        $calendarNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addCalendarNode($calendarNode1);
        $bag->addCalendarNode($calendarNode2);

        self::assertSame($calendarNode1, $bag->current());

        $bag->next();

        self::assertSame($calendarNode2, $bag->current());
    }

    public function testOffsetExistsTrue() {
        $bag = new CalendarBag();
        $calendarNode = $this->createMock(CalendarNode::class);
        $calendarNode->method('getNodename')->willReturn('testnodename');
        $bag->addCalendarNode($calendarNode);
        $this->assertTrue($bag->offsetExists('testnodename'));
    }

    public function testOffsetExistsFalse() {
        $bag = new CalendarBag();
        $this->assertFalse($bag->offsetExists('testnodename'));
    }

    public function testOffsetGetExists() {
        $bag = new CalendarBag();
        $calendarNode = $this->createMock(CalendarNode::class);
        $calendarNode->method('getNodename')->willReturn('testnodename');
        $bag->addCalendarNode($calendarNode);
        self::assertSame($calendarNode, $bag->offsetGet('testnodename'));
    }

    public function testOffsetGetMissing() {
        $bag = new CalendarBag();
        $this->assertNull($bag->offsetGet('testnodename'));
    }

    public function testContainsKey() {
        $bag = new CalendarBag();
        $calendarNode = $this->createMock(CalendarNode::class);
        $calendarNode->method('getNodename')->willReturn('testnodename');
        $bag->addCalendarNode($calendarNode);
        $this->assertTrue($bag->containsKey('testnodename'));
    }

    public function testContains() {
        $bag = new CalendarBag();
        $calendarNode = $this->createMock(CalendarNode::class);
        $calendarNode->method('getNodename')->willReturn('testnodename');
        $bag->addCalendarNode($calendarNode);
        $this->assertTrue($bag->contains($calendarNode));
    }

    public function testIndexOf() {
        $bag = new CalendarBag();
        $calendarNode1 = $this->createMock(CalendarNode::class);
        $calendarNode1->method('getNodename')->willReturn('testnodename1');
        $calendarNode2 = $this->createMock(CalendarNode::class);
        $calendarNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addCalendarNode($calendarNode1);
        $bag->addCalendarNode($calendarNode2);

        $this->assertEquals('testnodename2', $bag->indexOf($calendarNode2));
    }

    public function testGetKeys() {
        $bag = new CalendarBag();
        $calendarNode1 = $this->createMock(CalendarNode::class);
        $calendarNode1->method('getNodename')->willReturn('testnodename1');
        $calendarNode2 = $this->createMock(CalendarNode::class);
        $calendarNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addCalendarNode($calendarNode1);
        $bag->addCalendarNode($calendarNode2);

        $keys = [
            'testnodename1',
            'testnodename2',
        ];

        $this->assertEquals($keys, $bag->getKeys());
    }

    public function testGetValues() {
        $bag = new CalendarBag();
        $calendarNode1 = $this->createMock(CalendarNode::class);
        $calendarNode1->method('getNodename')->willReturn('testnodename1');
        $calendarNode2 = $this->createMock(CalendarNode::class);
        $calendarNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addCalendarNode($calendarNode1);
        $bag->addCalendarNode($calendarNode2);

        $keys = [
            $calendarNode1,
            $calendarNode2,
        ];

        $this->assertEquals($keys, $bag->getValues());
    }

    public function testCount() {
        $bag = new CalendarBag();
        $calendarNode1 = $this->createMock(CalendarNode::class);
        $calendarNode1->method('getNodename')->willReturn('testnodename1');
        $calendarNode2 = $this->createMock(CalendarNode::class);
        $calendarNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addCalendarNode($calendarNode1);
        $bag->addCalendarNode($calendarNode2);

        $this->assertEquals(2, $bag->count());
    }

    public function testIsEmpty() {
        $bag = new CalendarBag();
        $this->assertTrue($bag->isEmpty());
    }

    public function testGetIterator() : void
    {
        $bag = new CalendarBag();
        $calendarNode1 = $this->createMock(CalendarNode::class);
        $calendarNode1->method('getNodename')->willReturn('testnodename1');
        $calendarNode2 = $this->createMock(CalendarNode::class);
        $calendarNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addCalendarNode($calendarNode1);
        $bag->addCalendarNode($calendarNode2);

        $elements = [
            'testnodename1' => $calendarNode1,
            'testnodename2' => $calendarNode2,
        ];

        $iterations = 0;
        foreach ($bag->getIterator() as $key => $item) {
            self::assertSame($elements[$key], $item);
            ++$iterations;
        }

        self::assertEquals(count($elements), $iterations);
    }

    public function testToString() {
        $bag = new CalendarBag();
        $children = $bag->getChildren();
        $childrenString = get_class($children) . '@' . spl_object_hash($children);
        $this->assertEquals($childrenString, $bag->__toString());
    }

    public function testSlice() {
        $bag = new CalendarBag();
        $calendarNode1 = $this->createMock(CalendarNode::class);
        $calendarNode1->method('getNodename')->willReturn('testnodename1');
        $calendarNode2 = $this->createMock(CalendarNode::class);
        $calendarNode2->method('getNodename')->willReturn('testnodename2');
        $calendarNode3 = $this->createMock(CalendarNode::class);
        $calendarNode3->method('getNodename')->willReturn('testnodename3');
        $bag->addCalendarNode($calendarNode1);
        $bag->addCalendarNode($calendarNode2);
        $bag->addCalendarNode($calendarNode3);

        $slice = [
            'testnodename2' => $calendarNode2,
            'testnodename3' => $calendarNode2,
        ];

        $this->assertEquals($slice, $bag->slice(1));
    }

    public function testToArray() {
        $bag = new CalendarBag();
        $calendarNode1 = $this->createMock(CalendarNode::class);
        $calendarNode1->method('getNodename')->willReturn('testnodename1');
        $calendarNode2 = $this->createMock(CalendarNode::class);
        $calendarNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addCalendarNode($calendarNode1);
        $bag->addCalendarNode($calendarNode2);

        $elements = [
            'testnodename1' => $calendarNode1,
            'testnodename2' => $calendarNode2,
        ];

        $this->assertEquals($elements, $bag->toArray());
    }

    public function testExists() {
        $bag = new CalendarBag();
        $calendarNode1 = $this->createMock(CalendarNode::class);
        $calendarNode1->method('getNodename')->willReturn('testnodename1');
        $calendarNode2 = $this->createMock(CalendarNode::class);
        $calendarNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addCalendarNode($calendarNode1);
        $bag->addCalendarNode($calendarNode2);

        self::assertTrue($bag->exists(
            function ($key, $element) use ($calendarNode2) {
                return $key === 'testnodename2' && $element === $calendarNode2;
            }));
        self::assertFalse($bag->exists(
            function ($key, $element) {
                return $key === 'non-existent' && $element === 'non-existent';
            }));
    }

    public function testMap() {
        $bag = new CalendarBag();
        $calendarNode1 = $this->createMock(CalendarNode::class);
        $calendarNode1->method('getNodename')->willReturn('testnodename1');
        $calendarNode2 = $this->createMock(CalendarNode::class);
        $calendarNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addCalendarNode($calendarNode1);
        $bag->addCalendarNode($calendarNode2);

        $expected = [
            'testnodename1' => 'Hello, testnodename1',
            'testnodename2' => 'Hello, testnodename2',
        ];
        $hellos = $bag->map(function (CalendarNode $calendarNode) {
            $message = sprintf('Hello, %s', $calendarNode->getNodename());
            return $message;
        });
        self::assertEquals($expected, $hellos->toArray());
    }

    public function testFilter() {
        $bag = new CalendarBag();
        $calendarNode1 = $this->createMock(CalendarNode::class);
        $calendarNode1->method('getNodename')->willReturn('testnodename1');
        $calendarNode2 = $this->createMock(CalendarNode::class);
        $calendarNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addCalendarNode($calendarNode1);
        $bag->addCalendarNode($calendarNode2);

        $expected = [
            'testnodename2' => $calendarNode2,
        ];
        $filteredBag = $bag->filter(function (CalendarNode $calendarNode) {
            return $calendarNode->getNodename() === 'testnodename2';
        });

        self::assertEquals($expected, $filteredBag->toArray());
    }

    public function testForAll() {
        $bag = new CalendarBag();
        $calendarNode1 = $this->createMock(CalendarNode::class);
        $calendarNode1->method('getNodename')->willReturn('testnodename1');
        $bag->addCalendarNode($calendarNode1);

        $this->assertTrue($bag->forAll(function ($playerName, $calendarNode) {
            return $playerName === 'testnodename1' && $calendarNode->getNodename() === $playerName;
        }));
        $this->assertFalse($bag->forAll(function ($playerName, $calendarNode) {
            return $playerName === 'testnodename3' && $calendarNode->getNodename() === $playerName;
        }));
    }

    public function testPartition() {
        $bag = new CalendarBag();
        $calendarNode1 = $this->createMock(CalendarNode::class);
        $calendarNode1->method('getNodename')->willReturn('testnodename1');
        $calendarNode2 = $this->createMock(CalendarNode::class);
        $calendarNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addCalendarNode($calendarNode1);
        $bag->addCalendarNode($calendarNode2);

        $partition = $bag->partition(function ($playerName, $calendarNode) {
            return $playerName === 'testnodename1' && $calendarNode->getNodename() === $playerName;
        });

        $this->assertEquals('testnodename1', $partition[0]->first()->getNodename());
        $this->assertEquals('testnodename2', $partition[1]->first()->getNodename());
    }

    public function testMatchingWithSortingPreservesKeys() : void
    {
        $bag = new CalendarBag();
        $calendarNode1 = $this->createMock(CalendarNode::class);
        $calendarNode1->method('getNodename')->willReturn('testnodename1');
        $calendarNode2 = $this->createMock(CalendarNode::class);
        $calendarNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addCalendarNode($calendarNode1);
        $bag->addCalendarNode($calendarNode2);

        if (! $this->isSelectable($bag)) {
            $this->markTestSkipped();
        }

        self::assertSame(
            [
                'testnodename2' => $calendarNode2,
                'testnodename1' => $calendarNode1,
            ],
            $bag
                ->matching(new Criteria(null, ['nodename' => Criteria::DESC]))
                ->toArray()
        );
    }
}
