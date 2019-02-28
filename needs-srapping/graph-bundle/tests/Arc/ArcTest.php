<?php

namespace Tests\Arc;

use Jollyblume\Bundle\GraphBundle\Arc\Arc;
use Jollyblume\Bundle\GraphBundle\Arc\ArcInterface;
use Jollyblume\Bundle\GraphBundle\Arc\ArcCollection;
use Jollyblume\Bundle\GraphBundle\Validation\ErrorsTrait;
use Jollyblume\Bundle\GraphBundle\Node\NodeInterface;
use Jollyblume\Bundle\GraphBundle\Type\ParentTypeInterface;

/**
 * Arc testSuite
 */
class ArcTest extends \PHPUnit\Framework\TestCase
{
    public function testArcInterfaces()
    {
        $mustImplement = [
            ArcInterface::class,
        ];
        $doesImplement = class_implements(Arc::class);
        $intersection = array_intersect($mustImplement, $doesImplement);
        $this->assertEquals(
            $intersection,
            $mustImplement,
            'Arc must implement CollectableTargetInterface, ErrorsInterface'
        );
    }

    public function testArcTraits()
    {
        $mustUse = [
            ErrorsTrait::class,
        ];
        $doesUse = class_uses(Arc::class);
        $intersection = array_intersect($mustUse, $doesUse);
        $this->assertEquals(
            $intersection,
            $mustUse,
            'Arc must use ErrorsTrait'
        );
    }

    public function testGetSourceNodeEmitsNode()
    {
        $sourceNode = $this->createMock(NodeInterface::class);
        $sinkNode = $this->createMock(NodeInterface::class);
        $arcType = ParenTypeInterface::class;
        $arc = new Arc($sourceNode, $sinkNode, $arcType);
        $this->assertEquals(
            $sourceNode,
            $arc->getSourceNode(),
            'getSourceNode() must emit expected Node'
        );
    }

    public function testGetSinkNodeEmitsNode()
    {
        $sourceNode = $this->createMock(NodeInterface::class);
        $sinkNode = $this->createMock(NodeInterface::class);
        $arcType = ParenTypeInterface::class;
        $arc = new Arc($sourceNode, $sinkNode, $arcType);
        $this->assertEquals(
            $sinkNode,
            $arc->getSinkNode(),
            'getSinkNode() must emit expected Node'
        );
    }

    public function testGetArcTypeEmitsType()
    {
        $sourceNode = $this->createMock(NodeInterface::class);
        $sinkNode = $this->createMock(NodeInterface::class);
        $arcType = ParenTypeInterface::class;
        $arc = new Arc($sourceNode, $sinkNode, $arcType);
        $this->assertEquals(
            $arcType,
            $arc->getArcType(),
            'getArcType() must emit expected arcType'
        );
    }

    public function testGetArcNameEmitsName()
    {
        $sourceNode = $this->createMock(NodeInterface::class);
        $sourceNode->method('getNodename')->willReturn('sourceNodename');
        $sinkNode = $this->createMock(NodeInterface::class);
        $sinkNode->method('getNodename')->willReturn('sinkNodename');
        $arcType = ParenTypeInterface::class;
        $arc = new Arc($sourceNode, $sinkNode, $arcType);
        $arcName = sprintf(
            '%s:%s:%s',
            'sourceNodename',
            'sinkNodename',
            $arcType
        );
        $this->assertEquals(
            $arcName,
            $arc->getArcName(),
            'getArcName() must emit expected arcName'
        );
    }

    public function testToStringEmitsArcName()
    {
        $sourceNode = $this->createMock(NodeInterface::class);
        $sourceNode->method('getNodename')->willReturn('sourceNodename');
        $sinkNode = $this->createMock(NodeInterface::class);
        $sinkNode->method('getNodename')->willReturn('sinkNodename');
        $arcType = ParenTypeInterface::class;
        $arc = new Arc($sourceNode, $sinkNode, $arcType);
        $arcName = sprintf(
            '%s:%s:%s',
            'sourceNodename',
            'sinkNodename',
            $arcType
        );
        $this->assertEquals(
            $arcName,
            strval($arc),
            '__toString() must emit expected arcName'
        );
    }
}
