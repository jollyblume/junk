<?php

namespace App\ReferenceCollection;

use App\ReferrerCollection\LeagueReferrersInterface;
use App\Collections\ComposedCollectionInterface;

interface LeagueReferencesInterface extends ReferencesInterface
{
    /**
     * Get the LeagueReferrersInterface collection.
     *
     * @return ComposedCollectionInterface
     */
    public function getLeagueReferences();

    /**
     * Add a reference.
     *
     * @param LeagueReferrersInterface
     *
     * @return self
     */
    public function addLeagueReference(LeagueReferrersInterface $node);

    /**
     * Remove a reference.
     *
     * @param LeagueReferrersInterface
     *
     * @return self
     */
    public function removeLeagueReference(LeagueReferrersInterface $node);

    /**
     * Test if a reference exists.
     *
     * @param LeagueReferrersInterface
     *
     * @return bool
     */
    public function hasLeagueReference(LeagueReferrersInterface $node);
}
