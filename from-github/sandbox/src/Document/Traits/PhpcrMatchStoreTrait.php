<?php

namespace App\Document\Traits;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Traits\MatchStoreTrait;
use App\Collections\SemanticCollectionInterface;
use App\Model\MatchStoreInterface;
use App\Document\MatchBag;

trait PhpcrMatchStoreTrait {
    use MatchStoreTrait;

    /**
     * @var MatchStoreInterface
     * @PHPCR\Child
     */
    private $composedMatchBag;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return MatchStoreInterface
     */
    private function getMatchBagFromStore() {
        $bag = $this->composedMatchBag;
        return $bag;
    }

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @throws MissingInterfaceException
     * @return MatchStoreInterface
     */
    private function setMatchBagToStore(MatchStoreInterface $bag) {
        $this->addChildIfMissing($bag);
        $bag = $this->getChild($bag->getNodename());
        $this->composedMatchBag = $bag;
        return $this;
    }
}
