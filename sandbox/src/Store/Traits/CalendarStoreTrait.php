<?php

namespace App\Store\Traits;

use App\Model\CalendarInterface;
use App\Store\CalendarStoreInterface;
use App\Document\CalendarBag;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CalendarStoreTrait.
 *
 * Implements CalendarStoreInterface
 */
trait CalendarStoreTrait
{
    /**
     * @var CalendarStoreInterface
     */
    private $calendarBag;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return CalendarStoreInterface
     */
    private function getCalendarBagFromStore()
    {
        $bag = $this->calendarBag;

        return $bag;
    }

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @param CalendarStorInterface
     *
     * @return self
     */
    private function setCalendarBagToStore(CalendarStoreInterface $bag)
    {
        $bag = $this->addChildIfMissing($bag);
        $this->calendarBag = $bag;

        return $this;
    }

    /**
     * Get (or create, if needed) a CalendarBag.
     *
     * @return CalendarBag
     */
    private function getOrCreateCalendarBag()
    {
        $bag = $this->getCalendarBagFromStore();
        if (null === $bag) {
            $newBag = new CalendarBag();
            $nodename = strtolower($newBag->getSemanticNodeType());
            $newBag->setNodename($nodename);
            $this->setCalendarNodes($newBag);
            $bag = $this->getCalendarBagFromStore();
        }

        return $bag;
    }

    /**
     * Get all Calendar Nodes.
     *
     * @return ArrayCollection
     */
    public function getCalendarNodes()
    {
        return $this->getOrCreateCalendarBag();
    }

    /**
     * Set all Calendar Nodes.
     *
     * @param CalendarStoreInterface
     *
     * @return self
     */
    public function setCalendarNodes(CalendarStoreInterface $bag)
    {
        $this->setCalendarBagToStore($bag);

        return $this;
    }

    /**
     * Add a Calendar Node.
     *
     * @param CalendarInterface
     *
     * @return self
     */
    public function addCalendarNode(CalendarInterface $node)
    {
        $bag = $this->getOrCreateCalendarBag();

        return $bag->addCalendarNode($node);
    }

    /**
     * Test if a Calendar Node exists.
     *
     * @param CalendarInterface
     *
     * @return bool
     */
    public function hasCalendarNode(CalendarInterface $node)
    {
        $bag = $this->getOrCreateCalendarBag();

        return $bag->hasCalendarNode($node);
    }

    /**
     * Test if a Calendar Nodename exists.
     *
     * @param string
     *
     * @return bool
     */
    public function hasCalendarName(string $nodename)
    {
        $bag = $this->getOrCreateCalendarBag();

        return $bag->hasCalendarName($nodename);
    }

    /**
     * Remove a Calendar Node.
     *
     * @param CalendarInterface
     *
     * @return null|CalendarInterface The removed node or null if not exists
     */
    public function removeCalendarNode(CalendarInterface $node)
    {
        $bag = $this->getOrCreateCalendarBag();

        return $bag->removeCalendarNode($node);
    }

    /**
     * Remove a Calendar Nodename.
     *
     * @param string
     *
     * @return null|CalendarInterface The removed node or null if not exists
     */
    public function removeCalendarName(string $nodename)
    {
        $bag = $this->getOrCreateCalendarBag();

        return $bag->removeCalendarName($nodename);
    }

    /**
     * Get a Calendar Nodename.
     *
     * @param string
     *
     * @return null|CalendarInterface The requested node or null if not exists
     */
    public function getCalendarNode(string $nodename)
    {
        $bag = $this->getOrCreateCalendarBag();

        return $bag->getCalendarNode($nodename);
    }

    /**
     * Set a Calendar Nodename and Node.
     *
     * @param string
     * @param CalendarInterface
     *
     * @return null|CalendarInterface The requested node or null if not exists
     */
    public function setCalendarNode(string $nodename, CalendarInterface $node)
    {
        $bag = $this->getOrCreateCalendarBag();

        return $bag->setCalendarNode($nodename, $node);
    }
}
