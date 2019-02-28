<?php

namespace App\ReferenceCollection;

use App\ReferrerCollection\PlayerReferrersInterface;
use App\Collections\ComposedCollectionInterface;

interface PlayerReferencesInterface extends ReferencesInterface
{
    /**
     * Get a the PlayerReferrersInterface collection.
     *
     * @return ComposedCollectionInterface
     */
    public function getPlayerReferences();

    /**
     * Add a reference.
     *
     * @param PlayerReferrersInterface
     *
     * @return self
     */
    public function addPlayerReference(PlayerReferrersInterface $node);

    /**
     * Remove a reference.
     *
     * @param PlayerReferrersInterface
     *
     * @return self
     */
    public function removePlayerReference(PlayerReferrersInterface $node);

    /**
     * Test if a reference exists.
     *
     * @param PlayerReferrersInterface
     *
     * @return bool
     */
    public function hasPlayerReference(PlayerReferrersInterface $node);
}
