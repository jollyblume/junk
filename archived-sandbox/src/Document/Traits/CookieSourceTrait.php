<?php

namespace App\Document\Traits;

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
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function createCookie(CookieStoreInterface $storeNode)
    {
        $cookie = new GenericCookie();
        $cookie->addProperty('storeNode', $storeNode->getId());

        return $cookie;
    }
}
