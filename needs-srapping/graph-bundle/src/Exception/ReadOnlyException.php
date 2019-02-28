<?php

namespace Jollyblume\Bundle\GraphBundle\Exception;

use Jollyblume\Bundle\GraphBundle\Exception\GraphException;

/**
 * ReadOnlyException
 *
 * ReadOnlyException is thrown for writing to read-only properties
 */
class ReadOnlyException extends GraphException
{
}
