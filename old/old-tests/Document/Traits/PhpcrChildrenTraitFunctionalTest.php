<?php

namespace OldApp\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\RootNode;
use App\Document\EmailTree;
use App\Document\PlayerBag;
use App\Document\PlayerNode;

class PhpcrChildrenTraitFunctionalTest extends TestCase
{
    /**
     * @expectedException       \App\Exception\NodenameMissingException
     */
    public function testAddChildThrowIfNodenameEmpty() {
        $node = new RootNode();
        $node->setNodename('testrootnode');
        $child = new EmailTree();
        $node->addTreeNode($child);
    }

    /**
     * @expectedException       \App\Exception\NodeExistsException
     */
    public function testAddChildThrowIfNodenameExists() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child = new PlayerNode();
        $child->setNodename('testchildnode');
        $node->addPlayerNode($child);
        $this->assertTrue($node->hasPlayerNode($child));
        $node->addPlayerNode($child);
    }

    public function testAddChildChildSetsParentIfNull()
    {
        $node = new RootNode();
        $node->setNodename('testrootnode');
        $child = new EmailTree();
        $child->setNodename('testchildnode');
        $node->addTreeNode($child);
        $this->assertEquals($node, $child->getParent());
    }

    public function testAddChildChildLeavesParentIfNotNull()
    {
        $node = new RootNode();
        $node->setNodename('testrootnode');
        $child = new EmailTree();
        $child->setNodename('testchildnode');
        $child->setParent($node);
        $node->addTreeNode($child);
        $this->assertEquals($node, $child->getParent());
    }

    public function testAddChildAddsChild() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child = new PlayerNode();
        $child->setNodename('testchildnode');
        $node->addPlayerNode($child);
        $this->assertTrue($node->hasPlayerName('testchildnode'));
    }

    public function testRemoveChildReturnsRemovedChild() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child = new PlayerNode();
        $child->setNodename('testchildnode');
        $node->addPlayerNode($child);
        $node->removePlayerNode($child);
        $this->assertFalse($node->hasPlayerNode($child));
    }

    public function testRemoveChildKeyReturnsRemovedChild() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child = new PlayerNode();
        $child->setNodename('testchildnode');
        $node->addPlayerNode($child);
        $gotChild = $node->getPlayerNode('testchildnode');
        $this->assertEquals($gotChild, $node->removePlayerName('testchildnode'));
        $this->assertFalse($node->hasPlayerName('testchildnode'));
    }

    public function testSetChildSetsNodename() {
        $this->markTestSkipped('todo implement setPlayerNode in concrete Node classes');
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child = new PlayerNode();
        // $child->setNodename('testchildnode');
        $node->setPlayerNode('testchildnode', $child);
    }

    public function testFirst() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child1 = new PlayerNode();
        $child1->setNodename('testchildnode1');
        $node->addPlayerNode($child1);
        $child2 = new PlayerNode();
        $child2->setNodename('testchildnode2');
        $node->addPlayerNode($child2);
        $child3 = new PlayerNode();
        $child3->setNodename('testchildnode3');
        $node->addPlayerNode($child3);

        $this->assertEquals($child1, $node->first());
    }

    public function testLast() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child1 = new PlayerNode();
        $child1->setNodename('testchildnode1');
        $node->addPlayerNode($child1);
        $child2 = new PlayerNode();
        $child2->setNodename('testchildnode2');
        $node->addPlayerNode($child2);
        $child3 = new PlayerNode();
        $child3->setNodename('testchildnode3');
        $node->addPlayerNode($child3);

        $this->assertEquals($child3, $node->last());
    }

    public function testNext() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child1 = new PlayerNode();
        $child1->setNodename('testchildnode1');
        $node->addPlayerNode($child1);
        $child2 = new PlayerNode();
        $child2->setNodename('testchildnode2');
        $node->addPlayerNode($child2);
        $child3 = new PlayerNode();
        $child3->setNodename('testchildnode3');
        $node->addPlayerNode($child3);

        $node->first();
        $node->next();
        $this->assertEquals($child2, $node->current());
        $this->assertEquals('testchildnode2', $node->key());
    }

    public function testRemove() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child1 = new PlayerNode();
        $child1->setNodename('testchildnode1');
        $node->addPlayerNode($child1);
        $node->removePlayerName('testchildnode1');
        $this->assertFalse($node->hasPlayerName($child1));
    }

    public function testRemoveElement() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child1 = new PlayerNode();
        $child1->setNodename('testchildnode1');
        $node->addPlayerNode($child1);
        $node->removePlayerNode($child1);
        $this->assertFalse($node->hasPlayerNode($child1));
    }

    public function testOffsetExists() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child1 = new PlayerNode();
        $child1->setNodename('testchildnode1');
        $node->addPlayerNode($child1);
        $this->assertTrue($node->offsetExists('testchildnode1'));
    }

    public function testOffsetGet() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child1 = new PlayerNode();
        $child1->setNodename('testchildnode1');
        $node->addPlayerNode($child1);
        $this->assertEquals($child1, $node->offsetGet('testchildnode1'));
    }

    public function testOffsetSet() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child1 = new PlayerNode();
        $node->offsetSet('testchildnode1', $child1);
        $this->assertEquals($child1, $node->offsetGet('testchildnode1'));
    }

    public function testOffsetUnset() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child1 = new PlayerNode();
        $child1->setNodename('testchildnode1');
        $node->addPlayerNode($child1);
        $node->offsetUnset('testchildnode1', $child1);
        $this->assertFalse($node->offsetExists('testchildnode1'));
    }

    public function testContainsKey() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child1 = new PlayerNode();
        $child1->setNodename('testchildnode1');
        $node->addPlayerNode($child1);
        $this->assertTrue($node->containsKey('testchildnode1'));
    }

    public function testContains() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child1 = new PlayerNode();
        $child1->setNodename('testchildnode1');
        $node->addPlayerNode($child1);
        $this->assertTrue($node->contains($child1));
    }

    public function testIndexOf() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child1 = new PlayerNode();
        $child1->setNodename('testchildnode1');
        $node->addPlayerNode($child1);
        $this->assertEquals('testchildnode1', $node->indexOf($child1));
    }

    public function testGet() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child1 = new PlayerNode();
        $child1->setNodename('testchildnode1');
        $node->addPlayerNode($child1);
        $this->assertEquals($child1, $node->get('testchildnode1'));
    }

    public function testGetKeys() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child1 = new PlayerNode();
        $child1->setNodename('testchildnode1');
        $node->addPlayerNode($child1);
        $child2 = new PlayerNode();
        $child2->setNodename('testchildnode2');
        $node->addPlayerNode($child2);
        $child3 = new PlayerNode();
        $child3->setNodename('testchildnode3');
        $node->addPlayerNode($child3);
        $expected = [
            'testchildnode1',
            'testchildnode2',
            'testchildnode3',
        ];
        $this->assertEquals($expected, $node->getKeys());
    }

    public function testGetValues() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child1 = new PlayerNode();
        $child1->setNodename('testchildnode1');
        $node->addPlayerNode($child1);
        $child2 = new PlayerNode();
        $child2->setNodename('testchildnode2');
        $node->addPlayerNode($child2);
        $child3 = new PlayerNode();
        $child3->setNodename('testchildnode3');
        $node->addPlayerNode($child3);
        $expected = [
            $child1,
            $child2,
            $child3,
        ];
        $this->assertEquals($expected, $node->getValues());
    }

    public function testCount() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child1 = new PlayerNode();
        $child1->setNodename('testchildnode1');
        $node->addPlayerNode($child1);
        $child2 = new PlayerNode();
        $child2->setNodename('testchildnode2');
        $node->addPlayerNode($child2);
        $child3 = new PlayerNode();
        $child3->setNodename('testchildnode3');
        $node->addPlayerNode($child3);
        $this->assertEquals(3, $node->count());
    }

    public function testSet() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child1 = new PlayerNode();
        $node->set('testchildnode1', $child1);
        $this->assertTrue($node->hasPlayerNode($child1));
    }

    public function testAdd() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $child1 = new PlayerNode();
        $child1->setNodename('testchildnode1');
        $node->add($child1);
        $this->assertTrue($node->hasPlayerNode($child1));
    }

    public function testIsEmpty() {
        $node = new PlayerBag();
        $node->setNodename('testparentnode');
        $this->assertTrue($node->isEmpty());
        $child1 = new PlayerNode();
        $child1->setNodename('testchildnode1');
        $node->add($child1);
        $this->assertFalse($node->isEmpty($child1));
    }
}
