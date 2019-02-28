<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\AbstractNode;
use Doctrine\Common\Collections\Selectable;

class AbstractNodeTest extends TestCase
{
    public function testGetAccessorMap() {
        $bag = $this->getMockForAbstractClass(AbstractNode::class);
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
