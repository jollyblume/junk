<?php

namespace App\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Document\Traits\TrashTrait;

/**
 * TeamTrash.
 *
 * Implements TreeInterface, allowing the trash can to be added to the Root Node
 *
 *
 *
 * @PHPCR\Document()
 */
class TeamTrash extends TeamBag implements TreeInterface
{
    use TrashTrait;

    /**
     * Get the Bags Node Type.
     *
     * @return string
     */
    public function getNodeType()
    {
        return 'TeamTrash';
    }

    /**
     * Add a Team Node.
     *
     * @param TeamNode $tournament
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addTeamTrashNode(TeamNode $tournamentNode)
    {
        return $this->addChild($tournamentNode);
    }

    /**
     * Check if Team exists.
     *
     * @param TeamNode $tournamentNode
     *
     * @return bool
     */
    public function hasTeamTrashNode(TeamNode $tournamentNode)
    {
        return $this->hasChild($tournamentNode);
    }

    /**
     * Check if Team Name exists.
     *
     * @param TeamNode $nodename
     *
     * @return bool
     */
    public function hasTeamTrashName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    /**
     * Remove Team.
     *
     * @param TeamNode $tournamentNode Team to remove
     *
     * @return null|TeamNode Null if Team doesn't exist
     *                       Otherwise, removed Team Node
     */
    public function removeTeamTrashNode(TeamNode $tournamentNode)
    {
        return $this->removeChild($tournamentNode);
    }

    /**
     * Remove the Team by name.
     *
     * @param string $nodename Team name
     *
     * @return null|TeamNode Null if Team doesn't exist
     *                       Otherwise, removed Team Node
     */
    public function removeTeamTrashName(string $nodename)
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
    public function getTeamTrashNode(string $nodename)
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
    public function setTeamTrashNode(string $nodename, TeamNode $tournamentNode)
    {
        return $this->setChild($nodename, $tournamentNode);
    }
}
