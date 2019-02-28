<?php

namespace OldApp\Document;

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
 * @PHPCR\Document(childClasses={"App\Document\AllowedByCalendarBag"})
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
        return $node instanceof AllowedByCalendarBag;
    }

    /**
     * Add a Calendar Node.
     *
     * @param AllowedByCalendarBag $calendar
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addCalendarNode(AllowedByCalendarBag $calendarNode)
    {
        return $this->addChild($calendarNode);
    }

    /**
     * Check if Calendar exists.
     *
     * @param AllowedByCalendarBag $calendarNode
     *
     * @return bool
     */
    public function hasCalendarNode(AllowedByCalendarBag $calendarNode)
    {
        return $this->hasChild($calendarNode);
    }

    /**
     * Check if Calendar Name exists.
     *
     * @param AllowedByCalendarBag $nodename
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
     * @param AllowedByCalendarBag $calendarNode Calendar to remove
     *
     * @return null|AllowedByCalendarBag Null if Calendar doesn't exist
     *                           Otherwise, removed Calendar Node
     */
    public function removeCalendarNode(AllowedByCalendarBag $calendarNode)
    {
        // todo create event listener to move child instead of delete it
        return $this->removeChild($calendarNode);
    }

    /**
     * Remove the Calendar by name.
     *
     * @param string $nodename Calendar name
     *
     * @return null|AllowedByCalendarBag Null if Calendar doesn't exist
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
     * @return null|AllowedByCalendarBag
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
     * @return null|AllowedByCalendarBag
     */
    public function setCalendarNode(string $nodename, AllowedByCalendarBag $calendarNode)
    {
        return $this->setChild($nodename, $calendarNode);
    }
}
