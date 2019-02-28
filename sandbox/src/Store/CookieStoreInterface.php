<?php

namespace App\Store;

use App\Model\CookieInterface;
use App\Model\ParentNodeInterface;
use App\Model\ReferenceableNodeInterface;

/**
 * CookieStoreInterface.
 *
 * Defines methods external systems can use to extend a NodeInterface by adding
 * CookieInterfaces to the ParentNodeInterface. CookieInterface implementations
 * are stored as children of the ParentNodeInterface.
 *
 * For instance, a the security system can create a Cookie to add data to support
 * authentication to a PlayerInterface. Since the data belongs to the
 * PlayerInterface, this is the proper place for the data. The PlayerInterface
 * doesn't know anything about it's Cookies. Only the security system
 * understands and manipulates this data.
 */
interface CookieStoreInterface extends ParentNodeInterface, ReferenceableNodeInterface
{
    /**
     * Add a Cookie Node.
     *
     * @param CookieInterface
     *
     * @return self
     */
    public function addCookieNode(CookieInterface $cookie);

    /**
     * Test if there is a Cookie Node.
     *
     * @param CookieInterface
     *
     * @return bool
     */
    public function hasCookieNode(CookieInterface $cookie);

    /**
     * Test if there is a Cookie Nodename.
     *
     * @param string
     *
     * @return bool
     */
    public function hasCookieName(string $cookieNodename);

    /**
     * Add a Cookie Node.
     *
     * @param CookieInterface
     *
     * @return self
     */
    public function removeCookieNode(CookieInterface $cookie);

    /**
     * Remove a Cookie Nodename.
     *
     * @param string
     *
     * @return null|CookieInterface Removed node or null if not found
     */
    public function removeCookieName(string $cookieNodename);

    /**
     * Get a Cookie Nodename.
     *
     * @param string
     *
     * @return null|CookieInterface Requested node or null if not found
     */
    public function getCookieNode(string $cookieNodename);

    /**
     * Set a Cookie Nodename and Node.
     *
     * @param string
     * @param CookieInterface
     *
     * @return self
     */
    public function setCookieNode(string $cookieNodename, CookieInterface $cookie);
}
