<?php

namespace OldApp\Document;

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
 * @PHPCR\Document(childClasses={"App\Document\AllowedByTournamentBag"})
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
        return $node instanceof AllowedByTournamentBag;
    }

    /**
     * Add a Tournament Node.
     *
     * @param AllowedByTournamentBag $tournament
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addTournamentNode(AllowedByTournamentBag $tournamentNode)
    {
        return $this->addChild($tournamentNode);
    }

    /**
     * Check if Tournament exists.
     *
     * @param AllowedByTournamentBag $tournamentNode
     *
     * @return bool
     */
    public function hasTournamentNode(AllowedByTournamentBag $tournamentNode)
    {
        return $this->hasChild($tournamentNode);
    }

    /**
     * Check if Tournament Name exists.
     *
     * @param AllowedByTournamentBag $nodename
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
     * @param AllowedByTournamentBag $tournamentNode Tournament to remove
     *
     * @return null|AllowedByTournamentBag Null if Tournament doesn't exist
     *                             Otherwise, removed Tournament Node
     */
    public function removeTournamentNode(AllowedByTournamentBag $tournamentNode)
    {
        return $this->removeChild($tournamentNode);
    }

    /**
     * Remove the Tournament by name.
     *
     * @param string $nodename Tournament name
     *
     * @return null|AllowedByTournamentBag Null if Tournament doesn't exist
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
     * @return null|AllowedByTournamentBag
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
     * @return null|AllowedByTournamentBag
     */
    public function setTournamentNode(string $nodename, AllowedByTournamentBag $tournamentNode)
    {
        return $this->setChild($nodename, $tournamentNode);
    }
}
