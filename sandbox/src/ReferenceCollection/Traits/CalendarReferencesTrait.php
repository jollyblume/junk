<?php

namespace App\ReferenceCollection\Traits;

use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Collections\ReadOnlyCollectionWrapper;
use App\ReferrerCollection\CalendarReferrersInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait CalendarReferencesTrait
{
    /**
     * @var Collection
     */
    private $calendarReferences;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return Collection
     */
    private function getCalendarReferencesFromStore()
    {
        $calendarReferences = $this->calendarReferences;
        if (null === $calendarReferences) {
            $calendarReferences = new ArrayCollection();
            $this->calendarReferences = $calendarReferences;
        }

        return $calendarReferences;
    }

    /**
     * Get the CalendarReferrersInterface collection.
     *
     * @return ReadOnlyCollectionWrapper
     */
    public function getCalendarReferences()
    {
        $calendarReferences = $this->getCalendarReferencesFromStore();

        return new ReadOnlyCollectionWrapper($calendarReferences);
    }

    private function assertCalendarReferenceNotExists(CalendarReferrersInterface $reference) {
        if ($this->hasCalendarReference($reference)) {
            $context = new ExceptionContext(
                'exception.nodeexists',
                'Reference exists'
            );
            throw new NodeExistsException($context);
        }
    }

    private function setRemoteCalendarReferrer(CalendarReferrersInterface $reference) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReferrer', $localNodeType);

        if (!$reference->$remoteHasMethod($this)) {
            $remoteAddMethod = sprintf('add%sReferrer', $localNodeType);
            $reference->$remoteAddMethod($this);
        }
    }

    /**
     * Add a reference to a CalendarReferrersInterface.
     *
     * @param CalendarReferrersInterface
     *
     * @throws NodeExistsException
     * @return self
     */
    public function addCalendarReference(CalendarReferrersInterface $reference)
    {
        $this->assertCalendarReferenceNotExists($reference);

        $references = $this->getCalendarReferencesFromStore();
        $references->add($reference);

        $this->setRemoteCalendarReferrer($reference);

        return $this;
    }

    private function unsetRemoteCalendarReferrer(CalendarReferrersInterface $reference) {
        $localNodeType = $this->getSemanticNodeType();
        $remoteHasMethod = sprintf('has%sReferrer', $localNodeType);

        if ($reference->$remoteHasMethod($this)) {
            $remoteRemoveMethod = sprintf('remove%sReferrer', $localNodeType);
            $reference->$remoteRemoveMethod($this);
        }
    }

    /**
     * Remove a reference to a CalendarReferrersInterface.
     *
     * @param CalendarReferrersInterface
     *
     * @return self
     */
    public function removeCalendarReference(CalendarReferrersInterface $reference)
    {
        if ($this->hasCalendarReference($reference)) {
            $references = $this->getCalendarReferencesFromStore();
            $references->remove($reference);
        }

        $this->unsetRemoteCalendarReferrer($reference);

        return $this;
    }

    /**
     * Test if a reference to a CalendarReferrersInterface exists.
     *
     * @param CalendarReferrersInterface
     *
     * @return bool
     */
    public function hasCalendarReference(CalendarReferrersInterface $reference)
    {
        $references = $this->getCalendarReferencesFromStore();

        return $references->contains($reference);
    }
}
