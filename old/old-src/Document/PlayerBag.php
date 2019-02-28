<?php

namespace OldApp\Document;

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
 * @PHPCR\Document(childClasses={"App\Document\AllowedByPlayerBag"})
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
        return $node instanceof AllowedByPlayerBag;
    }

    /**
     * Add a Player Node.
     *
     * @param AllowedByPlayerBag $player
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addPlayerNode(AllowedByPlayerBag $playerNode)
    {
        return $this->addChild($playerNode);
    }

    /**
     * Check if Player exists.
     *
     * @param AllowedByPlayerBag $playerNode
     *
     * @return bool
     */
    public function hasPlayerNode(AllowedByPlayerBag $playerNode)
    {
        return $this->hasChild($playerNode);
    }

    /**
     * Check if Player Name exists.
     *
     * @param AllowedByPlayerBag $nodename
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
     * @param AllowedByPlayerBag $playerNode Player to remove
     *
     * @return null|AllowedByPlayerBag Null if Player doesn't exist
     *                         Otherwise, removed Player Node
     */
    public function removePlayerNode(AllowedByPlayerBag $playerNode)
    {
        return $this->removeChild($playerNode);
    }

    /**
     * Remove the Player by name.
     *
     * @param string $nodename Player name
     *
     * @return null|AllowedByPlayerBag Null if Player doesn't exist
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
     * @return null|AllowedByPlayerBag
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
     * @return null|AllowedByPlayerBag
     */
    public function setPlayerNode(string $nodename, AllowedByPlayerBag $playerNode)
    {
        return $this->setChild($nodename, $playerNode);
    }
}
