<?php

namespace OldApp\Traits;

use Closure;
use App\NodeTypeInterface;
use App\Exception\ExceptionContext;
use App\Exception\PropImmutableException;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

trait ComposedCollectionTrait
{
    /**
     * Get the composed collection.
     *
     * @return ArrayCollection
     */
    abstract protected function getComposedCollection();

    /**
     * Select the method name of the accessor.
     *
     * @param string
     *
     * @return string
     */
    protected function selectAccessorMethodName(string $templateName)
    {
        $methodName = $templateName;
        if ($this instanceof NodeTypeInterface) {
            $methodName = $this->computeMethodName($templateName);
        }

        return $methodName;
    }

    /**
     * {@inheritdoc}
     */
    public function first()
    {
        return $this->getComposedCollection()->first();
    }

    /**
     * {@inheritdoc}
     */
    public function last()
    {
        return $this->getComposedCollection()->last();
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->getComposedCollection()->key();
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        return $this->getComposedCollection()->next();
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return $this->getComposedCollection()->current();
    }

    /**
     * {@inheritdoc}
     */
    public function remove($key)
    {
        $method = $this->selectAccessorMethodName('removeChildKey');

        return $this->$method($key);
    }

    /**
     * {@inheritdoc}
     */
    public function removeElement($element)
    {
        $method = $this->selectAccessorMethodName('removeChild');

        return $this->$method($element);
    }

    /**
     * Required by interface ArrayAccess.
     *
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        $method = $this->selectAccessorMethodName('hasChildKey');

        return $this->$method($offset);
    }

    /**
     * Required by interface ArrayAccess.
     *
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        $method = $this->selectAccessorMethodName('getChild');

        return $this->$method($offset);
    }

    /**
     * Required by interface ArrayAccess.
     *
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $method = $this->selectAccessorMethodName('setChild');

        return $this->$method($offset, $value);
    }

    /**
     * Required by interface ArrayAccess.
     *
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        $method = $this->selectAccessorMethodName('removeChildKey');

        return $this->$method($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function containsKey($key)
    {
        $method = $this->selectAccessorMethodName('hasChildKey');

        return $this->$method($key);
    }

    /**
     * {@inheritdoc}
     */
    public function contains($element)
    {
        $method = $this->selectAccessorMethodName('hasChild');

        return $this->$method($element);
    }

    /**
     * {@inheritdoc}
     */
    public function indexOf($element)
    {
        return $this->getComposedCollection()->indexOf($element);
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        $method = $this->selectAccessorMethodName('getChild');

        return $this->$method($key);
    }

    /**
     * {@inheritdoc}
     */
    public function getKeys()
    {
        return $this->getComposedCollection()->getKeys();
    }

    /**
     * {@inheritdoc}
     */
    public function getValues()
    {
        return $this->getComposedCollection()->getValues();
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return $this->getComposedCollection()->count();
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        return $this->setChild($key, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function add($element)
    {
        $method = $this->selectAccessorMethodName('addChild');

        return $this->$method($element);
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return $this->getComposedCollection()->isEmpty();
    }

    /**
     * Required by interface IteratorAggregate.
     *
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return $this->getComposedCollection()->getIterator();
    }

    /**
     * {@inheritdoc}
     */
    public function exists(Closure $predicate)
    {
        return $this->getComposedCollection()->exists($predicate);
    }

    /**
     * {@inheritdoc}
     *
     * @return static
     */
    public function map(Closure $func)
    {
        return $this->getComposedCollection()->map($func);
    }

    /**
     * {@inheritdoc}
     *
     * @return static
     */
    public function filter(Closure $predicate)
    {
        return $this->getComposedCollection()->filter($predicate);
    }

    /**
     * {@inheritdoc}
     */
    public function forAll(Closure $predicate)
    {
        return $this->getComposedCollection()->forAll($predicate);
    }

    /**
     * {@inheritdoc}
     */
    public function partition(Closure $predicate)
    {
        return $this->getComposedCollection()->partition($predicate);
    }

    /**
     * Returns a string representation of this object.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getComposedCollection()->__toString();
    }

    /**
     * {@inheritdoc}
     */
    public function slice($offset, $length = null)
    {
        return $this->getComposedCollection()->slice($offset, $length);
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return $this->getComposedCollection()->toArray();
    }

    /**
     * {@inheritdoc}
     */
    public function matching(Criteria $criteria)
    {
        return $this->getComposedCollection()->matching($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $context = new ExceptionContext(
            'exception.propimmutable',
            'unable to clear'
        );

        throw new PropImmutableException($context);
    }
}
