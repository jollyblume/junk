<?php

namespace OldApp\Document\Traits;

use App\Document\CookieInterface;
use App\Document\CookieSourceInterface;
use App\Document\CookieStoreInterface;
use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Exception\MissingInterfaceException;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CookieStoreTrait.
 *
 * Implements CookieStoreInterface
 */
trait CookieStoreTrait
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
    public function registerCookie(CookieSourceInterface $sourceNode)
    {
        if ($this->hasCookie($sourceNode)) {
            $context = new ExceptionContext(
                'exception.nodeexists',
                'Cookie Node exists'
            );

            throw new NodeExistsException($context);
        }

        // Get the Cookie Node from the sourceNode
        $cookieNode = $sourceNode->createCookie($this);
        // Silenty exit if no cookieNode returned (nothing to persist)
        if (null === $cookieNode) {
            return $this;
        }
        if (empty($cookieNode->getNodename())) {
            $cookieNodename = $sourceNode->getCookieNodename($this);
            $cookieNode->setNodename($cookieNodename);
        }
        // Assert cookieNode implements CookieInterface
        if (!$cookieNode instanceof CookieInterface) {
            $context = new ExceptionContext(
                'exception.missinginterface',
                'Cookie node must implement CookieNodeInterface'
            );

            throw new MissingInterfaceException($context);
        }

        $this->addChild($cookieNode);

        return $this;
    }

    /**
     * Check if a Cookie Node from Source Node is registered.
     *
     * @param CookieSourceInterface $source Source Node
     *
     * @return bool True if Store has a Cookie Node for Source Node
     */
    public function hasCookie(CookieSourceInterface $sourceNode)
    {
        $cookieNodename = $sourceNode->getCookieNodename($this);

        return $this->hasChildKey($cookieNodename);
    }

    /**
     * Get a Cookie Node for a Source Node.
     *
     * @param CookieSourceInterface $source Source Node
     *
     * @return null|CookieInterface Null if Cookie Node for Source Node not registered
     */
    public function getCookie(CookieSourceInterface $sourceNode)
    {
        $cookieNodename = $sourceNode->getCookieNodename($this);

        return $this->getChild($cookieNodename);
    }
}
