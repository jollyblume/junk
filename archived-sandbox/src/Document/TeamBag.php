<?php

namespace App\Document;

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
 * @PHPCR\Document(childClasses={"App\Document\TeamNode"})
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
     * @param TeamNode $team
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addTeamNode(TeamNode $teamNode)
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
    public function hasTeamNode(TeamNode $teamNode)
    {
        return $this->hasChild($teamNode);
    }

    /**
     * Check if Team Name exists.
     *
     * @param TeamNode $nodename
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
     * @param TeamNode $teamNode Team to remove
     *
     * @return null|TeamNode Null if Team doesn't exist
     *                       Otherwise, removed Team Node
     */
    public function removeTeamNode(TeamNode $teamNode)
    {
        return $this->removeChild($teamNode);
    }

    /**
     * Remove the Team by name.
     *
     * @param string $nodename Team name
     *
     * @return null|TeamNode Null if Team doesn't exist
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
     * @return null|TeamNode
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
     * @return null|TeamNode
     */
    public function setTeamNode(string $nodename, TeamNode $teamNode)
    {
        return $this->setChild($nodename, $teamNode);
    }
}
