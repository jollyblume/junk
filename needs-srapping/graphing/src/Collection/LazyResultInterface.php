<?php

namespace Jollyblume\Component\Graphing\Collection;

use Closure;
use Jollyblume\Component\Graphing\Collection\LazyArrayCollection;

/**
 * LazyResultInterface
 *
 * Additional methods for CollectionInterface to support lazy collections.
 */
interface LazyResultInterface
{
    /**
     * Get a lazy filtered collection
     *
     * The lazy collection delays the filtering operation until first access.
     *
     * This can have unexpected results. The filtering will occur against the
     * state of the sourceCollection at the time of lazy initialization.
     *
     * The state of the sourceCollection is ignored when the lazy collection is
     * first instantiated. Creating a lazy collection will not effect the
     * initialization state of a sourceCollection until first access.
     *
     * @param Closure $predicate
     * @return LazyArrayCollection
     */
    public function lazyFilter(Closure $predicate) : LazyArrayCollection;

    /**
     * Get a lazy mapped collection
     *
     * The lazy collection delays the mapping operation until first use.
     *
     * This can have unexpected results. The mapping will occur against the
     * state of the sourceCollection at the time of initialization.
     *
     * The state of the sourceCollection is ignored when the lazy collection is
     * first instantiated. Creating a lazy collection will not effect the
     * initialization state of a sourceCollection.
     *
     * @param Closure $predicate
     * @return LazyArrayCollection
     */
    public function lazyMap(Closure $predicate) : LazyArrayCollection;
}
