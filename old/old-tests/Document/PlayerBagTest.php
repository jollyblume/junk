<?php

namespace OldApp\Tests\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\PlayerBag;
use App\Document\PlayerNode;
use App\Document\AbstractNode;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;
use function count;

/**
 * PlayerBagTest.
 *
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class PlayerBagTest extends TestCase
{
    public function testGetNodeType() {
        $bag = new PlayerBag();
        $this->assertEquals('Player', $bag->getNodeType());
    }

    public function testSupportsTrue()
    {
        $bag = new PlayerBag();
        $playerNode = $this->createMock(PlayerNode::class);
        $this->assertTrue($bag->supports($playerNode));
    }

    public function testSupportsFalse()
    {
        $bag = new PlayerBag();
        $playerNode = $this->createMock(AbstractNode::class);
        $this->assertFalse($bag->supports($playerNode));
    }

    public function testConstructSetChildren(): void
    {
        $bag = new PlayerBag();
        $this->assertInstanceOf(ArrayCollection::class, $bag->getChildren());
    }

    public function testAddPlayerNode()
    {
        $bag = new PlayerBag();
        $playerNode = $this->createMock(PlayerNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addPlayerNode($playerNode);
        $this->assertTrue($bag->hasPlayerNode($playerNode));
    }

    public function testGetPlayerNode()
    {
        $bag = new PlayerBag();
        $playerNode1 = $this->createMock(PlayerNode::class);
        $playerNode1->method('getNodename')->willReturn('testnodename1');
        $playerNode2 = $this->createMock(PlayerNode::class);
        $playerNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addPlayerNode($playerNode1);
        $bag->addPlayerNode($playerNode2);

        $this->assertEquals($playerNode2, $bag->getPlayerNode('testnodename2'));
    }

    public function testHasPlayerName()
    {
        $bag = new PlayerBag();
        $playerNode = $this->createMock(PlayerNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addPlayerNode($playerNode);
        $this->assertTrue($bag->hasPlayerName('testnodename'));
    }

    public function testRemovePlayerNode()
    {
        $bag = new PlayerBag();
        $playerNode = $this->createMock(PlayerNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addPlayerNode($playerNode);
        $bag->removePlayerNode($playerNode);
        $this->assertFalse($bag->hasPlayerNode($playerNode));
    }

    public function testRemovePlayerName()
    {
        $bag = new PlayerBag();
        $playerNode = $this->createMock(PlayerNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addPlayerNode($playerNode);
        $bag->removePlayerName('testnodename');
        $this->assertFalse($bag->hasPlayerName('testnodename'));
    }
}
