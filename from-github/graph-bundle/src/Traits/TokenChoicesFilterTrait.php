<?php

namespace Jollyblume\Bundle\GraphBundle\Traits;

/**
 * TokenChoicesFilterTrait
 *
 * TokenChoicesFilterTrait implements methods to decode a filterString and use it to
 * select 0 or more Tokens from an array of Token choices.
 *
 * Tokens are case-sensitive. No normalization is performed on the token choices.
 */
trait TokenChoicesFilterTrait
{
    /**
     * Resolve a filterString into a selection of Token choices.
     *
     * filterString can remove or select Tokens, but not both. All Token choices
     * are selected if no selectRules are included, then removeRules are applied.
     *
     * Will emit an empty array when unexpected input is provided.
     *
     * resolveFilterString() is case-sensitive.
     *
     * @param string $filterString Select or remove rules
     * @param array $tokenChoices
     * @return array Possibly empty array of tokens selected from the tokenChoices
     */
    protected function resolveTokenChoices(string $filterString, array $tokenChoices) : array
    {
        if (empty($tokenChoices)) {
            // Invalid tokenChoices: empty
            return [];
        }

        $tokenChoicesString = strpos(implode('', $tokenChoices), '!');
        if (false !== $tokenChoicesString) {
            // Invalid tokenChoices: contains '!'
            return [];
        }

        if (empty($filterString)) {
            // No selectRules, select all tokenChoices
            return $tokenChoices;
        }

        $ruleTypes = [];
        $filterTokens = explode('|', $filterString);
        $isRemoveRule = null;
        $tokens = array_unique(array_map(
            function ($token) use (&$isRemoveRule, &$ruleTypes) {
                $isRemoveRule = ('!' === substr($token, 0, 1));
                $ruleTypes[] = $isRemoveRule;

                if ($isRemoveRule) {
                    // Remove '!'
                    $token = substr($token, 1);
                }

                // Normalized token
                return $token;
            },
            $filterTokens
        ));
        $ruleTypes = array_unique($ruleTypes);
        if (1 !== count($ruleTypes)) {
            // Invalid filterString: both selectRules and removeRules included
            return [];
        }

        // knownTokens will be in tokenChoices order
        $knownTokens = array_filter(
            $tokenChoices,
            function ($token) use ($tokens) {
                return in_array($token, $tokens);
            },
            false
        );
        if (count($knownTokens) !== count($tokens)) {
            // Invalid filterString: unknownTokens
            return [];
        }

        if ($isRemoveRule) {
            $knownTokens = array_filter(
                $tokenChoices,
                function ($token) use ($knownTokens) {
                    return !in_array($token, $knownTokens);
                },
                false
            );
        }

        return array_values($knownTokens);
    }
}
