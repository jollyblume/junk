<?php

namespace OldApp\Document;

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
 * @PHPCR\Document(childClasses={"App\Document\AllowedByLeagueBag"})
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
        return $node instanceof AllowedByLeagueBag;
    }

    /**
     * Add a League Node.
     *
     * @param AllowedByLeagueBag $league
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addLeagueNode(AllowedByLeagueBag $leagueNode)
    {
        return $this->addChild($leagueNode);
    }

    /**
     * Check if League exists.
     *
     * @param AllowedByLeagueBag $leagueNode
     *
     * @return bool
     */
    public function hasLeagueNode(AllowedByLeagueBag $leagueNode)
    {
        return $this->hasChild($leagueNode);
    }

    /**
     * Check if League Name exists.
     *
     * @param AllowedByLeagueBag $nodename
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
     * @param AllowedByLeagueBag $leagueNode League to remove
     *
     * @return null|AllowedByLeagueBag Null if League doesn't exist
     *                         Otherwise, removed League Node
     */
    public function removeLeagueNode(AllowedByLeagueBag $leagueNode)
    {
        return $this->removeChild($leagueNode);
    }

    /**
     * Remove the League by name.
     *
     * @param string $nodename League name
     *
     * @return null|AllowedByLeagueBag Null if League doesn't exist
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
     * @return null|AllowedByLeagueBag
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
     * @return null|AllowedByLeagueBag
     */
    public function setLeagueNode(string $nodename, AllowedByLeagueBag $leagueNode)
    {
        return $this->setChild($nodename, $leagueNode);
    }
}
