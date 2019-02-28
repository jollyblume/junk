<?php

namespace App\ReferrerCollection;

use App\ReferenceCollection\PlayerReferencesInterface;
use App\Collections\ComposedCollectionInterface;

interface PlayerReferrersInterface extends ReferrersInterface
{
    /**
     * Get a collection of referrers from PlayerInterface implementations.
     *
     * @return ComposedCollectionInterface
     */
    public function getPlayerReferrers();

    /**
     * Add a referrer from a PlayerReferencesInterface.
     *
     * @param PlayerReferencesInterface
     *
     * @return self
     */
    public function addPlayerReferrer(PlayerReferencesInterface $node);

    /**
     * Remove a referrer from a PlayerReferencesInterface.
     *
     * @param PlayerReferencesInterface
     *
     * @return self
     */
    public function removePlayerReferrer(PlayerReferencesInterface $node);

    /**
     * Test if a referrer from a PlayerInterface exists.
     *
     * @param PlayerInterface
     *
     * @return bool
     */
    public function hasPlayerReferrer(PlayerInterface $node);
}
