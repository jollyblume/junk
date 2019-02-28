<?php

namespace App\Tests\Document;

use DateTime;
use PHPUnit\Framework\TestCase;
use App\Document\CalendarNode;
use App\Document\AbstractNode;
use Doctrine\Common\Collections\ArrayCollection;

class CalendarNodeTest extends TestCase
{
    public function testGetNodeType()
    {
        $node = new CalendarNode();
        $this->assertEquals('Calendar', $node->getNodeType());
    }

    public function testSetStartDate() {
        $node = new CalendarNode();
        $date = new DateTime('now');
        $node->setStartDate($date);
        $this->assertEquals($date, $node->getStartDate());
    }

    public function testSetEndDate() {
        $node = new CalendarNode();
        $date = new DateTime('now');
        $node->setEndDate($date);
        $this->assertEquals($date, $node->getEndDate());
    }

    public function testSetOriginalEventNode() {
        $node = new CalendarNode();
        $eventNode = $this->getMockForAbstractClass(AbstractNode::class);
        $node->setOriginalEventNode($eventNode);
        $this->assertEquals($eventNode, $node->getOriginalEventNode());
    }
}
