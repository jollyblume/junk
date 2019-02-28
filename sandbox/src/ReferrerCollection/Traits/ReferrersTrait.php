<?php

namespace App\ReferrerCollection\Traits;

use App\ReferenceCollection\ReferencesInterface;
use App\Exception\ExceptionContext;
use App\Exception\OutOfScopeException;

trait ReferrersTrait
{
    /**
     * Get a possibly constrained list of references from other nodes.
     *
     * @param array
     *
     * @return array [nodeType]
     */
    public function getReferrers(array $nodeTypes = []) {
        $types = $this->getAllowedReferrers();
        if (empty($nodeTypes)) {
            $nodeTypes = $types;
        }

        $referrers = [];
        foreach ($nodeTypes as $nodeType) {
            if (!array_key_exists($nodeType, $types)) {
                // Invalid nodeType
                $referrers[$nodeType] = [];
                continue;
            }

            $method = sprintf('get%sReferrers', $nodeType);
            $referrers[$nodeType] = $this->$method();
        }

        return $referrers;
    }

    private function assertReferrerMethodExists(ReferencesInterface $node) {
        $localTypes = $this->getAllowedReferrers();
        $remoteNodeType = $node->getSemanticNodeType();
        if (!array_key_exists($remoteNodeType, $localTypes)) {
            $context = new ExceptionContext(
                'exception.outofscope',
                'Unsupported nodeType'
            );

            throw new OutOfScopeException($context);
        }
    }

    /**
     * Add a reference from another node
     *
     * @param ReferencesInterface
     *
     * @throws OutOfScopeException
     *
     * @return self
     */
    public function addReferrer(ReferencesInterface $node) {
        $this->assertReferrerMethodExists($node);

        $remoteNodeType = $node->getSemanticNodeType();
        $localAddMethod = sprintf('add%sReferrer', $remoteNodeType);
        $this->$localAddMethod($node);

        return $this;
    }

    /**
     * Remove a reference from another node.
     *
     * @param ReferencesInterface
     *
     * @return self
     */
    public function removeReferrer(ReferencesInterface $node) {
        $this->assertReferrerMethodExists($node);

        $remoteNodeType = $node->getSemanticNodeType();
        $localRemoveMethod = sprintf('remove%sReferrer', $remoteNodeType);
        $this->$localRemoveMethod($node);

        return $this;
    }

    /**
     * Test if a reference from another node exists.
     *
     * @param ReferencesInterface
     *
     * @return bool
     */
    public function hasReferrer(ReferencesInterface $node) {
        $this->assertReferrerMethodExists($node);

        $remoteNodeType = $node->getSemanticNodeType();
        $localhasMethod = sprintf('has%sReferrer', $remoteNodeType);
        return $this->$localhasMethod($node);
    }
}
