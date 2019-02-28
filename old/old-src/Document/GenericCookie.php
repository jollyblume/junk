<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Document\Traits\PhpcrNodeTrait;
use App\Exception\ExceptionContext;
use App\Exception\NoSuchPropertyException;

/**
 * GenericCookie.
 *
 * Implements CookieInterface and can be used as a concrete Cookie Node for
 * system's using Source Nodes with simple needs.
 *
 * It implements a simple array-based property bag, where keys and values must
 * be strings.
 *
 * If a Team wanted to track some important data related to a Players'
 * membership on the team, they could used this Cookie Node for the purpose.
 *
 * @PHPCR\Document(isLeaf=true)
 */
class GenericCookie implements CookieInterface
{
    use PhpcrNodeTrait;

    /*
     * Value/Property array
     *
     * @var array $properties
     * @PHPCR\Field(type="string", assoc="propertyValues")
     */
    private $properties = [];

    /**
     * Get the properties array.
     *
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Clear and set all properties.
     *
     * @param array $properties
     *
     * @return self
     */
    public function setProperties(array $properties)
    {
        $this->properties = [];
        foreach ($properties as $property => $value) {
            $this->addProperty($property, $value);
        }

        return $this;
    }

    /**
     * Check if cookie has a property.
     *
     * @return bool
     */
    public function hasProperty(string $property)
    {
        $properties = $this->properties;

        return array_key_exists($property, $properties);
    }

    /**
     * Add a property or over-write an existing property.
     *
     * @param string $property
     * @param string $value    default: ''
     *
     * @return self
     */
    public function addProperty(string $property, string $value = '')
    {
        $this->properties[$property] = $value;

        return $this;
    }

    /**
     * Remove a property.
     *
     * @param string $property
     *
     * @return string Original value
     */
    public function removeProperty(string $property)
    {
        if (!$this->hasProperty($property)) {
            $context = new ExceptionContext(
                'exception.nosuchproperty',
                'Property does not exist'
            );

            throw new NoSuchPropertyException($context);
        }

        $value = $this->properties[$property];
        unset($this->properties[$property]);

        return $value;
    }

    /**
     * Get the value of a property.
     *
     * @param string $property
     *
     * @return string value
     */
    public function getProperty(string $property)
    {
        if (!$this->hasProperty($property)) {
            $context = new ExceptionContext(
                'exception.nosuchproperty',
                'Property does not exist'
            );

            throw new NoSuchPropertyException($context);
        }

        $properties = $this->properties;

        return $properties[$property];
    }

    /**
     * Set the value of a property.
     *
     * @param string $property
     * @param string value
     *
     * @throws NoSuchPropertyException
     *
     * @return self
     */
    public function setProperty(string $property, string $value)
    {
        if (!$this->hasProperty($property)) {
            $context = new ExceptionContext(
                'exception.nosuchproperty',
                'Property does not exist'
            );

            throw new NoSuchPropertyException($context);
        }

        $this->properties[$property] = $value;

        return $this;
    }
}
