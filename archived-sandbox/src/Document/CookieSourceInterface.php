<?php

namespace App\Document;

use App\Exception\MissingInterfaceException;

/**
 * CookieSourceInterface.
 *
 * Defines behaviour for a Source Node to store a Cookie containing data used
 * by the Source Node uses, but is actually data regarding a Store Node.
 *
 * The Source Node's Cookie becomes a child of the Store Node. The Cookie's
 * nodename will be the Source Node's Uuid.
 *
 * This allows Store Nodes to maintain a Source Node's detail records.
 *
 * Cookies are data owned by the Store Node, but used by the Source Node.
 *
 * Cookies are manipulated by the Source Node.
 */
interface CookieSourceInterface extends PhpcrReferencableInterface
{
    /**
     * Create a Cookie Node.
     *
     * Called by CookieStoreInterface::registerCookie() to generate the Cookie
     * Node. The Cookie Node can be any Phpcr Document devised by a Source Node.
     *
     * A Source Node can store a single Cookie Node on any given Store Node, but
     * it can store a different Cookie Node class on each different Store Node.
     *
     * This should allow system's using a Source Node to handle complex data
     * storage requirements.
     *
     * A Source Node can return null to indicate it has no Cookie Node to store.
     *
     * @param CookieStoreInterface $storeNode Store Node
     *
     * @throws MissingInterfaceException Cookie Node must implement CookieInterface
     *
     * @return null|PhpcrNodeInterface
     */
    public function createCookie(CookieStoreInterface $storeNode);
}
