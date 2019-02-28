<?php

namespace App\ReferrerCollection;

use App\ReferenceCollection\LeagueReferencesInterface;
use App\Collections\ComposedCollectionInterface;

interface LeagueReferrersInterface extends ReferrersInterface
{
    /**
     * Get a collection of referrers from LeagueInterface implementations.
     *
     * @return ComposedCollectionInterface
     */
    public function getLeagueReferrers();

    /**
     * Add a referrer from a LeagueReferencesInterface.
     *
     * @param LeagueReferencesInterface
     *
     * @return self
     */
    public function addLeagueReferrer(LeagueReferencesInterface $node);

    /**
     * Remove a referrer from a LeagueReferencesInterface.
     *
     * @param LeagueReferencesInterface
     *
     * @return self
     */
    public function removeLeagueReferrer(LeagueReferencesInterface $node);

    /**
     * Test if a referrer from a LeagueInterface exists.
     *
     * @param LeagueInterface
     *
     * @return bool
     */
    public function hasLeagueReferrer(LeagueInterface $node);
}
