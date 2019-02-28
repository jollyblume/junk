<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Document\Traits\TrashTrait;
use App\Document\AllowedByMatchBag;

/**
 * MatchTrash.
 *
 * Implements TreeInterface, allowing the trash can to be added to the Root Node
 *
 *
 *
 * @PHPCR\Document()
 */
class MatchTrash extends MatchBag implements TreeInterface, AllowedByMatchBag
{
    use TrashTrait;

    /**
     * Get the Bags Node Type.
     *
     * @return string
     */
    public function getNodeType()
    {
        return 'MatchTrash';
    }

    /**
     * Add a Match Node.
     *
     * @param MatchNode $tournament
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addMatchTrashNode(MatchNode $tournamentNode)
    {
        return $this->addChild($tournamentNode);
    }

    /**
     * Check if Match exists.
     *
     * @param MatchNode $tournamentNode
     *
     * @return bool
     */
    public function hasMatchTrashNode(MatchNode $tournamentNode)
    {
        return $this->hasChild($tournamentNode);
    }

    /**
     * Check if Match Name exists.
     *
     * @param MatchNode $nodename
     *
     * @return bool
     */
    public function hasMatchTrashName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    /**
     * Remove Match.
     *
     * @param MatchNode $tournamentNode Match to remove
     *
     * @return null|MatchNode Null if Match doesn't exist
     *                        Otherwise, removed Match Node
     */
    public function removeMatchTrashNode(MatchNode $tournamentNode)
    {
        return $this->removeChild($tournamentNode);
    }

    /**
     * Remove the Match by name.
     *
     * @param string $nodename Match name
     *
     * @return null|MatchNode Null if Match doesn't exist
     *                        Otherwise, removed Match Node
     */
    public function removeMatchTrashName(string $nodename)
    {
        return $this->removeChildKey($nodename);
    }

    /**
     * Get a Match Node.
     *
     * @param string $nodename Match Nodename to find
     *
     * @return null|MatchNode
     */
    public function getMatchTrashNode(string $nodename)
    {
        return $this->getChild($nodename);
    }

    /**
     * Set a Match Node.
     *
     * @param string $nodename Match Nodename to find
     *
     * @return null|MatchNode
     */
    public function setMatchTrashNode(string $nodename, MatchNode $tournamentNode)
    {
        return $this->setChild($nodename, $tournamentNode);
    }
}
