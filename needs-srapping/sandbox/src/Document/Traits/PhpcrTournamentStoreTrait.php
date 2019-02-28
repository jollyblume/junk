<?php

namespace App\Document\Traits;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Traits\TournamentStoreTrait;
use App\Collections\SemanticCollectionInterface;
use App\Model\TournamentStoreInterface;
use App\Document\TournamentBag;

trait PhpcrTournamentStoreTrait {
    use TournamentStoreTrait;

    /**
     * @var TournamentStoreInterface
     * @PHPCR\Child
     */
    private $composedTournamentBag;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return TournamentStoreInterface
     */
    private function getTournamentBagFromStore() {
        $bag = $this->composedTournamentBag;
        return $bag;
    }

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @return TournamentStoreInterface
     */
    private function setTournamentBagToStore(TournamentStoreInterface $bag) {
        $this->addChildIfMissing($bag);
        $bag = $this->getChild($bag->getNodename());
        $this->composedTournamentBag = $bag;
        return $this;
    }
}
