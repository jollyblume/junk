<?php

namespace Jollyblume\Bundle\GraphBundle\Traits;

/**
 * GetClassnameTrait
 *
 * GetClassnameTrait implements a method to return the classname of an object
 * instance or classname.
 *
 * Allows methods to accept either when a classname is required.
 */
trait GetClassnameTrait
{
    /**
     * Helper to return Classname of either an object instance or a classname string.
     *
     * @param object|string
     * @return string The classname
     */
    public function getClassname($classOrInstance) : string
    {
        $classname = is_object($classOrInstance) ? get_class($classOrInstance) : (string) $classOrInstance;
        return $classname;
    }
}
