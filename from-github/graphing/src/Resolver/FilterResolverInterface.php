<?php

namespace Jollyblume\Component\Graphing\Resolver;

/**
 * FilterResolverInterface
 *
 * Methods used by a Node to resolve filters into a working set of Tokens.
 *
 * QUESTION Are filterResolvers individual traits?
 */
interface FilterResolverInterface
{
    public function partitionFilter($filter, array $knownTokens, array &$unknownTokens = []) : array;
}
