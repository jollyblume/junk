<?php

namespace OldApp\Tests\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\TournamentBag;
use App\Document\TournamentNode;
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
 * TournamentBagTest
 *
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class TournamentBagTest extends TestCase {
    public function testGetNodeType() {
        $bag = new TournamentBag();
        $this->assertEquals('Tournament', $bag->getNodeType());
    }

    public function testSupportsTrue() {
        $bag = new TournamentBag();
        $playerNode = $this->createMock(TournamentNode::class);
        $this->assertTrue($bag->supports($playerNode));
    }

    public function testSupportsFalse() {
        $bag = new TournamentBag();
        $playerNode = $this->createMock(AbstractNode::class);
        $this->assertFalse($bag->supports($playerNode));
    }

    public function testConstructSetChildren(): void {
        $bag = new TournamentBag();
        $this->assertInstanceOf(ArrayCollection::class, $bag->getChildren());
    }

    public function testAddTournamentNode() {
        $bag = new TournamentBag();
        $playerNode = $this->createMock(TournamentNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addTournamentNode($playerNode);
        $this->assertTrue($bag->hasTournamentNode($playerNode));
    }

    public function testGetTournamentNode() {
        $bag = new TournamentBag();
        $playerNode1 = $this->createMock(TournamentNode::class);
        $playerNode1->method('getNodename')->willReturn('testnodename1');
        $playerNode2 = $this->createMock(TournamentNode::class);
        $playerNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addTournamentNode($playerNode1);
        $bag->addTournamentNode($playerNode2);

        $this->assertEquals($playerNode2, $bag->getTournamentNode('testnodename2'));
    }

    public function testHasTournamentName() {
        $bag = new TournamentBag();
        $playerNode = $this->createMock(TournamentNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addTournamentNode($playerNode);
        $this->assertTrue($bag->hasTournamentName('testnodename'));
    }

    public function testRemoveTournamentNode() {
        $bag = new TournamentBag();
        $playerNode = $this->createMock(TournamentNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addTournamentNode($playerNode);
        $bag->removeTournamentNode($playerNode);
        $this->assertFalse($bag->hasTournamentNode($playerNode));
    }

    public function testRemoveTournamentName() {
        $bag = new TournamentBag();
        $playerNode = $this->createMock(TournamentNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addTournamentNode($playerNode);
        $bag->removeTournamentName('testnodename');
        $this->assertFalse($bag->hasTournamentName('testnodename'));
    }
}
