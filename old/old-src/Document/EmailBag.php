<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Exception\NodeExistsException;

/**
 * Email Bag.
 *
 * Implements the final accessors AbstractBag delegates:
 *   - addEmailNode()
 *   - hasEmailNode()
 *   - hasEmailName()
 *   - removeEmailNode()
 *   - removeEmailName()
 *   - getEmailNode()
 *
 * @PHPCR\Document(childClasses={"App\Document\AllowedByEmailBag"})
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class EmailBag extends AbstractBag
{
    public function getNodeType()
    {
        return 'Email';
    }

    public function supports($node)
    {
        return $node instanceof AllowedByEmailBag;
    }

    /**
     * Add a Email Node.
     *
     * @param AllowedByEmailBag $email
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addEmailNode(AllowedByEmailBag $emailNode)
    {
        return $this->addChild($emailNode);
    }

    /**
     * Check if Email exists.
     *
     * @param AllowedByEmailBag $emailNode
     *
     * @return bool
     */
    public function hasEmailNode(AllowedByEmailBag $emailNode)
    {
        return $this->hasChild($emailNode);
    }

    /**
     * Check if Email Name exists.
     *
     * @param AllowedByEmailBag $nodename
     *
     * @return bool
     */
    public function hasEmailName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    /**
     * Remove Email.
     *
     * @param AllowedByEmailBag $emailNode Email to remove
     *
     * @return null|AllowedByEmailBag Null if Email doesn't exist
     *                        Otherwise, removed Email Node
     */
    public function removeEmailNode(AllowedByEmailBag $emailNode)
    {
        return $this->removeChild($emailNode);
    }

    /**
     * Remove the Email by name.
     *
     * @param string $nodename Email name
     *
     * @return null|AllowedByEmailBag Null if Email doesn't exist
     *                        Otherwise, removed Email Node
     */
    public function removeEmailName(string $nodename)
    {
        return $this->removeChildKey($nodename);
    }

    /**
     * Get a Email Node.
     *
     * @param string $nodename Email Nodename to find
     *
     * @return null|AllowedByEmailBag
     */
    public function getEmailNode(string $nodename)
    {
        return $this->getChild($nodename);
    }

    /**
     * Set a Email Node.
     *
     * @param string $nodename Email Nodename to find
     *
     * @return null|AllowedByEmailBag
     */
    public function setEmailNode(string $nodename, AllowedByEmailBag $emailNode)
    {
        return $this->setChild($nodename, $emailNode);
    }
}
