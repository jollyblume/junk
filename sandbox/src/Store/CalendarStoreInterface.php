<?php

namespace App\Store;

use App\Model\CalendarInterface;

/**
 * CalendarStoreInterface.
 *
 * Defines a StoreInterface for a CalendarInterface Collection that can be
 * embedded into a ParentNodeInterface.
 */
interface CalendarStoreInterface extends StoreInterface
{
    /**
     * Add a Calendar Node.
     *
     * @param CalendarInterface
     *
     * @return self
     */
    public function addCalendarNode(CalendarInterface $node);

    /**
     * Test if there is a Calendar Node.
     *
     * @param CalendarInterface
     *
     * @return bool
     */
    public function hasCalendarNode(CalendarInterface $node);

    /**
     * Test if there is a Calendar Nodename.
     *
     * @param string
     *
     * @return bool
     */
    public function hasCalendarName(string $node);

    /**
     * Add a Calendar Node.
     *
     * @param CalendarInterface
     *
     * @return self
     */
    public function removeCalendarNode(CalendarInterface $node);

    /**
     * Remove a Calendar Nodename.
     *
     * @param string
     *
     * @return null|CalendarInterface Removed node or null if not found
     */
    public function removeCalendarName(string $nodename);

    /**
     * Get a Calendar Nodename.
     *
     * @param string
     *
     * @return null|CalendarInterface Requested node or null if not found
     */
    public function getCalendarNode(string $nodename);

    /**
     * Set a Calendar Nodename and Node.
     *
     * @param string
     * @param CalendarInterface
     *
     * @return self
     */
    public function setCalendarNode(string $nodename, CalendarInterface $node);
}
