<?php

namespace App\Collections;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;

/**
 * ComposedCollectionInterface.
 *
 * This is a wrapper around the Doctrine Collection interface to avoid using
 * Doctrine directly.
 *
 * The Doctrine Collection library is required by this library. CollectionInterface
 * is largely ceremonial.
 *
 * TODO lazy collection for deep queries
 */
interface ComposedCollectionInterface extends Collection, Selectable
{
}
