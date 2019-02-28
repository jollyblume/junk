<?php

namespace Jollyblume\Component\Graphing\Resolver;

trait FilterResolverTrait
{
    public function partitionFilter($filter, array $knownTokens, array &$unknownTokens = []) : array
    {
        // Partition $filter into removeRules and selectRules
        $removeRules = [];
        $selectRules = array_filter(
            is_array($filter) ? $filter : explode('|', $filter),
            function ($rule) use (&$removeRules) {
                $isRemoveRule = '!' === substr($rule, 0, 1);
                if (true === $isRemoveRule) {
                    $removeRules[] = substr($rule, 1);
                }
                return !$isRemoveRule;
            },
            false
        );
        // Remove $removeRules from $knownTokens
        $nbrKnownTokens = count($knownTokens);
        $knownTokens = array_diff($knownTokens, $removeRules);
        $leftoverRemoveRules = $nbrKnownTokens - count($removeRules) - count($knownTokens);
        if (0 != $leftoverRemoveRules) {
            throw new \Exception('invalid removeRule. Matching knownToken not found'); // FIXME
        }
        $selectedTokens = array_filter(
            $selectRules,
            function ($rule) use ($knownTokens, &$unknownTokens) {
                $isKnown = array_key_exists($rule, $knownTokens);
                if (!$isKnown) {
                    $unknownTokens[] = $rule;
                }
                return $isKnown;
            },
            false
        );
        return $selectedTokens;
    }
}
