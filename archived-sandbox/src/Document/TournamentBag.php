<?php

namespace App\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Exception\NodeExistsException;

/**
 * Tournament Bag.
 *
 * Implements the final accessors AbstractBag delegates:
 *   - addTournamentNode()
 *   - hasTournamentNode()
 *   - hasTournamentName()
 *   - removeTournamentNode()
 *   - removeTournamentName()
 *   - getTournamentNode()
 *
 * @PHPCR\Document(childClasses={"App\Document\TournamentNode"})
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class TournamentBag extends AbstractBag
{
    public function getNodeType()
    {
        return 'Tournament';
    }

    public function supports($node)
    {
        return $node instanceof TournamentNode;
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
    public function addTournamentNode(TournamentNode $tournamentNode)
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
    public function hasTournamentNode(TournamentNode $tournamentNode)
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
    public function hasTournamentName(string $nodename)
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
    public function removeTournamentNode(TournamentNode $tournamentNode)
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
    public function removeTournamentName(string $nodename)
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
    public function getTournamentNode(string $nodename)
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
    public function setTournamentNode(string $nodename, TournamentNode $tournamentNode)
    {
        return $this->setChild($nodename, $tournamentNode);
    }
}
