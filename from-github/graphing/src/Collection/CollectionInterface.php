<?php

namespace Jollyblume\Component\Graphing\Collection;

use Closure;
use Doctrine\Common\Collections\Collection;
use Jollyblume\Component\Graphing\Collection\LazyResultInterface;

/**
 * CollectionInterface
 *
 * This is a wrapper around the Doctrine Collection interface to avoid using
 * Doctrine directly.
 *
 * The Doctrine Collection library is required by this library. CollectionInterface
 * is largely ceremonial.
 *
 * TODO extend Selectable
 */
interface CollectionInterface extends Collection, LazyResultInterface
{
}
