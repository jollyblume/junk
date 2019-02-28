<?php

namespace OldApp\Tests\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\LocationBag;
use App\Document\LocationNode;
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
 * LocationBagTest
 *
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class LocationBagTest extends TestCase {
    public function testGetNodeType() {
        $bag = new LocationBag();
        $this->assertEquals('Location', $bag->getNodeType());
    }

    public function testSupportsTrue() {
        $bag = new LocationBag();
        $playerNode = $this->createMock(LocationNode::class);
        $this->assertTrue($bag->supports($playerNode));
    }

    public function testSupportsFalse() {
        $bag = new LocationBag();
        $playerNode = $this->createMock(AbstractNode::class);
        $this->assertFalse($bag->supports($playerNode));
    }

    public function testConstructSetChildren(): void {
        $bag = new LocationBag();
        $this->assertInstanceOf(ArrayCollection::class, $bag->getChildren());
    }

    public function testAddLocationNode() {
        $bag = new LocationBag();
        $playerNode = $this->createMock(LocationNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addLocationNode($playerNode);
        $this->assertTrue($bag->hasLocationNode($playerNode));
    }

    public function testGetLocationNode() {
        $bag = new LocationBag();
        $playerNode1 = $this->createMock(LocationNode::class);
        $playerNode1->method('getNodename')->willReturn('testnodename1');
        $playerNode2 = $this->createMock(LocationNode::class);
        $playerNode2->method('getNodename')->willReturn('testnodename2');
        $bag->addLocationNode($playerNode1);
        $bag->addLocationNode($playerNode2);

        $this->assertEquals($playerNode2, $bag->getLocationNode('testnodename2'));
    }

    public function testHasLocationName() {
        $bag = new LocationBag();
        $playerNode = $this->createMock(LocationNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addLocationNode($playerNode);
        $this->assertTrue($bag->hasLocationName('testnodename'));
    }

    public function testRemoveLocationNode() {
        $bag = new LocationBag();
        $playerNode = $this->createMock(LocationNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addLocationNode($playerNode);
        $bag->removeLocationNode($playerNode);
        $this->assertFalse($bag->hasLocationNode($playerNode));
    }

    public function testRemoveLocationName() {
        $bag = new LocationBag();
        $playerNode = $this->createMock(LocationNode::class);
        $playerNode->method('getNodename')->willReturn('testnodename');
        $bag->addLocationNode($playerNode);
        $bag->removeLocationName('testnodename');
        $this->assertFalse($bag->hasLocationName('testnodename'));
    }
}
