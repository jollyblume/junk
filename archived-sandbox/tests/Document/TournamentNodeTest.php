<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\TournamentNode;
use Doctrine\Common\Collections\ArrayCollection;

class TournamentNodeTest extends TestCase
{
    public function testConstructSetsChildren()
    {
        $node = new TournamentNode();
        $this->assertInstanceOf(ArrayCollection::class, $node->getChildren());
    }

    public function testGetNodeType()
    {
        $node = new TournamentNode();
        $this->assertEquals('Tournament', $node->getNodeType());
    }
}
