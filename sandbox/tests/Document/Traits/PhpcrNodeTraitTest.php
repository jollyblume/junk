<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\Traits\PhpcrNodeTrait;
use App\Document\Traits\PhpcrParentNodeTrait;
use App\Model\NodeInterface;
use App\Model\ParentNodeInterface;
use App\Exception\NodeExistsException;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class PhpcrNodeTraitTest extends TestCase {
    public function testGetNodenameIfNotSet() {
        $trait = $this->getMockForTrait(PhpcrNodeTrait::class);

        $this->assertEquals('', $trait->getNodename());
    }

    public function testGetNodenameIfSet() {
        $trait = $this->getMockForTrait(PhpcrNodeTrait::class);

        $trait->setNodename('testnodename');
        $this->assertEquals('testnodename', $trait->getNodename());
    }

    public function testGetNodenameIfIdentifierSet() {
        $trait = $this->getMockForTrait(PhpcrNodeTrait::class);

        $trait->setIdentifier('/testparentnode/testnodename');
        $this->assertEquals('testnodename', $trait->getNodename());
    }

    public function testGetParentIfNotSet() {
        $trait = $this->getMockForTrait(PhpcrNodeTrait::class);

        $this->assertNull($trait->getParent());
    }

    public function testGetParentIfSet() {
        $trait = $this->getMockForTrait(PhpcrNodeTrait::class);
        $parent = $this->createMock(ParentNodeInterface::class);

        $trait->setParent($parent);
        $this->assertEquals($parent, $trait->getParent());
    }

    public function testGetParentIdIfIdentifierSet() {
        $trait = $this->getMockForTrait(PhpcrNodeTrait::class);

        $trait->setIdentifier('/testparentnode/testnodename');
        $this->assertEquals('/testparentnode', $trait->getParentIdentifier());
    }

    public function testGetParentIdIfParentSet() {
        $trait = $this->getMockForTrait(PhpcrNodeTrait::class);
        $parentNode = $this->createMock(ParentNodeInterface::class);
        $parentNode->method('getIdentifier')->willReturn('/testparentnode');

        $trait->setParent($parentNode);
        $this->assertEquals('/testparentnode', $trait->getParentIdentifier());
    }

    public function testGetIdentifierIfNotSet() {
        $trait = $this->getMockForTrait(PhpcrNodeTrait::class);

        $this->assertEquals('/', $trait->getIdentifier());
    }

    public function testGetIdentifierIfSet() {
        $trait = $this->getMockForTrait(PhpcrNodeTrait::class);

        $trait->setIdentifier('/testparentnodename/testnodename');
        $this->assertEquals('/testparentnodename/testnodename', $trait->getIdentifier());
    }

    // /**
    //  * @expectedException       App\Exception\PropImmutableException
    //  */
    // public function testSetNodenameThrowsIfIdentifierSet() {
    //     $trait = $this->getMockForTrait(PhpcrNodeTrait::class);
    //
    //     $trait->setIdentifier('/testparentnode/testnodename');
    //     $trait->setNodename('testnodename');
    // }

    // /**
    //  * @expectedException       App\Exception\PropImmutableException
    //  */
    // public function testSetParentThrowsIfIdentifierSet() {
    //     $trait = $this->getMockForTrait(PhpcrNodeTrait::class);
    //
    //     $parent = $this->createMock(ParentNodeInterface::class);
    //     $parent->method('getNodename')->willReturn('testnodename');
    //
    //     $trait->setIdentifier('/testparentnode/testnodename');
    //     $trait->setParent($parent);
    // }

    /**
     * @expectedException       App\Exception\PropImmutableException
     */
    public function testSetIdentifierThrowsIfNodenameSet() {
        $trait = $this->getMockForTrait(PhpcrNodeTrait::class);

        $trait->setNodename('testnodename');
        $trait->setIdentifier('/testparentnode/testnodename');
    }

    /**
     * @expectedException       App\Exception\PropImmutableException
     */
    public function testSetIdentifierThrowsIfParentSet() {
        $trait = $this->getMockForTrait(PhpcrNodeTrait::class);

        $parent = $this->createMock(ParentNodeInterface::class);
        $parent->method('getNodename')->willReturn('testnodename');

        $trait->setParent($parent);
        $trait->setIdentifier('/testparentnode/testnodename');
    }

    /**
     * @expectedException       App\Exception\PropImmutableException
     */
    public function testSetIdentifierThrowsIfIdentifierSet() {
        $trait = $this->getMockForTrait(PhpcrNodeTrait::class);

        $trait->setIdentifier('/testparentnode/testnodename');


        $trait->setIdentifier('/testparentnode/testnodename');
    }

    /**
     * @expectedException       App\Exception\NodeExistsException
     */
    public function testSetNodenameThrowsIfNodenameEmpty() {
        $trait = $this->getMockForTrait(PhpcrNodeTrait::class);

        $trait->setNodename('');
    }

    public function testDisconnectNodeExitsIfParentNotSet() {
        $trait = $this->getMockForTrait(PhpcrNodeTrait::class);
        $this->assertNull($trait->disconnectNode());
    }

    public function testMoveNodeExitsIfNothingToDo() {
        $trait = $this->getMockForTrait(PhpcrNodeTrait::class);
        $this->assertNull($trait->moveNode());
    }

    public function testMoveNodeSettingNodenameExitsIfNodenameNotChanging() {
        $trait = $this->getMockForTrait(PhpcrNodeTrait::class);
        $trait->setNodename('testnodename');
        $this->assertNull($trait->moveNode(null, 'testnodename'));
    }

    public function testMoveNodeSettingParentExitsIfParentNotChanging() {
        $trait = $this->getMockForTrait(PhpcrNodeTrait::class);
        $parentNode = $this->createMock(ParentNodeInterface::class);
        $trait->setParent($parentNode);
        $this->assertNull($trait->moveNode($parentNode));
    }

    // /**
    //  * @expectedException       App\Exception\PropImmutableException
    //  */
    // public function testMoveNodeThrowsIfIdendifierSet() {
    //     $trait = $this->getMockForTrait(PhpcrNodeTrait::class);
    //     $trait->setIdentifier('/testparentnode/testnodename');
    //     $trait->moveNode();
    // }

    /**
     * @expectedException       App\Exception\NodeExistsException
     */
    public function testMoveNodeThrowsIfNodenameEmpty() {
        $trait = $this->getMockForTrait(PhpcrNodeTrait::class);
        $trait->moveNode(null, '');
    }
}
