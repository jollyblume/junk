<?php

namespace App\Document;

use App\Model\EmailInterface;
use App\Store\EmailStoreInterface;

/**
 * EmailBag.
 */
class EmailBag extends AbstractParentNode implements EmailStoreInterface
{
    /**
     * Get the semantic Node Type.
     *
     * The Node Type is used to compute the method name of semantic collection
     * accessor methods.
     *
     * @return string The Bag Type
     */
    public function getSemanticNodeType()
    {
        return 'Email';
    }

    public function addEmailNode(EmailInterface $node)
    {
        $this->addChild($node);

        return $this;
    }

    public function hasEmailNode(EmailInterface $node)
    {
        return $this->hasChild($node);
    }

    public function hasEmailName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    public function removeEmailNode(EmailInterface $node)
    {
        return $this->removeChild($node);
    }

    public function removeEmailName(string $nodename)
    {
        return $this->removeChildKey($nodename);
    }

    public function getEmailNode(string $nodename)
    {
        return $this->getChild($nodename);
    }

    public function setEmailNode(string $nodename, EmailInterface $node)
    {
        $this->setChild($nodename, $node);

        return $this;
    }
}
