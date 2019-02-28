<?php

namespace App\ReferrerCollection;

use App\ReferenceCollection\LocationReferencesInterface;
use App\Collections\ComposedCollectionInterface;

interface LocationReferrersInterface extends ReferrersInterface
{
    /**
     * Get a collection of referrers from LocationInterface implementations.
     *
     * @return ComposedCollectionInterface
     */
    public function getLocationReferrers();

    /**
     * Add a referrer from a LocationReferencesInterface.
     *
     * @param LocationReferencesInterface
     *
     * @return self
     */
    public function addLocationReferrer(LocationReferencesInterface $node);

    /**
     * Remove a referrer from a LocationReferencesInterface.
     *
     * @param LocationReferencesInterface
     *
     * @return self
     */
    public function removeLocationReferrer(LocationReferencesInterface $node);

    /**
     * Test if a referrer from a LocationInterface exists.
     *
     * @param LocationInterface
     *
     * @return bool
     */
    public function hasLocationReferrer(LocationInterface $node);
}
