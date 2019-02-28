<?php

namespace App\Document\Traits;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Traits\CalendarStoreTrait;
use App\Collections\SemanticCollectionInterface;
use App\Model\CalendarStoreInterface;
use App\Document\CalendarBag;

trait PhpcrCalendarStoreTrait {
    use CalendarStoreTrait;

    /**
     * @var CalendarStoreInterface
     * @PHPCR\Child
     */
    private $composedCalendarBag;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return CalendarStoreInterface
     */
    private function getCalendarBagFromStore() {
        $bag = $this->composedCalendarBag;
        return $bag;
    }

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @return CalendarStoreInterface
     */
    private function setCalendarBagToStore(CalendarStoreInterface $bag) {
        $this->addChildIfMissing($bag);
        $bag = $this->getChild($bag->getNodename());
        $this->composedCalendarBag = $bag;

        return $this;
    }
}
