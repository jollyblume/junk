<?php

namespace App\Traits;
use App\Model\CalendarInterface;
use App\Model\CalendarStoreInterface;
use App\Document\CalendarBag;

trait CalendarStoreTrait {
    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return CalendarStoreInterface
     */
    abstract protected function getCalendarBagFromStore();

    abstract protected function setCalendarBagToStore(CalendarStoreInterface $bag);

    private function getOrCreateCalendarBag() {
        $bag = $this->getCalendarBagFromStore();
        if (null === $bag) {
            $newBag = new CalendarBag();
            $newBag->setNodename($newBag->getSemanticNodeType());
            $this->setCalendarNodes($newBag);
            $bag = $this->getCalendarBagFromStore();
        }
        return $bag;
    }

    public function getCalendarNodes() {
        return $this->getOrCreateCalendarBag();
    }

    public function setCalendarNodes(CalendarStoreInterface $bag) {
        $this->setCalendarBagToStore($bag);
        return $this;
    }

    public function addCalendarNode(CalendarInterface $node) {
        $bag = $this->getOrCreateCalendarBag();
        return $bag->addCalendarNode($node);
    }

    public function hasCalendarNode(CalendarInterface $node) {
        $bag = $this->getOrCreateCalendarBag();
        return $bag->hasCalendarNode($node);
    }

    public function hasCalendarName(string $nodename) {
        $bag = $this->getOrCreateCalendarBag();
        return $bag->hasCalendarName($nodename);
    }

    public function removeCalendarNode(CalendarInterface $node) {
        $bag = $this->getOrCreateCalendarBag();
        return $bag->removeCalendarNode($node);
    }

    public function removeCalendarName(string $nodename) {
        $bag = $this->getOrCreateCalendarBag();
        return $bag->removeCalendarName($nodename);
    }

    public function getCalendarNode(string $nodename) {
        $bag = $this->getOrCreateCalendarBag();
        return $bag->getCalendarNode($nodename);
    }

    public function setCalendarNode(string $nodename, CalendarInterface $node) {
        $bag = $this->getOrCreateCalendarBag();
        return $bag->setCalendarNode($nodename, $node);
    }
}
