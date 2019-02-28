<?php

namespace App\Tests\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\TeamBag;
use App\Document\TeamNode;
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
 * TeamBagTest
 *
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class TeamBagTest extends TestCase {
    public function testGetNodeType() {
        $bag = new TeamBag();
        $this->assertEquals('Team', $bag->getNodeType());
    }

    public function testSupportsTrue() {
        $bag = new TeamBag();
        $playerNode = $this->createMock(TeamNode::class);
        $this->assertTrue($bag->supports($playerNode));
    }

    public function testSupportsFalse() {
        $bag = new TeamBag();
        $playerNode = $this->createMock(AbstractNode::class);
        $this->assertFalse($bag->supports($playerNode));
    }

    public function testConstructSetChildren(): void {
        $bag = new TeamBag();
        $this->assertInstanceOf(ArrayCollection::class, $bag->getChildren());
    }

    public function testAddTeamNode() {
        $bag = new TeamBag();
        $playerNode = $this->createMock(TeamNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addTeamNode($playerNode);
        $this->assertTrue($bag->hasTeamNode($playerNode));
    }

    public function testGetTeamNode() {
        $bag = new TeamBag();
        $playerNode1 = $this->createMock(TeamNode::class);
        $playerNode1->method('getNodename')->willReturn('testnodename1');
        $playerNode2 = $this->createMock(TeamNode::class);
        $playerNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addTeamNode($playerNode1);
        $bag->addTeamNode($playerNode2);

        $this->assertEquals($playerNode2, $bag->getTeamNode('testnodename2'));
    }

    public function testHasTeamName() {
        $bag = new TeamBag();
        $playerNode = $this->createMock(TeamNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addTeamNode($playerNode);
        $this->assertTrue($bag->hasTeamName('testnodename'));
    }

    public function testRemoveTeamNode() {
        $bag = new TeamBag();
        $playerNode = $this->createMock(TeamNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addTeamNode($playerNode);
        $bag->removeTeamNode($playerNode);
        $this->assertFalse($bag->hasTeamNode($playerNode));
    }

    public function testRemoveTeamName() {
        $bag = new TeamBag();
        $playerNode = $this->createMock(TeamNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addTeamNode($playerNode);
        $bag->removeTeamName('testnodename');
        $this->assertFalse($bag->hasTeamName('testnodename'));
    }
}
