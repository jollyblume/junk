<?php

namespace App\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Document\Traits\TrashTrait;

/**
 * TournamentTrash.
 *
 * Implements TreeInterface, allowing the trash can to be added to the Root Node
 *
 *
 *
 * @PHPCR\Document()
 */
class TournamentTrash extends TournamentBag implements TreeInterface
{
    use TrashTrait;

    /**
     * Get the Bags Node Type.
     *
     * @return string
     */
    public function getNodeType()
    {
        return 'TournamentTrash';
    }

    /**
     * Add a Tournament Node.
     *
     * @param TournamentNode $tournament
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addTournamentTrashNode(TournamentNode $tournamentNode)
    {
        return $this->addChild($tournamentNode);
    }

    /**
     * Check if Tournament exists.
     *
     * @param TournamentNode $tournamentNode
     *
     * @return bool
     */
    public function hasTournamentTrashNode(TournamentNode $tournamentNode)
    {
        return $this->hasChild($tournamentNode);
    }

    /**
     * Check if Tournament Name exists.
     *
     * @param TournamentNode $nodename
     *
     * @return bool
     */
    public function hasTournamentTrashName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    /**
     * Remove Tournament.
     *
     * @param TournamentNode $tournamentNode Tournament to remove
     *
     * @return null|TournamentNode Null if Tournament doesn't exist
     *                             Otherwise, removed Tournament Node
     */
    public function removeTournamentTrashNode(TournamentNode $tournamentNode)
    {
        return $this->removeChild($tournamentNode);
    }

    /**
     * Remove the Tournament by name.
     *
     * @param string $nodename Tournament name
     *
     * @return null|TournamentNode Null if Tournament doesn't exist
     *                             Otherwise, removed Tournament Node
     */
    public function removeTournamentTrashName(string $nodename)
    {
        return $this->removeChildKey($nodename);
    }

    /**
     * Get a Tournament Node.
     *
     * @param string $nodename Tournament Nodename to find
     *
     * @return null|TournamentNode
     */
    public function getTournamentTrashNode(string $nodename)
    {
        return $this->getChild($nodename);
    }

    /**
     * Set a Tournament Node.
     *
     * @param string $nodename Tournament Nodename to find
     *
     * @return null|TournamentNode
     */
    public function setTournamentTrashNode(string $nodename, TournamentNode $tournamentNode)
    {
        return $this->setChild($nodename, $tournamentNode);
    }
}
