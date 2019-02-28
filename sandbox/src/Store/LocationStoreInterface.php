<?php

namespace App\Store;

use App\Model\LocationInterface;

/**
 * LocationStoreInterface.
 *
 * Defines a StoreInterface for a LocationInterface Collection that can be
 * embedded into a ParentNodeInterface.
 */
interface LocationStoreInterface extends StoreInterface
{
    /**
     * Add a Location Node.
     *
     * @param LocationInterface
     *
     * @return self
     */
    public function addLocationNode(LocationInterface $node);

    /**
     * Test if there is a Location Node.
     *
     * @param LocationInterface
     *
     * @return bool
     */
    public function hasLocationNode(LocationInterface $node);

    /**
     * Test if there is a Location Nodename.
     *
     * @param string
     *
     * @return bool
     */
    public function hasLocationName(string $node);

    /**
     * Add a Location Node.
     *
     * @param LocationInterface
     *
     * @return self
     */
    public function removeLocationNode(LocationInterface $node);

    /**
     * Remove a Location Nodename.
     *
     * @param string
     *
     * @return null|LocationInterface Removed node or null if not found
     */
    public function removeLocationName(string $nodename);

    /**
     * Get a Location Nodename.
     *
     * @param string
     *
     * @return null|LocationInterface Requested node or null if not found
     */
    public function getLocationNode(string $nodename);

    /**
     * Set a Location Nodename and Node.
     *
     * @param string
     * @param LocationInterface
     *
     * @return self
     */
    public function setLocationNode(string $nodename, LocationInterface $node);
}
