<?php

namespace OldApp\Tests\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\LeagueBag;
use App\Document\LeagueNode;
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
 * LeagueBagTest
 *
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class LeagueBagTest extends TestCase {
    public function testGetNodeType() {
        $bag = new LeagueBag();
        $this->assertEquals('League', $bag->getNodeType());
    }

    public function testSupportsTrue() {
        $bag = new LeagueBag();
        $playerNode = $this->createMock(LeagueNode::class);
        $this->assertTrue($bag->supports($playerNode));
    }

    public function testSupportsFalse() {
        $bag = new LeagueBag();
        $playerNode = $this->createMock(AbstractNode::class);
        $this->assertFalse($bag->supports($playerNode));
    }

    public function testConstructSetChildren(): void {
        $bag = new LeagueBag();
        $this->assertInstanceOf(ArrayCollection::class, $bag->getChildren());
    }

    public function testAddLeagueNode() {
        $bag = new LeagueBag();
        $playerNode = $this->createMock(LeagueNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addLeagueNode($playerNode);
        $this->assertTrue($bag->hasLeagueNode($playerNode));
    }

    public function testGetLeagueNode() {
        $bag = new LeagueBag();
        $playerNode1 = $this->createMock(LeagueNode::class);
        $playerNode1->method('getNodename')->willReturn('testnodename1');
        $playerNode2 = $this->createMock(LeagueNode::class);
        $playerNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addLeagueNode($playerNode1);
        $bag->addLeagueNode($playerNode2);

        $this->assertEquals($playerNode2, $bag->getLeagueNode('testnodename2'));
    }

    public function testHasLeagueName() {
        $bag = new LeagueBag();
        $playerNode = $this->createMock(LeagueNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addLeagueNode($playerNode);
        $this->assertTrue($bag->hasLeagueName('testnodename'));
    }

    public function testRemoveLeagueNode() {
        $bag = new LeagueBag();
        $playerNode = $this->createMock(LeagueNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addLeagueNode($playerNode);
        $bag->removeLeagueNode($playerNode);
        $this->assertFalse($bag->hasLeagueNode($playerNode));
    }

    public function testRemoveLeagueName() {
        $bag = new LeagueBag();
        $playerNode = $this->createMock(LeagueNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addLeagueNode($playerNode);
        $bag->removeLeagueName('testnodename');
        $this->assertFalse($bag->hasLeagueName('testnodename'));
    }
}
