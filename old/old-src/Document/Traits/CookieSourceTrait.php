<?php

namespace OldApp\Document\Traits;

use App\Document\CookieStoreInterface;
use App\Document\GenericCookie;
use App\Document\CookieInterface;

/**
 * CookieSourceTrait.
 *
 * Implements CookieSourceInterface
 */
trait CookieSourceTrait
{
    /**
     * Create a Cookie Node.
     *
     * Called by CookieStoreInterface::registerCookie()
     *
     * @param CookieStoreInterface $storeNode Store Node
     *
     * @return null|CookieInterface Null if no Cookie Node class exists
     */
    public function createCookie(CookieStoreInterface $storeNode)
    {
        $cookie = new GenericCookie();
        $cookieNodename = $this->getCookieNodename($storeNode);
        $cookie->setNodename($cookieNodename);

        return $cookie;
    }

    /**
     * Get the nodename for a cookie on storenode
     *
     * @param CookieStoreInterface
     * @return string
     */
    public function getCookieNodename(CookieStoreInterface $storeNode) {
        $cookieNodename = sprintf('%s_%s', $this->getNodename(), $storeNode->getNodename());
        return $cookieNodename;
    }
}
