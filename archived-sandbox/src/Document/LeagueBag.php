<?php

namespace App\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Exception\NodeExistsException;

/**
 * League Bag.
 *
 * Implements the final accessors AbstractBag delegates:
 *   - addLeagueNode()
 *   - hasLeagueNode()
 *   - hasLeagueName()
 *   - removeLeagueNode()
 *   - removeLeagueName()
 *   - getLeagueNode()
 *
 * @PHPCR\Document(childClasses={"App\Document\LeagueNode"})
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class LeagueBag extends AbstractBag
{
    public function getNodeType()
    {
        return 'League';
    }

    public function supports($node)
    {
        return $node instanceof LeagueNode;
    }

    /**
     * Add a League Node.
     *
     * @param LeagueNode $league
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addLeagueNode(LeagueNode $leagueNode)
    {
        return $this->addChild($leagueNode);
    }

    /**
     * Check if League exists.
     *
     * @param LeagueNode $leagueNode
     *
     * @return bool
     */
    public function hasLeagueNode(LeagueNode $leagueNode)
    {
        return $this->hasChild($leagueNode);
    }

    /**
     * Check if League Name exists.
     *
     * @param LeagueNode $nodename
     *
     * @return bool
     */
    public function hasLeagueName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    /**
     * Remove League.
     *
     * @param LeagueNode $leagueNode League to remove
     *
     * @return null|LeagueNode Null if League doesn't exist
     *                         Otherwise, removed League Node
     */
    public function removeLeagueNode(LeagueNode $leagueNode)
    {
        return $this->removeChild($leagueNode);
    }

    /**
     * Remove the League by name.
     *
     * @param string $nodename League name
     *
     * @return null|LeagueNode Null if League doesn't exist
     *                         Otherwise, removed League Node
     */
    public function removeLeagueName(string $nodename)
    {
        return $this->removeChildKey($nodename);
    }

    /**
     * Get a League Node.
     *
     * @param string $nodename League Nodename to find
     *
     * @return null|LeagueNode
     */
    public function getLeagueNode(string $nodename)
    {
        return $this->getChild($nodename);
    }

    /**
     * Set a League Node.
     *
     * @param string $nodename League Nodename to find
     *
     * @return null|LeagueNode
     */
    public function setLeagueNode(string $nodename, LeagueNode $leagueNode)
    {
        return $this->setChild($nodename, $leagueNode);
    }
}
