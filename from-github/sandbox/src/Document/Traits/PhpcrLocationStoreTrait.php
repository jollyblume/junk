<?php

namespace App\Document\Traits;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Traits\LocationStoreTrait;
use App\Collections\SemanticCollectionInterface;
use App\Model\LocationStoreInterface;
use App\Document\LocationBag;

trait PhpcrLocationStoreTrait {
    use LocationStoreTrait;

    /**
     * @var LocationStoreInterface
     * @PHPCR\Child
     */
    private $composedLocationBag;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return LocationStoreInterface
     */
    private function getLocationBagFromStore() {
        $bag = $this->composedLocationBag;
        return $bag;
    }

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @throws MissingInterfaceException
     * @return LocationStoreInterface
     */
    private function setLocationBagToStore(LocationStoreInterface $bag) {
        $this->addChildIfMissing($bag);
        $bag = $this->getChild($bag->getNodename());
        $this->composedLocationBag = $bag;
        return $this;
    }
}
