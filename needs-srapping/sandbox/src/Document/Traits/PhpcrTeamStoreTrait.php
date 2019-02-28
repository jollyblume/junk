<?php

namespace App\Document\Traits;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Traits\TeamStoreTrait;
use App\Collections\SemanticCollectionInterface;
use App\Model\TeamStoreInterface;
use App\Document\TeamBag;

trait PhpcrTeamStoreTrait {
    use TeamStoreTrait;

    /**
     * @var TeamStoreInterface
     * @PHPCR\Child
     */
    private $composedTeamBag;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return TeamStoreInterface
     */
    private function getTeamBagFromStore() {
        $bag = $this->composedTeamBag;
        return $bag;
    }

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @return TeamStoreInterface
     */
    private function setTeamBagToStore(TeamStoreInterface $bag) {
        $this->addChildIfMissing($bag);
        $bag = $this->getChild($bag->getNodename());
        $this->composedTeamBag = $bag;
        return $this;
    }
}
