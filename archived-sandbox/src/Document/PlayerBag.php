<?php

namespace App\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Exception\NodeExistsException;

/**
 * Player Bag.
 *
 * Implements the final accessors AbstractBag delegates:
 *   - addPlayerNode()
 *   - hasPlayerNode()
 *   - hasPlayerName()
 *   - removePlayerNode()
 *   - removePlayerName()
 *   - getPlayerNode()
 *
 * @PHPCR\Document(childClasses={"App\Document\PlayerNode"})
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class PlayerBag extends AbstractBag
{
    public function getNodeType()
    {
        return 'Player';
    }

    public function supports($node)
    {
        return $node instanceof PlayerNode;
    }

    /**
     * Add a Player Node.
     *
     * @param PlayerNode $player
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addPlayerNode(PlayerNode $playerNode)
    {
        return $this->addChild($playerNode);
    }

    /**
     * Check if Player exists.
     *
     * @param PlayerNode $playerNode
     *
     * @return bool
     */
    public function hasPlayerNode(PlayerNode $playerNode)
    {
        return $this->hasChild($playerNode);
    }

    /**
     * Check if Player Name exists.
     *
     * @param PlayerNode $nodename
     *
     * @return bool
     */
    public function hasPlayerName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    /**
     * Remove Player.
     *
     * @param PlayerNode $playerNode Player to remove
     *
     * @return null|PlayerNode Null if Player doesn't exist
     *                         Otherwise, removed Player Node
     */
    public function removePlayerNode(PlayerNode $playerNode)
    {
        return $this->removeChild($playerNode);
    }

    /**
     * Remove the Player by name.
     *
     * @param string $nodename Player name
     *
     * @return null|PlayerNode Null if Player doesn't exist
     *                         Otherwise, removed Player Node
     */
    public function removePlayerName(string $nodename)
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
    public function getPlayerNode(string $nodename)
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
    public function setPlayerNode(string $nodename, PlayerNode $playerNode)
    {
        return $this->setChild($nodename, $playerNode);
    }
}
