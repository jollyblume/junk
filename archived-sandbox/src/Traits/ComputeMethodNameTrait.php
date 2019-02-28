<?php

namespace App\Traits;

use App\Exception\ExceptionContext;
use App\Exception\OutOfScopeException;

trait ComputeMethodNameTrait
{
<<<<<<< HEAD
<<<<<<< HEAD
    /**
     * Get the class AccessorMap
     *
     * AccessorMap maps template names to a sprintf template, for instance:
     *   $AccessorMap = [
     *      'addNode' => 'add%sNode',
     *      'hasNode' => 'has%sNode',
     *      'hasName' => 'has%sNode',
     *      'removeNode' => 'remove%sNode',
     *      'removeName' => 'remove%sNode',
     *      'getNode' => 'get%sNode',
     *   ];
     *
     *   where %s will be replaced by getNodeType().
     *
     * @return array
     */
    abstract public function getAccessorMap();

    /**
     * Get the Node Type
     *
     * @return string
     */
    abstract public function getNodeType();
=======
    private function getAccessorMap() {
=======
    private function getAccessorMap()
    {
>>>>>>> move-collection-to-children
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
>>>>>>> move-collection-to-children

    /**
     * Get the AccessorMap sprintf template.
     *
     * @param string
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

        if (null === $accessorMap) {
            $context = new ExceptionContext(
                'exception.unexpectednullexception',
                'Null Accessor Map: ' . __METHOD__
            );

            throw new UnexpectedNullException($context);
        }

        return $accessorMap[$templateName];
    }

    /**
     * Compute method name.
     *
     * Inserts the getNodeType() into accessors, so the implementation methods
     * in this class have a single method that handles each type of accessor.
     *
     * @param string
     *
     * @throws OutOfScopeException
     *
     * @return string Method name requested (ie: addPlayerNode)
     */
    public function computeMethodName(string $templateName)
    {
        $template = $this->getAccessorMethodTemplate($templateName);
        $nodeType = $this->getNodeType();
        $methodName = sprintf($template, $nodeType);

        return $methodName;
    }
}
