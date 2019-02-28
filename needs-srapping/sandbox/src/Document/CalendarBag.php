<?php

namespace App\Document;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Model\CalendarInterface;
use App\Model\CalendarStoreInterface;

/**
 * @PHPCR\Document(childClasses={
 *      "App\Model\CalendarInterface",
 *      "App\Model\CalendarStoreInterface"
 * });
 */
class CalendarBag extends AbstractParentNode implements CalendarStoreInterface {
    /**
     * Get the semantic Node Type.
     *
     * The Node Type is used to compute the method name of semantic collection
     * accessor methods.
     *
     * @return string The Bag Type
     */
    public function getSemanticNodeType() {
        return 'Calendar';
    }

    public function addCalendarNode(CalendarInterface $node) {
        $this->addChild($node);
        return $this;
    }

    public function hasCalendarNode(CalendarInterface $node) {
        return $this->hasChild($node);
    }

    public function hasCalendarName(string $nodename) {
        return $this->hasChildKey($nodename);
    }

    public function removeCalendarNode(CalendarInterface $node) {
        return $this->removeChild($node);
    }

    public function removeCalendarName(string $nodename) {
        return $this->removeChildKey($nodename);
    }

    public function getCalendarNode(string $nodename) {
        return $this->getChild($nodename);
    }

    public function setCalendarNode(string $nodename, CalendarInterface $node) {
        $this->setChild($nodename, $node);
        return $this;
    }
}
