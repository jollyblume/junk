<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Document\Traits\TrashTrait;
use App\Document\AllowedByCalendarBag;

/**
 * CalendarTrash.
 *
 * Implements TreeInterface, allowing the trash can to be added to the Root Node
 *
 *
 *
 * @PHPCR\Document()
 */
class CalendarTrash extends CalendarBag implements TreeInterface, AllowedByCalendarBag
{
    use TrashTrait;

    /**
     * Get the Bags Node Type.
     *
     * @return string
     */
    public function getNodeType()
    {
        return 'CalendarTrash';
    }

    /**
     * Add a Calendar Node.
     *
     * @param CalendarNode $tournament
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addCalendarTrashNode(CalendarNode $tournamentNode)
    {
        return $this->addChild($tournamentNode);
    }

    /**
     * Check if Calendar exists.
     *
     * @param CalendarNode $tournamentNode
     *
     * @return bool
     */
    public function hasCalendarTrashNode(CalendarNode $tournamentNode)
    {
        return $this->hasChild($tournamentNode);
    }

    /**
     * Check if Calendar Name exists.
     *
     * @param CalendarNode $nodename
     *
     * @return bool
     */
    public function hasCalendarTrashName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    /**
     * Remove Calendar.
     *
     * @param CalendarNode $tournamentNode Calendar to remove
     *
     * @return null|CalendarNode Null if Calendar doesn't exist
     *                           Otherwise, removed Calendar Node
     */
    public function removeCalendarTrashNode(CalendarNode $tournamentNode)
    {
        return $this->removeChild($tournamentNode);
    }

    /**
     * Remove the Calendar by name.
     *
     * @param string $nodename Calendar name
     *
     * @return null|CalendarNode Null if Calendar doesn't exist
     *                           Otherwise, removed Calendar Node
     */
    public function removeCalendarTrashName(string $nodename)
    {
        return $this->removeChildKey($nodename);
    }

    /**
     * Get a Calendar Node.
     *
     * @param string $nodename Calendar Nodename to find
     *
     * @return null|CalendarNode
     */
    public function getCalendarTrashNode(string $nodename)
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
    public function setCalendarTrashNode(string $nodename, CalendarNode $tournamentNode)
    {
        return $this->setChild($nodename, $tournamentNode);
    }
}
