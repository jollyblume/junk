<?php

namespace App\ReferenceCollection;

use App\ReferrerCollection\CalendarReferrersInterface;
use App\Collections\ComposedCollectionInterface;

interface CalendarReferencesInterface extends ReferencesInterface
{
    /**
     * Get the CalendarReferrersInterface collection.
     *
     * @return ComposedCollectionInterface
     */
    public function getCalendarReferences();

    /**
     * Add a reference.
     *
     * @param CalendarReferrersInterface
     *
     * @return self
     */
    public function addCalendarReference(CalendarReferrersInterface $node);

    /**
     * Remove a reference.
     *
     * @param CalendarReferrersInterface
     *
     * @return self
     */
    public function removeCalendarReference(CalendarReferrersInterface $node);

    /**
     * Test if a reference exists.
     *
     * @param CalendarReferrersInterface
     *
     * @return bool
     */
    public function hasCalendarReference(CalendarReferrersInterface $node);
}
