<?php

namespace App\Document;

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
 * @PHPCR\Document(childClasses={"App\Document\MatchNode"})
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
        return $node instanceof MatchNode;
    }

    /**
     * Add a Match Node.
     *
     * @param MatchNode $match
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addMatchNode(MatchNode $matchNode)
    {
        return $this->addChild($matchNode);
    }

    /**
     * Check if Match exists.
     *
     * @param MatchNode $matchNode
     *
     * @return bool
     */
    public function hasMatchNode(MatchNode $matchNode)
    {
        return $this->hasChild($matchNode);
    }

    /**
     * Check if Match Name exists.
     *
     * @param MatchNode $nodename
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
     * @param MatchNode $matchNode Match to remove
     *
     * @return null|MatchNode Null if Match doesn't exist
     *                        Otherwise, removed Match Node
     */
    public function removeMatchNode(MatchNode $matchNode)
    {
        return $this->removeChild($matchNode);
    }

    /**
     * Remove the Match by name.
     *
     * @param string $nodename Match name
     *
     * @return null|MatchNode Null if Match doesn't exist
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
     * @return null|MatchNode
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
     * @return null|MatchNode
     */
    public function setMatchNode(string $nodename, MatchNode $matchNode)
    {
        return $this->setChild($nodename, $matchNode);
    }
}
