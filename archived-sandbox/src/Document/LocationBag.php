<?php

namespace App\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Exception\NodeExistsException;

/**
 * Location Bag.
 *
 * Implements the final accessors AbstractBag delegates:
 *   - addLocationNode()
 *   - hasLocationNode()
 *   - hasLocationName()
 *   - removeLocationNode()
 *   - removeLocationName()
 *   - getLocationNode()
 *
 * @PHPCR\Document(childClasses={"App\Document\LocationNode"})
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class LocationBag extends AbstractBag
{
    public function getNodeType()
    {
        return 'Location';
    }

    public function supports($node)
    {
        return $node instanceof LocationNode;
    }

    /**
     * Add a Location Node.
     *
     * @param LocationNode $location
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addLocationNode(LocationNode $locationNode)
    {
        return $this->addChild($locationNode);
    }

    /**
     * Check if Location exists.
     *
     * @param LocationNode $locationNode
     *
     * @return bool
     */
    public function hasLocationNode(LocationNode $locationNode)
    {
        return $this->hasChild($locationNode);
    }

    /**
     * Check if Location Name exists.
     *
     * @param LocationNode $nodename
     *
     * @return bool
     */
    public function hasLocationName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    /**
     * Remove Location.
     *
     * @param LocationNode $locationNode Location to remove
     *
     * @return null|LocationNode Null if Location doesn't exist
     *                           Otherwise, removed Location Node
     */
    public function removeLocationNode(LocationNode $locationNode)
    {
        return $this->removeChild($locationNode);
    }

    /**
     * Remove the Location by name.
     *
     * @param string $nodename Location name
     *
     * @return null|LocationNode Null if Location doesn't exist
     *                           Otherwise, removed Location Node
     */
    public function removeLocationName(string $nodename)
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
    public function getLocationNode(string $nodename)
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
    public function setLocationNode(string $nodename, LocationNode $locationNode)
    {
        return $this->setChild($nodename, $locationNode);
    }
}
