<?php

namespace App\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Document\Traits\TrashTrait;

/**
 * PlayerTrash.
 *
 * Implements TreeInterface, allowing the trash can to be added to the Root Node
 *
 *
 *
 * @PHPCR\Document()
 */
class PlayerTrash extends PlayerBag implements TreeInterface
{
    use TrashTrait;

    /**
     * Get the Bags Node Type.
     *
     * @return string
     */
    public function getNodeType()
    {
        return 'PlayerTrash';
    }

    /**
     * Add a Player Node.
     *
     * @param PlayerNode $tournament
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addPlayerTrashNode(PlayerNode $tournamentNode)
    {
        return $this->addChild($tournamentNode);
    }

    /**
     * Check if Player exists.
     *
     * @param PlayerNode $tournamentNode
     *
     * @return bool
     */
    public function hasPlayerTrashNode(PlayerNode $tournamentNode)
    {
        return $this->hasChild($tournamentNode);
    }

    /**
     * Check if Player Name exists.
     *
     * @param PlayerNode $nodename
     *
     * @return bool
     */
    public function hasPlayerTrashName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    /**
     * Remove Player.
     *
     * @param PlayerNode $tournamentNode Player to remove
     *
     * @return null|PlayerNode Null if Player doesn't exist
     *                         Otherwise, removed Player Node
     */
    public function removePlayerTrashNode(PlayerNode $tournamentNode)
    {
        return $this->removeChild($tournamentNode);
    }

    /**
     * Remove the Player by name.
     *
     * @param string $nodename Player name
     *
     * @return null|PlayerNode Null if Player doesn't exist
     *                         Otherwise, removed Player Node
     */
    public function removePlayerTrashName(string $nodename)
    {
        return $this->removeChildKey($nodename);
    }

    /**
     * Get a Player Node.
     *
     * @param string $nodename Player Nodename to find
     *
     * @return null|PlayerNode
     */
    public function getPlayerTrashNode(string $nodename)
    {
        return $this->getChild($nodename);
    }

    /**
     * Set a Player Node.
     *
     * @param string $nodename Player Nodename to find
     *
     * @return null|PlayerNode
     */
    public function setPlayerTrashNode(string $nodename, PlayerNode $tournamentNode)
    {
        return $this->setChild($nodename, $tournamentNode);
    }
}
