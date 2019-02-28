<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\Traits\PhpcrEmailStoreTrait;
use App\Model\EmailInterface;
use App\Model\EmailStoreInterface;

class PhpcrEmailStoreTraitTest extends TestCase {
    public function testSetEmailBagSetsBag() {
        $trait = $this->getMockForTrait(PhpcrEmailStoreTrait::class);
        $bag = $this->createMock(EmailStoreInterface::class);
        $bag->method('getNodename')->willReturn('testbag');
        $trait->setEmailNodes($bag);
        $this->assertEquals($bag, $trait->getEmailNodes());
    }

    public function testAddEmailNode() {
        $trait = $this->getMockForTrait(PhpcrEmailStoreTrait::class);
        $node = $this->createMock(EmailInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addEmailNode($node);
        $this->assertEquals($node, $trait->getEmailNode('testnode'));
    }

    public function testRemoveEmailNode() {
        $trait = $this->getMockForTrait(PhpcrEmailStoreTrait::class);
        $node = $this->createMock(EmailInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addEmailNode($node);
        $trait->removeEmailNode($node);
        $this->assertFalse($trait->hasEmailNode($node));
    }

    public function testRemoveEmailName() {
        $trait = $this->getMockForTrait(PhpcrEmailStoreTrait::class);
        $node = $this->createMock(EmailInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addEmailNode($node);
        $trait->removeEmailName('testnode');
        $this->assertFalse($trait->hasEmailName('testnode'));
    }

    public function testSetEmailNode() {
        $trait = $this->getMockForTrait(PhpcrEmailStoreTrait::class);
        $node = $this->createMock(EmailInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->setEmailNode('testnode', $node);
        $this->assertTrue($trait->hasEmailNode($node));
    }
}
