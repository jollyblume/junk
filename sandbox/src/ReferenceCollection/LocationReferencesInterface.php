<?php

namespace App\ReferenceCollection;

use App\ReferrerCollection\LocationReferrersInterface;
use App\Collections\ComposedCollectionInterface;

interface LocationReferencesInterface extends ReferencesInterface
{
    /**
     * Get the LocationReferrersInterface collection.
     *
     * @return ComposedCollectionInterface
     */
    public function getLocationReferences();

    /**
     * Add a reference.
     *
     * @param LocationReferrersInterface
     *
     * @return self
     */
    public function addLocationReference(LocationReferrersInterface $node);

    /**
     * Remove a reference.
     *
     * @param LocationReferrersInterface
     *
     * @return self
     */
    public function removeLocationReference(LocationReferrersInterface $node);

    /**
     * Test if a reference exists.
     *
     * @param LocationReferrersInterface
     *
     * @return bool
     */
    public function hasLocationReference(LocationReferrersInterface $node);
}
