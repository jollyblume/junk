<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Exception\NodeExistsException;

/**
 * Match Bag.
 *
 * Implements the final accessors AbstractBag delegates:
 *   - addMatchNode()
 *   - hasMatchNode()
 *   - hasMatchName()
 *   - removeMatchNode()
 *   - removeMatchName()
 *   - getMatchNode()
 *
 * @PHPCR\Document(childClasses={"App\Document\AllowedByMatchBag"})
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class MatchBag extends AbstractBag
{
    public function getNodeType()
    {
        return 'Match';
    }

    public function supports($node)
    {
        return $node instanceof AllowedByMatchBag;
    }

    /**
     * Add a Match Node.
     *
     * @param AllowedByMatchBag $match
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addMatchNode(AllowedByMatchBag $matchNode)
    {
        return $this->addChild($matchNode);
    }

    /**
     * Check if Match exists.
     *
     * @param AllowedByMatchBag $matchNode
     *
     * @return bool
     */
    public function hasMatchNode(AllowedByMatchBag $matchNode)
    {
        return $this->hasChild($matchNode);
    }

    /**
     * Check if Match Name exists.
     *
     * @param AllowedByMatchBag $nodename
     *
     * @return bool
     */
    public function hasMatchName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    /**
     * Remove Match.
     *
     * @param AllowedByMatchBag $matchNode Match to remove
     *
     * @return null|AllowedByMatchBag Null if Match doesn't exist
     *                        Otherwise, removed Match Node
     */
    public function removeMatchNode(AllowedByMatchBag $matchNode)
    {
        return $this->removeChild($matchNode);
    }

    /**
     * Remove the Match by name.
     *
     * @param string $nodename Match name
     *
     * @return null|AllowedByMatchBag Null if Match doesn't exist
     *                        Otherwise, removed Match Node
     */
    public function removeMatchName(string $nodename)
    {
        return $this->removeChildKey($nodename);
    }

    /**
     * Get a Match Node.
     *
     * @param string $nodename Match Nodename to find
     *
     * @return null|AllowedByMatchBag
     */
    public function getMatchNode(string $nodename)
    {
        return $this->getChild($nodename);
    }

    /**
     * Set a Match Node.
     *
     * @param string $nodename Match Nodename to find
     *
     * @return null|AllowedByMatchBag
     */
    public function setMatchNode(string $nodename, AllowedByMatchBag $matchNode)
    {
        return $this->setChild($nodename, $matchNode);
    }
}
