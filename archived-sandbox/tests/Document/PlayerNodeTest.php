<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\PlayerNode;
use Doctrine\Common\Collections\ArrayCollection;

class PlayerNodeTest extends TestCase
{
    public function testConstructSetsChildren()
    {
        $node = new PlayerNode();
        $this->assertInstanceOf(ArrayCollection::class, $node->getChildren());
    }

    public function testGetNodeType()
    {
        $node = new PlayerNode();
        $this->assertEquals('Player', $node->getNodeType());
    }
}
