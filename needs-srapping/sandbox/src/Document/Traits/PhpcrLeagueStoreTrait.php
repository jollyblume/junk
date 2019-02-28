<?php

namespace App\Document\Traits;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Traits\LeagueStoreTrait;
use App\Collections\SemanticCollectionInterface;
use App\Model\LeagueStoreInterface;
use App\Document\LeagueBag;

trait PhpcrLeagueStoreTrait {
    use LeagueStoreTrait;

    /**
     * @var LeagueStoreInterface
     * @PHPCR\Child
     */
    private $composedLeagueBag;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return LeagueStoreInterface
     */
    private function getLeagueBagFromStore() {
        $bag = $this->composedLeagueBag;
        return $bag;
    }

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @throws MissingInterfaceException
     * @return LeagueStoreInterface
     */
    private function setLeagueBagToStore(LeagueStoreInterface $bag) {
        $this->addChildIfMissing($bag);
        $bag = $this->getChild($bag->getNodename());
        $this->composedLeagueBag = $bag;
        return $this;
    }
}
