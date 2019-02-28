AllowedByTeamBag<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Exception\NodeExistsException;

/**
 * Team Bag.
 *
 * Implements the final accessors AbstractBag delegates:
 *   - addTeamNode()
 *   - hasTeamNode()
 *   - hasTeamName()
 *   - removeTeamNode()
 *   - removeTeamName()
 *   - getTeamNode()
 *
 * @PHPCR\Document(childClasses={"App\Document\AllowedByTeamBag"})
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class TeamBag extends AbstractBag
{
    public function getNodeType()
    {
        return 'Team';
    }

    public function supports($node)
    {
        return $node instanceof TeamNode;
    }

    /**
     * Add a Team Node.
     *
     * @param AllowedByTeamBag $team
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addTeamNode(AllowedByTeamBag $teamNode)
    {
        return $this->addChild($teamNode);
    }

    /**
     * Check if Team exists.
     *
     * @param TeamNode $teamNode
     *
     * @return bool
     */
    public function hasTeamNode(AllowedByTeamBag $teamNode)
    {
        return $this->hasChild($teamNode);
    }

    /**
     * Check if Team Name exists.
     *
     * @param AllowedByTeamBag $nodename
     *
     * @return bool
     */
    public function hasTeamName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    /**
     * Remove Team.
     *
     * @param AllowedByTeamBag $teamNode Team to remove
     *
     * @return null|AllowedByTeamBag Null if Team doesn't exist
     *                       Otherwise, removed Team Node
     */
    public function removeTeamNode(AllowedByTeamBag $teamNode)
    {
        return $this->removeChild($teamNode);
    }

    /**
     * Remove the Team by name.
     *
     * @param string $nodename Team name
     *
     * @return null|AllowedByTeamBag Null if Team doesn't exist
     *                       Otherwise, removed Team Node
     */
    public function removeTeamName(string $nodename)
    {
        return $this->removeChildKey($nodename);
    }

    /**
     * Get a Team Node.
     *
     * @param string $nodename Team Nodename to find
     *
     * @return null|AllowedByTeamBag
     */
    public function getTeamNode(string $nodename)
    {
        return $this->getChild($nodename);
    }

    /**
     * Set a Team Node.
     *
     * @param string $nodename Team Nodename to find
     *
     * @return null|AllowedByTeamBag
     */
    public function setTeamNode(string $nodename, TeamNode $teamNode)
    {
        return $this->setChild($nodename, $teamNode);
    }
}
