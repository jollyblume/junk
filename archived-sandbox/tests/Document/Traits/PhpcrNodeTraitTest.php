<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\Traits\PhpcrNodeTrait;
use App\Document\PhpcrChildrenInterface;
use App\Document\PhpcrNodeInterface;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.TooManyMethods)
 */
class PhpcrNodeTraitTest extends TestCase
{
    protected function buildMockForTrait() {
        $trait = $this->getMockForTrait(PhpcrNodeTrait::class);
        return $trait;
    }

    public function testSetNodenameIfAllPropertiesNull() {
        $trait = $this->buildMockForTrait();
        $trait->setNodename('testnodename');
        $this->assertEquals('testnodename', $trait->getNodename());
        $this->assertEquals('/testnodename', $trait->getId());
    }

    public function testSetParentIfAllPropertiesNull() {
        $trait = $this->buildMockForTrait();
        $parent = $this->createMock(PhpcrChildrenInterface::class);
        $parent->method('getId')->willReturn('/testparent');
        $trait->setParent($parent);
        $this->assertEquals($parent, $trait->getParent());
        $this->assertEquals('/testparent/', $trait->getId());
    }

    public function testSetIdIfAllPropertiesNull() {
        $trait = $this->buildMockForTrait();
        $trait->setId('/testparent/testnodename');
        $this->assertEquals('/testparent/testnodename', $trait->getId());
        $this->assertEquals('/testparent', $trait->getParentId());
        $this->assertEquals('testnodename', $trait->getNodeName());
    }

    /**
     * @expectedException       \App\Exception\PropImmutableException
     */
    public function testSetNodenameThrowsIfNodenameSet() {
        $trait = $this->buildMockForTrait();
        $trait->setNodename('testnodename');
        $trait->setNodename('testnodename');
    }

    /**
     * @expectedException       \App\Exception\PropImmutableException
     */
    public function testSetNodenameThrowsIfIdSet() {
        $trait = $this->buildMockForTrait();
        $trait->setId('/testparent/testnodename');
        $trait->setNodename('testnodename');
    }

    /**
     * @expectedException       \App\Exception\PropImmutableException
     */
    public function testSetParentThrowsIfParentSet() {
        $trait = $this->buildMockForTrait();
        $parent = $this->createMock(PhpcrChildrenInterface::class);
        $parent->method('getId')->willReturn('/testparent');
        $trait->setParent($parent);
        $trait->setParent($parent);
    }

    /**
     * @expectedException       \App\Exception\PropImmutableException
     */
    public function testSetParentThrowsIfIdSet() {
        $trait = $this->buildMockForTrait();
        $parent = $this->createMock(PhpcrChildrenInterface::class);
        $parent->method('getId')->willReturn('/testparent');
        $trait->setParent($parent);
        $trait->setId('/testparent/testnodename');
        $trait->setParent($parent);
    }

    /**
     * @expectedException       \App\Exception\PropImmutableException
     */
    public function testSetIdThrowsIfIdSet() {
        $trait = $this->buildMockForTrait();
        $trait->setId('/testparent/testnodename');
        $trait->setId('/testparent/testnodename');
    }

    /**
     * @expectedException       \App\Exception\PropImmutableException
     */
    public function testSetIdThrowsIfParentSet() {
        $trait = $this->buildMockForTrait();
        $parent = $this->createMock(PhpcrChildrenInterface::class);
        $parent->method('getId')->willReturn('/testparent');
        $trait->setParent($parent);
        $trait->setId('/testparent/testnodename');
    }

    /**
     * @expectedException       \App\Exception\PropImmutableException
     */
    public function testSetIdThrowsIfNodenameSet() {
        $trait = $this->buildMockForTrait();
        $trait->setNodename('testnodename');
        $trait->setId('/testparent/testnodename');
    }

    /**
     * @expectedException       \App\Exception\NodeExistsException
     */
    public function testSetIdThrowsIfIdIsSlash() {
        $trait = $this->buildMockForTrait();
        $trait->setId('/');
    }

    /**
     * @expectedException       \App\Exception\NodeExistsException
     */
    public function testSetIdThrowsIfIdIsEmpty() {
        $trait = $this->buildMockForTrait();
        $trait->setId('');
    }

    /**
     * @expectedException       \App\Exception\NodeExistsException
     */
    public function testSetNodenameThrowsIfNodenameIsEmpty() {
        $trait = $this->buildMockForTrait();
        $trait->setNodename('');
    }

    public function testSetNodenameReturnsSelf() {
        $trait = $this->buildMockForTrait();
        $this->assertEquals($trait, $trait->setNodename('testnodename'));
    }

    public function testSetParentReturnsSelf()
    {
        $trait = $this->buildMockForTrait();
        $parent = $this->createMock(PhpcrChildrenInterface::class);
        $parent->method('getId')->willReturn('/testparent');
        $this->assertEquals($trait, $trait->setParent($parent));
    }

    public function testSetIdReturnsSelf()
    {
        $trait = $this->buildMockForTrait();
        $this->assertEquals($trait, $trait->setId('/testparent/testnodename'));
    }
}
