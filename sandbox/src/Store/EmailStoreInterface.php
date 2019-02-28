<?php

namespace App\Store;

use App\Model\EmailInterface;

/**
 * EmailStoreInterface.
 *
 * Defines a StoreInterface for a EmailInterface Collection that can be
 * embedded into a ParentNodeInterface.
 */
interface EmailStoreInterface extends StoreInterface
{
    /**
     * Add a Email Node.
     *
     * @param EmailInterface
     *
     * @return self
     */
    public function addEmailNode(EmailInterface $node);

    /**
     * Test if there is a Email Node.
     *
     * @param EmailInterface
     *
     * @return bool
     */
    public function hasEmailNode(EmailInterface $node);

    /**
     * Test if there is a Email Nodename.
     *
     * @param string
     *
     * @return bool
     */
    public function hasEmailName(string $node);

    /**
     * Add a Email Node.
     *
     * @param EmailInterface
     *
     * @return self
     */
    public function removeEmailNode(EmailInterface $node);

    /**
     * Remove a Email Nodename.
     *
     * @param string
     *
     * @return null|EmailInterface Removed node or null if not found
     */
    public function removeEmailName(string $nodename);

    /**
     * Get a Email Nodename.
     *
     * @param string
     *
     * @return null|EmailInterface Requested node or null if not found
     */
    public function getEmailNode(string $nodename);

    /**
     * Set a Email Nodename and Node.
     *
     * @param string
     * @param EmailInterface
     *
     * @return self
     */
    public function setEmailNode(string $nodename, EmailInterface $node);
}
