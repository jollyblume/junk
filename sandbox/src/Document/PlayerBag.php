<?php

namespace App\Document;

use App\Model\PlayerInterface;
use App\Store\PlayerStoreInterface;

/**
 * PlayerBag.
 */
class PlayerBag extends AbstractParentNode implements PlayerStoreInterface
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
        return 'Player';
    }

    public function addPlayerNode(PlayerInterface $node)
    {
        $this->addChild($node);

        return $this;
    }

    public function hasPlayerNode(PlayerInterface $node)
    {
        return $this->hasChild($node);
    }

    public function hasPlayerName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    public function removePlayerNode(PlayerInterface $node)
    {
        return $this->removeChild($node);
    }

    public function removePlayerName(string $nodename)
    {
        return $this->removeChildKey($nodename);
    }

    public function getPlayerNode(string $nodename)
    {
        return $this->getChild($nodename);
    }

    public function setPlayerNode(string $nodename, PlayerInterface $node)
    {
        $this->setChild($nodename, $node);

        return $this;
    }
}
