<?php

namespace OldApp\Tests\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\MatchBag;
use App\Document\MatchNode;
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
 * MatchBagTest
 *
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class MatchBagTest extends TestCase {
    public function testGetNodeType() {
        $bag = new MatchBag();
        $this->assertEquals('Match', $bag->getNodeType());
    }

    public function testSupportsTrue() {
        $bag = new MatchBag();
        $playerNode = $this->createMock(MatchNode::class);
        $this->assertTrue($bag->supports($playerNode));
    }

    public function testSupportsFalse() {
        $bag = new MatchBag();
        $playerNode = $this->createMock(AbstractNode::class);
        $this->assertFalse($bag->supports($playerNode));
    }

    public function testConstructSetChildren(): void {
        $bag = new MatchBag();
        $this->assertInstanceOf(ArrayCollection::class, $bag->getChildren());
    }

    public function testAddMatchNode() {
        $bag = new MatchBag();
        $playerNode = $this->createMock(MatchNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addMatchNode($playerNode);
        $this->assertTrue($bag->hasMatchNode($playerNode));
    }

    public function testGetMatchNode() {
        $bag = new MatchBag();
        $playerNode1 = $this->createMock(MatchNode::class);
        $playerNode1->method('getNodename')->willReturn('testnodename1');
        $playerNode2 = $this->createMock(MatchNode::class);
        $playerNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addMatchNode($playerNode1);
        $bag->addMatchNode($playerNode2);

        $this->assertEquals($playerNode2, $bag->getMatchNode('testnodename2'));
    }

    public function testHasMatchName() {
        $bag = new MatchBag();
        $playerNode = $this->createMock(MatchNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addMatchNode($playerNode);
        $this->assertTrue($bag->hasMatchName('testnodename'));
    }

    public function testRemoveMatchNode() {
        $bag = new MatchBag();
        $playerNode = $this->createMock(MatchNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addMatchNode($playerNode);
        $bag->removeMatchNode($playerNode);
        $this->assertFalse($bag->hasMatchNode($playerNode));
    }

    public function testRemoveMatchName() {
        $bag = new MatchBag();
        $playerNode = $this->createMock(MatchNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addMatchNode($playerNode);
        $bag->removeMatchName('testnodename');
        $this->assertFalse($bag->hasMatchName('testnodename'));
    }
}
