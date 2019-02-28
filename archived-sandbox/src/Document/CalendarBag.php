<?php

namespace App\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Exception\NodeExistsException;

/**
 * Calendar Bag.
 *
 * Implements the final accessors AbstractBag delegates:
 *   - addCalendarNode()
 *   - hasCalendarNode()
 *   - hasCalendarName()
 *   - removeCalendarNode()
 *   - removeCalendarName()
 *   - getCalendarNode()
 *
 * A Calendar Bag is a queue for Calendar Nodes created by Event Nodes. These
 * Nodes are processed by a workflow.
 *
 * todo merge bags
 *
 * @PHPCR\Document(childClasses={"App\Document\CalendarNode"})
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class CalendarBag extends AbstractBag
{
    public function getNodeType()
    {
        return 'Calendar';
    }

    public function supports($node)
    {
        return $node instanceof CalendarNode;
    }

    /**
     * Add a Calendar Node.
     *
     * @param CalendarNode $calendar
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addCalendarNode(CalendarNode $calendarNode)
    {
        return $this->addChild($calendarNode);
    }

    /**
     * Check if Calendar exists.
     *
     * @param CalendarNode $calendarNode
     *
     * @return bool
     */
    public function hasCalendarNode(CalendarNode $calendarNode)
    {
        return $this->hasChild($calendarNode);
    }

    /**
     * Check if Calendar Name exists.
     *
     * @param CalendarNode $nodename
     *
     * @return bool
     */
    public function hasCalendarName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    /**
     * Remove Calendar.
     *
     * @param CalendarNode $calendarNode Calendar to remove
     *
     * @return null|CalendarNode Null if Calendar doesn't exist
     *                           Otherwise, removed Calendar Node
     */
    public function removeCalendarNode(CalendarNode $calendarNode)
    {
        // todo create event listener to move child instead of delete it
        return $this->removeChild($calendarNode);
    }

    /**
     * Remove the Calendar by name.
     *
     * @param string $nodename Calendar name
     *
     * @return null|CalendarNode Null if Calendar doesn't exist
     *                           Otherwise, removed Calendar Node
     */
    public function removeCalendarName(string $nodename)
    {
        // todo create event listener to move child instead of delete it
        return $this->removeChildKey($nodename);
    }

    /**
     * Get a Calendar Node.
     *
     * @param string $nodename Calendar Nodename to find
     *
     * @return null|CalendarNode
     */
    public function getCalendarNode(string $nodename)
    {
        return $this->getChild($nodename);
    }

    /**
     * Set a Calendar Node.
     *
     * @param string $nodename Calendar Nodename to find
     *
     * @return null|CalendarNode
     */
    public function setCalendarNode(string $nodename, CalendarNode $calendarNode)
    {
        return $this->setChild($nodename, $calendarNode);
    }
}
