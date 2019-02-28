<?php

namespace App\Store;

use App\Model\ParentNodeInterface;

/**
 * StoreInterface.
 *
 * Defines methods for a NodeInterface to add arbitrary data Documents to
 * a ParentNodeInterface and the accessors needed to used them.
 *
 * Mostly, this is used by NodeInterface implementations to add collections of
 * other NodeInterface implementations easily.
 *
 * For each StoreInterface extension, a Bag will be added to the NodeInterface
 * that can store a specific NodeInterface implementation.
 *
 * For instance, if a TournamentInterface needs to have MatchInterface children,
 * a MatchBag will be added to the TournamentInterface children. The methods
 * added to the TournamentInterface are accessors for the MatchInterface
 * children in the bag.
 *
 * StoreInterface extends CookieStoreInterface, which is a generic extension
 * point for external interfaces.
 */
interface StoreInterface extends ParentNodeInterface, CookieStoreInterface
{
}
