<?php

namespace App\Document;

use App\Model\LeagueInterface;
use App\Store\LeagueStoreInterface;

/**
 * LeagueBag.
 */
class LeagueBag extends AbstractParentNode implements LeagueStoreInterface
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
        return 'League';
    }

    public function addLeagueNode(LeagueInterface $node)
    {
        $this->addChild($node);

        return $this;
    }

    public function hasLeagueNode(LeagueInterface $node)
    {
        return $this->hasChild($node);
    }

    public function hasLeagueName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    public function removeLeagueNode(LeagueInterface $node)
    {
        return $this->removeChild($node);
    }

    public function removeLeagueName(string $nodename)
    {
        return $this->removeChildKey($nodename);
    }

    public function getLeagueNode(string $nodename)
    {
        return $this->getChild($nodename);
    }

    public function setLeagueNode(string $nodename, LeagueInterface $node)
    {
        $this->setChild($nodename, $node);

        return $this;
    }
}
