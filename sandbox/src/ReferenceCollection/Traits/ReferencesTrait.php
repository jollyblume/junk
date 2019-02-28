<?php

namespace App\ReferenceCollection\Traits;

use App\ReferrerCollection\ReferrersInterface;
use App\Exception\ExceptionContext;
use App\Exception\OutOfScopeException;

trait ReferencesTrait
{
    /**
     * Get a possibly constrained list of references to other nodes.
     *
     * @param array
     *
     * @return array [nodeType]
     */
    public function getReferences(array $nodeTypes = []) {
        $types = $this->getAllowedReferences();
        if (empty($nodeTypes)) {
            $nodeTypes = $types;
        }

        $references = [];
        foreach ($nodeTypes as $nodeType) {
            if (!array_key_exists($nodeType, $types)) {
                // Invalid nodeType
                $references[$nodeType] = [];
                continue;
            }

            $method = sprintf('get%sReferences', $nodeType);
            $references[$nodeType] = $this->$method();
        }

        return $references;
    }

    private function assertReferenceMethodExists(ReferrersInterface $node) {
        $localTypes = $this->getAllowedReferences();
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
     * Add a reference to another node
     *
     * @param ReferrersInterface
     *
     * @return self
     */
    public function addReference(ReferrersInterface $node) {
        $this->assertReferenceMethodExists($node);

        $remoteNodeType = $node->getSemanticNodeType();
        $localAddMethod = sprintf('add%sReference', $remoteNodeType);
        $this->$localAddMethod($node);

        return $this;
    }

    /**
    * Remove a reference to another node.
    *
    * @param ReferrersInterface
    *
    * @return self
    */
    public function removeReference(ReferrersInterface $node) {
        $this->assertReferenceMethodExists($node);

        $remoteNodeType = $node->getSemanticNodeType();
        $localRemoveMethod = sprintf('remove%sReference', $remoteNodeType);
        $this->$localRemoveMethod($node);

        return $this;
    }

    /**
     * Test if a reference to another node exists.
     *
     * @param ReferrersInterface
     *
     * @return bool
     */
    public function hasReference(ReferrersInterface $node) {
        $this->assertReferenceMethodExists($node);

        $remoteNodeType = $node->getSemanticNodeType();
        $localHasMethod = sprintf('has%sReference', $remoteNodeType);
        return $this->$localHasMethod($node);
    }
}
