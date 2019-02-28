<?php

namespace App\Document;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Model\TournamentInterface;
use App\Model\TournamentStoreInterface;

/**
 * @PHPCR\Document(childClasses={
 *      "App\Model\TournamentInterface",
 *      "App\Model\TournamentStoreInterface"
 * });
 */
class TournamentBag extends AbstractParentNode implements TournamentStoreInterface {
    /**
     * Get the semantic Node Type.
     *
     * The Node Type is used to compute the method name of semantic collection
     * accessor methods.
     *
     * @return string The Bag Type
     */
    public function getSemanticNodeType() {
        return 'Tournament';
    }

    public function addTournamentNode(TournamentInterface $node) {
        $this->addChild($node);
        return $this;
    }

    public function hasTournamentNode(TournamentInterface $node) {
        return $this->hasChild($node);
    }

    public function hasTournamentName(string $nodename) {
        return $this->hasChildKey($nodename);
    }

    public function removeTournamentNode(TournamentInterface $node) {
        return $this->removeChild($node);
    }

    public function removeTournamentName(string $nodename) {
        return $this->removeChildKey($nodename);
    }

    public function getTournamentNode(string $nodename) {
        return $this->getChild($nodename);
    }

    public function setTournamentNode(string $nodename, TournamentInterface $node) {
        $this->setChild($nodename, $node);
        return $this;
    }
}
