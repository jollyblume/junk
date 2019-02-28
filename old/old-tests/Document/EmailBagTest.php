<?php

namespace OldApp\Tests\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\EmailBag;
use App\Document\EmailNode;
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
 * EmailBagTest
 *
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class EmailBagTest extends TestCase {
    public function testGetNodeType() {
        $bag = new EmailBag();
        $this->assertEquals('Email', $bag->getNodeType());
    }

    public function testSupportsTrue() {
        $bag = new EmailBag();
        $playerNode = $this->createMock(EmailNode::class);
        $this->assertTrue($bag->supports($playerNode));
    }

    public function testSupportsFalse() {
        $bag = new EmailBag();
        $playerNode = $this->createMock(AbstractNode::class);
        $this->assertFalse($bag->supports($playerNode));
    }

    public function testConstructSetChildren(): void {
        $bag = new EmailBag();
        $this->assertInstanceOf(ArrayCollection::class, $bag->getChildren());
    }

    public function testAddEmailNode() {
        $bag = new EmailBag();
        $playerNode = $this->createMock(EmailNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addEmailNode($playerNode);
        $this->assertTrue($bag->hasEmailNode($playerNode));
    }

    public function testGetEmailNode() {
        $bag = new EmailBag();
        $playerNode1 = $this->createMock(EmailNode::class);
        $playerNode1->method('getNodename')->willReturn('testnodename1');
        $playerNode2 = $this->createMock(EmailNode::class);
        $playerNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addEmailNode($playerNode1);
        $bag->addEmailNode($playerNode2);

        $this->assertEquals($playerNode2, $bag->getEmailNode('testnodename2'));
    }

    public function testHasEmailName() {
        $bag = new EmailBag();
        $playerNode = $this->createMock(EmailNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addEmailNode($playerNode);
        $this->assertTrue($bag->hasEmailName('testnodename'));
    }

    public function testRemoveEmailNode() {
        $bag = new EmailBag();
        $playerNode = $this->createMock(EmailNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addEmailNode($playerNode);
        $bag->removeEmailNode($playerNode);
        $this->assertFalse($bag->hasEmailNode($playerNode));
    }

    public function testRemoveEmailName() {
        $bag = new EmailBag();
        $playerNode = $this->createMock(EmailNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addEmailNode($playerNode);
        $bag->removeEmailName('testnodename');
        $this->assertFalse($bag->hasEmailName('testnodename'));
    }
}
