<?php

namespace App\Store\Traits;

use App\Model\EmailInterface;
use App\Store\EmailStoreInterface;
use App\Document\EmailBag;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * EmailStoreTrait.
 *
 * Implements EmailStoreInterface
 */
trait EmailStoreTrait
{
    /**
     * @var EmailStoreInterface
     */
    private $emailBag;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return EmailStoreInterface
     */
    private function getEmailBagFromStore()
    {
        $bag = $this->emailBag;

        return $bag;
    }

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @param EmailStoreInterface
     *
     * @return self
     */
    private function setEmailBagToStore(EmailStoreInterface $bag)
    {
        $bag = $this->addChildIfMissing($bag);
        $this->emailBag = $bag;

        return $this;
    }

    /**
     * Get (or create, if needed) a EmailBag.
     *
     * @return EmailBag
     */
    private function getOrCreateEmailBag()
    {
        $bag = $this->getEmailBagFromStore();
        if (null === $bag) {
            $newBag = new EmailBag();
            $nodename = strtolower($newBag->getSemanticNodeType());
            $newBag->setNodename($nodename);
            $this->setEmailNodes($newBag);
            $bag = $this->getEmailBagFromStore();
        }

        return $bag;
    }

    /**
     * Get all Email Nodes.
     *
     * @return ArrayCollection
     */
    public function getEmailNodes()
    {
        return $this->getOrCreateEmailBag();
    }

    /**
     * Set all Email Nodes.
     *
     * @param EmailStoreInterface
     *
     * @return self
     */
    public function setEmailNodes(EmailStoreInterface $bag)
    {
        $this->setEmailBagToStore($bag);

        return $this;
    }

    /**
     * Add a Email Node.
     *
     * @param EmailInterface
     *
     * @return self
     */
    public function addEmailNode(EmailInterface $node)
    {
        $bag = $this->getOrCreateEmailBag();

        return $bag->addEmailNode($node);
    }

    /**
     * Test if a Email Node exists.
     *
     * @param EmailInterface
     *
     * @return bool
     */
    public function hasEmailNode(EmailInterface $node)
    {
        $bag = $this->getOrCreateEmailBag();

        return $bag->hasEmailNode($node);
    }

    /**
     * Test if a Email Nodename exists.
     *
     * @param string
     *
     * @return bool
     */
    public function hasEmailName(string $nodename)
    {
        $bag = $this->getOrCreateEmailBag();

        return $bag->hasEmailName($nodename);
    }

    /**
     * Remove a Email Node.
     *
     * @param EmailInterface
     *
     * @return null|EmailInterface The removed node or null if not exists
     */
    public function removeEmailNode(EmailInterface $node)
    {
        $bag = $this->getOrCreateEmailBag();

        return $bag->removeEmailNode($node);
    }

    /**
     * Remove a Email Nodename.
     *
     * @param string
     *
     * @return null|EmailInterface The removed node or null if not exists
     */
    public function removeEmailName(string $nodename)
    {
        $bag = $this->getOrCreateEmailBag();

        return $bag->removeEmailName($nodename);
    }

    /**
     * Get a Email Nodename.
     *
     * @param string
     *
     * @return null|EmailInterface The requested node or null if not exists
     */
    public function getEmailNode(string $nodename)
    {
        $bag = $this->getOrCreateEmailBag();

        return $bag->getEmailNode($nodename);
    }

    /**
     * Set a Email Nodename and Node.
     *
     * @param string
     * @param EmailInterface
     *
     * @return null|EmailInterface The requested node or null if not exists
     */
    public function setEmailNode(string $nodename, EmailInterface $node)
    {
        $bag = $this->getOrCreateEmailBag();

        return $bag->setEmailNode($nodename, $node);
    }
}
