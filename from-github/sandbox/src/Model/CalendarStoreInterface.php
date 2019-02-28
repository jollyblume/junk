<?php

namespace App\Model;
use App\Model\StoreInterface;

interface CalendarStoreInterface extends StoreInterface {
    public function addCalendarNode(CalendarInterface $node);

    public function hasCalendarNode(CalendarInterface $node);

    public function hasCalendarName(string $nodename);

    public function removeCalendarNode(CalendarInterface $node);

    public function removeCalendarName(string $nodename);

    public function getCalendarNode(string $nodename);

    public function setCalendarNode(string $nodename, CalendarInterface $node);
}
