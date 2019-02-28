<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Document\Traits\TrashTrait;
use App\Document\AllowedByLeagueBag;

/**
 * LeagueTrash.
 *
 * Implements TreeInterface, allowing the trash can to be added to the Root Node
 *
 *
 *
 * @PHPCR\Document()
 */
class LeagueTrash extends LeagueBag implements TreeInterface, AllowedByLeagueBag
{
    use TrashTrait;

    /**
     * Get the Bags Node Type.
     *
     * @return string
     */
    public function getNodeType()
    {
        return 'LeagueTrash';
    }

    /**
     * Add a League Node.
     *
     * @param LeagueNode $tournament
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addLeagueTrashNode(LeagueNode $tournamentNode)
    {
        return $this->addChild($tournamentNode);
    }

    /**
     * Check if League exists.
     *
     * @param LeagueNode $tournamentNode
     *
     * @return bool
     */
    public function hasLeagueTrashNode(LeagueNode $tournamentNode)
    {
        return $this->hasChild($tournamentNode);
    }

    /**
     * Check if League Name exists.
     *
     * @param LeagueNode $nodename
     *
     * @return bool
     */
    public function hasLeagueTrashName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    /**
     * Remove League.
     *
     * @param LeagueNode $tournamentNode League to remove
     *
     * @return null|LeagueNode Null if League doesn't exist
     *                         Otherwise, removed League Node
     */
    public function removeLeagueTrashNode(LeagueNode $tournamentNode)
    {
        return $this->removeChild($tournamentNode);
    }

    /**
     * Remove the League by name.
     *
     * @param string $nodename League name
     *
     * @return null|LeagueNode Null if League doesn't exist
     *                         Otherwise, removed League Node
     */
    public function removeLeagueTrashName(string $nodename)
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
    public function getLeagueTrashNode(string $nodename)
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
    public function setLeagueTrashNode(string $nodename, LeagueNode $tournamentNode)
    {
        return $this->setChild($nodename, $tournamentNode);
    }
}
