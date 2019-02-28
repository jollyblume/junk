<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\LeagueNode;
use Doctrine\Common\Collections\ArrayCollection;

class LeagueNodeTest extends TestCase
{
    public function testConstructSetsChildren()
    {
        $node = new LeagueNode();
        $this->assertInstanceOf(ArrayCollection::class, $node->getChildren());
    }

    public function testGetNodeType()
    {
        $node = new LeagueNode();
        $this->assertEquals('League', $node->getNodeType());
    }
}
