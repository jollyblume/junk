<?php

namespace App\Store\Traits;

use App\Model\CookieInterface;

/** CookieStoreTrait
 *
 * Implements CookieStoreInterface.
 */
trait CookieStoreTrait
{
    /**
     * Add a Cookie Node.
     *
     * @param CookieInterface
     *
     * @return self
     */
    public function addCookieNode(CookieInterface $cookie)
    {
        $this->addChild($cookie);

        return $this;
    }

    /**
     * Test if a Cookie Node exists.
     *
     * @param CookieInterface
     *
     * @return bool
     */
    public function hasCookieNode(CookieInterface $cookie)
    {
        return $this->hasChild($cookie);
    }

    /**
     * Test if a Cookie Nodename exists.
     *
     * @param string
     *
     * @return bool
     */
    public function hasCookieName(string $cookieNodename)
    {
        return $this->hasChildKey($cookieNodename);
    }

    /**
     * Remove a Cookie Node.
     *
     * @param CookieInterface
     *
     * @return null|CookieInterface The removed node or null if not exists
     */
    public function removeCookieNode(CookieInterface $cookie)
    {
        return $this->removeChild($cookie);
    }

    /**
     * Remove a Cookie Nodename.
     *
     * @param string
     *
     * @return null|CookieInterface The removed node or null if not exists
     */
    public function removeCookieName(string $cookieNodename)
    {
        return $this->removeChildKey($cookieNodename);
    }

    /**
     * Get a Cookie Nodename.
     *
     * @param string
     *
     * @return null|CookieInterface The requested node or null if not exists
     */
    public function getCookieNode(string $cookieNodename)
    {
        return $this->getChild($cookieNodename);
    }

    /**
     * Set a Cookie Nodename and Node.
     *
     * @param string
     * @param CookieInterface
     *
     * @return null|CookieInterface The requested node or null if not exists
     */
    public function setCookieNode(?string $cookieNodename, CookieInterface $cookie)
    {
        $this->setChild($cookieNodename, $cookie);

        return $this;
    }
}
