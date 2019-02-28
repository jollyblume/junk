<?php

namespace App\Collections;

use App\Exception\ExceptionContext;
use App\Exception\OutOfScopeException;

trait SemanticCollectionTrait
{
    private function getAccessorMap()
    {
        $accessorMap = [
            'addChild' => 'add%sNode',
            'hasChild' => 'has%sNode',
            'hasChildKey' => 'has%sName',
            'removeChild' => 'remove%sNode',
            'removeChildKey' => 'remove%sName',
            'getChild' => 'get%sNode',
            'setChild' => 'set%sNode',
        ];

        return $accessorMap;
    }

    /**
     * Get the AccessorMap sprintf template.
     *
     * @param string
     *
     * @throws OutOfScopeException
     *
     * @return string
     */
    private function getAccessorMethodTemplate(string $templateName)
    {
        $accessorMap = $this->getAccessorMap();

        if (!array_key_exists($templateName, $accessorMap)) {
            $context = new ExceptionContext(
                'exception.outofscopeexception',
                sprintf('invalid template name "%s". use: %s', $templateName, join(', ', array_keys($accessorMap)))
            );

            throw new OutOfScopeException($context);
        }

        return $accessorMap[$templateName];
    }

    /**
     * Compute method name.
     *
     * Inserts the semantic node type into accessors, so implementation methods
     * in this class have a single method that handles each type of accessor.
     *
     * @param string
     *
     * @throws OutOfScopeException
     *
     * @return string Method name requested (ie: addPlayerNode)
     */
    public function getSemanticMethodName(string $templateName)
    {
        $template = $this->getAccessorMethodTemplate($templateName);
        $nodeType = $this->getSemanticNodeType();
        $methodName = sprintf($template, $nodeType);

        return $methodName;
    }
}
