<?php

namespace App\Document;

use App\Model\LocationInterface;
use App\Store\LocationStoreInterface;

/**
 * LocationBag.
 */
class LocationBag extends AbstractParentNode implements LocationStoreInterface
{
    /**
     * Get the semantic Node Type.
     *
     * The Node Type is used to compute the method name of semantic collection
     * accessor methods.
     *
     * @return string The Bag Type
     */
    public function getSemanticNodeType()
    {
        return 'Location';
    }

    public function addLocationNode(LocationInterface $node)
    {
        $this->addChild($node);

        return $this;
    }

    public function hasLocationNode(LocationInterface $node)
    {
        return $this->hasChild($node);
    }

    public function hasLocationName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    public function removeLocationNode(LocationInterface $node)
    {
        return $this->removeChild($node);
    }

    public function removeLocationName(string $nodename)
    {
        return $this->removeChildKey($nodename);
    }

    public function getLocationNode(string $nodename)
    {
        return $this->getChild($nodename);
    }

    public function setLocationNode(string $nodename, LocationInterface $node)
    {
        $this->setChild($nodename, $node);

        return $this;
    }
}
