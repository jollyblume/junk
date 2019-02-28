<?php

namespace App\ReferrerCollection;

use App\ReferenceCollection\MatchReferencesInterface;
use App\Collections\ComposedCollectionInterface;

interface MatchReferrersInterface extends ReferrersInterface
{
    /**
     * Get a collection of referrers from MatchInterface implementations.
     *
     * @return ComposedCollectionInterface
     */
    public function getMatchReferrers();

    /**
     * Add a referrer from a MatchReferencesInterface.
     *
     * @param MatchReferencesInterface
     *
     * @return self
     */
    public function addMatchReferrer(MatchReferencesInterface $node);

    /**
     * Remove a referrer from a MatchReferencesInterface.
     *
     * @param MatchReferencesInterface
     *
     * @return self
     */
    public function removeMatchReferrer(MatchReferencesInterface $node);

    /**
     * Test if a referrer from a MatchInterface exists.
     *
     * @param MatchInterface
     *
     * @return bool
     */
    public function hasMatchReferrer(MatchInterface $node);
}
