<?php

namespace App\ReferrerCollection;

use App\ReferenceCollection\CalendarReferencesInterface;
use App\Collections\ComposedCollectionInterface;

interface CalendarReferrersInterface extends ReferrersInterface
{
    /**
     * Get a collection of referrers from CalendarInterface implementations.
     *
     * @return ComposedCollectionInterface
     */
    public function getCalendarReferrers();

    /**
     * Add a referrer from a CalendarReferencesInterface.
     *
     * @param CalendarReferencesInterface
     *
     * @return self
     */
    public function addCalendarReferrer(CalendarReferencesInterface $node);

    /**
     * Remove a referrer from a CalendarReferencesInterface.
     *
     * @param CalendarReferencesInterface
     *
     * @return self
     */
    public function removeCalendarReferrer(CalendarReferencesInterface $node);

    /**
     * Test if a referrer from a CalendarInterface exists.
     *
     * @param CalendarInterface
     *
     * @return bool
     */
    public function hasCalendarReferrer(CalendarInterface $node);
}
