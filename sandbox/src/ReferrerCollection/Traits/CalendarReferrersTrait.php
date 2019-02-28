<?php

namespace App\ReferrerCollection\Traits;

use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Collections\ReadOnlyCollectionWrapper;
use App\ReferrerCollection\CalendarReferencesInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait CalendarReferrersTrait
{
    /**
     * @var Collection
     */
    private $calendarReferrers;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return string
     */
    private function getCalendarReferrersFromStore()
    {
        $calendarReferrers = $this->calendarReferrers;
        if (null === $calendarReferrers) {
            $calendarReferrers = new ArrayCollection();
            $this->calendarReferrers = $calendarReferrers;
        }

        return $calendarReferrers;
    }

    /**
     * Get the CalendarReferencesInterface collection.
     *
     * @return ReadOnlyCollectionWrapper
     */
    public function getCalendarReferrers()
    {
        $calendarReferrers = $this->getCalendarReferrersFromStore();

        return new ReadOnlyCollectionWrapper($calendarReferrers);
    }

    private function assertCalendarReferrerNotExists(CalendarReferencesInterface $referrer) {
        if ($this->hasCalendarReference($referrer)) {
            $context = new ExceptionContext(
                'exception.nodeexists',
                'Reference exists'
            );
            throw new NodeExistsException($context);
        }
    }

    private function setRemoteCalendarReference(CalendarReferencesInterface $referrer) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReference', $localNodeType);

        if (!$referrer->$remoteHasMethod($this)) {
            $remoteAddMethod = sprintf('add%sReference', $localNodeType);
            $referrer->$remoteAddMethod($this);
        }
    }

    /**
     * Add a referrer from a CalendarReferencesInterface.
     *
     * @param CalendarReferencesInterface
     *
     * @throws CalendarReferencesInterface
     *
     * @return self
     */
    public function addCalendarReferrer(CalendarReferencesInterface $referrer)
    {
        $this->assertCalendarReferrerNotExists($referrer);

        $calendarReferrers = $this->getCalendarReferrersFromStore();
        $calendarReferrers->add($referrer);

        $this->setRemoteCalendarReference($referrer);

        return $this;
    }

    private function unsetRemoteCalendarReference(CalendarReferencesInterface $referrer) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReference', $localNodeType);

        if ($referrer->$remoteHasMethod($this)) {
            $remoteRemoveMethod = sprintf('remove%sReference', $localNodeType);
            $referrer->$remoteRemoveMethod($this);
        }
    }

    /**
     * Remove a referrer from a CalendarReferencesInterface.
     *
     * @param CalendarReferencesInterface
     *
     * @return self
     */
    public function removeCalendarReferrer(CalendarReferencesInterface $referrer)
    {
        if ($this->hasCalendarReferrer($referrer)) {
            $calendarReferrers = $this->getCalendarReferrersFromStore();
            $calendarReferrers->remove($referrer);

            return $referrer;
        }

        $this->setRemoteCalendarReference($referrer);

        return $this;
    }

    /**
     * Test if a referrer from a CalendarReferencesInterface exists.
     *
     * @param CalendarReferencesInterface
     *
     * @return bool
     */
    public function hasCalendarReferrer(CalendarReferencesInterface $referrer)
    {
        $calendarReferrers = $this->getCalendarReferrersFromStore();

        return $calendarReferrers->contains($referrer);
    }
}
