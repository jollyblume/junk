<?php

namespace App\Document;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Model\TeamInterface;
use App\Model\TeamStoreInterface;

/**
 * @PHPCR\Document(childClasses={
 *      "App\Model\TeamInterface",
 *      "App\Model\TeamStoreInterface"
 * });
 */
class TeamBag extends AbstractParentNode implements TeamStoreInterface {
    /**
     * Get the semantic Node Type.
     *
     * The Node Type is used to compute the method name of semantic collection
     * accessor methods.
     *
     * @return string The Bag Type
     */
    public function getSemanticNodeType() {
        return 'Team';
    }

    public function addTeamNode(TeamInterface $node) {
        $this->addChild($node);
        return $this;
    }

    public function hasTeamNode(TeamInterface $node) {
        return $this->hasChild($node);
    }

    public function hasTeamName(string $nodename) {
        return $this->hasChildKey($nodename);
    }

    public function removeTeamNode(TeamInterface $node) {
        return $this->removeChild($node);
    }

    public function removeTeamName(string $nodename) {
        return $this->removeChildKey($nodename);
    }

    public function getTeamNode(string $nodename) {
        return $this->getChild($nodename);
    }

    public function setTeamNode(string $nodename, TeamInterface $node) {
        $this->setChild($nodename, $node);
        return $this;
    }
}
