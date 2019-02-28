<?php

namespace App\Document\Traits;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Traits\NodeTrait;
use App\Model\ParentNodeInterface;

trait PhpcrNodeTrait
{
    use NodeTrait;

    /**
     * Phpcr Nodename field.
     *
     * @var string
     * @PHPCR\Nodename()
     */
    private $nodename;

    /**
     * Phpcr Id field.
     *
     * @var string
     * @PHPCR\Id()
     */
    private $identifier;

    /**
     * Phpcr Parent Node field.
     *
     * @var ParentNodeInterface
     * @PHPCR\ParentDocument()
     */
    private $parent;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return string
     */
    private function getNodenameFromStore()
    {
        return $this->nodename;
    }

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @param string
     *
     * @return self
     */
    private function setNodenameToStore(string $nodename)
    {
        $this->nodename = $nodename;

        return $this;
    }

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return ParentNodeInterface
     */
    private function getParentFromStore()
    {
        return $this->parent;
    }

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @param ParentNodeInterface
     *
     * @return self
     */
    private function setParentToStore(?ParentNodeInterface $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return string
     */
    private function getIdentifierFromStore()
    {
        return $this->identifier;
    }

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @param string
     *
     * @return self
     */
    private function setIdentifierToStore(string $identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }
}
