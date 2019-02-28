<?php

namespace App\ReferenceCollection;

use App\ReferrerCollection\MatchReferrersInterface;
use App\Collections\ComposedCollectionInterface;

interface MatchReferencesInterface extends ReferencesInterface
{
    /**
     * Get the MatchReferrersInterface collection.
     *
     * @return ComposedCollectionInterface
     */
    public function getMatchReferences();

    /**
     * Add a reference.
     *
     * @param MatchReferrersInterface
     *
     * @return self
     */
    public function addMatchReference(MatchReferrersInterface $node);

    /**
     * Remove a reference.
     *
     * @param MatchReferrersInterface
     *
     * @return self
     */
    public function removeMatchReference(MatchReferrersInterface $node);

    /**
     * Test if a reference exists.
     *
     * @param MatchReferrersInterface
     *
     * @return bool
     */
    public function hasMatchReference(MatchReferrersInterface $node);
}
