<?php

namespace App\Document;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Model\MatchInterface;
use App\Model\MatchStoreInterface;

/**
 * @PHPCR\Document(childClasses={
 *      "App\Model\MatchInterface",
 *      "App\Model\MatchStoreInterface"
 * });
 */
class MatchBag extends AbstractParentNode implements MatchStoreInterface {
    /**
     * Get the semantic Node Type.
     *
     * The Node Type is used to compute the method name of semantic collection
     * accessor methods.
     *
     * @return string The Bag Type
     */
    public function getSemanticNodeType() {
        return 'Match';
    }

    public function addMatchNode(MatchInterface $node) {
        $this->addChild($node);
        return $this;
    }

    public function hasMatchNode(MatchInterface $node) {
        return $this->hasChild($node);
    }

    public function hasMatchName(string $nodename) {
        return $this->hasChildKey($nodename);
    }

    public function removeMatchNode(MatchInterface $node) {
        return $this->removeChild($node);
    }

    public function removeMatchName(string $nodename) {
        return $this->removeChildKey($nodename);
    }

    public function getMatchNode(string $nodename) {
        return $this->getChild($nodename);
    }

    public function setMatchNode(string $nodename, MatchInterface $node) {
        $this->setChild($nodename, $node);
        return $this;
    }
}
