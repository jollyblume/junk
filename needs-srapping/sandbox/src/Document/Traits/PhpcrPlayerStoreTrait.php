<?php

namespace App\Document\Traits;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Traits\PlayerStoreTrait;
use App\Collections\SemanticCollectionInterface;
use App\Model\PlayerStoreInterface;
use App\Document\PlayerBag;

trait PhpcrPlayerStoreTrait {
    use PlayerStoreTrait;

    /**
     * @var PlayerStoreInterface
     * @PHPCR\Child
     */
    private $composedPlayerBag;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return PlayerStoreInterface
     */
    private function getPlayerBagFromStore() {
        $bag = $this->composedPlayerBag;
        return $bag;
    }

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @throws MissingInterfaceException
     * @return PlayerStoreInterface
     */
    private function setPlayerBagToStore(PlayerStoreInterface $bag) {
        $this->addChildIfMissing($bag);
        $bag = $this->getChild($bag->getNodename());
        $this->composedPlayerBag = $bag;
        return $this;
    }
}
