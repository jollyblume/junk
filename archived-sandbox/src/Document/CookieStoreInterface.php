<?php

namespace App\Document;

use App\Exception\NodeExistsException;
use App\Exception\MissingInterfaceException;

/**
 * CookieStoreInterface.
 *
 * Defines behaviour for a Store Node to accept a Cookie Node from a
 * Source Node.
 *
 * The Cookie Node contains data used by its Source Node related to the
 * Store Node that owns it.
 *
 * Cookie Nodes are stored as children of the Store Node, but their data
 * is only manitpulated (or understood) by the Source Nodes.
 *
 * Accepting and storing the Cookie Node is controlled by the Store Node
 */
interface CookieStoreInterface extends PhpcrChildrenInterface
{
    /**
     * Register a new Cookie Node.
     *
     * Calls a CookieSourceInterface to create the Cookie Node, which it
     * will store as a child Node.
     *
     * The Cookie Source can return null, indicating it has no Cookie Node to
     * store.
     *
     * @param CookieSourceInterface $source Source Node
     *
     * @throws MissingInterfaceException
     * @throws NodeExistsException
     *
     * @return self
     */
    public function registerCookie(CookieSourceInterface $sourceNode);

    /**
     * Check if a Cookie Node from Source Node is registered.
     *
     * @param CookieSourceInterface $source Source Node
     *
     * @return bool True if Store has a Cookie Node for Source Node
     */
    public function hasCookie(CookieSourceInterface $sourceNode);

    /**
     * Get a Cookie Node for a Source Node.
     *
     * @return null|CookieInterface Null if Cookie Node for Source Node not registered
     */
    public function getCookie(CookieSourceInterface $sourceNode);
}
