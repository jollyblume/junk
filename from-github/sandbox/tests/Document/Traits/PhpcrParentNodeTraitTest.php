<?php

namespace App\Tests\Document\Traits;

use ArrayIterator;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\Criteria;
use App\Document\Traits\PhpcrParentNodeTrait;
use App\Model\NodeInterface;
use App\Exception\OutOfScopeException;
use App\Exception\NodenameMissingException;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class PhpcrParentNodeTraitTest extends TestCase {
    /** @expectedException  App\Exception\NodenameMissingException */
    public function testAddChildThrowsIfNodenameNotSet() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);
        $child = $this->createMock(NodeInterface::class);
        $trait->add($child);
    }

    /** @expectedException  App\Exception\NodeExistsException */
    public function testAddChildThrowsIfNodeExists() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);
        $child = $this->createMock(NodeInterface::class);
        $child->method('getNodename')->willReturn('test child');
        $child->method('getParent')->willReturn($trait);
        $trait->add($child);
        $trait->add($child);
    }

    public function testHasChildTrue() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);
        $child = $this->createMock(NodeInterface::class);
        $child->method('getNodename')->willReturn('test child');
        $child->method('getParent')->willReturn($trait);
        $trait->add($child);
        $this->assertTrue($trait->contains($child));
    }

    public function testHasChildFalse() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);
        $child = $this->createMock(NodeInterface::class);
        $child->method('getNodename')->willReturn('test child');
        $child->method('getParent')->willReturn($trait);
        $this->assertFalse($trait->contains($child));
    }

    public function testHasChildKeyTrue() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);
        $child = $this->createMock(NodeInterface::class);
        $child->method('getNodename')->willReturn('test child');
        $child->method('getParent')->willReturn($trait);
        $trait->add($child);
        $this->assertTrue($trait->containsKey('test child'));
    }

    public function testHasChildKeyFalse() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);
        $this->assertFalse($trait->containsKey('test child'));
    }

    /**
     * @expectedException       App\Exception\OutOfScopeException
     */
    public function testRemoveChildThrowsIfChildBelongsToAnotherCollection() {
        $trait1 = $this->getMockForTrait(PhpcrParentNodeTrait::class);
        $child = $this->createMock(NodeInterface::class);
        $child->method('getNodename')->willReturn('test child');
        $child->method('getParent')->willReturn($trait1);
        $trait1->add($child);
        $trait2 = $this->getMockForTrait(PhpcrParentNodeTrait::class);
        $trait2->removeElement($child);
    }

    public function testRemoveChildReturnsNullIfChildNotExists() {
        $trait1 = $this->getMockForTrait(PhpcrParentNodeTrait::class);
        $child = $this->createMock(NodeInterface::class);
        $child->method('getNodename')->willReturn('test child');
        $child->method('getParent')->willReturn($trait1);
        $this->assertNull($trait1->removeElement($child));
    }

    public function testRemoveChildReturnsRemovedChild() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);
        $child = $this->createMock(NodeInterface::class);
        $child->method('getNodename')->willReturn('test child');
        $child->method('getParent')->willReturn($trait);
        $trait->add($child);
        $removed = $trait->removeElement($child);
        $this->assertEquals($child, $removed);
    }

    public function testRemoveChildKeyReturnsNullIfChildNotExists() {
        $trait1 = $this->getMockForTrait(PhpcrParentNodeTrait::class);
        $child = $this->createMock(NodeInterface::class);
        $child->method('getNodename')->willReturn('test child');
        $child->method('getParent')->willReturn($trait1);
        $this->assertNull($trait1->remove('test child'));
    }

    public function testRemoveChildKeyReturnsRemovedChild() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);
        $child = $this->createMock(NodeInterface::class);
        $child->method('getNodename')->willReturn('test child');
        $child->method('getParent')->willReturn($trait);
        $trait->add($child);
        $removed = $trait->remove('test child');
        $this->assertEquals($child, $removed);
    }

    public function testSetChildOkIfNodenameSameAsChildNodename() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);
        $child = $this->createMock(NodeInterface::class);
        $child->method('getNodename')->willReturn('test child');
        $child->method('getParent')->willReturn($trait);
        $this->assertEquals($trait, $trait->set('test child', $child));
    }

    /** @expectedException      App\Exception\OutOfScopeException */
    public function setChildThrowsIfNodenameDifferentThenChildNodename() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);
        $child = $this->createMock(NodeInterface::class);
        $child->method('getNodename')->willReturn('test child');
        $child->method('getParent')->willReturn($trait);
        $trait->set('test child 1', $child);
    }

    /** @expectedException      App\Exception\UnexpectedNullException */
    public function setChildThrowsIfNodenameNotSetAnywhere() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);
        $child = $this->createMock(NodeInterface::class);
        $child->method('getParent')->willReturn($trait);
        $trait->set(null, $child);
    }

    public function testGetChildReturnsNullIfMissing() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);
        $this->assertNull($trait->get('test child'));
    }

    public function testGetChildReturnsReturnsChild() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);
        $child = $this->createMock(NodeInterface::class);
        $child->method('getNodename')->willReturn('test child');
        $child->method('getParent')->willReturn($trait);
        $trait->add($child);
        $this->assertEquals($child, $trait->get('test child'));
    }

    public function testFirst() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $this->assertEquals($child1, $trait->first());
    }

    public function testLast() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $this->assertEquals($child3, $trait->last());
    }

    public function testKey() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $trait->first();
        $trait->next();

        $this->assertEquals('test child 2', $trait->key());
    }

    public function testNext() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $this->assertEquals($child2, $trait->next());
    }

    public function testCurrent() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $this->assertEquals($child1, $trait->current());
    }

    public function testRemove() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $removed = $trait->remove('test child 1');
        $this->assertEquals($child1, $removed);
    }

    public function testRemoveElement() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $removed = $trait->removeElement($child1);
        $this->assertEquals($child1, $removed);
    }

    public function testOffsetExistsTrue() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $this->assertTrue($trait->offsetExists('test child 1'));
    }

    public function testOffsetExistsFalse() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $this->assertFalse($trait->offsetExists('test child 4'));
    }

    public function testOffsetGetWhenChildExists() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->set($nodename, $child);
        }

        $this->assertEquals($child1, $trait->get('test child 1'));
    }

    public function testOffsetGetWhenChildNotExists() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $this->assertNull($trait->offsetGet('test child 4'));
    }

    public function testOffsetSet() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->offsetSet($nodename, $child);
        }

        $this->assertEquals($child1, $trait->offsetGet('test child 1'));
    }

    public function testOffsetUnset() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->offsetSet($nodename, $child);
        }

        $trait->offsetUnset('test child 2');

        $this->assertFalse($trait->offsetExists('test child 2'));
    }

    public function testContainsKeyTrue() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $this->assertTrue($trait->containsKey('test child 1'));
    }

    public function testContainsKeyFalse() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $this->assertFalse($trait->containsKey('test child 4'));
    }

    public function testContainsTrue() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $this->assertTrue($trait->contains($child1));
    }

    public function testContainsFalse() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);
        $child4 = $this->createMock(NodeInterface::class);
        $child4->method('getNodename')->willReturn('test child 4');
        $child4->method('getParent')->willReturn($trait);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $this->assertFalse($trait->contains($child4));
    }

    public function testIndexOfIfExists() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $this->assertEquals('test child 1', $trait->indexOf($child1));
    }

    public function testIndexOfIfNotExists() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);
        $child4 = $this->createMock(NodeInterface::class);
        $child4->method('getNodename')->willReturn('test child 4');
        $child4->method('getParent')->willReturn($trait);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $this->assertFalse($trait->indexOf

        ($child4));
    }

    public function testGetKeys() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $expects = [
            'test child 1',
            'test child 2',
            'test child 3',
        ];

        $this->assertEquals($expects, $trait->getKeys());
    }

    public function testGetValues() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $expects = [
            $child1,
            $child2,
            $child3,
        ];

        $this->assertEquals($expects, $trait->getValues());
    }

    public function testCount() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $this->assertEquals(3, $trait->count());
    }

    public function testIsEmptyFalse() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $this->assertFalse($trait->isEmpty());
    }

    public function testEmptyTrue() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $this->assertTrue($trait->isEmpty());
    }

    public function testGetIterator() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $this->assertInstanceOf(ArrayIterator::class, $trait->getIterator());
    }

    public function testExistsFalse() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $this->assertFalse($trait->exists(function ($key, $element) {
            return $key === 'non-existent' || $element === 'non-existent';
        }));
    }

    public function testExistsTrue() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $this->assertTrue($trait->exists(function ($key, $element) {
            return $key === 'test child 1' || $element === $child3;
        }));
    }

    public function testMap() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $expected = [
            'test child 1' => 'Hello, test child 1',
            'test child 2' => 'Hello, test child 2',
            'test child 3' => 'Hello, test child 3',
        ];
        $hellos = $trait->map(function ($value) {
            $message = sprintf('Hello, %s', $value->getNodename());
            return $message;
        });
        self::assertEquals($expected, $hellos->toArray());
    }

    public function testFilter() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $expected = [
            'test child 2' => $child2,
        ];
        $hellos = $trait->filter(function ($value) use ($child2){
            return $value === $child2;
        });
        self::assertEquals($expected, $hellos->toArray());
    }

    /** @SuppressWarnings(PHPMD.UnusedLocalVariable) */
    public function testForAllFalse() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $state = $trait->forAll(function ($key, $value) {
            return $key !== 'test child 3';
        });
        self::assertFalse($state);
    }

    /** @SuppressWarnings(PHPMD.UnusedLocalVariable) */
    public function testForAllTrue() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $state = $trait->forAll(function ($key, $value) {

            return $key !== 'test child 4';
        });
        self::assertTrue($state);
    }

    /** @SuppressWarnings(PHPMD.UnusedLocalVariable) */
    public function testPartition() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $expectedEvenSet = [
            'test child 2' => $child2,
        ];
        $expectedOddSet = [
            'test child 1' => $child1,
            'test child 3' => $child3,
        ];
        [$evenSet, $oddSet] = $trait->partition(function ($key, $value) {
            return $key === 'test child 2';
        });
        self::assertEquals($expectedEvenSet, $evenSet->toArray());
        self::assertEquals($expectedOddSet, $oddSet->toArray());
    }

    public function testMatchingWithSortingPreservesKeys() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $expected = [
            'test child 3' => $child3,
            'test child 2' => $child2,
            'test child 1' => $child1,
        ];

        $criteria = new Criteria(null, ['nodename' => Criteria::DESC]);
        $sorted = $trait->matching($criteria);
        self::assertEquals($expected, $sorted->toArray());
    }

    public function testToString() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $this->assertInternalType('string', $trait->__toString());
    }

    public function testSlice() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $expected = [
            'test child 2' => $child2,
            'test child 3' => $child3,
        ];
        $slice = $trait->slice(1);
        self::assertEquals($expected, $slice);
    }

    public function testToArray() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);

        $child1 = $this->createMock(NodeInterface::class);
        $child2 = $this->createMock(NodeInterface::class);
        $child3 = $this->createMock(NodeInterface::class);

        foreach ([
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3] as $nodename => $child) {
            $child->method('getNodename')->willReturn($nodename);
            $child->method('getParent')->willReturn($trait);
            $trait->add($child);
        }

        $expected = [
            'test child 1' => $child1,
            'test child 2' => $child2,
            'test child 3' => $child3,
        ];

        $this->assertEquals($expected, $trait->toArray());
    }

    /**
     * @expectedException       App\Exception\PropImmutableException
     */
    public function testClearThrows() {
        $trait = $this->getMockForTrait(PhpcrParentNodeTrait::class);
        $trait->clear();
    }
}
