<?php

namespace App\Document;

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
 * @PHPCR\Document(childClasses={"App\Document\EmailNode"})
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
        return $node instanceof EmailNode;
    }

    /**
     * Add a Email Node.
     *
     * @param EmailNode $email
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addEmailNode(EmailNode $emailNode)
    {
        return $this->addChild($emailNode);
    }

    /**
     * Check if Email exists.
     *
     * @param EmailNode $emailNode
     *
     * @return bool
     */
    public function hasEmailNode(EmailNode $emailNode)
    {
        return $this->hasChild($emailNode);
    }

    /**
     * Check if Email Name exists.
     *
     * @param EmailNode $nodename
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
     * @param EmailNode $emailNode Email to remove
     *
     * @return null|EmailNode Null if Email doesn't exist
     *                        Otherwise, removed Email Node
     */
    public function removeEmailNode(EmailNode $emailNode)
    {
        return $this->removeChild($emailNode);
    }

    /**
     * Remove the Email by name.
     *
     * @param string $nodename Email name
     *
     * @return null|EmailNode Null if Email doesn't exist
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
     * @return null|EmailNode
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
     * @return null|EmailNode
     */
    public function setEmailNode(string $nodename, EmailNode $emailNode)
    {
        return $this->setChild($nodename, $emailNode);
    }
}
