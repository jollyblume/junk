<?php

namespace Jollyblume\Component\Tests\Graphing\ArcType;

use InvalidArgumentException;
use Jollyblume\Component\Graphing\ArcType\Definition;
use Jollyblume\Component\Graphing\ArcType\ArcTypeInterface;
use Jollyblume\Component\Graphing\ArcType\ParentInterface;
use Jollyblume\Component\Graphing\ArcType\ChildrenInterface;
use Jollyblume\Component\Graphing\ArcType\MetadataInterface;
use Jollyblume\Component\Graphing\Node\NodeInterface;

class DefinitionTest extends \PHPUnit\Framework\TestCase
{
    public function testConstructThrowsForNoSuchInterface()
    {
        $node = $this->createMock(NodeInterface::class);
        $message = '__construct() MUST THROW for NO_SUCH_INTERFACE';
        try {
            new Definition('notAnInterface', $node);
            $this->fail(
                $message
            );
        } catch (InvalidArgumentException $ex) {
            $this->assertStringStartsWith(
                'NO_SUCH_INTERFACE',
                $ex->getMessage(),
                $message
            );
        }
    }

    /** @depends testConstructThrowsForNoSuchInterface */
    public function testConstructThrowsForInvalidArcType()
    {
        $node = $this->createMock(NodeInterface::class);
        $message = '__construct() MUST THROW for INVALID_ARCTYPE';
        try {
            new Definition(ArcTypeInterface::class, $node);
            $this->fail(
                $message
            );
        } catch (InvalidArgumentException $ex) {
            $this->assertStringStartsWith(
                'INVALID_ARCTYPE',
                $ex->getMessage(),
                $message
            );
        }
    }

    /** @depends testConstructThrowsForInvalidArcType */
    public function testConstructThrowsForNotAnArcType()
    {
        $node = $this->createMock(NodeInterface::class);
        $message = '__construct() MUST THROW for NOT_AN_ARCTYPE';
        try {
            new Definition(NodeInterface::class, $node);
            $this->fail(
                $message
            );
        } catch (InvalidArgumentException $ex) {
            $this->assertStringStartsWith(
                'NOT_AN_ARCTYPE',
                $ex->getMessage(),
                $message
            );
        }
    }

    /** @depends testConstructThrowsForNotAnArcType */
    public function testConstructThrowsForUnsupportedNode()
    {
        $node = $this->createMock(MetadataInterface::class);
        $node->method('hasDefinitions')->willReturn(false);
        $message = '__construct() MUST THROW for UNSUPPORTED_ARCTYPE';
        try {
            new Definition(ParentInterface::class, $node);
            $this->fail(
                $message
            );
        } catch (InvalidArgumentException $ex) {
            $this->assertStringStartsWith(
                'UNSUPPORTED_ARCTYPE',
                $ex->getMessage(),
                $message
            );
        }
    }

    /** @depends testConstructThrowsForUnsupportedNode
     * @SuppressWarnings(unused)
     */
    public function testgetArcTypeEqualsCtorArgParentInterface()
    {
        $node = new class implements ParentInterface, MetadataInterface {
            public function getDefinitions() : array
            {
            }
            public function isSourceNode()
            {
            }
            public function hasDefinitions(string $arcTypeFilter = '') : bool
            {
            }
            public function supportsArcType(string $arcType) : bool
            {
                return true;
            }
            public function getParentNode() : NodeInterface
            {
            }
            public function setParentNode(NodeInterface $node) : ParentInterface
            {
            }
        };
        $definition = new Definition(ParentInterface::class, $node);
        $this->assertEquals(
            ParentInterface::class,
            $definition->getArcType(),
            'getArcType() MUST EQUAL constructor argument $arcType'
        );
    }

    /** @depends testConstructThrowsForUnsupportedNode
     * @SuppressWarnings(unused)
     */
    public function testgetSourceNodeEqualsCtorArg()
    {
        $node = new class implements ParentInterface, MetadataInterface {
            public function getDefinitions() : array
            {
            }
            public function isSourceNode()
            {
            }
            public function hasDefinitions(string $arcTypeFilter = '') : bool
            {
            }
            public function supportsArcType(string $arcType) : bool
            {
                return true;
            }
            public function getParentNode() : NodeInterface
            {
            }
            public function setParentNode(NodeInterface $node) : ParentInterface
            {
            }
        };
        $definition = new Definition(ParentInterface::class, $node);
        $this->assertEquals(
            $node,
            $definition->getSourceNode(),
            'getSourceNode() MUST EQUAL constructor argument $sourceNode'
        );
    }

    /** @depends testConstructThrowsForUnsupportedNode
     * @SuppressWarnings(unused)
     */
    public function testIsAlienArcTypeTrueIfInterfaceNotImplemented()
    {
        $node = new class implements ArcTypeInterface, MetadataInterface {
            public function getDefinitions() : array
            {
            }
            public function isSourceNode()
            {
            }
            public function hasDefinitions(string $arcTypeFilter = '') : bool
            {
            }
            public function supportsArcType(string $arcType) : bool
            {
                return true;
            }
            public function getParentNode() : NodeInterface
            {
            }
            public function setParentNode(NodeInterface $node) : ParentInterface
            {
            }
        };
        $definition = new Definition(ParentInterface::class, $node);
        $this->assertTrue(
            $definition->isAlienArcType(),
            'isAlienArcType() MUST be TRUE when $node supports arcType interface'
        );
    }

    /** @depends testConstructThrowsForUnsupportedNode
     * @SuppressWarnings(unused)
     */
    public function testIsAlienArcTypeFalseIfInterfaceImplemented()
    {
        $node = new class implements ParentInterface, MetadataInterface {
            public function getDefinitions() : array
            {
            }
            public function isSourceNode()
            {
            }
            public function hasDefinitions(string $arcTypeFilter = '') : bool
            {
            }
            public function supportsArcType(string $arcType) : bool
            {
                return true;
            }
            public function getParentNode() : NodeInterface
            {
            }
            public function setParentNode(NodeInterface $node) : ParentInterface
            {
            }
        };
        $definition = new Definition(ParentInterface::class, $node);
        $this->assertFalse(
            $definition->isAlienArcType(),
            'isAlienArcType() MUST be FALSE when $node implments arcType interface'
        );
    }
}
