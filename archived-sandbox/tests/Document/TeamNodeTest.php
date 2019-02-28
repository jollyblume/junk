<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\TeamNode;
use Doctrine\Common\Collections\ArrayCollection;

class TeamNodeTest extends TestCase
{
    public function testConstructSetsChildren()
    {
        $node = new TeamNode();
        $this->assertInstanceOf(ArrayCollection::class, $node->getChildren());
    }

    public function testGetNodeType()
    {
        $node = new TeamNode();
        $this->assertEquals('Team', $node->getNodeType());
    }
}
