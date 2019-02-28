<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\AbstractBag;
use Doctrine\Common\Collections\Selectable;

class AbstractBagTest extends TestCase
{
    public function testIsBagTrash() {
        $bag = $this->getMockForAbstractClass(AbstractBag::class);
        $this->assertFalse($bag->isBagTrash());
    }

    public function testGetAccessorMap() {
        $bag = $this->getMockForAbstractClass(AbstractBag::class);
        $expected = [
            "addNode",
            "hasNode",
            "hasName",
            "removeNode",
            "removeName",
            "getNode",
        ];
        $actual = array_keys($bag->getAccessorMap());
        $this->assertEquals($expected, $actual);
    }
}
