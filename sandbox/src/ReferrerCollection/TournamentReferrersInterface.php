<?php

namespace App\ReferrerCollection;

use App\ReferenceCollection\TournamentReferencesInterface;
use App\Collections\ComposedCollectionInterface;

interface TournamentReferrersInterface extends ReferrersInterface
{
    /**
     * Get a collection of referrers from TournamentInterface implementations.
     *
     * @return ComposedCollectionInterface
     */
    public function getTournamentReferrers();

    /**
     * Add a referrer from a TournamentReferencesInterface.
     *
     * @param TournamentReferencesInterface
     *
     * @return self
     */
    public function addTournamentReferrer(TournamentReferencesInterface $node);

    /**
     * Remove a referrer from a TournamentReferencesInterface.
     *
     * @param TournamentReferencesInterface
     *
     * @return self
     */
    public function removeTournamentReferrer(TournamentReferencesInterface $node);

    /**
     * Test if a referrer from a TournamentInterface exists.
     *
     * @param TournamentInterface
     *
     * @return bool
     */
    public function hasTournamentReferrer(TournamentInterface $node);
}
