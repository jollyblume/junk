<?php

namespace OldApp\Document;

use DateTime;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * CalendarNode.
 *
 * This is a concrete Document Node.
 *
 * Calendar Nodes represent a request for a block of time required by some event
 * to be coordinated with a master schedule.
 * (ei: for a league match occuring on Tuesday, from 6pm until 10pm).
 *
 * The Node Queue is processed by a workflow.
 *
 * The Scheduler use data in the master schedule to juggle matches where a
 * participant (Team or Player) has a conflict for Calendar Nodes in the queue.
 *
 * todo nodename should be original Event Node's Uuid.
 *
 * @PHPCR\Document()
 */
class CalendarNode extends AbstractNode implements AllowedByCalendarBag
{
    public function getNodeType()
    {
        return 'Calendar';
    }

    /**
     * Start date.
     *
     * @var DateTime
     * @PHPCR\Field(type="date")
     */
    private $startDate;

    /**
     * End date.
     *
     * This can be null for single day events. The Scheduler will assume the
     * event lasts the remainder of the day
     *
     * @var DateTime
     * @PHPCR\Field(type="date")
     */
    private $endDate;

    /**
     * Event Node with the original time requirement.
     *
     * @var CalendarReferanceInterface
     * @PHPCR\ReferenceOne(strategy="weak", targetDocument="App\Document\AbstractNode")
     */
    private $originalEventNode;

    /**
     * Get the starting date.
     *
     * @return DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set the starting date.
     *
     * @param DateTime
     *
     * @return self
     */
    public function setStartDate(DateTime $startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get the ending date.
     *
     * @return DateTime
     */
    public function getEndDate()
    {
        // todo return end of day if null
        return $this->endDate;
    }

    /**
     * Set the ending date.
     *
     * @param DateTime
     *
     * @return self
     */
    public function setEndDate(DateTime $endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get the Event Node that created the original time requirement.
     *
     * An Event that defines a time requirement creates a new Calendar Node and
     * adds it to a Calendar Bag for processing.
     *
     * Events are usually Tournaments or Matches.
     *
     * @return AbstractNode
     */
    public function getOriginalEventNode()
    {
        return $this->originalEventNode;
    }

    /**
     * Set the Event Node that created the original time requirement.
     *
     * @param AbstractNode
     *
     * @return self
     */
    public function setOriginalEventNode(AbstractNode $eventNode)
    {
        $this->originalEventNode = $eventNode;

        return $this;
    }
}
