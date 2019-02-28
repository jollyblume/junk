<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Document\Traits\TrashTrait;
use App\Document\AllowedByEmailBag;

/**
 * EmailTrash.
 *
 * Implements TreeInterface, allowing the trash can to be added to the Root Node
 *
 *
 *
 * @PHPCR\Document()
 */
class EmailTrash extends EmailBag implements TreeInterface, AllowedByEmailBag
{
    use TrashTrait;

    /**
     * Get the Bags Node Type.
     *
     * @return string
     */
    public function getNodeType()
    {
        return 'EmailTrash';
    }

    /**
     * Add a Email Node.
     *
     * @param EmailNode $tournament
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    public function addEmailTrashNode(EmailNode $tournamentNode)
    {
        return $this->addChild($tournamentNode);
    }

    /**
     * Check if Email exists.
     *
     * @param EmailNode $tournamentNode
     *
     * @return bool
     */
    public function hasEmailTrashNode(EmailNode $tournamentNode)
    {
        return $this->hasChild($tournamentNode);
    }

    /**
     * Check if Email Name exists.
     *
     * @param EmailNode $nodename
     *
     * @return bool
     */
    public function hasEmailTrashName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    /**
     * Remove Email.
     *
     * @param EmailNode $tournamentNode Email to remove
     *
     * @return null|EmailNode Null if Email doesn't exist
     *                        Otherwise, removed Email Node
     */
    public function removeEmailTrashNode(EmailNode $tournamentNode)
    {
        return $this->removeChild($tournamentNode);
    }

    /**
     * Remove the Email by name.
     *
     * @param string $nodename Email name
     *
     * @return null|EmailNode Null if Email doesn't exist
     *                        Otherwise, removed Email Node
     */
    public function removeEmailTrashName(string $nodename)
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
    public function getEmailTrashNode(string $nodename)
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
    public function setEmailTrashNode(string $nodename, EmailNode $tournamentNode)
    {
        return $this->setChild($nodename, $tournamentNode);
    }
}
