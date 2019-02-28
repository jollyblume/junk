<?php

namespace App\ReferenceCollection;

use App\ReferrerCollection\TeamReferrersInterface;
use App\Collections\ComposedCollectionInterface;

interface TeamReferencesInterface extends ReferencesInterface
{
    /**
     * Get the TeamReferrersInterface collection.
     *
     * @return ComposedCollectionInterface
     */
    public function getTeamReferences();

    /**
     * Add a reference.
     *
     * @param TeamReferrersInterface
     *
     * @return self
     */
    public function addTeamReference(TeamReferrersInterface $node);

    /**
     * Remove a reference.
     *
     * @param TeamReferrersInterface
     *
     * @return self
     */
    public function removeTeamReference(TeamReferrersInterface $node);

    /**
     * Test if a reference exists.
     *
     * @param TeamReferrersInterface
     *
     * @return bool
     */
    public function hasTeamReference(TeamReferrersInterface $node);
}
