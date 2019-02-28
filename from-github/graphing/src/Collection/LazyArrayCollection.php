<?php

namespace Jollyblume\Component\Graphing\Collection;

use Closure;
use Doctrine\Common\Collections\AbstractLazyCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Jollyblume\Component\Graphing\Collection\CollectionInterface;
use Jollyblume\Component\Graphing\Collection\LazyArrayCollection;

/**
 * LazyArrayCollection
 *
 * A lazy collection to delay potentially expensive ArrayCollection methods,
 * such as filter, map, and matching until the collection is first used.
 *
 * TODO implement Selectable
 *
 * A Closure (collectionFactory), is used to create the internal collection and
 * a Collection instace can be provided to the collectionFactory during the
 * initialization process.
 *
 * The collectionFactory should emit an array or Doctrine Collection. ArrayCollection
 * is used internally, and collectionFactory() output will be converted, if it
 * does not implement at least the Doctrine Collection interface.
 *
 * lazyFilter() and lazyMap() return lazy collections that do not
 * trigger initialization of any source collections until first access.
 *
 * lazyMatch() has not been implemented, yet.
 */
class LazyArrayCollection extends AbstractLazyCollection implements CollectionInterface
{
    /**
     * @var Closure $collectionFactory Internal Collection initializer
     */
    private $collectionFactory;

    /**
     * @var CollectionInterface $sourceCollection Optional Collection to query
     */
    private $sourceCollection;

    /**
     * LazyArrayCollection Constructor
     *
     * Initialization of the collection occurs in doInitialize().
     *
     * Output from the collectionFactory is used to initialize the internal
     * Collection in doInitialize(). The collectionFactory can use the
     * sourceCollection, if provided.
     *
     * @param Closure $collectionFactory Internal Collection initializer.
     * @param Collection $sourceCollection Optional Collection to query.
     * @return void
     */
    public function __construct(Closure $collectionFactory, Collection $sourceCollection = null)
    {
        $this->collectionFactory = $collectionFactory;
        $this->sourceCollection = $sourceCollection;
    }

    /**
     * Initialize the internal Collection
     *
     * Executes $collectionFactory(), providing it with the sourceCollection, if
     * it was provided.
     *
     * The internal Collection will be cast to an ArrayCollection if the
     * collectionFactory emits anything that does not implement Collection.
     *
     * @return void
     */
    protected function doInitialize()
    {
        $collectionFactory = $this->collectionFactory;
        $sourceCollection = $this->sourceCollection;
        $elements = null === $sourceCollection ? $collectionFactory() : $collectionFactory($sourceCollection);

        if ($elements instanceof Collection) {
            // Use provided Collection
            $this->collection = $elements;
            return;
        }

        if (!is_array($elements)) {
            // Cast to array
            $elements = [$elements];
        }

        $collection = new ArrayCollection($elements);
        $this->collection = $collection;
    }

    /**
     * Get a lazy filtered collection
     *
     * The lazy collection delays the filtering operation until first use.
     *
     * This can have unexpected results. The filtering will occur against the
     * state of the sourceCollection at the time of initialization.
     *
     * The state of the sourceCollection is ignored when the lazy collection is
     * first instantiated. Creating a lazy collection will not effect the
     * initialization state of a sourceCollection.
     *
     * @param Closure $predicate
     * @return LazyArrayCollection
     */
    public function lazyFilter(Closure $predicate) : LazyArrayCollection
    {
        $collectionFactory = function ($sourceCollection) use ($predicate) {
            return $sourceCollection->filter($predicate);
        };

        $lazyCollection = new self($collectionFactory, $this);
        return $lazyCollection;
    }

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
    public function lazyMap(Closure $predicate) : LazyArrayCollection
    {
        $collectionFactory = function ($sourceCollection) use ($predicate) {
            return $sourceCollection->map($predicate);
        };

        $lazyCollection = new self($collectionFactory, $this);
        return $lazyCollection;
    }

    /**
     * Emit a string suitable for use as an array key
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__ . '@' . spl_object_hash($this);
    }
}
