<?php

namespace OldApp\Document;

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
 * @PHPCR\Document(childClasses={"App\Document\AllowedByLocationBag"})
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
        return $node instanceof AllowedByLocationBag;
    }

    /**
     * Add a Location Node.
     *
     * @param AllowedByLocationBag $location
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addLocationNode(AllowedByLocationBag $locationNode)
    {
        return $this->addChild($locationNode);
    }

    /**
     * Check if Location exists.
     *
     * @param AllowedByLocationBag $locationNode
     *
     * @return bool
     */
    public function hasLocationNode(AllowedByLocationBag $locationNode)
    {
        return $this->hasChild($locationNode);
    }

    /**
     * Check if Location Name exists.
     *
     * @param AllowedByLocationBag $nodename
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
     * @param AllowedByLocationBag $locationNode Location to remove
     *
     * @return null|AllowedByLocationBag Null if Location doesn't exist
     *                           Otherwise, removed Location Node
     */
    public function removeLocationNode(AllowedByLocationBag $locationNode)
    {
        return $this->removeChild($locationNode);
    }

    /**
     * Remove the Location by name.
     *
     * @param string $nodename Location name
     *
     * @return null|AllowedByLocationBag Null if Location doesn't exist
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
     * @return null|AllowedByLocationBag
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
     * @return null|AllowedByLocationBag
     */
    public function setLocationNode(string $nodename, AllowedByLocationBag $locationNode)
    {
        return $this->setChild($nodename, $locationNode);
    }
}
