<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Document\Traits\TrashTrait;
use App\Document\AllowedByLocationBag;

/**
 * LocationTrash.
 *
 * Implements TreeInterface, allowing the trash can to be added to the Root Node
 *
 *
 *
 * @PHPCR\Document()
 */
class LocationTrash extends LocationBag implements TreeInterface, AllowedByLocationBag
{
    use TrashTrait;

    /**
     * Get the Bags Node Type.
     *
     * @return string
     */
    public function getNodeType()
    {
        return 'LocationTrash';
    }

    /**
     * Add a Location Node.
     *
     * @param LocationNode $tournament
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addLocationTrashNode(LocationNode $tournamentNode)
    {
        return $this->addChild($tournamentNode);
    }

    /**
     * Check if Location exists.
     *
     * @param LocationNode $tournamentNode
     *
     * @return bool
     */
    public function hasLocationTrashNode(LocationNode $tournamentNode)
    {
        return $this->hasChild($tournamentNode);
    }

    /**
     * Check if Location Name exists.
     *
     * @param LocationNode $nodename
     *
     * @return bool
     */
    public function hasLocationTrashName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    /**
     * Remove Location.
     *
     * @param LocationNode $tournamentNode Location to remove
     *
     * @return null|LocationNode Null if Location doesn't exist
     *                           Otherwise, removed Location Node
     */
    public function removeLocationTrashNode(LocationNode $tournamentNode)
    {
        return $this->removeChild($tournamentNode);
    }

    /**
     * Remove the Location by name.
     *
     * @param string $nodename Location name
     *
     * @return null|LocationNode Null if Location doesn't exist
     *                           Otherwise, removed Location Node
     */
    public function removeLocationTrashName(string $nodename)
    {
        return $this->removeChildKey($nodename);
    }

    /**
     * Get a Location Node.
     *
     * @param string $nodename Location Nodename to find
     *
     * @return null|LocationNode
     */
    public function getLocationTrashNode(string $nodename)
    {
        return $this->getChild($nodename);
    }

    /**
     * Set a Location Node.
     *
     * @param string $nodename Location Nodename to find
     *
     * @return null|LocationNode
     */
    public function setLocationTrashNode(string $nodename, LocationNode $tournamentNode)
    {
        return $this->setChild($nodename, $tournamentNode);
    }
}
