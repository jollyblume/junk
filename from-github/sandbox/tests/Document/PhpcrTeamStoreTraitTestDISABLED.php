<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\Traits\PhpcrTeamStoreTrait;
use App\Model\TeamInterface;
use App\Model\TeamStoreInterface;

class PhpcrTeamStoreTraitTest extends TestCase {
    public function testSetTeamBagSetsBag() {
        $trait = $this->getMockForTrait(PhpcrTeamStoreTrait::class);
        $bag = $this->createMock(TeamStoreInterface::class);
        $bag->method('getNodename')->willReturn('testbag');
        $trait->setTeamNodes($bag);
        $this->assertEquals($bag, $trait->getTeamNodes());
    }

    public function testAddTeamNode() {
        $trait = $this->getMockForTrait(PhpcrTeamStoreTrait::class);
        $node = $this->createMock(TeamInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addTeamNode($node);
        $this->assertEquals($node, $trait->getTeamNode('testnode'));
    }

    public function testRemoveTeamNode() {
        $trait = $this->getMockForTrait(PhpcrTeamStoreTrait::class);
        $node = $this->createMock(TeamInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addTeamNode($node);
        $trait->removeTeamNode($node);
        $this->assertFalse($trait->hasTeamNode($node));
    }

    public function testRemoveTeamName() {
        $trait = $this->getMockForTrait(PhpcrTeamStoreTrait::class);
        $node = $this->createMock(TeamInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addTeamNode($node);
        $trait->removeTeamName('testnode');
        $this->assertFalse($trait->hasTeamName('testnode'));
    }

    public function testSetTeamNode() {
        $trait = $this->getMockForTrait(PhpcrTeamStoreTrait::class);
        $node = $this->createMock(TeamInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->setTeamNode('testnode', $node);
        $this->assertTrue($trait->hasTeamNode($node));
    }
}
