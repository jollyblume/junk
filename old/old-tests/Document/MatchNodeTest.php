<?php

namespace OldApp\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\MatchNode;
use Doctrine\Common\Collections\ArrayCollection;

class MatchNodeTest extends TestCase
{
    public function testConstructSetsChildren()
    {
        $node = new MatchNode();
        $this->assertInstanceOf(ArrayCollection::class, $node->getChildren());
    }

    public function testGetNodeType()
    {
        $node = new MatchNode();
        $this->assertEquals('Match', $node->getNodeType());
    }
}
