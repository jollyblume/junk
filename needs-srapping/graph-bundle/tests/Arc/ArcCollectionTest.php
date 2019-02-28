<?php

namespace Tests\Arc;

use Jollyblume\Bundle\GraphBundle\Node\NodeInterface;
use Jollyblume\Bundle\GraphBundle\Arc\Arc;
use Jollyblume\Bundle\GraphBundle\Arc\ArcInterface;
use Jollyblume\Bundle\GraphBundle\Arc\ArcCollection;
use Jollyblume\Bundle\GraphBundle\Arc\ArcCollectionInterface;
use Jollyblume\Bundle\GraphBundle\Collection\TargetCollectionInterface;
use Jollyblume\Bundle\GraphBundle\Validation\ValidityChainInterface;
use Jollyblume\Bundle\GraphBundle\Collection\TargetCollectionTrait;
use Jollyblume\Bundle\GraphBundle\Validation\ValidityChainTrait;
use Jollyblume\Bundle\GraphBundle\Validation\ErrorsTrait;

/**
 * ArcCollection testSuite
 */
class ArcCollectionTest extends \PHPUnit\Framework\TestCase
{
    public function testArcCollectionInterfaces()
    {
        $mustImplement = [
            ArcCollectionInterface::class,
        ];
        $doesImplement = class_implements(ArcCollection::class);
        $intersection = array_intersect($mustImplement, $doesImplement);
        $this->assertEquals($intersection, $mustImplement);
    }

    public function testArcCollectionTraits()
    {
        $mustUse = [
            TargetCollectionTrait::class,
            ValidityChainTrait::class,
            ErrorsTrait::class,
        ];
        $doesUse = class_uses(ArcCollection::class);
        $intersection = array_intersect($mustUse, $doesUse);
        $this->assertEquals($intersection, $mustUse);
    }

    public function testHasArcByName()
    {
        $sourceNode = $this->createMock(NodeInterface::class);
        $sinkNode = $this->createMock(NodeInterface::class);
        $arcType = ParenTypeInterface::class;
        $arc = new Arc($sourceNode, $sinkNode, $arcType);
        $arcCollection = new ArcCollection();
        $arcCollection->addArc($arc);
        $this->assertTrue(
            $arcCollection->hasArc($arc->getArcName()),
            'hasArc(arcName) must be TRUE if collection contains the Arc'
        );
    }

    public function testNotHasMissingArcByName()
    {
        $sourceNode = $this->createMock(NodeInterface::class);
        $sinkNode = $this->createMock(NodeInterface::class);
        $arcType = ParenTypeInterface::class;
        $arc = new Arc($sourceNode, $sinkNode, $arcType);
        $arcCollection = new ArcCollection();
        $this->assertFalse(
            $arcCollection->hasArc($arc->getArcName()),
            'hasArc(arcName) must be FALSE if collection does not contain the Arc'
        );
    }

    public function testHasArcByObject()
    {
        $sourceNode = $this->createMock(NodeInterface::class);
        $sinkNode = $this->createMock(NodeInterface::class);
        $arcType = ParenTypeInterface::class;
        $arc = new Arc($sourceNode, $sinkNode, $arcType);
        $arcCollection = new ArcCollection();
        $arcCollection->addArc($arc);
        $this->assertTrue(
            $arcCollection->hasArc($arc),
            'hasArc(arcInstance) must be TRUE if collection contains the Arc'
        );
    }

    public function testNotHasMissingArcByObject()
    {
        $sourceNode = $this->createMock(NodeInterface::class);
        $sinkNode = $this->createMock(NodeInterface::class);
        $arcType = ParenTypeInterface::class;
        $arc = new Arc($sourceNode, $sinkNode, $arcType);
        $arcCollection = new ArcCollection();
        $this->assertFalse(
            $arcCollection->hasArc($arc),
            'hasArc(arcInstance) must be FALSE if collection does not contain the Arc'
        );
    }

    public function testGetArcsEmptyArrayForNewArcCollection()
    {
        $arcCollection = new ArcCollection();
        $this->assertEquals(
            [],
            $arcCollection->getArcs(),
            'getArcs() must emit []  for new ArcCollection'
        );
    }

    public function testGetArcsEmitsExpectedArray()
    {
        $sourceNode = $this->createMock(NodeInterface::class);
        $sourceNode->method('getNodename')->willreturn('sourceNodename');
        $sinkNode = $this->createMock(NodeInterface::class);
        $sinkNode->method('getNodename')->willreturn('sinkNodename');
        $arcType = ParenTypeInterface::class;
        $arc = new Arc($sourceNode, $sinkNode, $arcType);
        $arcName = $arc->getArcName();
        $arcCollection = new ArcCollection();
        $arcCollection->addArc($arc);
        $this->assertEquals(
            [$arcName => $arc],
            $arcCollection->getArcs(),
            'getArcs() must emit expected array'
        );
    }

    public function testSetArcsEmitsExpectedArray()
    {
        $sourceNode = $this->createMock(NodeInterface::class);
        $sourceNode->method('getNodename')->willreturn('sourceNodename');
        $sinkNode = $this->createMock(NodeInterface::class);
        $sinkNode->method('getNodename')->willreturn('sinkNodename');
        $arcType = ParenTypeInterface::class;
        $arc = new Arc($sourceNode, $sinkNode, $arcType);
        $arcName = $arc->getArcName();
        $arcCollection = new ArcCollection();
        $arcCollection->setArcs([$arc]);
        $this->assertEquals(
            [$arcName => $arc],
            $arcCollection->getArcs(),
            'getArcs() must emit expected array'
        );
    }

    public function testRemoveArcRemovesByName()
    {
        $sourceNode = $this->createMock(NodeInterface::class);
        $sourceNode->method('getNodename')->willreturn('sourceNodename');
        $sinkNode = $this->createMock(NodeInterface::class);
        $sinkNode->method('getNodename')->willreturn('sinkNodename');
        $arcType = ParenTypeInterface::class;
        $arc = new Arc($sourceNode, $sinkNode, $arcType);
        $arcName = $arc->getArcName();
        $arcCollection = new ArcCollection();
        $arcCollection->setArcs([$arc]);
        $arcCollection->removeArc($arcName);
        $this->assertFalse(
            $arcCollection->hasArc($arcName),
            'removeArc(byName) removes an Arc contained in the collection'
        );
    }

    public function testRemoveArcRemovesByObject()
    {
        $sourceNode = $this->createMock(NodeInterface::class);
        $sourceNode->method('getNodename')->willreturn('sourceNodename');
        $sinkNode = $this->createMock(NodeInterface::class);
        $sinkNode->method('getNodename')->willreturn('sinkNodename');
        $arcType = ParenTypeInterface::class;
        $arc = new Arc($sourceNode, $sinkNode, $arcType);
        $arcName = $arc->getArcName();
        $arcCollection = new ArcCollection();
        $arcCollection->setArcs([$arc]);
        $arcCollection->removeArc($arc);
        $this->assertFalse(
            $arcCollection->hasArc($arcName),
            'removeArc(byName) removes an Arc contained in the collection'
        );
    }

    public function testRemoveArcIgnoresMissingArc()
    {
        $sourceNode = $this->createMock(NodeInterface::class);
        $sourceNode->method('getNodename')->willreturn('sourceNodename');
        $sinkNode = $this->createMock(NodeInterface::class);
        $sinkNode->method('getNodename')->willreturn('sinkNodename');
        $arcType = ParenTypeInterface::class;
        $arc = new Arc($sourceNode, $sinkNode, $arcType);
        $arcName = $arc->getArcName();
        $arcCollection = new ArcCollection();
        $arcCollection->removeArc($arcName);
        $this->assertFalse(
            $arcCollection->hasArc($arcName),
            'removeArc(byName) ignores an Arc not contained in the collection'
        );
    }
}
