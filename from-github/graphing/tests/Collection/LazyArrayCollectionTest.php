<?php

namespace Jollyblume\Component\Tests\Graphing\Traits;

use Closure;
use Jollyblume\Component\Graphing\Collection\LazyArrayCollection;
use Doctrine\Common\Collections\ArrayCollection;

class LazyArrayCollectionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Get a test object for unit testing Closure results
     *
     * @param array $elements A array fixture
     * @return class@anonymous
     */
    protected function getUser(array $elements)
    {
        /**
         * Test class to get a lazy collection with various Closure results
         *
         * A lazy collection will accept any Closure result and will cast it
         * a Collection internally, if required.
         */
        $user = new class($elements) {
            /**
             * @var array $elements Array to provide lazy methods for
             */
            private $elements;

            /**
             * @param array $elements A test array of elements
             */
            public function __construct(array $elements)
            {
                $this->elements = $elements;
            }

            /**
             * Get a lazy collection when the Closure returns an array
             *
             * The Closure will not be executed until the first access to the
             * lazy collection.
             *
             * The elements will be in their state from when the lazy collection
             * was created.
             *
             * @param Closure $predicate array_filter function
             * @return LazyArrayCollection
             */
            public function getLazyFilterArray(Closure $predicate) : LazyArrayCollection
            {
                $elements = $this->elements;
                $lazyMethod = function () use ($elements, $predicate) {
                    $collection = array_filter($elements, $predicate);
                    return $collection;
                };
                $lazyCollection = new LazyArrayCollection($lazyMethod);
                return $lazyCollection;
            }

            /**
             * Get a lazy collection when the Closure returns a Collection
             *
             * The Closure will not be executed until the first access to the
             * lazy collection.
             *
             * The elements will be in their state from when the lazy collection
             * was created.
             *
             * @param Closure $predicate array_filter function
             * @return LazyArrayCollection
             */
            public function getLazyFilterCollection(Closure $predicate) : LazyArrayCollection
            {
                $elements = $this->elements;
                $lazyMethod = function () use ($elements, $predicate) {
                    $collection = array_filter($elements, $predicate);
                    return new ArrayCollection($collection);
                };
                $lazyCollection = new LazyArrayCollection($lazyMethod);
                return $lazyCollection;
            }

            /**
             * Get a lazy collection of elements when Closure returns a string
             *
             * Anything that not an array or Collection is converted into a
             * single element array. For instanct, returning an Exception from
             * the Closure would wrap the Exception in an array and return an
             * array with the Exception as index 0.
             *
             * The Closure will not be executed until the first access to the
             * lazy collection.
             *
             * The elements will be in their state from when the lazy collection
             * was created.
             *
             * @param Closure $predicate array_filter function
             * @return LazyArrayCollection
             */
            public function getLazyFilterString() : LazyArrayCollection
            {
                $elements = array_values($this->elements);
                $lazyMethod = function () use ($elements) {
                    $collection = $elements[0];
                    return $collection;
                };
                $lazyCollection = new LazyArrayCollection($lazyMethod);
                return $lazyCollection;
            }
        };
        return $user;
    }

    /**
     * Assert collectionFactory() can emit an array
     */
    public function testLazyFilterAsArray()
    {
        $elements = [
            2 => 'goodToken',
            8 => 'badToken',
            22 => 'redToken',
            99 => 'blueToken'
        ];
        $user = $this->getUser($elements);
        $predicate = function ($value) {
            return 'badToken' === $value;
        };
        $collection = $user->getLazyFilterArray($predicate);
        $this->assertEquals(
            [8 => 'badToken'],
            $collection->toArray(),
            'LazyArrayCollection::doInitialize() must support a collectionFactory() that emits an array'
        );
    }

    /**
     * Assert collectionFactory() can emit a Doctrine ArrayCollection
     */
    public function testLazyFilterAsCollection()
    {
        $elements = [
            2 => 'goodToken',
            8 => 'badToken',
            22 => 'redToken',
            99 => 'blueToken'
        ];
        $user = $this->getUser($elements);
        $predicate = function ($value) {
            return 'badToken' === $value;
        };
        $collection = $user->getLazyFilterCollection($predicate);
        $this->assertEquals(
            [8 => 'badToken'],
            $collection->toArray(),
            'LazyArrayCollection::doInitialize() must support a collectionFactory() that emits a Doctrine ArrayCollection'
        );
    }

    /**
     * Assert collectionFactory() can emit a string
     */
    public function testLazyFilterAsString()
    {
        $elements = [
            2 => 'goodToken',
            8 => 'badToken',
            22 => 'redToken',
            99 => 'blueToken'
        ];
        $user = $this->getUser($elements);
        $collection = $user->getLazyFilterString();
        $this->assertEquals(
            [0 => 'goodToken'],
            $collection->toArray(),
            'LazyArrayCollection::doInitialize() must support a collectionFactory() that emits a string'
        );
    }

    /**
     * Assert lazy collection is not initialized after instantiation.
     */
    public function testNotInitializedAfterConstruction()
    {
        $elements = [
            2 => 'goodToken',
            8 => 'badToken',
            22 => 'redToken',
            99 => 'blueToken'
        ];
        $user = $this->getUser($elements);
        $predicate = function ($value) {
            return 'badToken' === $value;
        };
        $collection = $user->getLazyFilterCollection($predicate);
        $this->assertFalse(
            $collection->isInitialized(),
            'LazyArrayCollection::isInitialized() must be FALSE after instantiation'
        );
    }

    /**
     * Assert lazy collection is initialized after first use.
     */
    public function testInitializedAfterFirstUse()
    {
        $elements = [
            2 => 'goodToken',
            8 => 'badToken',
            22 => 'redToken',
            99 => 'blueToken'
        ];
        $user = $this->getUser($elements);
        $predicate = function ($value) {
            return 'badToken' === $value;
        };
        $collection = $user->getLazyFilterCollection($predicate);
        $collection->count(); // Use the lazy collection
        $this->assertTrue(
            $collection->isInitialized(),
            'LazyArrayCollection::isInitialized() must be TRUE after first use'
        );
    }

    /**
     * Assert __toString emits a sortable object name.
     */
    public function testToString()
    {
        $elements = [
            2 => 'goodToken',
            8 => 'badToken',
            22 => 'redToken',
            99 => 'blueToken'
        ];
        $user = $this->getUser($elements);
        $predicate = function ($value) {
            return 'badToken' === $value;
        };
        $collection = $user->getLazyFilterCollection($predicate);
        $this->assertEquals(
            get_class($collection) . '@' . spl_object_hash($collection),
            strval($collection),
            'LazyArrayCollection::__toString() must emit __CLASS__ . \'@spl_object_hash()\''
        );
    }

    /**
     * Assert lazyFilter() does not trigger initialization of a lazy source collection
     */
    public function testLazyFilterNotTriggerSourceCollectionInitialization()
    {
        $elements = [
            2 => 'goodToken',
            8 => 'badToken',
            22 => 'redToken',
            99 => 'blueToken'
        ];
        $user = $this->getUser($elements);
        $sourcePredicate = function ($value) {
            return 'badToken' === $value || 'blueToken' === $value;
        };
        $sourceCollection = $user->getLazyFilterCollection($sourcePredicate);
        $finalPredicate = function ($value) {
            return 'badToken' === $value;
        };
        $sourceCollection->lazyFilter($finalPredicate);
        $this->assertFalse(
            $sourceCollection->isInitialized(),
            'LazyArrayCollection::lazyFilter() must  NOT trigger initialization of a lazy source collection'
        );
    }

    /**
    * Assert lazyFilter() emits a filtered collection
    */
    public function testSecondLazyFilterHasExpectedResult()
    {
        $elements = [
            2 => 'goodToken',
            8 => 'badToken',
            22 => 'redToken',
            99 => 'blueToken'
        ];
        $user = $this->getUser($elements);
        $sourcePredicate = function ($value) {
            return 'badToken' === $value || 'blueToken' === $value;
        };
        $sourceCollection = $user->getLazyFilterCollection($sourcePredicate);
        $finalPredicate = function ($value) {
            return 'badToken' === $value;
        };
        $finalCollection = $sourceCollection->lazyFilter($finalPredicate);
        $this->assertEquals(
            [8 => 'badToken'],
            $finalCollection->toArray(),
            'LazyArrayCollection::lazyFilter() must  emit expected results for final collection'
        );
    }

    /**
     * Assert lazyFilter() emits a filtered collection
     */
    public function testSecondLazyMapHasExpectedResult()
    {
        $elements = [
            2 => 'goodToken',
            8 => 'badToken',
            22 => 'redToken',
            99 => 'blueToken'
        ];
        $user = $this->getUser($elements);
        $sourcePredicate = function ($value) {
            return 'badToken' === $value || 'blueToken' === $value;
        };
        $sourceCollection = $user->getLazyFilterCollection($sourcePredicate);
        $finalPredicate = function ($value) {
            return $value . 'Mapped';
        };
        $finalCollection = $sourceCollection->lazyMap($finalPredicate);
        $this->assertEquals(
            [
                8 => 'badTokenMapped',
                99 => 'blueTokenMapped',
            ],
            $finalCollection->toArray(),
            'LazyArrayCollection::lazyFilter() must  NOT trigger initialization of a lazy source collection'
        );
    }
}
