<?php

namespace Jollyblume\Component\Tests\Graphing\ArcType;

use stdClass;
use Jollyblume\Component\Graphing\ArcType\ArcTypeInterface;
use Jollyblume\Component\Graphing\ArcType\ParentInterface;
use Jollyblume\Component\Graphing\ArcType\ChildrenInterface;
use Jollyblume\Component\Graphing\ArcType\MetadataInterface;
use Jollyblume\Component\Graphing\ArcType\MetadataTrait;
use Jollyblume\Component\Graphing\Resolver\FilterResolverTrait;
use Jollyblume\Component\Graphing\Node\NodeInterface;

/** @SuppressWarnings(methods) */
class MetadataTraitTest extends \PHPUnit\Framework\TestCase
{
    public function testGetDefinitionsEmptyIfNoArcTypesImplemented()
    {
        $metadata = new class implements MetadataInterface, ArcTypeInterface {
            use MetadataTrait, FilterResolverTrait;
        };
        $this->assertEquals(
            [],
            $metadata->getDefinitions(),
            'getDefinitions() MUST BE EMTPY if Node does not implment any arcTypes'
        );
    }

    /** @SuppressWarnings(unused) */
    public function testGetDefinitionsIncludesImplementedArcTypes()
    {
        $metadata = new class implements MetadataInterface, ParentInterface {
            use MetadataTrait, FilterResolverTrait;
            public function getParentNode() : ?NodeInterface
            {
            }
            public function setParentNode(NodeInterface $sourceNode) : ParentInterface
            {
            }
        };
        $this->assertEquals(
            [ParentInterface::class],
            array_keys($metadata->getDefinitions()),
            'getDefinitions() MUST CONTAINS implemented arcTypes'
        );
    }

    /** @SuppressWarnings(unused) */
    public function testSupportsArcTypeFalseIfNotAnInterface()
    {
        $metadata = new class implements MetadataInterface, ParentInterface {
            use MetadataTrait, FilterResolverTrait;
            public function getParentNode() : ?NodeInterface
            {
            }
            public function setParentNode(NodeInterface $sourceNode) : ParentInterface
            {
            }
        };
        $this->assertFalse(
            $metadata->supportsArcType(stdClass::class),
            'supportsArcType(stdClass::class) MUST be FALSE'
        );
    }

    /** @SuppressWarnings(unused) */
    public function testSupportsArcTypeFalseIfArcTypeInterface()
    {
        $metadata = new class implements MetadataInterface, ParentInterface {
            use MetadataTrait, FilterResolverTrait;
            public function getParentNode() : ?NodeInterface
            {
            }
            public function setParentNode(NodeInterface $sourceNode) : ParentInterface
            {
            }
        };
        $this->assertFalse(
            $metadata->supportsArcType(ArcTypeInterface::class),
            'supportsArcType() MUST be FALSE for ArcTypeInterface'
        );
    }

    /** @SuppressWarnings(unused) */
    public function testSupportsArcTypeFalseIfNotAnArcType()
    {
        $metadata = new class implements MetadataInterface, ParentInterface {
            use MetadataTrait, FilterResolverTrait;
            public function getParentNode() : ?NodeInterface
            {
            }
            public function setParentNode(NodeInterface $sourceNode) : ParentInterface
            {
            }
        };
        $this->assertFalse(
            $metadata->supportsArcType(NodeInterface::class),
            'supportsArcType(NodeInterface::class) MUST be FALSE'
        );
    }

    /** @SuppressWarnings(unused) */
    public function testSupportsArcTypeTrueIfParentInterfaceImplemented()
    {
        $metadata = new class implements MetadataInterface, ParentInterface {
            use MetadataTrait, FilterResolverTrait;
            public function getParentNode() : ?NodeInterface
            {
            }
            public function setParentNode(NodeInterface $sourceNode) : ParentInterface
            {
            }
        };
        $this->assertTrue(
            $metadata->supportsArcType(ParentInterface::class),
            'supportsArcType(ParentInterface::class) MUST be TRUE if ParentInterface implemented'
        );
    }

    /** @SuppressWarnings(unused) */
    public function testSupportsArcTypeTrueIfParentInterfaceSupported()
    {
        $metadata = new class implements MetadataInterface, ArcTypeInterface {
            use MetadataTrait, FilterResolverTrait;
            public function getParentNode() : ?NodeInterface
            {
            }
            public function setParentNode(NodeInterface $sourceNode) : ParentInterface
            {
            }
        };
        $this->assertTrue(
            $metadata->supportsArcType(ParentInterface::class),
            'supportsArcType(ParentInterface::class) MUST be TRUE if ParentInterface supported'
        );
    }

    /** @SuppressWarnings(unused) */
    public function testHasDefinitionFalseIfChildrenInterfaceNotSupported()
    {
        $metadata = new class implements MetadataInterface, ParentInterface {
            use MetadataTrait, FilterResolverTrait;
            public function getParentNode() : ?NodeInterface
            {
            }
            public function setParentNode(NodeInterface $sourceNode) : ParentInterface
            {
            }
        };
        $this->assertFalse(
            $metadata->hasDefinitions(ChildrenInterface::class),
            'hasDefinitions(ChildrenInterface::class) MUST be FALSE if ChildrenInterface NOT implemented'
        );
    }

    /** @SuppressWarnings(unused) */
    public function testSupportsArcTypeFalseIfChildrenInterfaceNotSupported()
    {
        $metadata = new class implements MetadataInterface, ParentInterface {
            use MetadataTrait, FilterResolverTrait;
            public function getParentNode() : ?NodeInterface
            {
            }
            public function setParentNode(NodeInterface $sourceNode) : ParentInterface
            {
            }
        };
        $this->assertFalse(
            $metadata->supportsArcType(ChildrenInterface::class),
            'supportsArcType(ChildrenInterface::class) MUST be FALSE if ChildrenInterface NOT implemented'
        );
    }

    public function testIsSourceNodeFalseIfNoArcTypes()
    {
        $metadata = new class implements MetadataInterface, ArcTypeInterface {
            use MetadataTrait, FilterResolverTrait;
        };
        $this->assertFalse(
            $metadata->isSourceNode(),
            'isSourceNode() MUST BE FALSE if no arcTypes supported'
        );
    }

    /** @SuppressWarnings(unused) */
    public function testIsSourceNodeFalseIfNoArcTypeImplementedViaHasDefinitions()
    {
        $metadata = new class implements MetadataInterface, ArcTypeInterface {
            use MetadataTrait, FilterResolverTrait;
            public function getParentNode() : ?NodeInterface
            {
            }
            public function setParentNode(NodeInterface $sourceNode) : ParentInterface
            {
            }
        };
        $this->assertFalse(
            $metadata->hasDefinitions(),
            'isSourceNode() MUST BE True if ParentInterface implemented'
        );
    }

    /** @SuppressWarnings(unused) */
    public function testIsSourceNodeTrueIfParentInterfaceImplemented()
    {
        $metadata = new class implements MetadataInterface, ParentInterface {
            use MetadataTrait, FilterResolverTrait;
            public function getParentNode() : ?NodeInterface
            {
            }
            public function setParentNode(NodeInterface $sourceNode) : ParentInterface
            {
            }
        };
        $this->assertTrue(
            $metadata->isSourceNode(),
            'isSourceNode() MUST BE True if ParentInterface implemented'
        );
    }

    /** @SuppressWarnings(unused) */
    public function testIsSourceNodeFalseIfParentInterfaceNotDiscovered()
    {
        $metadata = new class implements MetadataInterface, ArcTypeInterface {
            use MetadataTrait, FilterResolverTrait;
            public function getParentNode() : ?NodeInterface
            {
            }
            public function setParentNode(NodeInterface $sourceNode) : ParentInterface
            {
            }
        };
        $this->assertFalse(
            $metadata->isSourceNode(),
            'isSourceNode() MUST BE FALSE if ParentInterface supported'
        );
    }

    /** @SuppressWarnings(unused) */
    public function testIsSourceNodeTrueIfParentInterfaceDiscovered()
    {
        $metadata = new class implements MetadataInterface, ArcTypeInterface {
            use MetadataTrait, FilterResolverTrait;
            public function getParentNode() : ?NodeInterface
            {
            }
            public function setParentNode(NodeInterface $sourceNode) : ParentInterface
            {
            }
        };
        $metadata->hasDefinitions(ParentInterface::class);
        $this->assertTrue(
            $metadata->isSourceNode(),
            'isSourceNode() MUST BE TRUE if ParentInterface supported and discovered'
        );
    }
}
