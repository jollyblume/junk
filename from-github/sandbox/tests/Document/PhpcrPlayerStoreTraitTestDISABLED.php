<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\Traits\PhpcrPlayerStoreTrait;
use App\Model\PlayerInterface;
use App\Model\PlayerStoreInterface;

class PhpcrPlayerStoreTraitTest extends TestCase {
    public function testSetPlayerBagSetsBag() {
        $trait = $this->getMockForTrait(PhpcrPlayerStoreTrait::class);
        $bag = $this->createMock(PlayerStoreInterface::class);
        $bag->method('getNodename')->willReturn('testbag');
        $trait->setPlayerNodes($bag);
        $this->assertEquals($bag, $trait->getPlayerNodes());
    }

    public function testAddPlayerNode() {
        $trait = $this->getMockForTrait(PhpcrPlayerStoreTrait::class);
        $node = $this->createMock(PlayerInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addPlayerNode($node);
        $this->assertEquals($node, $trait->getPlayerNode('testnode'));
    }

    public function testRemovePlayerNode() {
        $trait = $this->getMockForTrait(PhpcrPlayerStoreTrait::class);
        $node = $this->createMock(PlayerInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addPlayerNode($node);
        $trait->removePlayerNode($node);
        $this->assertFalse($trait->hasPlayerNode($node));
    }

    public function testRemovePlayerName() {
        $trait = $this->getMockForTrait(PhpcrPlayerStoreTrait::class);
        $node = $this->createMock(PlayerInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addPlayerNode($node);
        $trait->removePlayerName('testnode');
        $this->assertFalse($trait->hasPlayerName('testnode'));
    }

    public function testSetPlayerNode() {
        $trait = $this->getMockForTrait(PhpcrPlayerStoreTrait::class);
        $node = $this->createMock(PlayerInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->setPlayerNode('testnode', $node);
        $this->assertTrue($trait->hasPlayerNode($node));
    }
}
