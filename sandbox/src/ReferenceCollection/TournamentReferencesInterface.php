<?php

namespace App\ReferenceCollection;

use App\ReferrerCollection\TournamentReferrersInterface;
use App\Collections\ComposedCollectionInterface;

interface TournamentReferencesInterface extends ReferencesInterface
{
    /**
     * Get the TournamentReferrersInterface collection.
     *
     * @return ComposedCollectionInterface
     */
    public function getTournamentReferences();

    /**
     * Add a reference.
     *
     * @param TournamentReferrersInterface
     *
     * @return self
     */
    public function addTournamentReference(TournamentReferrersInterface $node);

    /**
     * Remove a reference to a TournamentInterface.
     *
     * @param TournamentReferrersInterface
     *
     * @return self
     */
    public function removeTournamentReference(TournamentReferrersInterface $node);

    /**
     * Test if a reference to a TournamentInterface exists.
     *
     * @param TournamentReferrersInterface
     *
     * @return bool
     */
    public function hasTournamentReference(TournamentReferrersInterface $node);
}
