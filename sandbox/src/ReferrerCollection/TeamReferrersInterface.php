<?php

namespace App\ReferrerCollection;

use App\ReferenceCollection\TeamReferencesInterface;
use App\Collections\ComposedCollectionInterface;

interface TeamReferrersInterface extends ReferrersInterface
{
    /**
     * Get a collection of referrers from TeamInterface implementations.
     *
     * @return ComposedCollectionInterface
     */
    public function getTeamReferrers();

    /**
     * Add a referrer from a TeamReferencesInterface.
     *
     * @param TeamReferencesInterface
     *
     * @return self
     */
    public function addTeamReferrer(TeamReferencesInterface $node);

    /**
     * Remove a referrer from a TeamReferencesInterface.
     *
     * @param TeamReferencesInterface
     *
     * @return self
     */
    public function removeTeamReferrer(TeamReferencesInterface $node);

    /**
     * Test if a referrer from a TeamInterface exists.
     *
     * @param TeamInterface
     *
     * @return bool
     */
    public function hasTeamReferrer(TeamInterface $node);
}
